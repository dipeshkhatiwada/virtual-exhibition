<?php
namespace App\Http\Controllers\employer;

use App\Employers;
use App\EmployerUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\EmployerAddress;
use App\EmployerContactPerson;
use App\EmployerHead;
use App\OrganizationType;
use App\Size;
use App\Ownership;
use App\MemberType;
use App\Saluation;
use App\Imagetool;
use Image;
use File;
use App\Jobs;
use App\RecruitmentProcess;
use App\JobRequirements;
use App\JobLocation;
use App\JobForm;
use App\JobEducations;
use App\JobExperiences;
use App\Employees;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeLanguage;
use App\EmployeeReference;
use App\EmployeeTraining;
use App\EmployeeCategory;
use Carbon\Carbon;
use App\JobType;
use App\JobPrice;
use App\library\Settings;
use App\library\myFunctions;
use App\UpgradeRequest;
use Mail;
use App\Layout;
use App\JobCategory;
use App\JobApply;
use App\library\ApplicationExport;
use Excel;
use App\JobProcess;
use App\Project;
use App\Training;
use App\Event;
use App\Tender;
use App\TenderFunctionType;
use App\TenderType;
use App\EmployeeActivity;
use App\JobTypeOffer;
use App\MemberTypeOffer;
use App\ReferenceComment;
use App\Payments;
use App\PivotEmployerPaymentMethod;


