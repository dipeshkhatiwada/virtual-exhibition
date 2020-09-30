<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeSkills;
use App\TestExam;
use App\TestAnswer;
use App\EmployeeActivity;
use App\Employees;
use App\Rchalange;
use App\RchalangeQuestion;
use App\EmployeeEducation;
use App\EmployeeTraining;
use App\EmployeeExperience;

class EmployeeActivity extends Model
{
    protected $table = 'employee_activity';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'total_login', 'total_share', 'total_verify','comment','forum','skill_endorse'
    ];
    
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public static function getPoints($id='')
    {
    	$testpointscore = 0;
    	$testpointscoreweithtage = 0;
    	$leaderpoint = 0;
    	$leaderpointweithtage = 0;
    	$verifypoint = 0;
    	$verifypointweithtage = 0;
    	$endorsepoint = 0;
    	$endorsepointweithtage = 0;
    	$chalangepoint = 0;
    	$chalangepointweithtage = 0;
    	$sharepoint = 0;
    	$sharepointweithtage = 0;
    	$premiumpoint = 0;
    	$premiumpointweithtage = 0;
    	$activitypoint = 0;
    	$activitypointweithtage = 0;

    	$skils = ['0'];
    	$skills = EmployeeSkills::where('employees_id',$id)->get();
    	foreach ($skills as $key => $skill) {
    		$testexam = TestExam::select('id')->where('title',$skill->title)->first();
    		if (isset($testexam->id)) {
    			$testpoint = TestAnswer::where('test_id',$testexam->id)->where('employes_id',$id)->orderBy('marks','desc')->first();
    			if (isset($testpoint->marks)) {
    				$high = TestAnswer::where('test_id',$testexam->id)->orderBy('marks','desc')->first();
    				$skils[] = ($testpoint->marks * 100) / $high->marks;
    			}
    		}
    	}

    	$skl = array_filter($skils);
    	if (count($skl)) {
    		$averageskill = array_sum($skl)/count($skl);
    		$testnumber = $averageskill / 10;
    		$testpointscore = number_format((float)$testnumber, 2, '.', '');
    		$testweithtage = $testpointscore * 0.17;
    		$testpointscoreweithtage = number_format((float)$testweithtage, 2, '.', '');
    	}

    	$checkeactivity = EmployeeActivity::where('employees_id',$id)->first();
    	if (isset($checkeactivity)) {
    		if ($checkeactivity->forum > 0) {
    			$highforum = EmployeeActivity::orderBy('forum', 'desc')->first();
    			$forumnumber = ($checkeactivity->forum * 100) / $highforum->forum;
    			$leaderpoint = number_format((float)$forumnumber / 10, 2, '.', '');
	    		$forumw = $leaderpoint * 0.17;
	    		$leaderpointweithtage = number_format((float)$forumw, 2, '.', '');
    		}

    		if ($checkeactivity->total_verify > 0) {
    			$hightotal_verify = EmployeeActivity::orderBy('total_verify', 'desc')->first();
    			$total_verifynumber = ($checkeactivity->total_verify * 100) / $hightotal_verify->total_verify;
    			$verifypoint = number_format((float)$total_verifynumber / 10, 2, '.', '');
	    		$total_verifyw = $verifypoint * 0.17;
	    		$verifypointweithtage = number_format((float)$total_verifyw, 2, '.', '');
    		}

    		if ($checkeactivity->skill_endorse > 0) {
    			$highskill_endorse = EmployeeActivity::orderBy('skill_endorse', 'desc')->first();
    			$skill_endorsenumber = ($checkeactivity->skill_endorse * 100) / $highskill_endorse->skill_endorse;
    			$endorsepoint = number_format((float)$skill_endorsenumber / 10, 2, '.', '');
	    		$skill_endorsew = $endorsepoint * 0.17;
	    		$endorsepointweithtage = number_format((float)$skill_endorsew, 2, '.', '');
    		}

    		if ($checkeactivity->total_share > 0) {
    			$hightotal_share = EmployeeActivity::orderBy('total_share', 'desc')->first();
    			$total_sharenumber = ($checkeactivity->total_share * 100) / $hightotal_share->total_share;
    			$sharepoint = number_format((float)$total_sharenumber / 10, 2, '.', '');
	    		$total_sharew = $sharepoint * 0.05;
	    		$sharepointweithtage = number_format((float)$total_sharew, 2, '.', '');
    		}
    		if ($checkeactivity->total_login > 0) {
    			$hightotal_login = EmployeeActivity::orderBy('total_login', 'desc')->first();
    			$total_loginnumber = ($checkeactivity->total_login * 100) / $hightotal_login->total_login;
    			$activitypoint = number_format((float)$total_loginnumber / 10, 2, '.', '');
	    		$total_loginw = $activitypoint * 0.05;
	    		$activitypointweithtage = number_format((float)$total_loginw, 2, '.', '');
    		}
    	}

    	$emp = Employees::select('employee_type')->where('id',$id)->first();
    	if (isset($emp->employee_type)) {
    		if ($emp->employee_type == 2) {
    			$premiumpoint = 10;
    			$premiumpointweithtage = '0.50';
    		}
    	}

    	$checkchalange = Rchalange::where('created_by', $id)->get();
    	if (count($checkchalange) > 0) {
    		$total_question = 0;
    		foreach ($checkchalange as $key => $chalange) {
    			$total_question += count($chalange->Questions);
    		}
    		if ($total_question > 0) {
    			$highquestion = Rchalange::leftJoin('rchalange_question','rchalange.id','=','rchalange_question.rchalange_id')
           			->selectRaw('rchalange.*, count(rchalange_question.id) AS `count`')
           			->where('rchalange.status', 1)->where('rchalange.publish_date', '<=', $today)
          			->groupBy('rchalange.id')
           			->orderBy('count','DESC')
           			->first();
           		$chalangenumber = ($total_question * 100) / $total_question->count;
    			$chalangepoint = number_format((float)$chalangenumber / 10, 2, '.', '');
	    		$chala = $chalangepoint * 0.05;
	    		$chalangepointweithtage = number_format((float)$chala, 2, '.', '');

    		}
    	}

    	$total_point = $testpointscoreweithtage + $leaderpointweithtage + $verifypointweithtage + $endorsepointweithtage + $chalangepointweithtage + $sharepointweithtage + $premiumpointweithtage + $activitypointweithtage;
    	Employees::where('id',$id)->update(['points' => $total_point]);


    	$datas = [
    		'testpointscore' 				=> $testpointscore,
	    	'testpointscoreweithtage'		=>	$testpointscoreweithtage,
	    	'leaderpoint'					=>	$leaderpoint,
	    	'leaderpointweithtage'			=>	$leaderpointweithtage,
	    	'verifypoint'					=>	$verifypoint,
	    	'verifypointweithtage'			=>	$verifypointweithtage,
	    	'endorsepoint'					=>	$endorsepoint,
	    	'endorsepointweithtage'			=>	$endorsepointweithtage,
	    	'chalangepoint'					=>	$chalangepoint,
	    	'chalangepointweithtage'		=>	$chalangepointweithtage,
	    	'sharepoint'					=>	$sharepoint,
	    	'sharepointweithtage'			=>	$sharepointweithtage,
	    	'premiumpoint'					=>	$premiumpoint,
	    	'premiumpointweithtage'			=>	$premiumpointweithtage,
	    	'activitypoint'					=>	$activitypoint,
	    	'activitypointweithtage'		=>	$activitypointweithtage,
    	];

    	return $datas;




    }

    public static function getRank($type = 'All', $id = '',$emp='')
    {
    	$score = 0;
    	$highscore = 0;
    	$rank = 0;
    	$total = 0;
    	$employers = [];
        $topthree = [];
       

    	$userscore = Employees::select('points')->where('id',$id)->first();
    	if (isset($userscore->points)) {
    		$score = $userscore->points;
    	}
    	$high = Employees::select('points')->orderBy('points','desc')->first();
    	if (isset($high->points)) {
    		$highscore = $high->points;
    	}
    	if ($type == 'All') {
    		$employee = Employees::select('id')->orderBy('points','desc')->pluck('id')->toArray();
    		//dd($employee);
    		$rank = array_search($id,$employee) + 1;
    		$total = count($employee);
            $topthree = array_slice($employee, 0, 3);
    	}

    	elseif ($type == 'Alumni') {
    		if($emp)
    		{
    			$employers = [$emp];

    		}else{
    			$collegs = EmployeeEducation::where('employees_id', $id)->groupBy('employers_id')->pluck('employers_id')->toArray();
	       		$trainings = EmployeeTraining::where('employees_id', $id)->groupBy('employers_id')->pluck('employers_id')->toArray();
	       		$employers = array_unique(array_merge($collegs,$trainings), SORT_REGULAR);

    		}
       		
       		
       		$fedu = EmployeeEducation::whereIn('employers_id', $employers)->groupBy('employees_id')->pluck('employees_id')->toArray();
       		$ttf = EmployeeTraining::whereIn('employers_id', $employers)->groupBy('employees_id')->pluck('employees_id')->toArray();
       		$employees = array_unique(array_merge($fedu,$ttf), SORT_REGULAR);
       		$employee = Employees::select('id')->whereIn('id',$employees)->orderBy('points','desc')->pluck('id')->toArray();
    		//dd($employee);
    		$rank = array_search($id,$employee) + 1;
    		$total = count($employee);
            $topthree = array_slice($employee, 0, 3);
    	} elseif ($type == 'Colleagues') {
    		if($emp)
    		{
    			$employers = [$emp];

    		}else{
	    		$employers = EmployeeExperience::where('employees_id', $id)->groupBy('employers_id')->pluck('employers_id')->toArray();
	    	}
    		$employees = EmployeeExperience::whereIn('employers_id', $employers)->groupBy('employees_id')->pluck('employees_id')->toArray();
    		$employee = Employees::select('id')->whereIn('id',$employees)->orderBy('points','desc')->pluck('id')->toArray();
    		//dd($employee);
    		$rank = array_search($id,$employee) + 1;
    		$total = count($employee);
            $topthree = array_slice($employee, 0, 3);
    	} elseif ($type == 'Circle') {
    		$circle = \App\UserCircle::where('user_id',$id)->where('status', 1)->pluck('staff_id')->toArray();
    		$myid = [$id];
    		$employees = array_unique(array_merge($circle,$myid), SORT_REGULAR);
       		$employee = Employees::select('id')->whereIn('id',$employees)->orderBy('points','desc')->pluck('id')->toArray();
    		//dd($employee);
    		$rank = array_search($id,$employee) + 1;
    		$total = count($employee);
            $topthree = array_slice($employee, 0, 3);

    	}elseif ($type == 'Functional') {
            if($emp)
            {
                $skil = [$emp];

            }else{
                $skil = EmployeeSkills::where('employees_id', $id)->groupBy('title')->pluck('title')->toArray();
            }
            $employees = EmployeeSkills::whereIn('title', $skil)->groupBy('employees_id')->pluck('employees_id')->toArray();
            $employee = Employees::select('id')->whereIn('id',$employees)->orderBy('points','desc')->pluck('id')->toArray();
            //dd($employee);
            $rank = array_search($id,$employee) + 1;
            $total = count($employee);
            $topthree = array_slice($employee, 0, 3);
        }

    	$datas = [
    		'score'		=> $score,
    		'highscore'	=> $highscore,
    		'rank'		=> $rank,
    		'total'		=> $total,
    		'employers' => $employers,
            'topthree'  => $topthree

    	];

    	return $datas;

    }


}
