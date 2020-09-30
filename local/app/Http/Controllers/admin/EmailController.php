<?php
namespace App\Http\Controllers\admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserGroup;
use App\Jobs;
use App\Employees;
use App\library\settings;
use Mail;
use App\library\myFunctions;

class EmailController extends Controller
{
   
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    	$permission = UserGroup::checkPermission('EmailController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        
      $datas = [];
      $datas['jobs'] = Jobs::where('status', 1)->where('trash', 0)->orderBy('title', 'asc')->get();
      $datas['candidates'][] = ['value' => 1, 'title' => 'Candidates for Written Exam'];
      $datas['candidates'][] = ['value' => 2, 'title' => 'Candidates for Group Discussion'];
      $datas['candidates'][] = ['value' => 3, 'title' => 'Candidates for Final Interview'];
      $datas['candidates'][] = ['value' => 4, 'title' => 'Candidates for Final Selected'];
        return view('admin.email.newform')->with('datas', $datas);
    }

    public static function sendConformation($datas)
   {
    set_time_limit(600);
         myFunctions::setEmail();
        Mail::queue('admin.email.email', ['datas' => $datas], function($mail) use ($datas){
                  $mail->to($datas['to_email'],$datas['to_name'])->from($datas['from_email'],$datas['from_name'])->subject($datas['subject']);
                        });        
        return 'success';
   }

    public function sendEmail(Request $request)
    {
    	$permission = UserGroup::checkPermission('EmailController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
    	$this->validate($request, [
    		'job' => 'required|integer',
            'candidate' => 'required|integer',
            'subject' => 'required|min:3',
            'from' => 'required|email',
            'message' => 'required|min:10'
    	]);

    	if ($request->candidate == 1) {
    		$employees = Employees::select('firstname', 'email')->where('status', 1)->where('trash', 0)->where('jobs_id', $request->job)->where('written_exam', 1)->get();
    	} elseif ($request->candidate == 2) {
    		$employees = Employees::select('firstname', 'email')->where('status', 1)->where('trash', 0)->where('jobs_id', $request->job)->where('group_discussion', 1)->get();
    	}
    	elseif ($request->candidate == 3) {
    		$employees = Employees::select('firstname', 'email')->where('status', 1)->where('trash', 0)->where('jobs_id', $request->job)->where('final_interview', 1)->get();
    	}
    	elseif ($request->candidate == 4) {
    		$employees = Employees::select('firstname', 'email')->where('status', 1)->where('trash', 0)->where('jobs_id', $request->job)->where('filan_selection', 1)->get();
    	}
    	else {
    		$employees = [];
    	}

    	if(count($employees) > 0)
    	{
    		foreach ($employees as $employee) {
    			$others = [
		            'from_name' => Settings::getSettings()->name,
		            'from_email' => $request->from,
		            'to_name' => $employee->firstname,
		            'to_email' => $employee->email,
		            'subject' => $request->subject,
		            'message' => $request->message
		          ];
		          $this->sendConformation($others);
    		}
    		\Session::flash('alert-success','You Successfully send mail');
                    return redirect()->back();
         

    	} else{
    		\Session::flash('alert-danger','Sorry there are not candidates for this job');
                    return redirect()->back();

    	}

    }
    
}