class EmployerController extends Controller
{
  protected $has_filter = false;
    public function __construct()
    {
        $this->middleware('employer');
    }
     public function dashboard(Request $request)
    {
         $config = array(
          'app.meta_title' => 'Employer Complete Profile',
          'app.meta_keyword' => 'Employer Complete Profile',
          'app.meta_description' => 'Employer Complete Profile',
          'app.meta_image' => '',
          'app.meta_url' => url('/employer/'),
          'app.meta_type' => 'Employer Dashboard',

      );




         config($config);

         $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();
         if($employer->last_login == '')
            {

             return redirect('employer/feditprofile');
          }

          $pr = 0;
          if($employer->org_type != 0)
          {
            $pr += 1;
          }
           if($employer->ownership != 0)
          {
            $pr += 1;
          }
           if($employer->logo != '')
          {
            $pr += 1;
          }
           if($employer->banner != '')
          {
            $pr += 1;
          }
           if($employer->description != '')
          {
            $pr += 1;
          }
           if($employer->approval != 0)
          {
            $pr += 1;
          }

          $address = $employer->EmployerAddress;
          $head = $employer->EmployerHead;
          $contactperson = $employer->EmployerContactPerson;
           if($address->phone != '')
          {
            $pr += 1;
          }

          if($address->secondary_email != '')
          {
            $pr += 1;
          }
          if($address->fax != '')
          {
            $pr += 1;
          }
          if($address->pobox != '')
          {
            $pr += 1;
          }
          if($address->website != '')
          {
            $pr += 1;
          }
          if($address->address != '')
          {
            $pr += 1;
          }
          if($address->country != '')
          {
            $pr += 1;
          }
          if($address->city != '')
          {
            $pr += 1;
          }
          if($address->billing_address != '')
          {
            $pr += 1;
          }

          if($contactperson->phone != '')
          {
            $pr += 1;
          }
          if($contactperson->name != '')
          {
            $pr += 1;
          }
          if($contactperson->designation != '')
          {
            $pr += 1;
          }
          if($contactperson->email != '')
          {
            $pr += 1;
          }
          if($head->name != '')
          {
            $pr += 1;
          }
          if($head->designation != '')
          {
            $pr += 1;
          }
         $employer_id = $employer->id;
         $percent = ($pr / 21) * 100;
         $datas['profile_complete'] = number_format($percent);
         $today = Carbon::now()->toDateString();

         $active = Jobs::where('employers_id', $employer->id)->where('status', 1)->where('deadline', '>=', $today)->where('publish_date', '<=', $today)->where('trash', 0)->where('draft', 0)->get();
         $completed = Jobs::where('employers_id', $employer->id)->where('status', 2)->where('deadline', '<', $today)->where('trash', 0)->where('draft', 0)->get();
         $pending = Jobs::where('employers_id', $employer->id)->where('status', 3)->where('trash', 0)->where('draft', 0)->get();
         $datas['archive'] = Jobs::where('employers_id', $employer->id)->where('trash', 1)->get();

         $datas['drafted'] = Jobs::where('employers_id', $employer->id)->where('draft', 1)->get();

         $datas['active'] = $active;
         $datas['completed'] = $completed;
         $datas['pending'] = $pending;
         $datas['address'] = $address;
         $datas['head'] = $head;
         $datas['contact'] = $contactperson;



         $datas['employer'] = $employer;
        $datas['last_login'] = $employer->last_login;
        $jtid = ['1','2','3'];

        $datas['category'] = [];
        $categories = JobCategory::orderBy('name', 'asc')->get();
        foreach ($categories as $key => $category) {
          $ecate = EmployeeCategory::where('job_category_id', $category->id)->count();
          $datas['category'][] = [
            'title' => $category->name,
            'total' => $ecate
          ];
        }

         $member_types = MemberType::select('id')->orderBy('rank','desc')->first();

        $emp_loyers = Employers::select('id')->where('member_type','>',$member_types->id)->get();
        $yesterday = Carbon::now()->subDay(1)->toDateString();

        foreach ($emp_loyers as $key => $emp) {
          $check = UpgradeRequest::where('employers_id',$emp->id)->where('member_type_id', '!=', $member_types->id)->where('end_date',$yesterday)->count();
          if ($check > 0) {
            Employers::where('id',$emp->id)->update(['member_type' => $member_types->id]);
          }
        }
        $datas['rm_approve'] = EmployeeExperience::where('employers_id',$employer->id)->where('status','0')->where('currently_working', '!=',1)->get();

         //new added
         $job_id = [];
        $datas['filter_stat'] = '';
        $datas['from'] = '';
        $datas['to'] = '';

       $jobs = Jobs::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('trash', '!=', 1)->where('status', 1)->where('publish_date', '<=', date('Y-m-d'))->where('deadline', '>=', date('Y-m-d'));
       $datas['total_jobs'] = Jobs::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('trash', '!=', 1)->count();
       $datas['application_receiving'] = Jobs::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('trash', '!=', 1)->where('status', 1)->where('publish_date', '<=', date('Y-m-d'))->where('deadline', '>=', date('Y-m-d'))->count();
        if(isset($request->filter_stat))
        {
            if($request->filter_stat == 1){
                $datas['filter_stat'] = 1;
                 $jobs = Jobs::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('trash', '!=', 1);
            }
        }
        if(isset($request->from) && isset($request->to))
        {
            $datas['filter_stat'] = 10;
            $datas['from'] = $request->from;
            $datas['to'] = $request->to;
            $jobs = Jobs::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('trash', '!=', 1)->where('deadline', '>=', $request->from)->where('deadline', '<=', $request->to);
             $datas['application_receiving'] = Jobs::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('trash', '!=', 1)->where('deadline', '>=', $request->from)->where('deadline', '<=', $request->to)->count();
        }
        $js = $jobs->get();
        foreach ($js as $j) {
            $job_id[] = $j->id;
        }

        $applicants = JobApply::whereIn('jobs_id', $job_id);
        $daywise = JobApply::whereIn('jobs_id', $job_id)->groupBy('apply_date')->get();
        if(isset($request->from) && isset($request->to)){
            $applicants = JobApply::whereIn('jobs_id', $job_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to);
            $daywise = JobApply::whereIn('jobs_id', $job_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to)->groupBy('apply_date')->get();
        }



        $datas['total_applicants'] = $applicants->count();

        $apps= $applicants->get();
        $emp_ids = [];
        foreach ($apps as $key => $app) {
          $emp_ids[] = $app->employees_id;
        }



        $datas['total_male'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Male')->count();
        $datas['total_female'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Female')->count();






        $datas['daywise'] = [];
        foreach ($daywise as $dys) {


            $datas['daywise'][] = [
                'title' => $dys->apply_date,
                'total_application' => JobApply::whereIn('jobs_id', $job_id)->where('apply_date', $dys->apply_date)->count(),
                'total_visit' => \App\Counter::whereIn('job_id', $job_id)->where('visit_date', $dys->apply_date)->sum('visits'),

            ];
        }


        $datas['age'][] = [
            'title' => '18-',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '<', '18')->count(),
            'color' => '#f56954',

        ];
        $datas['age'][] = [
            'title' => '18-22',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '18')->where('age', '<', '22')->count(),
            'color' => '#00a65a',

        ];

        $datas['age'][] = [
            'title' => '22-26',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '22')->where('age', '<', '26')->count(),
            'color' => '#f39c12',

        ];
        $datas['age'][] = [
            'title' => '26-30',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '26')->where('age', '<', '30')->count(),
            'color' => '#00c0ef',

        ];
        $datas['age'][] = [
            'title' => '30-40',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '30')->where('age', '<', '40')->count(),
            'color' => '#3c8dbc',

        ];
        $datas['age'][] = [
            'title' => '40-50',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '40')->where('age', '<=', '50')->count(),
            'color' => '#d2d6de',

        ];
        $datas['age'][] = [
            'title' => '50+',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>', '50')->count(),
            'color' => '#43e96e',

        ];

        $members = \App\EmployerUser::where('employers_id', auth()->guard('employer')->user()->employers_id)->get();
        $datas['members'] = [];
        foreach ($members as $key => $member) {
            if ($member->image != '') {
                $image = Imagetool::mycrop($member->image,200,200);
            } else{
                $image = Imagetool::mycrop('no-image.png',200,200);
            }
           $datas['members'][] = [
            'name' => $member->name,
            'designation' => $member->designation,
            'image' => $image,
            'user_type' => $member->user_type
           ];
        }


        $datas['total_single'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Single')->count();
        $datas['total_married'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Married')->count();
         $datas['total_divorced'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'divorced')->count();


         $addresses = \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->whereNotNull('permanent_district')->groupBy('permanent_district')->get();
         $datas['districts'] = [];

         foreach ($addresses as $key => $address) {
           $datas['districts'][] = [
            'title' => $address->permanent_district,
            'total' => \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->where('permanent_district', $address->permanent_district)->count(),
            'color' => \App\EmployeeAddress::getColour($address->permanent_district)
           ];
         }

        //dd($datas);

          return view('employer.dashboard')->with('data', $datas);

 }



 public function profile(Request $request)
 {
    $user = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();
    $datas = [];


    if (isset($user->logo) && !empty($user->logo)) {
     $datas['logo'] = asset('image/' . $user->logo);
 } else {
    $datas['logo'] ='';
}

$datas['employer'] = $user;
$datas['address'] = $user->EmployerAddress;
$datas['head'] = $user->EmployerHead;
$datas['contact'] = $user->EmployerContactPerson;
return view('employer.view')->with('datas', $datas);

}

public function changePassword(Request $request)
{

   $config = array(
              'app.meta_title' => 'Employer change password',
              'app.meta_keyword' => 'Employer change password',
              'app.meta_description' => 'Employer change password',
              'app.meta_image' => '',
              'app.meta_url' => url('/employer/changepassword'),
              'app.meta_type' => 'Employer Change Password',

          );
          config($config);
    $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();
    $datas = [];
    $datas['employer'] = $employer;


     return  view('employer.changepassword')->with('datas', $datas);






}

public function updatelogin(Request $request)
{
    $this->validate($request, [
        'id' => 'required|integer',
        'email'=>'required|email|unique:employer_user,email,'.$request->id.',id',
        'password' => 'confirmed|min:6',
    ]);
    \App\EmployerUser::where('id', $request->id)->update(['email' => $request->email, 'password' => bcrypt($request->password)]);
    \Session::flash('alert-success','Record have been saved Successfully');
    return redirect('employer');
}


public function editProfile(Request $request)
{

    $datas = array();


     $config = array(
              'app.meta_title' => 'Employer Edit Profile',
              'app.meta_keyword' => 'Employer Edit Profile',
              'app.meta_description' => 'Employer Edit Profile',
              'app.meta_image' => '',
              'app.meta_url' => url('/employer/'),
              'app.meta_type' => 'Employer Dashboard',

          );
          config($config);
          $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();
          $datas = array();
          $image='no-image.png';
           $placeholder = Imagetool::mycrop($image, 100, 100);
          $datas['logo'] = $placeholder;
          $datas['banner'] = $placeholder;


          $datas['size'] = Size::orderBy('id', 'asc')->get();
          $datas['type'] = OrganizationType::orderBy('name', 'asc')->get();
          $datas['salutation'] = Saluation::orderBy('name', 'asc')->get();
          $datas['ownership'] = Ownership::orderBy('name', 'asc')->get();
          $datas['member_type'] = MemberType::orderBy('name', 'asc')->get();

          $datas['placeholder'] = $placeholder;
          $datas['employer'] = $employer;
          $datas['head'] = $employer->EmployerHead;
          $datas['contact'] = $employer->EmployerContactPerson;
          $datas['address'] = $employer->EmployerAddress;
           $datas['href'] = url('/employer/updateprofile');
           if (is_file(DIR_IMAGE.$employer->logo)) {
            $datas['logo'] = Imagetool::mycrop($employer->logo, 100, 100);
          }
          if (is_file(DIR_IMAGE.$employer->banner)) {
            $datas['banner'] = Imagetool::mycrop($employer->banner, 100, 100);
          }

           $qus = \App\EmployerQuestion::groupBy('group_title')->orderBy('id', 'asc')->get();
           $datas['questions'] = [];

           foreach ($qus as $question) {
             $ques = \App\EmployerQuestion::where('group_title',$question->group_title)->get();
             $quests = [];
             foreach ($ques as  $qu) {
               $lists = explode(',', $qu->answer_list);
               if (is_array($lists)) {
                $answer_list = $lists;
               }else{
                $answer_list = [];
               }
               $quests[] = [
                'id' => $qu->id,
                'title' => $qu->question,
                'answers' => $answer_list,
                'answer' => $qu->answer,
                'mark' => $qu->marks,
                'image' => $qu->image
               ];
             }

             $datas['questions'][] = [
              'group_title' => $question->group_title,
              'questions' => $quests
             ];
           }



         $datas['countries'][] = ['value' => 'Nepal'];
$datas['countries'][] = ['value' => 'United States'];
  $datas['countries'][] = ['value' => 'United Kingdom'];
  $datas['countries'][] = ['value' => 'Afghanistan'];
  $datas['countries'][] = ['value' => 'Albania'];
  $datas['countries'][] = ['value' => 'Algeria'];
  $datas['countries'][] = ['value' => 'American Samoa'];
  $datas['countries'][] = ['value' => 'Andorra'];
  $datas['countries'][] = ['value' => 'Angola'];
  $datas['countries'][] = ['value' => 'Anguilla'];
  $datas['countries'][] = ['value' => 'Antarctica'];
  $datas['countries'][] = ['value' => 'Antigua and Barbuda'];
  $datas['countries'][] = ['value' => 'Argentina'];
  $datas['countries'][] = ['value' => 'Armenia'];
  $datas['countries'][] = ['value' => 'Aruba'];
  $datas['countries'][] = ['value' => 'Australia'];
  $datas['countries'][] = ['value' => 'Austria'];
  $datas['countries'][] = ['value' => 'Azerbaijan'];
  $datas['countries'][] = ['value' => 'Bahamas'];
  $datas['countries'][] = ['value' => 'Bahrain'];
  $datas['countries'][] = ['value' => 'Bangladesh'];
  $datas['countries'][] = ['value' => 'Barbados'];
  $datas['countries'][] = ['value' => 'Belarus'];
  $datas['countries'][] = ['value' => 'Belgium'];
  $datas['countries'][] = ['value' => 'Belize'];
  $datas['countries'][] = ['value' => 'Benin'];
  $datas['countries'][] = ['value' => 'Bermuda'];
  $datas['countries'][] = ['value' => 'Bhutan'];
  $datas['countries'][] = ['value' => 'Bolivia'];
  $datas['countries'][] = ['value' => 'Bosnia and Herzegovina'];
  $datas['countries'][] = ['value' => 'Botswana'];
  $datas['countries'][] = ['value' => 'Bouvet Island'];
  $datas['countries'][] = ['value' => 'Brazil'];
  $datas['countries'][] = ['value' => 'British Indian Ocean Territory'];
  $datas['countries'][] = ['value' => 'Brunei Darussalam'];
  $datas['countries'][] = ['value' => 'Bulgaria'];
  $datas['countries'][] = ['value' => 'Burkina Faso'];
  $datas['countries'][] = ['value' => 'Burundi'];
  $datas['countries'][] = ['value' => 'Cambodia'];
  $datas['countries'][] = ['value' => 'Cameroon'];
  $datas['countries'][] = ['value' => 'Canada'];
  $datas['countries'][] = ['value' => 'Cape Verde'];
  $datas['countries'][] = ['value' => 'Cayman Islands'];
  $datas['countries'][] = ['value' => 'Central African Republic'];
  $datas['countries'][] = ['value' => 'Chad'];
  $datas['countries'][] = ['value' => 'Chile'];
  $datas['countries'][] = ['value' => 'China'];
  $datas['countries'][] = ['value' => 'Christmas Island'];
  $datas['countries'][] = ['value' => 'Cocos (Keeling) Islands'];
  $datas['countries'][] = ['value' => 'Colombia'];
  $datas['countries'][] = ['value' => 'Comoros'];
  $datas['countries'][] = ['value' => 'Congo'];
  $datas['countries'][] = ['value' => 'Congo, The Democratic Republic of The'];
  $datas['countries'][] = ['value' => 'Cook Islands'];
  $datas['countries'][] = ['value' => 'Costa Rica'];
  $datas['countries'][] = ['value' => 'Cote Divoire'];
  $datas['countries'][] = ['value' => 'Croatia'];
  $datas['countries'][] = ['value' => 'Cuba'];
  $datas['countries'][] = ['value' => 'Cyprus'];
  $datas['countries'][] = ['value' => 'Czech Republic'];
  $datas['countries'][] = ['value' => 'Denmark'];
  $datas['countries'][] = ['value' => 'Djibouti'];
  $datas['countries'][] = ['value' => 'Dominica'];
  $datas['countries'][] = ['value' => 'Dominican Republic'];
  $datas['countries'][] = ['value' => 'Ecuador'];
  $datas['countries'][] = ['value' => 'Egypt'];
  $datas['countries'][] = ['value' => 'El Salvador'];
  $datas['countries'][] = ['value' => 'Equatorial Guinea'];
  $datas['countries'][] = ['value' => 'Eritrea'];
  $datas['countries'][] = ['value' => 'Estonia'];
  $datas['countries'][] = ['value' => 'Ethiopia'];
  $datas['countries'][] = ['value' => 'Falkland Islands (Malvinas)'];
  $datas['countries'][] = ['value' => 'Faroe Islands'];
  $datas['countries'][] = ['value' => 'Fiji'];
  $datas['countries'][] = ['value' => 'Finland'];
  $datas['countries'][] = ['value' => 'France'];
  $datas['countries'][] = ['value' => 'French Guiana'];
  $datas['countries'][] = ['value' => 'French Polynesia'];
  $datas['countries'][] = ['value' => 'French Southern Territories'];
  $datas['countries'][] = ['value' => 'Gabon'];
  $datas['countries'][] = ['value' => 'Gambia'];
  $datas['countries'][] = ['value' => 'Georgia'];
  $datas['countries'][] = ['value' => 'Germany'];
  $datas['countries'][] = ['value' => 'Ghana'];
  $datas['countries'][] = ['value' => 'Gibraltar'];
  $datas['countries'][] = ['value' => 'Greece'];
  $datas['countries'][] = ['value' => 'Greenland'];
  $datas['countries'][] = ['value' => 'Grenada'];
  $datas['countries'][] = ['value' => 'Guadeloupe'];
  $datas['countries'][] = ['value' => 'Guam'];
  $datas['countries'][] = ['value' => 'Guatemala'];
  $datas['countries'][] = ['value' => 'Guinea'];
  $datas['countries'][] = ['value' => 'Guinea-bissau'];
  $datas['countries'][] = ['value' => 'Guyana'];
  $datas['countries'][] = ['value' => 'Haiti'];
  $datas['countries'][] = ['value' => 'Heard Island and Mcdonald Islands'];
  $datas['countries'][] = ['value' => 'Holy See (Vatican City State)'];
  $datas['countries'][] = ['value' => 'Honduras'];
  $datas['countries'][] = ['value' => 'Hong Kong'];
  $datas['countries'][] = ['value' => 'Hungary'];
  $datas['countries'][] = ['value' => 'Iceland'];
  $datas['countries'][] = ['value' => 'India'];
  $datas['countries'][] = ['value' => 'Indonesia'];
  $datas['countries'][] = ['value' => 'Iran, Islamic Republic of'];
  $datas['countries'][] = ['value' => 'Iraq'];
  $datas['countries'][] = ['value' => 'Ireland'];
  $datas['countries'][] = ['value' => 'Israel'];
  $datas['countries'][] = ['value' => 'Italy'];
  $datas['countries'][] = ['value' => 'Jamaica'];
  $datas['countries'][] = ['value' => 'Japan'];
  $datas['countries'][] = ['value' => 'Jordan'];
  $datas['countries'][] = ['value' => 'Kazakhstan'];
  $datas['countries'][] = ['value' => 'Kenya'];
  $datas['countries'][] = ['value' => 'Kiribati'];
  $datas['countries'][] = ['value' => 'Korea, Democratic Peoples Republic of'];
  $datas['countries'][] = ['value' => 'Korea, Republic of'];
  $datas['countries'][] = ['value' => 'Kuwait'];
  $datas['countries'][] = ['value' => 'Kyrgyzstan'];
  $datas['countries'][] = ['value' => 'Lao Peoples Democratic Republic'];
  $datas['countries'][] = ['value' => 'Latvia'];
  $datas['countries'][] = ['value' => 'Lebanon'];
  $datas['countries'][] = ['value' => 'Lesotho'];
  $datas['countries'][] = ['value' => 'Liberia'];
  $datas['countries'][] = ['value' => 'Libyan Arab Jamahiriya'];
  $datas['countries'][] = ['value' => 'Liechtenstein'];
  $datas['countries'][] = ['value' => 'Lithuania'];
  $datas['countries'][] = ['value' => 'Luxembourg'];
  $datas['countries'][] = ['value' => 'Macao'];
  $datas['countries'][] = ['value' => 'Macedonia, The Former Yugoslav Republic of'];
  $datas['countries'][] = ['value' => 'Madagascar'];
  $datas['countries'][] = ['value' => 'Malawi'];
  $datas['countries'][] = ['value' => 'Malaysia'];
  $datas['countries'][] = ['value' => 'Maldives'];
  $datas['countries'][] = ['value' => 'Mali'];
  $datas['countries'][] = ['value' => 'Malta'];
  $datas['countries'][] = ['value' => 'Marshall Islands'];
  $datas['countries'][] = ['value' => 'Martinique'];
  $datas['countries'][] = ['value' => 'Mauritania'];
  $datas['countries'][] = ['value' => 'Mauritius'];
  $datas['countries'][] = ['value' => 'Mayotte'];
  $datas['countries'][] = ['value' => 'Mexico'];
  $datas['countries'][] = ['value' => 'Micronesia, Federated States of'];
  $datas['countries'][] = ['value' => 'Moldova, Republic of'];
  $datas['countries'][] = ['value' => 'Monaco'];
  $datas['countries'][] = ['value' => 'Mongolia'];
  $datas['countries'][] = ['value' => 'Montserrat'];
  $datas['countries'][] = ['value' => 'Morocco'];
  $datas['countries'][] = ['value' => 'Mozambique'];
  $datas['countries'][] = ['value' => 'Myanmar'];
  $datas['countries'][] = ['value' => 'Namibia'];
  $datas['countries'][] = ['value' => 'Nauru'];

  $datas['countries'][] = ['value' => 'Netherlands'];
  $datas['countries'][] = ['value' => 'Netherlands Antilles'];
  $datas['countries'][] = ['value' => 'New Caledonia'];
  $datas['countries'][] = ['value' => 'New Zealand'];
  $datas['countries'][] = ['value' => 'Nicaragua'];
  $datas['countries'][] = ['value' => 'Niger'];
  $datas['countries'][] = ['value' => 'Nigeria'];
  $datas['countries'][] = ['value' => 'Niue'];
  $datas['countries'][] = ['value' => 'Norfolk Island'];
  $datas['countries'][] = ['value' => 'Northern Mariana Islands'];
  $datas['countries'][] = ['value' => 'Norway'];
  $datas['countries'][] = ['value' => 'Oman'];
  $datas['countries'][] = ['value' => 'Pakistan'];
  $datas['countries'][] = ['value' => 'Palau'];
  $datas['countries'][] = ['value' => 'Palestinian Territory, Occupied'];
  $datas['countries'][] = ['value' => 'Panama'];
  $datas['countries'][] = ['value' => 'Papua New Guinea'];
  $datas['countries'][] = ['value' => 'Paraguay'];
  $datas['countries'][] = ['value' => 'Peru'];
  $datas['countries'][] = ['value' => 'Philippines'];
  $datas['countries'][] = ['value' => 'Pitcairn'];
  $datas['countries'][] = ['value' => 'Poland'];
  $datas['countries'][] = ['value' => 'Portugal'];
  $datas['countries'][] = ['value' => 'Puerto Rico'];
  $datas['countries'][] = ['value' => 'Qatar'];
  $datas['countries'][] = ['value' => 'Reunion'];
  $datas['countries'][] = ['value' => 'Romania'];
  $datas['countries'][] = ['value' => 'Russian Federation'];
  $datas['countries'][] = ['value' => 'Rwanda'];
  $datas['countries'][] = ['value' => 'Saint Helena'];
  $datas['countries'][] = ['value' => 'Saint Kitts and Nevis'];
  $datas['countries'][] = ['value' => 'Saint Lucia'];
  $datas['countries'][] = ['value' => 'Saint Pierre and Miquelon'];
  $datas['countries'][] = ['value' => 'Saint Vincent and The Grenadines'];
  $datas['countries'][] = ['value' => 'Samoa'];
  $datas['countries'][] = ['value' => 'San Marino'];
  $datas['countries'][] = ['value' => 'Sao Tome and Principe'];
  $datas['countries'][] = ['value' => 'Saudi Arabia'];
  $datas['countries'][] = ['value' => 'Senegal'];
  $datas['countries'][] = ['value' => 'Serbia and Montenegro'];
  $datas['countries'][] = ['value' => 'Seychelles'];
  $datas['countries'][] = ['value' => 'Sierra Leone'];
  $datas['countries'][] = ['value' => 'Singapore'];
  $datas['countries'][] = ['value' => 'Slovakia'];
  $datas['countries'][] = ['value' => 'Slovenia'];
  $datas['countries'][] = ['value' => 'Solomon Islands'];
  $datas['countries'][] = ['value' => 'Somalia'];
  $datas['countries'][] = ['value' => 'South Africa'];
  $datas['countries'][] = ['value' => 'South Georgia and The South Sandwich Islands'];
  $datas['countries'][] = ['value' => 'Spain'];
  $datas['countries'][] = ['value' => 'Sri Lanka'];
  $datas['countries'][] = ['value' => 'Sudan'];
  $datas['countries'][] = ['value' => 'Suriname'];
  $datas['countries'][] = ['value' => 'Svalbard and Jan Mayen'];
  $datas['countries'][] = ['value' => 'Swaziland'];
  $datas['countries'][] = ['value' => 'Sweden'];
  $datas['countries'][] = ['value' => 'Switzerland'];
  $datas['countries'][] = ['value' => 'Syrian Arab Republic'];
  $datas['countries'][] = ['value' => 'Taiwan, Province of China'];
  $datas['countries'][] = ['value' => 'Tajikistan'];
  $datas['countries'][] = ['value' => 'Tanzania, United Republic of'];
  $datas['countries'][] = ['value' => 'Thailand'];
  $datas['countries'][] = ['value' => 'Timor-leste'];
  $datas['countries'][] = ['value' => 'Togo'];
  $datas['countries'][] = ['value' => 'Tokelau'];
  $datas['countries'][] = ['value' => 'Tonga'];
  $datas['countries'][] = ['value' => 'Trinidad and Tobago'];
  $datas['countries'][] = ['value' => 'Tunisia'];
  $datas['countries'][] = ['value' => 'Turkey'];
  $datas['countries'][] = ['value' => 'Turkmenistan'];
  $datas['countries'][] = ['value' => 'Turks and Caicos Islands'];
  $datas['countries'][] = ['value' => 'Tuvalu'];
  $datas['countries'][] = ['value' => 'Uganda'];
  $datas['countries'][] = ['value' => 'Ukraine'];
  $datas['countries'][] = ['value' => 'United Arab Emirates'];
  $datas['countries'][] = ['value' => 'United Kingdom'];
  $datas['countries'][] = ['value' => 'United States'];
  $datas['countries'][] = ['value' => 'United States Minor Outlying Islands'];
  $datas['countries'][] = ['value' => 'Uruguay'];
  $datas['countries'][] = ['value' => 'Uzbekistan'];
  $datas['countries'][] = ['value' => 'Vanuatu'];
  $datas['countries'][] = ['value' => 'Venezuela'];
  $datas['countries'][] = ['value' => 'Viet Nam'];
  $datas['countries'][] = ['value' => 'Virgin Islands, British'];
  $datas['countries'][] = ['value' => 'Virgin Islands, U.S.'];
  $datas['countries'][] = ['value' => 'Wallis and Futuna'];
  $datas['countries'][] = ['value' => 'Western Sahara'];
  $datas['countries'][] = ['value' => 'Yemen'];
  $datas['countries'][] = ['value' => 'Zambia'];
  $datas['countries'][] = ['value' => 'Zimbabwe'];

  $datas['colors'][] = ['value' => 'blue', 'title' => 'Blue', 'color' => '0099e5'];
  $datas['colors'][] = ['value' => 'dark_blue', 'title' => 'Dark Blue', 'color' => '3627bc'];
  $datas['colors'][] = ['value' => 'green', 'title' => 'Green', 'color' => '5dc121'];
  $datas['colors'][] = ['value' => 'purple', 'title' => 'Purple', 'color' => '4c194c'];
  $datas['colors'][] = ['value' => 'red', 'title' => 'Red', 'color' => 'cc0000'];

  $datas['layouts'][] = ['value' => 'default', 'title' => 'Default', 'image' => asset('/image/default_layout.png')];
  $datas['layouts'][] = ['value' => 'layout1', 'title' => 'Layout1', 'image' => asset('/image/layout1.png')];
  $datas['layouts'][] = ['value' => 'layout2', 'title' => 'Layout2', 'image' => asset('/image/layout2.png')];
  $datas['layouts'][] = ['value' => 'layout3', 'title' => 'Layout3', 'image' => asset('/image/layout3.png')];
  $datas['layouts'][] = ['value' => 'layout4', 'title' => 'Layout4', 'image' => asset('/image/layout4.png')];
  $datas['layouts'][] = ['value' => 'layout5', 'title' => 'Layout5', 'image' => asset('/image/layout5.png')];


          return  view('employer.feditprofile')->with('datas', $datas);





}


public function feditProfile(Request $request)
{

   $layouts= Layout::where('layout_route', 'Employer_dashboard')->first();
      if(isset($data->layout_id))
      {
        $layout_id = $data->layout_id;
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }

    $datas = array();


     $config = array(
              'app.meta_title' => 'Employer Edit Profile',
              'app.meta_keyword' => 'Employer Edit Profile',
              'app.meta_description' => 'Employer Edit Profile',
              'app.meta_image' => '',
              'app.meta_url' => url('/employer/'),
              'app.meta_type' => 'Employer Dashboard',

          );
          config($config);
          $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();
          $datas = array();
          $image='no-image.png';
          $placeholder = Imagetool::mycrop($image, 100, 100);
          $datas['logo'] = $placeholder;
          $datas['banner'] = $placeholder;

          $datas['size'] = Size::orderBy('name', 'asc')->get();
          $datas['type'] = OrganizationType::orderBy('name', 'asc')->get();
          $datas['salutation'] = Saluation::orderBy('name', 'asc')->get();
          $datas['ownership'] = Ownership::orderBy('name', 'asc')->get();
          $datas['member_type'] = MemberType::orderBy('name', 'asc')->get();

          $datas['placeholder'] = $placeholder;
          $datas['employer'] = $employer;
          $datas['head'] = $employer->EmployerHead;
          $datas['contact'] = $employer->EmployerContactPerson;
          $datas['address'] = $employer->EmployerAddress;
          $datas['href'] = url('/employer/fupdateprofile');
          if (is_file(DIR_IMAGE.$employer->logo)) {
            $datas['logo'] = Imagetool::mycrop($employer->logo, 100, 100);
          }
          if (is_file(DIR_IMAGE.$employer->banner)) {
            $datas['banner'] = Imagetool::mycrop($employer->banner, 100, 100);
          }

          $qus = \App\EmployerQuestion::groupBy('group_title')->orderBy('id', 'asc')->get();
           $datas['questions'] = [];

           foreach ($qus as $question) {
             $ques = \App\EmployerQuestion::where('group_title',$question->group_title)->get();
             $quests = [];
             foreach ($ques as  $qu) {
               $lists = explode(',', $qu->answer_list);
               if (is_array($lists)) {
                $answer_list = $lists;
               }else{
                $answer_list = [];
               }
               $quests[] = [
                'id' => $qu->id,
                'title' => $qu->question,
                'answers' => $answer_list,
                'answer' => $qu->answer,
                'mark' => $qu->marks,
                'image' => $qu->image
               ];
             }

             $datas['questions'][] = [
              'group_title' => $question->group_title,
              'questions' => $quests
             ];
           }

        $datas['countries'][] = ['value' => 'Nepal'];
$datas['countries'][] = ['value' => 'United States'];
  $datas['countries'][] = ['value' => 'United Kingdom'];
  $datas['countries'][] = ['value' => 'Afghanistan'];
  $datas['countries'][] = ['value' => 'Albania'];
  $datas['countries'][] = ['value' => 'Algeria'];
  $datas['countries'][] = ['value' => 'American Samoa'];
  $datas['countries'][] = ['value' => 'Andorra'];
  $datas['countries'][] = ['value' => 'Angola'];
  $datas['countries'][] = ['value' => 'Anguilla'];
  $datas['countries'][] = ['value' => 'Antarctica'];
  $datas['countries'][] = ['value' => 'Antigua and Barbuda'];
  $datas['countries'][] = ['value' => 'Argentina'];
  $datas['countries'][] = ['value' => 'Armenia'];
  $datas['countries'][] = ['value' => 'Aruba'];
  $datas['countries'][] = ['value' => 'Australia'];
  $datas['countries'][] = ['value' => 'Austria'];
  $datas['countries'][] = ['value' => 'Azerbaijan'];
  $datas['countries'][] = ['value' => 'Bahamas'];
  $datas['countries'][] = ['value' => 'Bahrain'];
  $datas['countries'][] = ['value' => 'Bangladesh'];
  $datas['countries'][] = ['value' => 'Barbados'];
  $datas['countries'][] = ['value' => 'Belarus'];
  $datas['countries'][] = ['value' => 'Belgium'];
  $datas['countries'][] = ['value' => 'Belize'];
  $datas['countries'][] = ['value' => 'Benin'];
  $datas['countries'][] = ['value' => 'Bermuda'];
  $datas['countries'][] = ['value' => 'Bhutan'];
  $datas['countries'][] = ['value' => 'Bolivia'];
  $datas['countries'][] = ['value' => 'Bosnia and Herzegovina'];
  $datas['countries'][] = ['value' => 'Botswana'];
  $datas['countries'][] = ['value' => 'Bouvet Island'];
  $datas['countries'][] = ['value' => 'Brazil'];
  $datas['countries'][] = ['value' => 'British Indian Ocean Territory'];
  $datas['countries'][] = ['value' => 'Brunei Darussalam'];
  $datas['countries'][] = ['value' => 'Bulgaria'];
  $datas['countries'][] = ['value' => 'Burkina Faso'];
  $datas['countries'][] = ['value' => 'Burundi'];
  $datas['countries'][] = ['value' => 'Cambodia'];
  $datas['countries'][] = ['value' => 'Cameroon'];
  $datas['countries'][] = ['value' => 'Canada'];
  $datas['countries'][] = ['value' => 'Cape Verde'];
  $datas['countries'][] = ['value' => 'Cayman Islands'];
  $datas['countries'][] = ['value' => 'Central African Republic'];
  $datas['countries'][] = ['value' => 'Chad'];
  $datas['countries'][] = ['value' => 'Chile'];
  $datas['countries'][] = ['value' => 'China'];
  $datas['countries'][] = ['value' => 'Christmas Island'];
  $datas['countries'][] = ['value' => 'Cocos (Keeling) Islands'];
  $datas['countries'][] = ['value' => 'Colombia'];
  $datas['countries'][] = ['value' => 'Comoros'];
  $datas['countries'][] = ['value' => 'Congo'];
  $datas['countries'][] = ['value' => 'Congo, The Democratic Republic of The'];
  $datas['countries'][] = ['value' => 'Cook Islands'];
  $datas['countries'][] = ['value' => 'Costa Rica'];
  $datas['countries'][] = ['value' => 'Cote Divoire'];
  $datas['countries'][] = ['value' => 'Croatia'];
  $datas['countries'][] = ['value' => 'Cuba'];
  $datas['countries'][] = ['value' => 'Cyprus'];
  $datas['countries'][] = ['value' => 'Czech Republic'];
  $datas['countries'][] = ['value' => 'Denmark'];
  $datas['countries'][] = ['value' => 'Djibouti'];
  $datas['countries'][] = ['value' => 'Dominica'];
  $datas['countries'][] = ['value' => 'Dominican Republic'];
  $datas['countries'][] = ['value' => 'Ecuador'];
  $datas['countries'][] = ['value' => 'Egypt'];
  $datas['countries'][] = ['value' => 'El Salvador'];
  $datas['countries'][] = ['value' => 'Equatorial Guinea'];
  $datas['countries'][] = ['value' => 'Eritrea'];
  $datas['countries'][] = ['value' => 'Estonia'];
  $datas['countries'][] = ['value' => 'Ethiopia'];
  $datas['countries'][] = ['value' => 'Falkland Islands (Malvinas)'];
  $datas['countries'][] = ['value' => 'Faroe Islands'];
  $datas['countries'][] = ['value' => 'Fiji'];
  $datas['countries'][] = ['value' => 'Finland'];
  $datas['countries'][] = ['value' => 'France'];
  $datas['countries'][] = ['value' => 'French Guiana'];
  $datas['countries'][] = ['value' => 'French Polynesia'];
  $datas['countries'][] = ['value' => 'French Southern Territories'];
  $datas['countries'][] = ['value' => 'Gabon'];
  $datas['countries'][] = ['value' => 'Gambia'];
  $datas['countries'][] = ['value' => 'Georgia'];
  $datas['countries'][] = ['value' => 'Germany'];
  $datas['countries'][] = ['value' => 'Ghana'];
  $datas['countries'][] = ['value' => 'Gibraltar'];
  $datas['countries'][] = ['value' => 'Greece'];
  $datas['countries'][] = ['value' => 'Greenland'];
  $datas['countries'][] = ['value' => 'Grenada'];
  $datas['countries'][] = ['value' => 'Guadeloupe'];
  $datas['countries'][] = ['value' => 'Guam'];
  $datas['countries'][] = ['value' => 'Guatemala'];
  $datas['countries'][] = ['value' => 'Guinea'];
  $datas['countries'][] = ['value' => 'Guinea-bissau'];
  $datas['countries'][] = ['value' => 'Guyana'];
  $datas['countries'][] = ['value' => 'Haiti'];
  $datas['countries'][] = ['value' => 'Heard Island and Mcdonald Islands'];
  $datas['countries'][] = ['value' => 'Holy See (Vatican City State)'];
  $datas['countries'][] = ['value' => 'Honduras'];
  $datas['countries'][] = ['value' => 'Hong Kong'];
  $datas['countries'][] = ['value' => 'Hungary'];
  $datas['countries'][] = ['value' => 'Iceland'];
  $datas['countries'][] = ['value' => 'India'];
  $datas['countries'][] = ['value' => 'Indonesia'];
  $datas['countries'][] = ['value' => 'Iran, Islamic Republic of'];
  $datas['countries'][] = ['value' => 'Iraq'];
  $datas['countries'][] = ['value' => 'Ireland'];
  $datas['countries'][] = ['value' => 'Israel'];
  $datas['countries'][] = ['value' => 'Italy'];
  $datas['countries'][] = ['value' => 'Jamaica'];
  $datas['countries'][] = ['value' => 'Japan'];
  $datas['countries'][] = ['value' => 'Jordan'];
  $datas['countries'][] = ['value' => 'Kazakhstan'];
  $datas['countries'][] = ['value' => 'Kenya'];
  $datas['countries'][] = ['value' => 'Kiribati'];
  $datas['countries'][] = ['value' => 'Korea, Democratic Peoples Republic of'];
  $datas['countries'][] = ['value' => 'Korea, Republic of'];
  $datas['countries'][] = ['value' => 'Kuwait'];
  $datas['countries'][] = ['value' => 'Kyrgyzstan'];
  $datas['countries'][] = ['value' => 'Lao Peoples Democratic Republic'];
  $datas['countries'][] = ['value' => 'Latvia'];
  $datas['countries'][] = ['value' => 'Lebanon'];
  $datas['countries'][] = ['value' => 'Lesotho'];
  $datas['countries'][] = ['value' => 'Liberia'];
  $datas['countries'][] = ['value' => 'Libyan Arab Jamahiriya'];
  $datas['countries'][] = ['value' => 'Liechtenstein'];
  $datas['countries'][] = ['value' => 'Lithuania'];
  $datas['countries'][] = ['value' => 'Luxembourg'];
  $datas['countries'][] = ['value' => 'Macao'];
  $datas['countries'][] = ['value' => 'Macedonia, The Former Yugoslav Republic of'];
  $datas['countries'][] = ['value' => 'Madagascar'];
  $datas['countries'][] = ['value' => 'Malawi'];
  $datas['countries'][] = ['value' => 'Malaysia'];
  $datas['countries'][] = ['value' => 'Maldives'];
  $datas['countries'][] = ['value' => 'Mali'];
  $datas['countries'][] = ['value' => 'Malta'];
  $datas['countries'][] = ['value' => 'Marshall Islands'];
  $datas['countries'][] = ['value' => 'Martinique'];
  $datas['countries'][] = ['value' => 'Mauritania'];
  $datas['countries'][] = ['value' => 'Mauritius'];
  $datas['countries'][] = ['value' => 'Mayotte'];
  $datas['countries'][] = ['value' => 'Mexico'];
  $datas['countries'][] = ['value' => 'Micronesia, Federated States of'];
  $datas['countries'][] = ['value' => 'Moldova, Republic of'];
  $datas['countries'][] = ['value' => 'Monaco'];
  $datas['countries'][] = ['value' => 'Mongolia'];
  $datas['countries'][] = ['value' => 'Montserrat'];
  $datas['countries'][] = ['value' => 'Morocco'];
  $datas['countries'][] = ['value' => 'Mozambique'];
  $datas['countries'][] = ['value' => 'Myanmar'];
  $datas['countries'][] = ['value' => 'Namibia'];
  $datas['countries'][] = ['value' => 'Nauru'];

  $datas['countries'][] = ['value' => 'Netherlands'];
  $datas['countries'][] = ['value' => 'Netherlands Antilles'];
  $datas['countries'][] = ['value' => 'New Caledonia'];
  $datas['countries'][] = ['value' => 'New Zealand'];
  $datas['countries'][] = ['value' => 'Nicaragua'];
  $datas['countries'][] = ['value' => 'Niger'];
  $datas['countries'][] = ['value' => 'Nigeria'];
  $datas['countries'][] = ['value' => 'Niue'];
  $datas['countries'][] = ['value' => 'Norfolk Island'];
  $datas['countries'][] = ['value' => 'Northern Mariana Islands'];
  $datas['countries'][] = ['value' => 'Norway'];
  $datas['countries'][] = ['value' => 'Oman'];
  $datas['countries'][] = ['value' => 'Pakistan'];
  $datas['countries'][] = ['value' => 'Palau'];
  $datas['countries'][] = ['value' => 'Palestinian Territory, Occupied'];
  $datas['countries'][] = ['value' => 'Panama'];
  $datas['countries'][] = ['value' => 'Papua New Guinea'];
  $datas['countries'][] = ['value' => 'Paraguay'];
  $datas['countries'][] = ['value' => 'Peru'];
  $datas['countries'][] = ['value' => 'Philippines'];
  $datas['countries'][] = ['value' => 'Pitcairn'];
  $datas['countries'][] = ['value' => 'Poland'];
  $datas['countries'][] = ['value' => 'Portugal'];
  $datas['countries'][] = ['value' => 'Puerto Rico'];
  $datas['countries'][] = ['value' => 'Qatar'];
  $datas['countries'][] = ['value' => 'Reunion'];
  $datas['countries'][] = ['value' => 'Romania'];
  $datas['countries'][] = ['value' => 'Russian Federation'];
  $datas['countries'][] = ['value' => 'Rwanda'];
  $datas['countries'][] = ['value' => 'Saint Helena'];
  $datas['countries'][] = ['value' => 'Saint Kitts and Nevis'];
  $datas['countries'][] = ['value' => 'Saint Lucia'];
  $datas['countries'][] = ['value' => 'Saint Pierre and Miquelon'];
  $datas['countries'][] = ['value' => 'Saint Vincent and The Grenadines'];
  $datas['countries'][] = ['value' => 'Samoa'];
  $datas['countries'][] = ['value' => 'San Marino'];
  $datas['countries'][] = ['value' => 'Sao Tome and Principe'];
  $datas['countries'][] = ['value' => 'Saudi Arabia'];
  $datas['countries'][] = ['value' => 'Senegal'];
  $datas['countries'][] = ['value' => 'Serbia and Montenegro'];
  $datas['countries'][] = ['value' => 'Seychelles'];
  $datas['countries'][] = ['value' => 'Sierra Leone'];
  $datas['countries'][] = ['value' => 'Singapore'];
  $datas['countries'][] = ['value' => 'Slovakia'];
  $datas['countries'][] = ['value' => 'Slovenia'];
  $datas['countries'][] = ['value' => 'Solomon Islands'];
  $datas['countries'][] = ['value' => 'Somalia'];
  $datas['countries'][] = ['value' => 'South Africa'];
  $datas['countries'][] = ['value' => 'South Georgia and The South Sandwich Islands'];
  $datas['countries'][] = ['value' => 'Spain'];
  $datas['countries'][] = ['value' => 'Sri Lanka'];
  $datas['countries'][] = ['value' => 'Sudan'];
  $datas['countries'][] = ['value' => 'Suriname'];
  $datas['countries'][] = ['value' => 'Svalbard and Jan Mayen'];
  $datas['countries'][] = ['value' => 'Swaziland'];
  $datas['countries'][] = ['value' => 'Sweden'];
  $datas['countries'][] = ['value' => 'Switzerland'];
  $datas['countries'][] = ['value' => 'Syrian Arab Republic'];
  $datas['countries'][] = ['value' => 'Taiwan, Province of China'];
  $datas['countries'][] = ['value' => 'Tajikistan'];
  $datas['countries'][] = ['value' => 'Tanzania, United Republic of'];
  $datas['countries'][] = ['value' => 'Thailand'];
  $datas['countries'][] = ['value' => 'Timor-leste'];
  $datas['countries'][] = ['value' => 'Togo'];
  $datas['countries'][] = ['value' => 'Tokelau'];
  $datas['countries'][] = ['value' => 'Tonga'];
  $datas['countries'][] = ['value' => 'Trinidad and Tobago'];
  $datas['countries'][] = ['value' => 'Tunisia'];
  $datas['countries'][] = ['value' => 'Turkey'];
  $datas['countries'][] = ['value' => 'Turkmenistan'];
  $datas['countries'][] = ['value' => 'Turks and Caicos Islands'];
  $datas['countries'][] = ['value' => 'Tuvalu'];
  $datas['countries'][] = ['value' => 'Uganda'];
  $datas['countries'][] = ['value' => 'Ukraine'];
  $datas['countries'][] = ['value' => 'United Arab Emirates'];
  $datas['countries'][] = ['value' => 'United Kingdom'];
  $datas['countries'][] = ['value' => 'United States'];
  $datas['countries'][] = ['value' => 'United States Minor Outlying Islands'];
  $datas['countries'][] = ['value' => 'Uruguay'];
  $datas['countries'][] = ['value' => 'Uzbekistan'];
  $datas['countries'][] = ['value' => 'Vanuatu'];
  $datas['countries'][] = ['value' => 'Venezuela'];
  $datas['countries'][] = ['value' => 'Viet Nam'];
  $datas['countries'][] = ['value' => 'Virgin Islands, British'];
  $datas['countries'][] = ['value' => 'Virgin Islands, U.S.'];
  $datas['countries'][] = ['value' => 'Wallis and Futuna'];
  $datas['countries'][] = ['value' => 'Western Sahara'];
  $datas['countries'][] = ['value' => 'Yemen'];
  $datas['countries'][] = ['value' => 'Zambia'];
  $datas['countries'][] = ['value' => 'Zimbabwe'];

  $datas['colors'][] = ['value' => 'blue', 'title' => 'Blue', 'color' => '0099e5'];
  $datas['colors'][] = ['value' => 'dark_blue', 'title' => 'Dark Blue', 'color' => '3627bc'];
  $datas['colors'][] = ['value' => 'green', 'title' => 'Green', 'color' => '5dc121'];
  $datas['colors'][] = ['value' => 'purple', 'title' => 'Purple', 'color' => '4c194c'];
  $datas['colors'][] = ['value' => 'red', 'title' => 'Red', 'color' => 'cc0000'];

  $datas['layouts'][] = ['value' => 'default', 'title' => 'Default', 'image' => asset('/image/default_layout.png')];
  $datas['layouts'][] = ['value' => 'layout1', 'title' => 'Layout1', 'image' => asset('/image/layout1.png')];
  $datas['layouts'][] = ['value' => 'layout2', 'title' => 'Layout2', 'image' => asset('/image/layout2.png')];
  $datas['layouts'][] = ['value' => 'layout3', 'title' => 'Layout3', 'image' => asset('/image/layout3.png')];
  $datas['layouts'][] = ['value' => 'layout4', 'title' => 'Layout4', 'image' => asset('/image/layout4.png')];
  $datas['layouts'][] = ['value' => 'layout5', 'title' => 'Layout5', 'image' => asset('/image/layout5.png')];


          return view('employer.feditprofile')->with('datas', $datas);


}
public function updateProfile(Request $request)
{
    $this->validate($request, [
        'name' => 'required|min:3',
        'organization_size' => 'required|integer',
        'organization_type' => 'required|integer',
        'ownership' => 'required|integer',




    ]);


    $company = Employers::where('id', $request->id)->first();

    $layout = 'default';
    $color = '';
    if (isset($request->layout)) {
     $layout = $request->layout;
    }
    if (isset($request->color)) {
      $color = $request->color;
    }



    $Employer_data = array(
        'name' => $request->name,
        'org_size' => $request->organization_size,
        'description' => $request->description,
        'org_type' => $request->organization_type,
        'ownership' => $request->ownership,
        'logo' =>  $request->logo,
        'banner' =>  $request->banner,

        'last_login' => date('Y-m-d h:i:s'),
        'layout' => $layout,
        'color' => $color

    );

    $employer=Employers::where('id', $request->id)->update($Employer_data);
    if($employer)
    {

     $head = array(

        'saluation' => $request->salutation,
        'name' => $request->head_name,
        'designation' => $request->head_designation );
     EmployerHead::where('employers_id', $request->id)->update($head);
     $this->validate($request, [
        'contact_name' => 'required',
        'contact_email' => 'required',
        'contact_phone' => 'required',
        'contact_designation' => 'required',
     ]);
     $contact = array(

        'saluation' => $request->contact_salutation,
        'name' => $request->contact_name,
        'designation' => $request->contact_designation,
        'phone' => $request->contact_phone,
        'email' => $request->contact_email );
     EmployerContactPerson::where('employers_id', $request->id)->update($contact);

     $this->validate($request, [
        'country' => 'required',
        'city' => 'required',
        'address' => 'required',
        'billing_address' => 'required',
        'billing_policy' => 'required',
     ]);
     $address = array(

        'phone' => $request->phone,
        'secondary_email' => $request->secondary_email,
        'fax'   => $request->fax,
        'pobox' => $request->pobox,
        'website' => $request->website,
        'address' => $request->address,
        'country' => $request->country,
        'city' => $request->city,
        'billing_address' => $request->billing_address
    );

     EmployerAddress::where('employers_id', $request->id)->update($address);


     if (isset($request->facilities)) {
       foreach ($request->facilities as $facilitity) {
        if ($facilitity['answer'] == $facilitity['right_answer']) {
          $obmark = $facilitity['marks'];

          } else{
            $obmark = 0;
          }

          if (isset($facilitity['infa_image'])) {
            $faimage = $facilitity['infa_image'];
          } else{
            $faimage = '';
          }
          $ans = \App\EmployerQuestionAnswer::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('employer_question_id', $facilitity['question_id'])->first();

          if (isset($ans->id)) {
            $fdata = [

                    'employer_question_id' => $facilitity['question_id'],
                    'employer_answers' => $facilitity['answer'],
                    'ob_mark' => $obmark,
                    'image' => $faimage
                    ];
                    \App\EmployerQuestionAnswer::where('id', $ans->id)->update($fdata);
          } else {
          $fdata = [
                    'employers_id' => $request->id,
                    'employer_question_id' => $facilitity['question_id'],
                    'employer_answers' => $facilitity['answer'],
                    'ob_mark' => $obmark,
                    'image' => $faimage
                    ];
                    \App\EmployerQuestionAnswer::create($fdata);
                  }
        }
       }



     \Session::flash('alert-success','Record have been updated Successfully');
     return redirect('employer/dashboard');
 } else {
    \Session::flash('alert-danger','Something went wrong while updating profile, please contact webmaster.');
    return redirect()->back()->withInput();
}
}


public function fupdateProfile(Request $request)
{


    $this->validate($request, [
        'name' => 'required|min:3',
        'organization_size' => 'required|integer',
        'organization_type' => 'required|integer',
        'ownership' => 'required|integer',



    ]);

    $layout = 'default';
    $color = '';
    if (isset($request->layout)) {
     $layout = $request->layout;
    }
    if (isset($request->color)) {
      $color = $request->color;
    }


    $company = Employers::where('id', $request->id)->first();


    $Employer_data = array(
        'name' => $request->name,
        'org_size' => $request->organization_size,
        'description' => $request->description,
        'org_type' => $request->organization_type,
        'ownership' => $request->ownership,
        'logo' =>  $request->logo,
        'banner' =>  $request->banner,

        'last_login' => date('Y-m-d h:i:s'),
        'layout' => $layout,
        'color' => $color

    );

    $employer=Employers::where('id', $request->id)->update($Employer_data);
    if($employer)
    {

     $head = array(

        'saluation' => $request->salutation,
        'name' => $request->head_name,
        'designation' => $request->head_designation );
     EmployerHead::where('employers_id', $request->id)->update($head);
     $this->validate($request, [
        'contact_name' => 'required',
        'contact_email' => 'required',
        'contact_phone' => 'required',
        'contact_designation' => 'required',
     ]);
     $contact = array(

        'saluation' => $request->contact_salutation,
        'name' => $request->contact_name,
        'designation' => $request->contact_designation,
        'phone' => $request->contact_phone,
        'email' => $request->contact_email );
     EmployerContactPerson::where('employers_id', $request->id)->update($contact);

     $this->validate($request, [
        'country' => 'required',
        'city' => 'required',
        'address' => 'required',
        'billing_address' => 'required',
        'billing_policy' => 'required',
     ]);
     $address = array(

        'phone' => $request->phone,
        'secondary_email' => $request->secondary_email,
        'fax'   => $request->fax,
        'pobox' => $request->pobox,
        'website' => $request->website,
        'address' => $request->address,
        'country' => $request->country,
        'city' => $request->city,
        'billing_address' => $request->billing_address
    );

     EmployerAddress::where('employers_id', $request->id)->update($address);


     \App\EmployerQuestionAnswer::where('employers_id', $request->id)->delete();
     if (isset($request->facilities)) {
       foreach ($request->facilities as $facilitity) {
        if ($facilitity['answer'] == $facilitity['right_answer']) {
          $obmark = $facilitity['marks'];

          } else{
            $obmark = 0;
          }

          if (isset($facilitity['infa_image'])) {
            $faimage = $facilitity['infa_image'];
          } else{
            $faimage = '';
          }
          $ans = \App\EmployerQuestionAnswer::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('employer_question_id', $facilitity['question_id'])->first();

          if (isset($ans->id)) {
            $fdata = [

                    'employer_question_id' => $facilitity['question_id'],
                    'employer_answers' => $facilitity['answer'],
                    'ob_mark' => $obmark,
                    'image' => $faimage
                    ];
                    \App\EmployerQuestionAnswer::where('id', $ans->id)->update($fdata);
          } else {
          $fdata = [
                    'employers_id' => $request->id,
                    'employer_question_id' => $facilitity['question_id'],
                    'employer_answers' => $facilitity['answer'],
                    'ob_mark' => $obmark,
                    'image' => $faimage
                    ];
                    \App\EmployerQuestionAnswer::create($fdata);
                  }
        }
       }



     \Session::flash('alert-success','Record have been updated Successfully');
     return redirect('employer/dashboard');
 } else {
    \Session::flash('alert-danger','Something went wrong while updating profile, please contact webmaster.');
    return redirect()->back()->withInput();
}
}

public function uploadImage(Request $request)
{
    $directory = DIR_IMAGE . 'catalog/employers/'.auth()->guard('employer')->user()->employers_id;

    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    if ($request->hasFile('file')) {
       $v= Validator::make($request->all(),
        [
            'file'=>'mimes:jpeg,jpg,png,gif|required|max:10000',

        ]);
       if($v->fails())
       {
        \Session::flash('alert-danger','Your file type did not match or your file size is too big.');
        return redirect()->back();
    }
    $user_profile = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();
    if (isset($user_profile->image)) {

        if (is_file(DIR_IMAGE.$user_profile->image)) {
            File::delete(DIR_IMAGE.$user_profile->image);


        }
    }
    $file = $request->File('file');
    $str = preg_replace('/\s+/', '', $file->getClientOriginalName());
    $path = $directory.'/' . $str;

    Image::make($file->getRealPath())->resize(600)->save($path);
    Employers::where('id',auth()->guard('employer')->user()->employers_id)->update(['logo' => 'catalog/employers/'.auth()->guard('employer')->user()->employers_id.'/'.$str]);
    \Session::flash('alert-success','Record have been updated Successfully');
    return redirect()->back();
}
else {
   \Session::flash('alert-danger','File did not found.');
   return redirect()->back();
}
}

public function jobs(Request $request)
{
  $datas = [];
  $jobs = Jobs::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('trash', '!=', 1)->orderBy('id', 'desc')->paginate(50);

  $user = auth()->guard('employer')->user();



  return view('employer.jobs')->with('data',$jobs)->with('user', $user);
}

public function jobView($id, Request $request)
{
  $jobs= Jobs::where('id',$id)->first();
  if (isset($jobs->id)) {
    $datas['job'] = $jobs;


    $datas['jobs_location'] = [];
    foreach ($jobs->JobsLocation as $jl) {
     $datas['jobs_location'][] = JobLocation::where('id', $jl->location_id)->first();
 }
 $datas['job_educations'] = $jobs->JobEducations;
 $datas['job_experiences'] = $jobs->JobExperiences;
 $datas['jobs_requirements'] = $jobs->JobsRequirements;
 $datas['jobs_form'] = [];
 foreach ($jobs->JobForm as $tabs) {

     $datas['jobs_form'][] = array(
        'level' => $tabs->f_lable,
        'rq' => $tabs->requ,
        'form' => \App\JobForm::createForm($tabs->f_lable,$tabs->f_type,$tabs->list_menu,$tabs->requ),
    );
 }

 return view('employer.jobview')->with('datas', $datas);
} else{
    \Session::flash('alert-danger','Sorry we could not find your request.');
    return redirect()->back();
}
}

public function Applications($id, Request $request)
{





  $datas = [];
  $datas['filter_education'] = '';
  $datas['filter_faculty'] = '';
  $datas['filter_percentage'] = '';
  $datas['filter_cgpa4'] = '';
  $datas['filter_cgpa10'] = '';
  $datas['filter_minimum_age'] = '';
  $datas['filter_maximum_age'] = '';
  $datas['filter_experience'] = '';
  $datas['filter_travel'] = '';
  $datas['filter_relocate'] = '';
  $datas['filter_license'] = '';
  $datas['filter_vehicle'] = '';
  $datas['filter_language'] = [];
  $datas['filter_gender'] = '';
  $datas['filter_marital_status'] = '';
  $datas['filter_minimum_salary'] = '';
  $datas['filter_maximum_salary'] = '';
  $datas['filter_nationality'] = '';
  $datas['filter_location'] = [];
  $datas['filter_name'] = '';
  $datas['filter_id'] = '';
  $datas['filter_email'] = '';
  $url = '';

  $employe_id = [];
  $jobapply = \App\JobApply::where('jobs_id',$id)->get();
  foreach ($jobapply as $key => $apply) {
      $expers = EmployeeExperience::where('employees_id',$apply->employees_id)->get();
      $yr = 0;
         if (count($expers) > 0) {
            $dif = 0;
             foreach ($expers as $exper) {
                $from = explode('-', $exper->from);
                $to = explode('-', $exper->to);
                 $dt1 = Carbon::createFromDate($from[0], $from[1], $from[2]);
                 $dt2 = Carbon::createFromDate($to[0], $to[1], $to[2]);

                 $dif += $dt1->diffInDays($dt2);


             }
             $yr = $dif / 365;

         }
         \App\EmployeeSetting::where('employees_id',$apply->employees_id)->update(['total_experience' => $yr]);
    $employe_id[] = $apply->employees_id;
  }

  $employee = Employees::select('employees.*')->join('employee_setting','employee_setting.employees_id','=','employees.id');
  if (isset($request->filter_education)) {
    if ($request->filter_education != '') {
      $employee->join('employee_education','employee_education.employees_id','=','employees.id');
    }

  }
  if (isset($request->filter_language)) {
    $employee->leftjoin('employee_language','employee_language.employees_id','=','employees.id');
  }
  if (isset($request->filter_location)) {
    $employee->leftjoin('employee_location','employee_location.employees_id','=','employees.id');
  }
  $employee->whereIn('employees.id',$employe_id);




  //$employee = Employees::whereIn('id', $employe_id);
  if (isset($request->filter_name) && !empty($request->filter_name)) {
    $employee->where('employees.firstname', 'like', '%' . $request->filter_name . '%');
    $datas['filter_name'] = $request->filter_name;
    $url .= '&filter_name='.$request->filter_name;
}

if (isset($request->filter_id) && !empty($request->filter_id)) {
    $employee->where('employees.id', $request->filter_id);
    $datas['filter_id'] = $request->filter_id;
    $url .= '&filter_id='.$request->filter_id;
}


if (isset($request->filter_email) && !empty($request->filter_email)) {
    $employee->where('employees.email', $request->filter_email);
    $datas['filter_email'] = $request->filter_email;
    $url .= '&filter_email='.$request->filter_email;
}

if (isset($request->filter_gender) && !empty($request->filter_gender)) {
    $employee->where('employees.gender', $request->filter_gender);
    $datas['filter_gender'] = $request->filter_gender;
    $url .= '&filter_gender='.$request->filter_gender;
}
if (isset($request->filter_marital_status) && !empty($request->filter_marital_status)) {
    $employee->where('employees.marital_status', $request->filter_marital_status);
    $datas['filter_marital_status'] = $request->filter_marital_status;
    $url .= '&filter_marital_status='.$request->filter_marital_status;
}
if (isset($request->filter_nationality) && !empty($request->filter_nationality)) {
    $employee->where('employees.nationality', $request->filter_nationality);
    $datas['filter_nationality'] = $request->filter_nationality;
    $url .= '&filter_nationality='.$request->filter_nationality;
}
if (isset($request->filter_minimum_salary) && !empty($request->filter_minimum_salary)) {
    $employee->where('employees.expected_salary', '>=', $request->filter_minimum_salary);
    $datas['filter_minimum_salary'] = $request->filter_minimum_salary;
    $url .= '&filter_minimum_salary='.$request->filter_minimum_salary;
}
if (isset($request->filter_maximum_salary) && !empty($request->filter_maximum_salary)) {
    $employee->where('employees.expected_salary', '<=', $request->filter_maximum_salary);
    $datas['filter_maximum_salary'] = $request->filter_maximum_salary;
    $url .= '&filter_maximum_salary='.$request->filter_maximum_salary;
}



if (isset($request->filter_minimum_age) && !empty($request->filter_minimum_age)) {
    $employee->where('employee_setting.age', '>=', $request->filter_minimum_age);
    $datas['filter_minimum_age'] = $request->filter_minimum_age;
    $url .= '&filter_minimum_age='.$request->filter_minimum_age;
}
if (isset($request->filter_maximum_age) && !empty($request->filter_maximum_age)) {
    $employee->where('employee_setting.age', '<=', $request->filter_maximum_age);
    $datas['filter_maximum_age'] = $request->filter_maximum_age;
    $url .= '&filter_maximum_age='.$request->filter_maximum_age;
}

if (isset($request->filter_experience) && !empty($request->filter_experience)) {
    $employee->where('employee_setting.total_experience', '>=', $request->filter_experience);
    $datas['filter_experience'] = $request->filter_experience;
    $url .= '&filter_experience='.$request->filter_experience;
}
if (isset($request->filter_travel) && !empty($request->filter_travel)) {
    $employee->where('employee_setting.travel', '>=', $request->filter_travel);
    $datas['filter_travel'] = $request->filter_travel;
    $url .= '&filter_travel='.$request->filter_travel;
}

if (isset($request->filter_relocate) && !empty($request->filter_relocate)) {
    $employee->where('employee_setting.relocation', '>=', $request->filter_relocate);
    $datas['filter_relocate'] = $request->filter_relocate;
    $url .= '&filter_relocate='.$request->filter_relocate;
}
if (isset($request->filter_license) && !empty($request->filter_license)) {
    $employee->where('employee_setting.license', '>=', $request->filter_license);
    $datas['filter_license'] = $request->filter_license;
    $url .= '&filter_license='.$request->filter_license;
}
if (isset($request->filter_vehicle) && !empty($request->filter_vehicle)) {
    $employee->where('employee_setting.have_vehical', '>=', $request->filter_vehicle);
    $datas['filter_vehicle'] = $request->filter_vehicle;
    $url .= '&filter_vehicle='.$request->filter_vehicle;
}

if (isset($request->filter_language) && !empty($request->filter_language)) {
    $employee->where('employee_language.language', $request->filter_language);
    $datas['filter_language'] = $request->filter_language;
    $url .= '&filter_language='.$request->filter_language;
}

if (isset($request->filter_location) && !empty($request->filter_location)) {
    $employee->where('employee_location.job_location_id', $request->filter_location);
    $datas['filter_location'] = $request->filter_location;
    $url .= '&filter_location='.$request->filter_location;
}
if (isset($request->filter_education) && !empty($request->filter_education)) {
            $employee->where('employee_education.level_id', $request->filter_education);
            $datas['filter_education'] = $request->filter_education;
            $url .= '&filter_education='.$request->filter_education;
        }
        if (isset($request->filter_faculty) && !empty($request->filter_faculty)) {
            $employee->where('employee_education.faculty_id', $request->filter_faculty);
            $datas['filter_faculty'] = $request->filter_faculty;
            $url .= '&filter_faculty='.$request->filter_faculty;
        }

$employee->where(function ($q) use ($request,$datas,$url) {

        if ($request->has('filter_percentage')) {
          $q->where('employee_education.marksystem', 1)->where('employee_education.percentage', '>=', $request->filter_percentage);



        }

        if (isset($request->filter_cgpa4) && !empty($request->filter_cgpa4)) {
            $q->orWhere('employee_education.marksystem', 2)->Where('employee_education.percentage', '>=', $request->filter_cgpa4);



        }

         if (isset($request->filter_cgpa10) && !empty($request->filter_cgpa10)) {
            $q->orWhere('employee_education.marksystem', 3)->Where('employee_education.percentage', '>=', $request->filter_cgpa10);


        }


    });

 if ($request->has('filter_percentage')) {
  $datas['filter_percentage'] = $request->filter_percentage;
          $url .= '&filter_percentage='.$request->filter_percentage;
 }
  if ($request->has('filter_cgpa4')) {
     $datas['filter_cgpa4'] = $request->filter_cgpa4;
            $url .= '&filter_cgpa4='.$request->filter_cgpa4;
  }
  if ($request->has('filter_cgpa10')) {
    $datas['filter_cgpa10'] = $request->filter_cgpa10;
            $url .= '&filter_cgpa10='.$request->filter_cgpa10;
  }


$datas['employees'] = $employee->orderby('employees.firstname','asc')->groupBy('employees.id')->paginate(50)->setPath('?'.$url);
$datas['job_id'] = $id;
$datas['job_title'] = Jobs::getTitle($id);
$datas['job_code'] = Jobs::getCode($id);

$datas['education_levels'] = \App\EducationLevel::orderBy('id','asc')->get();
$datas['faculty'] = [];
if (isset($request->filter_education)) {
  $datas['faculty'] = \App\Faculty::where('level_id',$request->filter_education)->orderBy('name','asc')->get();
}

$datas['yesno'][] = ['value' => 1, 'title' => 'Yes'];
$datas['yesno'][] = ['value' => 2, 'title' => 'No'];

$datas['gender'][] = ['value' => 'Male', 'title' => 'Male'];
$datas['gender'][] = ['value' => 'Female', 'title' => 'Female'];

$datas['marital_status'][] = ['value' => 'Single', 'title' => 'Single'];
$datas['marital_status'][] = ['value' => 'Married', 'title' => 'Married'];
$datas['marital_status'][] = ['value' => 'Divorced', 'title' => 'Divorced'];

$datas['locations'] = \App\JobLocation::orderBy('name', 'asc')->get();
$datas['nationality'] = \App\Employees::select('nationality')->where('nationality', '!=', '')->groupBy('nationality')->orderBy('nationality','asc')->get();
$datas['language'] = \App\EmployeeLanguage::select('language')->groupBy('language')->orderBy('language','asc')->get();



//new added






        $daywise = JobApply::where('jobs_id', $id)->groupBy('apply_date')->get();

        $datas['total_male'] = Employees::whereIn('id',$employe_id)->where('gender', 'Male')->count();
        $datas['total_female'] = Employees::whereIn('id',$employe_id)->where('gender', 'Female')->count();




        $datas['daywise'] = [];
        foreach ($daywise as $dys) {

            $visits = 0;
            $visit = \App\Counter::where('job_id', $id)->where('visit_date', $dys->apply_date)->first();
            if(isset($visit->visits))
            {
                $visits = $visit->visits;
            }
            $datas['daywise'][] = [
                'title' => $dys->apply_date,
                'total_application' => JobApply::where('jobs_id', $id)->where('apply_date', $dys->apply_date)->count(),
                'total_visit' => $visits,

            ];
        }


        $datas['age'][] = [
            'title' => '18-',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $employe_id)->where('age', '<', '18')->count(),
            'color' => '#f56954',

        ];
        $datas['age'][] = [
            'title' => '18-22',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $employe_id)->where('age', '>=', '18')->where('age', '<', '22')->count(),
            'color' => '#00a65a',

        ];

        $datas['age'][] = [
            'title' => '22-26',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $employe_id)->where('age', '>=', '22')->where('age', '<', '26')->count(),
            'color' => '#f39c12',

        ];
        $datas['age'][] = [
            'title' => '26-30',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $employe_id)->where('age', '>=', '26')->where('age', '<', '30')->count(),
            'color' => '#00c0ef',

        ];
        $datas['age'][] = [
            'title' => '30-40',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $employe_id)->where('age', '>=', '30')->where('age', '<', '40')->count(),
            'color' => '#3c8dbc',

        ];
        $datas['age'][] = [
            'title' => '40-50',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $employe_id)->where('age', '>=', '40')->where('age', '<=', '50')->count(),
            'color' => '#d2d6de',

        ];
        $datas['age'][] = [
            'title' => '50+',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $employe_id)->where('age', '>', '50')->count(),
            'color' => '#43e96e',

        ];


        $datas['processes'] = JobProcess::where('jobs_id',$id)->orderBy('sort_order','asc')->get();
        $datas['url'] = $url;


