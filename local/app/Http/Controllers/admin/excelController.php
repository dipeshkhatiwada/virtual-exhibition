<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Jobs;
use App\Employers;
use App\UserGroup;
use App\JobCategory;
use App\OrganizationType;
use App\JobLevel;
use App\JobLocation;
use App\JobForm;
use App\JobRequirements;
use App\FormData;
use App\Currency;
use App\EducationLevel;
use App\Faculty;
use App\JobsLocation;
use App\Trash;
use App\Employees;
use App\RecruitmentProcess;
use PDF;

use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeLanguage;
use App\EmployeeReference;

use App\EmployeeTraining;


use App\Saluation;
use App\Imagetool;
use Excel;


class excelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

     

    public function exportCsv($id)
    {
       $permission = UserGroup::checkPermission('JobController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }

      $job = Jobs::where('id', $id)->first();
      if (isset($job->id)) {
        $employees = Employees::where('jobs_id', $job->id)->where('status', 1)->where('trash', 0)->get();
        $datas = [];
        $datas['employees'] = [];
        $datas['job'] = $job;
         $datas['jf'] = json_decode($job->formfields);
         $datas['edu'] = '';
         $datas['exp'] = '';
         $datas['lag'] = '';
         $datas['ref'] = '';
         $datas['tra'] = '';
         $datas['fdt'] = [];
         $form_data = JobForm::where('jobs_id', $job->id)->orderBy('f_lable', 'asc')->get();
        if (count($form_data) > 0) {

          foreach ($form_data as $value) {
            $datas['fdt'][] = [
              'f_title' => $value->f_lable,
            ];
          }
          # code...
        }
        $edud = EmployeeEducation::where('jobs_id', $job->id)->groupBy('level_id')->get();
        $datas['edu'] = count($edud);
        $expd = EmployeeExperience::where('jobs_id', $job->id)->groupBy('sn')->get();
       $datas['exp'] = count($expd);
       $langd = EmployeeLanguage::where('jobs_id', $job->id)->groupBy('language')->get();
        $datas['lag'] = count($langd);
        $trad = EmployeeTraining::where('jobs_id', $job->id)->groupBy('sn')->get();
       $datas['tra'] = count($trad);
       $refd = EmployeeReference::where('jobs_id', $job->id)->groupBy('sn')->get();
        $datas['ref'] = count($refd);
       
        foreach ($employees as $employee) {
               
        
        
        
        

        $datas['employees'][] = [
          'id' => $employee->id,
          'firstname' => $employee->firstname,
          'middlename' => $employee->middlename,
          'lastname' => $employee->lastname,
          'saluation' => Saluation::getTitle($employee->saluation),
          'email' => $employee->email,
          'gender' => $employee->gender,
          'dob' => $employee->dob,
          'age' => $employee->age,
          'total_experience' => $employee->total_experience,
          'marital_status' => $employee->marital_status,
          'nationality' => $employee->nationality,
          'image' => $employee->image,
          'resume' => $employee->resume,
          'coverletter' => $employee->coverletter,
          'permanent_address' => $employee->permanent_address,
          'temporary_address' => $employee->temporary_address,
          'home_phone' => $employee->home_phone,
          'mobile' => $employee->mobile,
          'fax' => $employee->fax,
          'website' => $employee->website,
          'vehicle' => $employee->vehicle,
          'license_of' => $employee->license_of,
          'created_at' => $employee->created_at,
          'education' => EmployeeEducation::where('employees_id', $employee->id)->get(),
          'experience' => EmployeeExperience::where('employees_id', $employee->id)->get(),
          'language' => EmployeeLanguage::where('employees_id', $employee->id)->get(),
          'reference' => EmployeeReference::where('employees_id', $employee->id)->get(),
          'form_data' => FormData::where('employees_id', $employee->id)->orderBy('f_title', 'asc')->get(),
          'training' => EmployeeTraining::where('employees_id', $employee->id)->get(),
        ];


       

            
        }
        
        set_time_limit(600);
       Excel::create('application_excel', function($excel) use($datas) {
            $excel->sheet('application_excel', function($sheet) use($datas) {
                $sheet->loadView('admin.jobs.csv')->with('datas', $datas);
            });
        })->download('xls');
       // Excel::loadView('admin.jobs.csv', array('datas' => $datas))->export('xls');
       
        //return view('admin.jobs.csv', ['datas' => $datas]);
      } else{
        \Session::flash('alert-danger','Sorry we did not found the job of your request');
                    return redirect()->back();
      }
    }


}