return view('employer.jobs.application')->with('datas',$datas);
}

public function processApplications($job_id, $process_id, Request $request)
{

  $datas['process_id'] = $process_id;
  $employe_id = [];
  $jobapply = \App\JobProcess::where('id',$process_id)->first();
  if (isset($jobapply->candidates)) {
    $candidates = json_decode($jobapply->candidates);
    if(is_array($candidates)) {
      foreach ($candidates as $key => $apply) {
        $employe_id[] = $apply;
      }
    }
  }


  $employee = Employees::whereIn('id', $employe_id)->where('status', '!=', 0)->where('trash', 0);
  if (isset($request->filter_name) && !empty($request->filter_name)) {
    $employee->where(\DB::raw('CONCAT_WS(" ", `firstname`, `middlename`, `lastname`)'), 'like', '%' . $request->filter_name . '%');
    $datas['filter_name'] = $request->filter_name;
}else{
    $datas['filter_name'] = '';
}

if (isset($request->filter_id) && !empty($request->filter_id)) {
    $employee->where('id', $request->filter_id);
    $datas['filter_id'] = $request->filter_id;
}else{
    $datas['filter_id'] = '';
}


if (isset($request->filter_email) && !empty($request->filter_email)) {
    $employee->where('email', $request->filter_email);
    $datas['filter_email'] = $request->filter_email;
}else{
    $datas['filter_email'] = '';
}


$datas['employees'] = $employee->orderBy('firstname','asc')->paginate(50);
$datas['job_id'] = $job_id;
$datas['job_title'] = Jobs::getTitle($job_id);
$datas['job_code'] = Jobs::getCode($job_id);
$datas['all_processes'] = JobProcess::where('jobs_id',$job_id)->orderBy('sort_order','asc')->get();

$process_sort = 0;
    $process = \App\JobProcess::where('id', $process_id)->first();
    if (isset($process->sort_order)) {
      $process_sort = $process->sort_order;
    }
    if($process_sort == 0)
    {
      $datas['processes'] = \App\JobProcess::where('jobs_id',$job_id)->orderBy('sort_order','asc')->get();
    }else{
      $datas['processes'] = \App\JobProcess::where('jobs_id',$job_id)->where('sort_order','>',$process_sort)->orderBy('sort_order','asc')->get();
    }


return view('employer.jobs.process_applicants')->with('datas',$datas);
}

public function updateApplication(Request $request)
    {


        $v= Validator::make($request->all(),
            [

                    'process_id' => 'required|integer',


            ]);
        if($v->fails())
        {
            \Session::flash('alert-danger','Sorry we did not found the job.');
        return redirect()->back();
        }

        $apps = \App\JobProcess::where('id',$request->process_id)->first();
      $applicant_id = [];
      if (isset($apps->candidates)) {
        if (is_array(json_decode($apps->candidates))) {
          $applicant_id = json_decode($apps->candidates);
        }
      }


        if (is_array($request->employee_id)) {
          foreach ($request->employee_id as $value){
            if (!in_array($value, $applicant_id)) {
                    $applicant_id[] = $value;
                  }

          }
          \App\JobProcess::where('id',$request->process_id)->update(['candidates' => json_encode($applicant_id)]);
           \Session::flash('alert-success','You Successfully update application for '.$apps->title);
        return redirect('employer/jobs/process/'.$apps->jobs_id.'/'.$request->process_id);
        } else{
          \Session::flash('alert-danger','Sorry you did not select any application.');
        return redirect()->back();
        }


    }




public function applicationView($id,Request $request)
{

    $employee= Employees::where('id',$id)->first();
    if($employee) {
        if (isset($employee->image) && !empty($employee->image)) {
         $datas['image'] = asset('image/' . $employee->image);
     } else {
        $datas['image'] ='';
    }


    $datas['employee'] = $employee;


    $datas['education'] = $employee->EmployeeEducation;
    $datas['experience'] = $employee->EmployeeExperience;
    $datas['language'] = $employee->EmployeeLanguage;

    $datas['reference'] = $employee->EmployeeReference;
    $datas['form_data'] = \App\FormData::where('employees_id', $employee->id)->where('jobs_id',$request->job_id)->get();
    $datas['training'] = $employee->EmployeeTraining;
    $datas['process_id'] = $request->process_id;
    $datas['job_id'] = $request->job_id;
    $datas['job_title'] = Jobs::getTitle($request->job_id);
    $datas['process_title'] = \App\JobProcess::getTitle($request->process_id);
    $process_sort = 0;
    $process = \App\JobProcess::where('id', $request->process_id)->first();
    if (isset($process->sort_order)) {
      $process_sort = $process->sort_order;
    }
    //dd($datas['reference']);
    if($process_sort == 0)
    {
      $datas['processes'] = \App\JobProcess::where('jobs_id',$request->job_id)->orderBy('sort_order','asc')->get();
    }else{
      $datas['processes'] = \App\JobProcess::where('jobs_id',$request->job_id)->where('sort_order','>',$process_sort)->orderBy('sort_order','asc')->get();
    }



    return view('employer.jobs.applicant_view')->with('datas', $datas);
} else {

   \Session::flash('alert-danger','You choosed wrong Data');
   return redirect()->back();
}

}







public function uploadFile(Request $request)
 {
      if ($request->hasFile('file')) {

            // Validate the filename length
            $v= Validator::make($request->all(),
                        [
                    'file'=>'mimes:jpeg,jpg,png,gif|required|max:10000',

                        ]);
                 if($v->fails())
                    {
                        return 'Error|File format did not match. Please upload Jpeg,jpg,ping,gif format|' ;
                    }

            $directory = DIR_IMAGE . 'catalog/employers/'.auth()->guard('employer')->user()->employers_id;

            $answer = \App\EmployerQuestionAnswer::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('employer_question_id', $request->question_id)->first();

            if (isset($answer->image)) {

                if (is_file(DIR_IMAGE.$answer->image)) {
                    File::delete(DIR_IMAGE.$answer->image);


                }
            }

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }
            $file = $request->File('file');
            $rand = \Str::random(10);
            $new_name = $rand.'.'.$file->getClientOriginalExtension();
            $file->move($directory, $new_name);

        $banner = 'catalog/employers/'.auth()->guard('employer')->user()->employers_id.'/'.$new_name;


            $imagefile = Imagetool::mycrop($banner, 40, 40);


            return 'Success|<img src="'.asset($imagefile).'">|'.$banner;
            }
 }

 public function jobType(Request $request)
 {
  $jobtype = JobType::where('id', $request->id)->first();
  $datas = [];
  $datas['jobtype'] = $jobtype;
  $datas['prices'] = $jobtype->JobPrice;
  return view('employer.job_type')->with('data', $datas);
 }


 public function upgrade(Request $request)
 {
  $employer = Employers::select('member_type')->where('id',auth()->guard('employer')->user()->employers_id)->first();
  $member_type = MemberType::whereNotIn('id', ['4',$employer->member_type])->orderBy('id', 'desc')->get();


  $datas['member_type'] = $member_type;
  //dd($datas);
  return view('employer.upgrade_member')->with('datas', $datas);
 }


 public function memberTypeView($id)
 {

  $mtype = MemberType::where('id', $id)->first();
  if(isset($mtype->id))
  {
   $config = array(
          'app.meta_title' => $mtype->name.' Detail' ,
          'app.meta_keyword' => $mtype->name,
          'app.meta_description' => $mtype->name.' Detail' ,
          'app.meta_image' => '',
          'app.meta_url' => url('/employer/membertype/'.$mtype->id),
          'app.meta_type' => $mtype->name.' Detail' ,

      );




         config($config);


  return view ('employer.membertypeview')->with('data', $mtype);
 }else {
       $config = array(
              'app.meta_title' => 'Member Type Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Member Type Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'),
              'app.meta_type' => 'job',

                );
            config($config);
        return   view('front.employer.employer_not_found');
      }


       }


       public function upgradeRequest(Request $request)
       {


         $v= Validator::make($request->all(),
            [

                    'member_type' => 'required|integer'

            ]);
        if($v->fails())
        {
          \Session::flash('alert-danger','Member Type is Required');
          return redirect()->back();
          } else{
            $employer = Employers::select('id','member_type')->where('id',auth()->guard('employer')->user()->employers_id)->first();


              if ($request->member_type == $employer->member_type) {
                \Session::flash('alert-danger','You are already in this member type.');
                return redirect()->back();
              }
              $checkrequest = UpgradeRequest::where('employers_id',$employer->id)->where('member_type_id',$request->member_type)->where('status',0)->count();
              if ($checkrequest > 0) {
                \Session::flash('alert-danger','You are already send request to upgrade. We will take action very soon');
                return redirect()->back();
              }


                $data = [
                  'employers_id' => auth()->guard('employer')->user()->employers_id,
                  'member_type_id' => $request->member_type
                ];
                $id = UpgradeRequest::create($data);
                if ($id) {

                  $datas = [
                     'from_name' => Settings::getSettings()->name,
                     'from_email' => 'noreply@rollingplans.com.np',
                     'to_name' => Settings::getSettings()->name,
                     'store_name' => Settings::getSettings()->name,
                     'to_email' => Settings::getSettings()->email,
                     'member_name' => auth()->guard('employer')->user()->name,
                     'member_type' => MemberType::getTypeTitle($request->member_type),
                     'subject' => 'Member Upgrade Request',
                  ];
                  myFunctions::setEmail();
            Mail::send('employer.requestmail', ['datas' => $datas], function($mail) use ($datas){
                      $mail->to($datas['to_email'],$datas['to_name'])->from($datas['from_email'],$datas['from_name'])->subject($datas['subject']);
                });
            \Session::flash('alert-success','Thank you for upgradeing your plan. We will approve your plan very soon.');
            return redirect()->back();
          } else{

            \Session::flash('alert-danger','Something went wrong while upgradeing member. Please contact web administrator.');
            return redirect()->back();

          }


       }
     }

     public function cart()
     {
      $carts = \App\Cart::where('employers_id', auth()->guard('employer')->user()->employers_id)->get();

        $datas = [];
        $datas['total_amount'] = 0;
         $job_id = [];
         $datas['cart'] = [];
        foreach ($carts as $cart) {


          $job_id[] = $cart->id;

        $datas['total_amount'] += $cart->amount;
        $datas['cart'][] = [
           'id' => $cart->id,
          'job_type_id' => $cart->job_type_id,
          'job_type' => $cart->job_type,
          'type' => $cart->type,
          'duration' => $cart->duration,
          'job_number' => $cart->number_of,
          'amount' => $cart->amount,

        ];




        }


        session(['cart_id' => rand(9999,15), 'total_amount' => $datas['total_amount'], 'job_id' => $job_id]);



        return view('employer.cart')->with('datas',$datas);




     }

     public function deleteCart($id)
     {
      $carts = \App\Cart::where('id', $id)->delete();

        \Session::flash('alert-success','Data deleted successfully');
        return redirect()->back();
     }


     public function checkout()
     {
      if(session()->has('cart_id'))
      {

        $payment_options = \App\Payments::where('status', 1)->get();

      return view('employer.checkout')->with('payments',$payment_options);



      } else{

            return redirect('employer/cart');
      }

     }

     public function payment(Request $request)
     {

       $opt = \App\Payments::where('id', $request->id)->first();
    //    dd('\App\Http\Controllers\employer\payments\\'.$opt->payment_page.'Controller');
       if(isset($opt->payment_page))
       {
            $cont= '\App\Http\Controllers\employer\payments\\'.$opt->payment_page.'Controller';
            $module = new $cont();
            return $module->index();

            } else{
                return 'error';
            }

     }


    public function ApproveExperience(Request $request)
    {
      $this->validate($request,['type' => 'required', 'id' => 'required|integer']);
      EmployeeExperience::where('id', $request->id)->update(['status' => $request->type]);
      $emp = EmployeeExperience::select('employees_id')->where('id', $request->id)->first();
      if(isset($emp->employees_id)){
       $check = EmployeeActivity::where('employees_id',$emp->employees_id)->first();
                  if (isset($check->id)) {
                      $total_verify = 1;
                      if($check->total_verify > 0)
                      {
                          $total_verify = $check->total_verify + 1;
                      }
                      EmployeeActivity::where('id',$check->id)->update(['total_verify' => $total_verify]);
                  }else{
                      EmployeeActivity::create(['employees_id' => $emp->employees_id, 'total_verify' => 1]);
                  }

      }
      \Session::flash('alert-success', 'Data updated successfully');
      return redirect()->back();
    }

    public function uploadXlprocess(Request $request)
      {


      $v= Validator::make($request->all(),
        [
          'jobs_id' => 'required|integer',
          'process_id' => 'required|integer',
          'upload_file' => 'mimes:csv,txt',

        ]);
      if($v->fails())
      {

        \Session::flash('alert-danger','Data Validation Fail.');
        return redirect()->back()->withErrors($v)
        ->withInput();
      }

      $apps = \App\JobProcess::where('id',$request->process_id)->first();
      $applicant_id = [];
      if (isset($apps->candidates)) {
        if (is_array(json_decode($apps->candidates))) {
          $applicant_id = json_decode($apps->candidates);
        }
      }
            //get file
      $upload = $request->file('upload_file');
      $filePath = $upload->getRealPath();
            //open and read

      $file = fopen($filePath, 'r');

      $header = fgetcsv($file);

      $lheader = [];
      foreach ($header as $key => $value) {
        $lh = strtolower($value);
        array_push($lheader, $lh);
      }


      while ($columns = fgetcsv($file) ) {
        if($columns[0] == "")
        {
          continue;
        }
        foreach ($columns as $key => &$value) {
          $vlaue = trim($value);
        }
        $data = array_combine($lheader, $columns);
        if (!in_array($data['applicant'], $applicant_id)) {
          $applicant_id[] = $data['applicant'];
        }




      }

      \App\JobProcess::where('id',$request->process_id)->update(['candidates' => json_encode($applicant_id)]);

      \Session::flash('alert-success','Record have been updated Successfully');
      return redirect()->back();

      }









      public function exportCsv(Request $request)
      {
        //return (new ApplicationExport($job_id))->download('invoices.csv', \Maatwebsite\Excel\Excel::CSV);
       //return Excel::download(new ApplicationExport($job_id), 'applications.csv',\Maatwebsite\Excel\Excel::CSV);
       //return (new ApplicationExport)->forRequest($job_id)->download('ticket.xlsx');
       return Excel::download(new ApplicationExport($request), 'applications.xlsx');
        //return Excel::download(new ApplicationExport($job_id), 'applications.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
      }

      public function saveJobProcess(Request $request)
      {
        $this->validate($request, [
          'job_id' => 'required|integer',
          'title' => 'required',
          'sort_order' => 'required'
        ]);

        $alow = \App\MemberType::getProcessNo();

        $proc = \App\JobProcess::select('id')->where('jobs_id',$request->job_id)->get();
        if ($alow == count($proc)) {

          \Session::flash('alert-danger','You can not add more process. If you need more process please upgrade account');
          return redirect()->back();
        }
        \App\JobProcess::create([
          'jobs_id' => $request->job_id,
          'title' => $request->title,
          'sort_order' => $request->sort_order,
          'email_txt' => $request->email_text
        ]);

        \Session::flash('alert_success','Data added successfully');
        return redirect()->back();
      }

      public function updateJobProcess(Request $request)
      {
        $this->validate($request, [
          'process_id' => 'required|integer',
          'title' => 'required',
          'sort_order' => 'required'
        ]);

        \App\JobProcess::where('id',$request->process_id)->update([

          'title' => $request->title,
          'sort_order' => $request->sort_order,
          'email_txt' => $request->email_text
        ]);

        \Session::flash('alert_success','Data update successfully');
        return redirect()->back();
      }

      public function deleteJobProcess($id)
      {


        \App\JobProcess::where('id',$id)->delete();

        \Session::flash('alert_success','Data deleted successfully');
        return redirect()->back();
      }

      public function sendEmail(Request $request)
      {
        $datas['jobs'] = \App\Jobs::select('id','title','vacancy_code')->where('employers_id', auth()->guard('employer')->user()->employers_id)->orderBy('id','desc')->get();

        return view('employer.jobs.send-email')->with('datas',$datas);
      }

      public function getProcess(Request $request)
      {
        $return = '<option value="0">All Applicant</option>';
        $process = \App\JobProcess::where('jobs_id',$request->job_id)->get();
        foreach ($process as $key => $value) {
          $return .= '<option value="'.$value->id.'">'.$value->title.'</option>';
        }
        return $return;
      }

      public function getProcessDetail(Request $request)
      {
        $return = 'Dear %employee-name%, <br><br>Your application was received on %application-date% for the post of %job-title%. We are in %job-process%. <br> Please Wait for further process.<br><br>%employer-name%<br><br>HR Division';
        $process = \App\JobProcess::where('id',$request->process_id)->first();
        if (isset($process->email_txt)) {
          $return = $process->email_txt;
        }
        return $return;
      }


      public function sendMail(Request $request)
      {
        $this->validate($request, [
          'job' => 'required|integer',
          'job_process' => 'required|integer',
          'subject' => 'required',
          'from' => 'required|email',
          'message' => 'required'
        ]);
        $emp_ids = [];
        $total = 0;
        if ($request->job_process > 0) {
          $jobprocess = \App\JobProcess::where('id',$request->job_process)->first();
           $process = $jobprocess->title;
          if (isset($jobprocess->candidates)) {
            $candidates = json_decode($jobprocess->candidates);
            if (is_array($candidates)) {
               $emp_ids = $candidates;
            }
          }
        } else{
          $process = 'Application On Process';
          $job_apply = \App\JobApply::where('jobs_id',$request->job)->get();
          foreach ($job_apply as $key => $apply) {
            $emp_ids[] = $apply->employees_id;
          }
        }
        $job_title = \App\Jobs::getTitle($request->job);
        $employees = \App\Employees::select('firstname','middlename','lastname','id','email')->whereIn('id',$emp_ids)->groupBy('id')->orderBy('firstname','asc')->get();

        foreach ($employees as $key => $employee) {
          $employeename = $employee->firstname.' '.$employee->middlename.' '.$employee->lastname;
          $appl = \App\JobApply::where('jobs_id',$request->job)->where('employees_id',$employee->id)->first();
          $apply_date = '';
          if (isset($appl->apply_date)) {
            $apply_date = $appl->apply_date;
          }


          $find = array("%employee-name%", "%application-date%", "%job-title%", "%job-process%");
          $replace   = array($employeename, $apply_date, $job_title, $process);

          $message = str_replace($find,$replace,$request->message);
          $datas = [
                'from_name' => Settings::getSettings()->name,
                'from_email' => $request->from,
                'to_name' => $employeename,
                'to_email' => strtolower(trim($employee->email)),
                'subject' => $request->subject,
                'message' => $message,
          ];

          set_time_limit(600);
         myFunctions::setEmail();
        Mail::queue('mail.applicant_email', ['datas' => $datas], function($mail) use ($datas){
                  $mail->to($datas['to_email'],$datas['to_name'])->from($datas['from_email'],$datas['from_name'])->subject($datas['subject']);
                        });
        $total = $total + 1;
        }

        \Session::flash('alert-success','Email send successfully '.$total);
        return redirect()->back();




      }

       public function projectDashboard(Request $request)
    {






         $config = array(
          'app.meta_title' => 'Employer Project Dashboard',
          'app.meta_keyword' => 'Employer Project Dashboard',
          'app.meta_description' => 'Employer Project Dashboard',
          'app.meta_image' => '',
          'app.meta_url' => url('/employer/dashboard/project'),
          'app.meta_type' => 'Employer Project Dashboard',

        );




         config($config);

         $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();

          $pr = 0;
          if($employer->org_type != 0)
          {
            $pr += 1;
          }
           if($employer->ownership != 0)
          {
            $pr += 1;
          }
           if($employer->logo != '')
          {
            $pr += 1;
          }
           if($employer->banner != '')
          {
            $pr += 1;
          }
           if($employer->description != '')
          {
            $pr += 1;
          }
           if($employer->approval != 0)
          {
            $pr += 1;
          }

          $address = $employer->EmployerAddress;
          $head = $employer->EmployerHead;
          $contactperson = $employer->EmployerContactPerson;
           if($address->phone != '')
          {
            $pr += 1;
          }

          if($address->secondary_email != '')
          {
            $pr += 1;
          }
          if($address->fax != '')
          {
            $pr += 1;
          }
          if($address->pobox != '')
          {
            $pr += 1;
          }
          if($address->website != '')
          {
            $pr += 1;
          }
          if($address->address != '')
          {
            $pr += 1;
          }
          if($address->country != '')
          {
            $pr += 1;
          }
          if($address->city != '')
          {
            $pr += 1;
          }
          if($address->billing_address != '')
          {
            $pr += 1;
          }

          if($contactperson->phone != '')
          {
            $pr += 1;
          }
          if($contactperson->name != '')
          {
            $pr += 1;
          }
          if($contactperson->designation != '')
          {
            $pr += 1;
          }
          if($contactperson->email != '')
          {
            $pr += 1;
          }
          if($head->name != '')
          {
            $pr += 1;
          }
          if($head->designation != '')
          {
            $pr += 1;
          }
         $employer_id = $employer->id;
         $percent = ($pr / 21) * 100;
         $datas['profile_complete'] = number_format($percent);
         $today = Carbon::now()->toDateString();

         $active = Project::where('employers_id', $employer->id)->where('status', 1)->where('deadline', '>=', $today)->where('publish_date', '<=', $today)->get();
         $completed = Project::where('employers_id', $employer->id)->where('status', 2)->where('deadline', '<', $today)->get();
         $pending = Project::where('employers_id', $employer->id)->where('status', 3)->get();


         $datas['active'] = $active;
         $datas['completed'] = $completed;
         $datas['pending'] = $pending;
         $datas['address'] = $address;
         $datas['head'] = $head;
         $datas['contact'] = $contactperson;



         $datas['employer'] = $employer;
        $datas['last_login'] = $employer->last_login;


        $datas['category'] = [];
        $categories = JobCategory::orderBy('name', 'asc')->get();
        foreach ($categories as $key => $category) {
          $ecate = EmployeeCategory::where('job_category_id', $category->id)->count();
          $datas['category'][] = [
            'title' => $category->name,
            'total' => $ecate
          ];
        }

         $member_types = MemberType::select('id')->orderBy('rank','desc')->first();

        $emp_loyers = Employers::select('id')->where('member_type','>',$member_types->id)->get();
        $yesterday = Carbon::now()->subDay(1)->toDateString();

        foreach ($emp_loyers as $key => $emp) {
          $check = UpgradeRequest::where('employers_id',$emp->id)->where('member_type_id', '!=', $member_types->id)->where('end_date',$yesterday)->count();
          if ($check > 0) {
            Employers::where('id',$emp->id)->update(['member_type' => $member_types->id]);
          }
        }
        $datas['rm_approve'] = EmployeeExperience::where('employers_id',$employer->id)->where('status','0')->where('currently_working', '!=',1)->get();

         //new added
         $project_id = [];
        $datas['filter_stat'] = '';
        $datas['from'] = '';
        $datas['to'] = '';

       $projects = Project::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('publish_date', '<=', date('Y-m-d'))->where('deadline', '>=', date('Y-m-d'));
       $datas['total_project'] = Project::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->count();
       $datas['application_receiving'] = Project::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('publish_date', '<=', date('Y-m-d'))->where('deadline', '>=', date('Y-m-d'))->count();
        if(isset($request->filter_stat))
        {
            if($request->filter_stat == 1){
                $datas['filter_stat'] = 1;
                 $projects = Project::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id);
            }
        }
        if(isset($request->from) && isset($request->to))
        {
            $datas['filter_stat'] = 10;
            $datas['from'] = $request->from;
            $datas['to'] = $request->to;
            $projects = Project::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('deadline', '>=', $request->from)->where('deadline', '<=', $request->to);
             $datas['application_receiving'] = Project::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('deadline', '>=', $request->from)->where('deadline', '<=', $request->to)->count();
        }
        $js = $projects->get();
        foreach ($js as $j) {
            $project_id[] = $j->id;
        }

        $applicants = \App\ProjectApply::whereIn('project_id', $project_id);
        $daywise = \App\ProjectApply::whereIn('project_id', $project_id)->groupBy('apply_date')->get();
        if(isset($request->from) && isset($request->to)){
            $applicants = \App\ProjectApply::whereIn('project_id', $project_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to);
            $daywise = \App\ProjectApply::whereIn('project_id', $project_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to)->groupBy('apply_date')->get();
        }



        $datas['total_applicants'] = $applicants->count();

        $apps= $applicants->get();
        $emp_ids = [];
        foreach ($apps as $key => $app) {
          $emp_ids[] = $app->employees_id;
        }



        $datas['total_male'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Male')->count();
        $datas['total_female'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Female')->count();






        $datas['daywise'] = [];
        foreach ($daywise as $dys) {


            $datas['daywise'][] = [
                'title' => $dys->apply_date,
                'total_application' => ProjectApply::whereIn('project_id', $project_id)->where('apply_date', $dys->apply_date)->count(),
                'total_visit' => \App\Counter::whereIn('project_id', $project_id)->where('visit_date', $dys->apply_date)->sum('visits'),

            ];
        }


        $datas['age'][] = [
            'title' => '18-',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '<', '18')->count(),
            'color' => '#f56954',

        ];
        $datas['age'][] = [
            'title' => '18-22',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '18')->where('age', '<', '22')->count(),
            'color' => '#00a65a',

        ];

        $datas['age'][] = [
            'title' => '22-26',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '22')->where('age', '<', '26')->count(),
            'color' => '#f39c12',

        ];
        $datas['age'][] = [
            'title' => '26-30',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '26')->where('age', '<', '30')->count(),
            'color' => '#00c0ef',

        ];
        $datas['age'][] = [
            'title' => '30-40',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '30')->where('age', '<', '40')->count(),
            'color' => '#3c8dbc',

        ];
        $datas['age'][] = [
            'title' => '40-50',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '40')->where('age', '<=', '50')->count(),
            'color' => '#d2d6de',

        ];
        $datas['age'][] = [
            'title' => '50+',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>', '50')->count(),
            'color' => '#43e96e',

        ];

        $members = \App\EmployerUser::where('employers_id', auth()->guard('employer')->user()->employers_id)->get();
        $datas['members'] = [];
        foreach ($members as $key => $member) {
            if ($member->image != '') {
                $image = Imagetool::mycrop($member->image,200,200);
            } else{
                $image = Imagetool::mycrop('no-image.png',200,200);
            }
           $datas['members'][] = [
            'name' => $member->name,
            'designation' => $member->designation,
            'image' => $image,
            'user_type' => $member->user_type
           ];
        }


        $datas['total_single'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Single')->count();
        $datas['total_married'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Married')->count();
         $datas['total_divorced'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'divorced')->count();


         $addresses = \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->whereNotNull('permanent_district')->groupBy('permanent_district')->get();
         $datas['districts'] = [];

         foreach ($addresses as $key => $address) {
           $datas['districts'][] = [
            'title' => $address->permanent_district,
            'total' => \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->where('permanent_district', $address->permanent_district)->count(),
            'color' => \App\EmployeeAddress::getColour($address->permanent_district)
           ];
         }

        //dd($datas);

          return view('employer.dashboardproject')->with('data', $datas);

 }


 public function trainingDashboard(Request $request)
    {






         $config = array(
          'app.meta_title' => 'Employer training Dashboard',
          'app.meta_keyword' => 'Employer training Dashboard',
          'app.meta_description' => 'Employer training Dashboard',
          'app.meta_image' => '',
          'app.meta_url' => url('/employer/dashboard/training'),
          'app.meta_type' => 'Employer training Dashboard',

      );




         config($config);

         $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();

          $pr = 0;
          if($employer->org_type != 0)
          {
            $pr += 1;
          }
           if($employer->ownership != 0)
          {
            $pr += 1;
          }
           if($employer->logo != '')
          {
            $pr += 1;
          }
           if($employer->banner != '')
          {
            $pr += 1;
          }
           if($employer->description != '')
          {
            $pr += 1;
          }
           if($employer->approval != 0)
          {
            $pr += 1;
          }

          $address = $employer->EmployerAddress;
          $head = $employer->EmployerHead;
          $contactperson = $employer->EmployerContactPerson;
           if($address->phone != '')
          {
            $pr += 1;
          }

          if($address->secondary_email != '')
          {
            $pr += 1;
          }
          if($address->fax != '')
          {
            $pr += 1;
          }
          if($address->pobox != '')
          {
            $pr += 1;
          }
          if($address->website != '')
          {
            $pr += 1;
          }
          if($address->address != '')
          {
            $pr += 1;
          }
          if($address->country != '')
          {
            $pr += 1;
          }
          if($address->city != '')
          {
            $pr += 1;
          }
          if($address->billing_address != '')
          {
            $pr += 1;
          }

          if($contactperson->phone != '')
          {
            $pr += 1;
          }
          if($contactperson->name != '')
          {
            $pr += 1;
          }
          if($contactperson->designation != '')
          {
            $pr += 1;
          }
          if($contactperson->email != '')
          {
            $pr += 1;
          }
          if($head->name != '')
          {
            $pr += 1;
          }
          if($head->designation != '')
          {
            $pr += 1;
          }
         $employer_id = $employer->id;
         $percent = ($pr / 21) * 100;
         $datas['profile_complete'] = number_format($percent);
         $today = Carbon::now()->toDateString();

         $active = Training::where('employers_id', $employer->id)->where('status', 1)->where('end_date', '>=', $today)->where('start_date', '<=', $today)->get();
         $completed = Training::where('employers_id', $employer->id)->where('status', 2)->where('end_date', '<', $today)->get();
         $pending = Training::where('employers_id', $employer->id)->where('status', 3)->get();


         $datas['active'] = $active;
         $datas['completed'] = $completed;
         $datas['pending'] = $pending;
         $datas['address'] = $address;
         $datas['head'] = $head;
         $datas['contact'] = $contactperson;



         $datas['employer'] = $employer;
        $datas['last_login'] = $employer->last_login;


        $datas['category'] = [];
        $categories = JobCategory::orderBy('name', 'asc')->get();
        foreach ($categories as $key => $category) {
          $ecate = EmployeeCategory::where('job_category_id', $category->id)->count();
          $datas['category'][] = [
            'title' => $category->name,
            'total' => $ecate
          ];
        }

         $member_types = MemberType::select('id')->orderBy('rank','desc')->first();

        $emp_loyers = Employers::select('id')->where('member_type','>',$member_types->id)->get();
        $yesterday = Carbon::now()->subDay(1)->toDateString();

        foreach ($emp_loyers as $key => $emp) {
          $check = UpgradeRequest::where('employers_id',$emp->id)->where('member_type_id', '!=', $member_types->id)->where('end_date',$yesterday)->count();
          if ($check > 0) {
            Employers::where('id',$emp->id)->update(['member_type' => $member_types->id]);
          }
        }
        $datas['rm_approve'] = EmployeeExperience::where('employers_id',$employer->id)->where('status','0')->where('currently_working', '!=',1)->get();

         //new added
         $training_id = [];
        $datas['filter_stat'] = '';
        $datas['from'] = '';
        $datas['to'] = '';

       $projects = Training::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'));
       $datas['total_training'] = Training::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->count();
       $datas['application_receiving'] = Training::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->count();
        if(isset($request->filter_stat))
        {
            if($request->filter_stat == 1){
                $datas['filter_stat'] = 1;
                 $trainings = Training::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id);
            }
        }
        if(isset($request->from) && isset($request->to))
        {
            $datas['filter_stat'] = 10;
            $datas['from'] = $request->from;
            $datas['to'] = $request->to;
            $projects = Training::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('end_date', '>=', $request->from)->where('end_date', '<=', $request->to);
             $datas['application_receiving'] = Training::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('end_date', '>=', $request->from)->where('end_date', '<=', $request->to)->count();
        }
        $js = $projects->get();
        foreach ($js as $j) {
            $training_id[] = $j->id;
        }

        $applicants = \App\TrainingApply::whereIn('training_id', $training_id);
        $daywise = \App\TrainingApply::whereIn('training_id', $training_id)->groupBy('apply_date')->get();
        if(isset($request->from) && isset($request->to)){
            $applicants = \App\TrainingApply::whereIn('training_id', $training_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to);
            $daywise = \App\TrainingApply::whereIn('training_id', $training_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to)->groupBy('apply_date')->get();
        }



        $datas['total_applicants'] = $applicants->count();

        $apps= $applicants->get();
        $emp_ids = [];
        foreach ($apps as $key => $app) {
          $emp_ids[] = $app->employees_id;
        }



        $datas['total_male'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Male')->count();
        $datas['total_female'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Female')->count();






        $datas['daywise'] = [];
        foreach ($daywise as $dys) {


            $datas['daywise'][] = [
                'title' => $dys->apply_date,
                'total_application' => TrainingApply::whereIn('training_id', $training_id)->where('apply_date', $dys->apply_date)->count(),
                'total_visit' => \App\Counter::whereIn('training_id', $training_id)->where('visit_date', $dys->apply_date)->sum('visits'),

            ];
        }


        $datas['age'][] = [
            'title' => '18-',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '<', '18')->count(),
            'color' => '#f56954',

        ];
        $datas['age'][] = [
            'title' => '18-22',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '18')->where('age', '<', '22')->count(),
            'color' => '#00a65a',

        ];

        $datas['age'][] = [
            'title' => '22-26',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '22')->where('age', '<', '26')->count(),
            'color' => '#f39c12',

        ];
        $datas['age'][] = [
            'title' => '26-30',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '26')->where('age', '<', '30')->count(),
            'color' => '#00c0ef',

        ];
        $datas['age'][] = [
            'title' => '30-40',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '30')->where('age', '<', '40')->count(),
            'color' => '#3c8dbc',

        ];
        $datas['age'][] = [
            'title' => '40-50',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '40')->where('age', '<=', '50')->count(),
            'color' => '#d2d6de',

        ];
        $datas['age'][] = [
            'title' => '50+',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>', '50')->count(),
            'color' => '#43e96e',

        ];

        $members = \App\EmployerUser::where('employers_id', auth()->guard('employer')->user()->employers_id)->get();
        $datas['members'] = [];
        foreach ($members as $key => $member) {
            if ($member->image != '') {
                $image = Imagetool::mycrop($member->image,200,200);
            } else{
                $image = Imagetool::mycrop('no-image.png',200,200);
            }
           $datas['members'][] = [
            'name' => $member->name,
            'designation' => $member->designation,
            'image' => $image,
            'user_type' => $member->user_type
           ];
        }


        $datas['total_single'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Single')->count();
        $datas['total_married'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Married')->count();
         $datas['total_divorced'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'divorced')->count();


         $addresses = \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->whereNotNull('permanent_district')->groupBy('permanent_district')->get();
         $datas['districts'] = [];

         foreach ($addresses as $key => $address) {
           $datas['districts'][] = [
            'title' => $address->permanent_district,
            'total' => \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->where('permanent_district', $address->permanent_district)->count(),
            'color' => \App\EmployeeAddress::getColour($address->permanent_district)
           ];
         }

        //dd($datas);

          return view('employer.dashboardtraining')->with('data', $datas);

 }


 public function eventDashboard(Request $request)
    {






         $config = array(
          'app.meta_title' => 'Employer Event Dashboard',
          'app.meta_keyword' => 'Employer Event Dashboard',
          'app.meta_description' => 'Employer Event Dashboard',
          'app.meta_image' => '',
          'app.meta_url' => url('/employer/dashboard/event'),
          'app.meta_type' => 'Employer Event Dashboard',

      );




         config($config);

         $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();

          $pr = 0;
          if($employer->org_type != 0)
          {
            $pr += 1;
          }
           if($employer->ownership != 0)
          {
            $pr += 1;
          }
           if($employer->logo != '')
          {
            $pr += 1;
          }
           if($employer->banner != '')
          {
            $pr += 1;
          }
           if($employer->description != '')
          {
            $pr += 1;
          }
           if($employer->approval != 0)
          {
            $pr += 1;
          }

          $address = $employer->EmployerAddress;
          $head = $employer->EmployerHead;
          $contactperson = $employer->EmployerContactPerson;
           if($address->phone != '')
          {
            $pr += 1;
          }

          if($address->secondary_email != '')
          {
            $pr += 1;
          }
          if($address->fax != '')
          {
            $pr += 1;
          }
          if($address->pobox != '')
          {
            $pr += 1;
          }
          if($address->website != '')
          {
            $pr += 1;
          }
          if($address->address != '')
          {
            $pr += 1;
          }
          if($address->country != '')
          {
            $pr += 1;
          }
          if($address->city != '')
          {
            $pr += 1;
          }
          if($address->billing_address != '')
          {
            $pr += 1;
          }

          if($contactperson->phone != '')
          {
            $pr += 1;
          }
          if($contactperson->name != '')
          {
            $pr += 1;
          }
          if($contactperson->designation != '')
          {
            $pr += 1;
          }
          if($contactperson->email != '')
          {
            $pr += 1;
          }
          if($head->name != '')
          {
            $pr += 1;
          }
          if($head->designation != '')
          {
            $pr += 1;
          }
         $employer_id = $employer->id;
         $percent = ($pr / 21) * 100;
         $datas['profile_complete'] = number_format($percent);
         $today = Carbon::now()->toDateString();

         $active = Event::where('employers_id', $employer->id)->where('status', 1)->where('to_date', '>=', $today)->where('event_date', '<=', $today)->get();
         $completed = Event::where('employers_id', $employer->id)->where('status', 2)->where('to_date', '<', $today)->get();
         $pending = Event::where('employers_id', $employer->id)->where('status', 3)->get();


         $datas['active'] = $active;
         $datas['completed'] = $completed;
         $datas['pending'] = $pending;
         $datas['address'] = $address;
         $datas['head'] = $head;
         $datas['contact'] = $contactperson;



         $datas['employer'] = $employer;
        $datas['last_login'] = $employer->last_login;


        $datas['category'] = [];
        $categories = JobCategory::orderBy('name', 'asc')->get();
        foreach ($categories as $key => $category) {
          $ecate = EmployeeCategory::where('job_category_id', $category->id)->count();
          $datas['category'][] = [
            'title' => $category->name,
            'total' => $ecate
          ];
        }

         $member_types = MemberType::select('id')->orderBy('rank','desc')->first();

        $emp_loyers = Employers::select('id')->where('member_type','>',$member_types->id)->get();
        $yesterday = Carbon::now()->subDay(1)->toDateString();

        foreach ($emp_loyers as $key => $emp) {
          $check = UpgradeRequest::where('employers_id',$emp->id)->where('member_type_id', '!=', $member_types->id)->where('to_date',$yesterday)->count();
          if ($check > 0) {
            Employers::where('id',$emp->id)->update(['member_type' => $member_types->id]);
          }
        }
        $datas['rm_approve'] = EmployeeExperience::where('employers_id',$employer->id)->where('status','0')->where('currently_working', '!=',1)->get();

         //new added
         $event_id = [];
        $datas['filter_stat'] = '';
        $datas['from'] = '';
        $datas['to'] = '';

       $projects = Event::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('event_date', '<=', date('Y-m-d'))->where('to_date', '>=', date('Y-m-d'));
       $datas['total_event'] = Event::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->count();
       $datas['application_receiving'] = Event::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('event_date', '<=', date('Y-m-d'))->where('to_date', '>=', date('Y-m-d'))->count();
        if(isset($request->filter_stat))
        {
            if($request->filter_stat == 1){
                $datas['filter_stat'] = 1;
                 $events = Event::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id);
            }
        }
        if(isset($request->from) && isset($request->to))
        {
            $datas['filter_stat'] = 10;
            $datas['from'] = $request->from;
            $datas['to'] = $request->to;
            $projects = Event::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('to_date', '>=', $request->from)->where('to_date', '<=', $request->to);
             $datas['application_receiving'] = Event::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('to_date', '>=', $request->from)->where('to_date', '<=', $request->to)->count();
        }
        $js = $projects->get();
        foreach ($js as $j) {
            $event_id[] = $j->id;
        }

        $applicants = \App\EventApply::whereIn('event_id', $event_id);
        $daywise = \App\EventApply::whereIn('event_id', $event_id)->groupBy('apply_date')->get();
        if(isset($request->from) && isset($request->to)){
            $applicants = \App\EventApply::whereIn('event_id', $event_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to);
            $daywise = \App\EventApply::whereIn('event_id', $event_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to)->groupBy('apply_date')->get();
        }



        $datas['total_applicants'] = $applicants->count();

        $apps= $applicants->get();
        $emp_ids = [];
        foreach ($apps as $key => $app) {
          $emp_ids[] = $app->employees_id;
        }



        $datas['total_male'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Male')->count();
        $datas['total_female'] = Employees::whereIn('id',$emp_ids)->where('gender', 'Female')->count();






        $datas['daywise'] = [];
        foreach ($daywise as $dys) {


            $datas['daywise'][] = [
                'title' => $dys->apply_date,
                'total_application' => EventApply::whereIn('event_id', $event_id)->where('apply_date', $dys->apply_date)->count(),
                'total_visit' => \App\Counter::whereIn('event_id', $event_id)->where('visit_date', $dys->apply_date)->sum('visits'),

            ];
        }


        $datas['age'][] = [
            'title' => '18-',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '<', '18')->count(),
            'color' => '#f56954',

        ];
        $datas['age'][] = [
            'title' => '18-22',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '18')->where('age', '<', '22')->count(),
            'color' => '#00a65a',

        ];

        $datas['age'][] = [
            'title' => '22-26',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '22')->where('age', '<', '26')->count(),
            'color' => '#f39c12',

        ];
        $datas['age'][] = [
            'title' => '26-30',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '26')->where('age', '<', '30')->count(),
            'color' => '#00c0ef',

        ];
        $datas['age'][] = [
            'title' => '30-40',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '30')->where('age', '<', '40')->count(),
            'color' => '#3c8dbc',

        ];
        $datas['age'][] = [
            'title' => '40-50',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>=', '40')->where('age', '<=', '50')->count(),
            'color' => '#d2d6de',

        ];
        $datas['age'][] = [
            'title' => '50+',
            'total' => \App\EmployeeSetting::whereIn('employees_id', $emp_ids)->where('age', '>', '50')->count(),
            'color' => '#43e96e',

        ];

        $members = \App\EmployerUser::where('employers_id', auth()->guard('employer')->user()->employers_id)->get();
        $datas['members'] = [];
        foreach ($members as $key => $member) {
            if ($member->image != '') {
                $image = Imagetool::mycrop($member->image,200,200);
            } else{
                $image = Imagetool::mycrop('no-image.png',200,200);
            }
           $datas['members'][] = [
            'name' => $member->name,
            'designation' => $member->designation,
            'image' => $image,
            'user_type' => $member->user_type
           ];
        }


        $datas['total_single'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Single')->count();
        $datas['total_married'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'Married')->count();
         $datas['total_divorced'] = Employees::whereIn('id',$emp_ids)->where('marital_status', 'divorced')->count();


         $addresses = \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->whereNotNull('permanent_district')->groupBy('permanent_district')->get();
         $datas['districts'] = [];

         foreach ($addresses as $key => $address) {
           $datas['districts'][] = [
            'title' => $address->permanent_district,
            'total' => \App\EmployeeAddress::whereIn('employees_id',$emp_ids)->where('permanent_district', $address->permanent_district)->count(),
            'color' => \App\EmployeeAddress::getColour($address->permanent_district)
           ];
         }

        //dd($datas);

          return view('employer.dashboardevent')->with('data', $datas);

 }


 public function tenderDashboard(Request $request)
    {






         $config = array(
          'app.meta_title' => 'Employer Tender Dashboard',
          'app.meta_keyword' => 'Employer Tender Dashboard',
          'app.meta_description' => 'Employer Tender Dashboard',
          'app.meta_image' => '',
          'app.meta_url' => url('/employer/dashboard/tender'),
          'app.meta_type' => 'Employer Tender Dashboard',

      );




         config($config);

         $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();

          $pr = 0;
          if($employer->org_type != 0)
          {
            $pr += 1;
          }
           if($employer->ownership != 0)
          {
            $pr += 1;
          }
           if($employer->logo != '')
          {
            $pr += 1;
          }
           if($employer->banner != '')
          {
            $pr += 1;
          }
           if($employer->description != '')
          {
            $pr += 1;
          }
           if($employer->approval != 0)
          {
            $pr += 1;
          }

          $address = $employer->EmployerAddress;
          $head = $employer->EmployerHead;
          $contactperson = $employer->EmployerContactPerson;
           if($address->phone != '')
          {
            $pr += 1;
          }

          if($address->secondary_email != '')
          {
            $pr += 1;
          }
          if($address->fax != '')
          {
            $pr += 1;
          }
          if($address->pobox != '')
          {
            $pr += 1;
          }
          if($address->website != '')
          {
            $pr += 1;
          }
          if($address->address != '')
          {
            $pr += 1;
          }
          if($address->country != '')
          {
            $pr += 1;
          }
          if($address->city != '')
          {
            $pr += 1;
          }
          if($address->billing_address != '')
          {
            $pr += 1;
          }

          if($contactperson->phone != '')
          {
            $pr += 1;
          }
          if($contactperson->name != '')
          {
            $pr += 1;
          }
          if($contactperson->designation != '')
          {
            $pr += 1;
          }
          if($contactperson->email != '')
          {
            $pr += 1;
          }
          if($head->name != '')
          {
            $pr += 1;
          }
          if($head->designation != '')
          {
            $pr += 1;
          }
         $employer_id = $employer->id;
         $percent = ($pr / 21) * 100;
         $datas['profile_complete'] = number_format($percent);
         $today = Carbon::now()->toDateString();

         $active = Tender::where('employers_id', $employer->id)->where('status', 1)->where('submission_end_date', '>=', $today)->where('publish_date', '<=', $today)->get();
         $completed = Tender::where('employers_id', $employer->id)->where('status', 2)->where('submission_end_date', '<', $today)->get();
         $pending = Tender::where('employers_id', $employer->id)->where('status', 3)->get();


         $datas['active'] = $active;
         $datas['completed'] = $completed;
         $datas['pending'] = $pending;
         $datas['address'] = $address;
         $datas['head'] = $head;
         $datas['contact'] = $contactperson;



         $datas['employer'] = $employer;
        $datas['last_login'] = $employer->last_login;


        $datas['category'] = [];
        $categories = JobCategory::orderBy('name', 'asc')->get();
        foreach ($categories as $key => $category) {
          $ecate = EmployeeCategory::where('job_category_id', $category->id)->count();
          $datas['category'][] = [
            'title' => $category->name,
            'total' => $ecate
          ];
        }

         $member_types = MemberType::select('id')->orderBy('rank','desc')->first();

        $emp_loyers = Employers::select('id')->where('member_type','>',$member_types->id)->get();
        $yesterday = Carbon::now()->subDay(1)->toDateString();

        foreach ($emp_loyers as $key => $emp) {
          $check = UpgradeRequest::where('employers_id',$emp->id)->where('member_type_id', '!=', $member_types->id)->where('submission_end_date',$yesterday)->count();
          if ($check > 0) {
            Employers::where('id',$emp->id)->update(['member_type' => $member_types->id]);
          }
        }
        $datas['rm_approve'] = EmployeeExperience::where('employers_id',$employer->id)->where('status','0')->where('currently_working', '!=',1)->get();

         //new added
         $tender_id = [];
        $datas['filter_stat'] = '';
        $datas['from'] = '';
        $datas['to'] = '';

       $tenders = Tender::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('publish_date', '<=', date('Y-m-d'))->where('submission_end_date', '>=', date('Y-m-d'));
       $datas['total_tender'] = Tender::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->count();
       $datas['application_receiving'] = Tender::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->where('publish_date', '<=', date('Y-m-d'))->where('submission_end_date', '>=', date('Y-m-d'))->count();
        $datas['functions'] = [];
        $tender_functions = TenderFunctionType::orderBy('title','asc')->get();
          foreach ($tender_functions as $key => $tf) {
            $datas['functions'][] = [
              'title' => $tf->title,
              'total' => Tender::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('tender_function', $tf->id)->count(),
              'color' => \App\EmployeeAddress::getColour($tf->title)
            ];
          }

          $datas['types'] = [];
        $tender_types = TenderType::orderBy('title','asc')->get();
          foreach ($tender_types as $key => $ttype) {
            $datas['types'][] = [
              'title' => $ttype->title,
              'total' => Tender::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('tender_type_id', $ttype->id)->count(),
              'color' => \App\EmployeeAddress::getColour($ttype->title)
            ];
          }
        if(isset($request->filter_stat))
        {
            if($request->filter_stat == 1){
                $datas['filter_stat'] = 1;
                 $tenders = Tender::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id);
            }
        }
        if(isset($request->from) && isset($request->to))
        {
            $datas['filter_stat'] = 10;
            $datas['from'] = $request->from;
            $datas['to'] = $request->to;
            $tenders = Tender::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('submission_end_date', '>=', $request->from)->where('submission_end_date', '<=', $request->to);
             $datas['application_receiving'] = Tender::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('submission_end_date', '>=', $request->from)->where('submission_end_date', '<=', $request->to)->count();
        }
        $js = $tenders->get();
        foreach ($js as $j) {
            $tender_id[] = $j->id;
        }

        $applicants = \App\TenderApply::whereIn('tender_id', $tender_id);
        $daywise = \App\TenderApply::whereIn('tender_id', $tender_id)->groupBy('apply_date')->get();
        if(isset($request->from) && isset($request->to)){
            $applicants = \App\TenderApply::whereIn('tender_id', $tender_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to);
            $daywise = \App\TenderApply::whereIn('tender_id', $tender_id)->where('apply_date', '>=', $request->from)->where('apply_date', '<=', $request->to)->groupBy('apply_date')->get();
        }



        $datas['total_applicants'] = $applicants->count();

        $apps= $applicants->get();
        $emp_ids = [];
        foreach ($apps as $key => $app) {
          $emp_ids[] = $app->employers_id;
        }







        $datas['daywise'] = [];
        foreach ($daywise as $dys) {


            $datas['daywise'][] = [
                'title' => $dys->apply_date,
                'total_application' => TenderApply::whereIn('tender_id', $tender_id)->where('apply_date', $dys->apply_date)->count(),
                'total_visit' => '0',

            ];
        }




        $members = \App\EmployerUser::where('employers_id', auth()->guard('employer')->user()->employers_id)->get();
        $datas['members'] = [];
        foreach ($members as $key => $member) {
            if ($member->image != '') {
                $image = Imagetool::mycrop($member->image,200,200);
            } else{
                $image = Imagetool::mycrop('no-image.png',200,200);
            }
           $datas['members'][] = [
            'name' => $member->name,
            'designation' => $member->designation,
            'image' => $image,
            'user_type' => $member->user_type
           ];
        }



         $addresses = \App\EmployerAddress::whereIn('employers_id',$emp_ids)->whereNotNull('city')->groupBy('city')->get();
         $datas['districts'] = [];

         foreach ($addresses as $key => $address) {
           $datas['districts'][] = [
            'title' => $address->city,
            'total' => \App\EmployerAddress::whereIn('employers_id',$emp_ids)->where('city', $address->city)->count(),
            'color' => \App\EmployerAddress::getColour($address->city)
           ];
         }

         $datas['document_tender'] = Tender::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('tender_function', 2)->get();
          $datas['full_tender'] = Tender::select('id')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('tender_function', 1)->get();

        //dd($datas);

          return view('employer.dashboardtender')->with('data', $datas);

 }


 public function SearchResume(Request $request)
 {
    $datas = [];
    $datas['filter_education'] = '';
    $datas['filter_faculty'] = '';
    $datas['filter_percentage'] = '';
    $datas['filter_cgpa4'] = '';
    $datas['filter_cgpa10'] = '';
    $datas['filter_minimum_age'] = '';
    $datas['filter_maximum_age'] = '';
    $datas['filter_experience'] = '';
    $datas['filter_travel'] = '';
    $datas['filter_relocate'] = '';
    $datas['filter_license'] = '';
    $datas['filter_vehicle'] = '';
    $datas['filter_language'] = [];
    $datas['filter_gender'] = '';
    $datas['filter_marital_status'] = '';
    $datas['filter_minimum_salary'] = '';
    $datas['filter_maximum_salary'] = '';
    $datas['filter_nationality'] = '';
    $datas['filter_location'] = [];
    $datas['filter_name'] = '';
    $datas['filter_id'] = '';
    $datas['filter_email'] = '';
    $url = '';



  $employee = Employees::select('employees.*')->join('employee_setting','employee_setting.employees_id','=','employees.id');
  if (isset($request->filter_education)) {
    if ($request->filter_education != '') {
      $employee->join('employee_education','employee_education.employees_id','=','employees.id');
    }

  }
  if (isset($request->filter_language)) {
    $employee->leftjoin('employee_language','employee_language.employees_id','=','employees.id');
  }
  if (isset($request->filter_location)) {
    $employee->leftjoin('employee_location','employee_location.employees_id','=','employees.id');
  }





  //$employee = Employees::whereIn('id', $employe_id);
  if (isset($request->filter_name) && !empty($request->filter_name)) {
    $employee->where('employees.firstname', 'like', '%' . $request->filter_name . '%');
    $datas['filter_name'] = $request->filter_name;
    $url .= '&filter_name='.$request->filter_name;
}

if (isset($request->filter_id) && !empty($request->filter_id)) {
    $employee->where('employees.id', $request->filter_id);
    $datas['filter_id'] = $request->filter_id;
    $url .= '&filter_id='.$request->filter_id;
}


if (isset($request->filter_email) && !empty($request->filter_email)) {
    $employee->where('employees.email', $request->filter_email);
    $datas['filter_email'] = $request->filter_email;
    $url .= '&filter_email='.$request->filter_email;
}

if (isset($request->filter_gender) && !empty($request->filter_gender)) {
    $employee->where('employees.gender', $request->filter_gender);
    $datas['filter_gender'] = $request->filter_gender;
    $url .= '&filter_gender='.$request->filter_gender;
}
if (isset($request->filter_marital_status) && !empty($request->filter_marital_status)) {
    $employee->where('employees.marital_status', $request->filter_marital_status);
    $datas['filter_marital_status'] = $request->filter_marital_status;
    $url .= '&filter_marital_status='.$request->filter_marital_status;
}
if (isset($request->filter_nationality) && !empty($request->filter_nationality)) {
    $employee->where('employees.nationality', $request->filter_nationality);
    $datas['filter_nationality'] = $request->filter_nationality;
    $url .= '&filter_nationality='.$request->filter_nationality;
}
if (isset($request->filter_minimum_salary) && !empty($request->filter_minimum_salary)) {
    $employee->where('employees.expected_salary', '>=', $request->filter_minimum_salary);
    $datas['filter_minimum_salary'] = $request->filter_minimum_salary;
    $url .= '&filter_minimum_salary='.$request->filter_minimum_salary;
}
if (isset($request->filter_maximum_salary) && !empty($request->filter_maximum_salary)) {
    $employee->where('employees.expected_salary', '<=', $request->filter_maximum_salary);
    $datas['filter_maximum_salary'] = $request->filter_maximum_salary;
    $url .= '&filter_maximum_salary='.$request->filter_maximum_salary;
}



if (isset($request->filter_minimum_age) && !empty($request->filter_minimum_age)) {
    $employee->where('employee_setting.age', '>=', $request->filter_minimum_age);
    $datas['filter_minimum_age'] = $request->filter_minimum_age;
    $url .= '&filter_minimum_age='.$request->filter_minimum_age;
}
if (isset($request->filter_maximum_age) && !empty($request->filter_maximum_age)) {
    $employee->where('employee_setting.age', '<=', $request->filter_maximum_age);
    $datas['filter_maximum_age'] = $request->filter_maximum_age;
    $url .= '&filter_maximum_age='.$request->filter_maximum_age;
}

if (isset($request->filter_experience) && !empty($request->filter_experience)) {
    $employee->where('employee_setting.total_experience', '>=', $request->filter_experience);
    $datas['filter_experience'] = $request->filter_experience;
    $url .= '&filter_experience='.$request->filter_experience;
}
if (isset($request->filter_travel) && !empty($request->filter_travel)) {
    $employee->where('employee_setting.travel', '>=', $request->filter_travel);
    $datas['filter_travel'] = $request->filter_travel;
    $url .= '&filter_travel='.$request->filter_travel;
}

if (isset($request->filter_relocate) && !empty($request->filter_relocate)) {
    $employee->where('employee_setting.relocation', '>=', $request->filter_relocate);
    $datas['filter_relocate'] = $request->filter_relocate;
    $url .= '&filter_relocate='.$request->filter_relocate;
}
if (isset($request->filter_license) && !empty($request->filter_license)) {
    $employee->where('employee_setting.license', '>=', $request->filter_license);
    $datas['filter_license'] = $request->filter_license;
    $url .= '&filter_license='.$request->filter_license;
}
if (isset($request->filter_vehicle) && !empty($request->filter_vehicle)) {
    $employee->where('employee_setting.have_vehical', '>=', $request->filter_vehicle);
    $datas['filter_vehicle'] = $request->filter_vehicle;
    $url .= '&filter_vehicle='.$request->filter_vehicle;
}

if (isset($request->filter_language) && !empty($request->filter_language)) {
    $employee->where('employee_language.language', $request->filter_language);
    $datas['filter_language'] = $request->filter_language;
    $url .= '&filter_language='.$request->filter_language;
}

if (isset($request->filter_location) && !empty($request->filter_location)) {
    $employee->where('employee_location.job_location_id', $request->filter_location);
    $datas['filter_location'] = $request->filter_location;
    $url .= '&filter_location='.$request->filter_location;
}
if (isset($request->filter_education) && !empty($request->filter_education)) {
            $employee->where('employee_education.level_id', $request->filter_education);
            $datas['filter_education'] = $request->filter_education;
            $url .= '&filter_education='.$request->filter_education;
        }
        if (isset($request->filter_faculty) && !empty($request->filter_faculty)) {
            $employee->where('employee_education.faculty_id', $request->filter_faculty);
            $datas['filter_faculty'] = $request->filter_faculty;
            $url .= '&filter_faculty='.$request->filter_faculty;
        }

        $employee->where(function ($q) use ($request,$datas,$url) {

        if ($request->has('filter_percentage')) {
          $q->where('employee_education.marksystem', 1)->where('employee_education.percentage', '>=', $request->filter_percentage);



        }

        if (isset($request->filter_cgpa4) && !empty($request->filter_cgpa4)) {
            $q->orWhere('employee_education.marksystem', 2)->Where('employee_education.percentage', '>=', $request->filter_cgpa4);



        }

         if (isset($request->filter_cgpa10) && !empty($request->filter_cgpa10)) {
            $q->orWhere('employee_education.marksystem', 3)->Where('employee_education.percentage', '>=', $request->filter_cgpa10);


        }


    });

 if ($request->has('filter_percentage')) {
  $datas['filter_percentage'] = $request->filter_percentage;
          $url .= '&filter_percentage='.$request->filter_percentage;
 }
  if ($request->has('filter_cgpa4')) {
     $datas['filter_cgpa4'] = $request->filter_cgpa4;
            $url .= '&filter_cgpa4='.$request->filter_cgpa4;
  }
  if ($request->has('filter_cgpa10')) {
    $datas['filter_cgpa10'] = $request->filter_cgpa10;
            $url .= '&filter_cgpa10='.$request->filter_cgpa10;
  }


$datas['employees'] = $employee->orderby('employees.firstname','asc')->groupBy('employees.id')->paginate(50)->setPath('?'.$url);


$datas['education_levels'] = \App\EducationLevel::orderBy('id','asc')->get();
$datas['faculty'] = [];
if (isset($request->filter_education)) {
  $datas['faculty'] = \App\Faculty::where('level_id',$request->filter_education)->orderBy('name','asc')->get();
}
 }

 public function getPackage(Request $request){
    if (isset($request->id)) {

      $jobprices = JobPrice::where('job_type_id', $request->id)->get();

      $rv = '<option value="">Select Number of Package</option>';
      foreach ($jobprices as $key => $price) {
        $rv .= '<option value="'.$price->no_of_post.'">Upto '.$price->no_of_post.' Unit </option>';
      }

      return $rv;
    } else{
      return '';
    }
 }



 public function buyPackage(Request $request)
{
  $datas['job_type'] = JobType::whereNotIn('id', ['4','5'])->orderBy('id','asc')->get();
  $employer = Employers::select('member_type')->where('id',auth()->guard('employer')->user()->employers_id)->first();
  $datas['member_type'] = MemberType::whereNotIn('id', ['4',$employer->member_type])->orderBy('id', 'desc')->get();
  $datas['resume_package'] = \App\EmployeeSearch::orderby('price','asc')->get();
  $datas['tender_type'] = TenderFunctionType::whereNotIn('id', ['3'])->orderBy('id','asc')->get();
  return view('employer.buy_package')->with('datas', $datas);
}

public function getPackageDuration(Request $request){
    if (isset($request->package_id)) {

      $price = JobPrice::where('job_type_id', $request->package_id)->where('no_of_post',$request->number_of_post)->first();
      if (isset($price->id)) {
        $rv = '<option value="7">Seven Days (Rs. '.$price->seven_days.')</option>';
        $rv .= '<option value="14">Fourteen Days (Rs. '.$price->fourteen_days.')</option>';
        $rv .= '<option value="21">Twenty-one Days (Rs. '.$price->twentyone_days.')</option>';
        $rv .= '<option value="30">Thirty Days (Rs. '.$price->thirty_days.')</option>';
      } else{
        $rv = '<option value="7">Seven Days (Rs. 0.00)</option>';
        $rv .= '<option value="14">Fourteen Days (Rs. 0.00)</option>';
        $rv .= '<option value="21">Twenty-one Days (Rs. 0.00)</option>';
        $rv .= '<option value="30">Thirty Days (Rs. 0.00)</option>';
      }
      return $rv;
    } else{
      return '';
    }
 }

 public function getPackageAmount(Request $request){
   $data = '0.00||0.00';
    if (isset($request->package_id)) {

      $price = JobPrice::where('job_type_id', $request->package_id)->where('no_of_post',$request->number_of_post)->first();
      if (isset($price->id)) {
        if ($request->duration == 7) {
          $rv = $price->seven_days;
        }elseif ($request->duration == 14) {
          $rv = $price->fourteen_days;
        }elseif ($request->duration == 21) {
          $rv = $price->twentyone_days;
        }elseif ($request->duration == 30) {
          $rv = $price->thirty_days;
        }else{
          $rv = '0.00';
        }
        $current_price = $rv * $request->number_of_post;
        $after_discount = '0.00';
        if (isset($request->discount)) {
          if ($request->discount > 0) {
            $after_discount = $current_price - (($current_price * $request->discount) / 100);
          }
        }
        $data = $current_price.'||'.$after_discount;
      } else{
        $data = '0.00||0.00';
      }

    } else{
      $data = '0.00||0.00';
    }
    return $data;
    }

 public function packageBuy(Request $request)
 {
  //dd($request->all());
   $this->validate($request, [
    'job_type' => 'required|integer',
    'number_of_job' => 'required|integer',
    'duration' => 'required|integer',
    'amount' => 'required'
   ]);



   $cdata = [
        'employers_id' => auth()->guard('employer')->user()->employers_id,

        'job_type_id' => $request->job_type,
        'job_type' => JobType::getTitle($request->job_type),
        'type' => 'JobPackage',
        'amount' => $request->amount,
        'duration' => $request->duration,
        'number_of' => $request->number_of_job,
        'remaining' => $request->number_of_job,
      ];

      \App\Cart::create($cdata);


      \Session::flash('alert-success','Record have been saved Successfully');
      return redirect('employer/cart');
 }


 public function EmployerPackages(Request $request)
 {
   $datas['packages'] = \App\EmployerPackage::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('status', 1)->paginate(50);
   return view('employer.package')->with('datas',$datas);
 }




 public function memberUpgrade(Request $request)
 {
  //dd($request->all());
   $this->validate($request, [
    'member_type' => 'required|integer',

    'duration' => 'required|integer',
    'amount' => 'required'
   ]);



   $cdata = [
        'employers_id' => auth()->guard('employer')->user()->employers_id,
        'jobs_id' => $request->member_type,
        'job_type_id' => $request->member_type,
        'job_type' => MemberType::getTypeTitle($request->member_type),
        'type' => 'MemberUpgrade',
        'amount' => $request->amount,
        'duration' => $request->duration,

      ];

      \App\Cart::create($cdata);


      \Session::flash('alert-success','Record have been saved Successfully');
      return redirect('employer/cart');
 }


    public function getTenderPackageAmount(Request $request){
        $data = '0.00||0.00';
        if (isset($request->package_id)) {

        $price = \App\TenderPrice::where('tender_function_type_id', $request->package_id)->where('no_of_post',$request->number_of_post)->first();
        if (isset($price->id)) {
            if ($request->duration == 7) {
            $rv = $price->seven_days;
            }elseif ($request->duration == 15) {
            $rv = $price->fifteen_days;
            }elseif ($request->duration == 30) {
            $rv = $price->thirty_days;
            }else{
            $rv = '0.00';
            }
            $current_price = $rv * $request->number_of_post;
            $after_discount = '0.00';
            if (isset($request->discount)) {
            if ($request->discount > 0) {
                $after_discount = $current_price - (($current_price * $request->discount) / 100);
            }
            }
            $data = $current_price.'||'.$after_discount;
        } else{
            $data = '0.00||0.00';
        }

        } else{
        $data = '0.00||0.00';
        }
        return $data;
    }


    public function tenderBuy(Request $request) {
        //dd($request->all());
        $this->validate($request, [
            'tender_type' => 'required|integer',
            'number_of_tender' => 'required|integer',
            'tender_duration' => 'required|integer',
            'tender_amount' => 'required'
        ]);



        $cdata = [
            'employers_id' => auth()->guard('employer')->user()->employers_id,

            'job_type_id' => $request->tender_type,
            'job_type' => \App\TenderFunctionType::getTitle($request->tender_type),
            'type' => 'TenderPackage',
            'amount' => $request->tender_amount,
            'duration' => $request->tender_duration,
            'number_of' => $request->number_of_tender,
            'remaining' => $request->number_of_tender,
        ];

      \App\Cart::create($cdata);


      \Session::flash('alert-success','Record have been saved Successfully');
      return redirect('employer/cart');
    }
}

