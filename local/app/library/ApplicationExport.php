<?php

namespace App\library;

use App\JobApply;
use App\JobForm;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeLanguage;
use App\EmployeeTraining;
use App\Employees;
use App\EmployeeReference;
use App\EmployeeAddress;
use App\EmployeeSetting;
use App\FormData;
use App\Saluation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Excel;
use Carbon\Carbon;


class ApplicationExport implements FromView
{
  
   

    public function __construct($request){
        $this->data = $request;
    }
    
   
     public function view(): View
    {
        ini_set('max_execution_time', 600);
      if ($this->data->process > 0) {
        $process = \App\JobProcess::where('id',$this->data->process)->first();
       
        if (isset($process->candidates)) {
          if (is_array(json_decode($process->candidates))) {
            foreach (json_decode($process->candidates) as $key => $value) {
               $emp_ids[] = $value;
            }
           
          }
          
        }
      }else{
        $application = JobApply::where('jobs_id',$this->data->job_id)->get();
         foreach ($application as $key => $value) {
            $emp_ids[] = $value->employees_id;
          }
      }

     





      $job = \App\Jobs::select('id','deadline')->where('id',$this->data->job_id)->first();
      $deadline = Carbon::now();
      if (isset($job->deadline)) {
        if ($job->deadline != '') {
          $deadline = Carbon::parse($job->deadline);
        }
      }










   $employee = Employees::select('employees.*')->join('employee_setting','employee_setting.employees_id','=','employees.id');
  
  if (isset($this->data->filter_education)) {
    if ($this->data->filter_education != '') {
      $employee->join('employee_education','employee_education.employees_id','=','employees.id');
    }
    
  }
  if (isset($this->data->filter_language)) {
    $employee->leftjoin('employee_language','employee_language.employees_id','=','employees.id');
  }
  if (isset($this->data->filter_location)) {
    $employee->leftjoin('employee_location','employee_location.employees_id','=','employees.id');
  }
  

  
       $employee->whereIn('employees.id',$emp_ids);
     
  

  //$employee = Employees::whereIn('id', $employe_id);
  if (isset($this->data->filter_name) && !empty($this->data->filter_name)) {
    $employee->where(\DB::raw('CONCAT_WS(" ", `employees.firstname`, `employees.middlename`, `employees.lastname`)'), 'like', '%' . $this->data->filter_name . '%');
   
}

if (isset($this->data->filter_id) && !empty($this->data->filter_id)) {
    $employee->where('employees.id', $this->data->filter_id);
   
}


if (isset($this->data->filter_email) && !empty($this->data->filter_email)) {
    $employee->where('employees.email', $this->data->filter_email);
    
}

if (isset($this->data->filter_gender) && !empty($this->data->filter_gender)) {
    $employee->where('employees.gender', $this->data->filter_gender);
    
}
if (isset($this->data->filter_marital_status) && !empty($this->data->filter_marital_status)) {
    $employee->where('employees.marital_status', $this->data->filter_marital_status);
    
}
if (isset($this->data->filter_nationality) && !empty($this->data->filter_nationality)) {
    $employee->where('employees.nationality', $this->data->filter_nationality);
    
}
if (isset($this->data->filter_minimum_salary) && !empty($this->data->filter_minimum_salary)) {
    $employee->where('employees.expected_salary', '>=', $this->data->filter_minimum_salary);
    
}
if (isset($this->data->filter_maximum_salary) && !empty($this->data->filter_maximum_salary)) {
    $employee->where('employees.expected_salary', '<=', $this->data->filter_maximum_salary);
   
}



if (isset($this->data->filter_minimum_age) && !empty($this->data->filter_minimum_age)) {
    $employee->where('employee_setting.age', '>=', $this->data->filter_minimum_age);
    
}
if (isset($this->data->filter_maximum_age) && !empty($this->data->filter_maximum_age)) {
    $employee->where('employee_setting.age', '<=', $this->data->filter_maximum_age);
   
}

if (isset($this->data->filter_experience) && !empty($this->data->filter_experience)) {
    $employee->where('employee_setting.total_experience', '>=', $this->data->filter_experience);
   
}
if (isset($this->data->filter_travel) && !empty($this->data->filter_travel)) {
    $employee->where('employee_setting.travel', '>=', $this->data->filter_travel);
   
}

if (isset($this->data->filter_relocate) && !empty($this->data->filter_relocate)) {
    $employee->where('employee_setting.relocation', '>=', $this->data->filter_relocate);
    
}
if (isset($this->data->filter_license) && !empty($this->data->filter_license)) {
    $employee->where('employee_setting.license', '>=', $this->data->filter_license);
   
}
if (isset($this->data->filter_vehicle) && !empty($this->data->filter_vehicle)) {
    $employee->where('employee_setting.have_vehical', '>=', $this->data->filter_vehicle);
    
}

if (isset($this->data->filter_language) && !empty($this->data->filter_language)) {
    $employee->where('employee_language.language', $this->data->filter_language);
   
}

if (isset($this->data->filter_location) && !empty($this->data->filter_location)) {
    $employee->where('employee_location.job_location_id', $this->data->filter_location);
   
}
if (isset($this->data->filter_education) && !empty($this->data->filter_education)) {
            $employee->where('employee_education.level_id', $this->data->filter_education);
            
        }
        if (isset($this->data->filter_faculty) && !empty($this->data->filter_faculty)) {
            $employee->where('employee_education.faculty_id', $this->data->filter_faculty);
           
        }

        $thisdata = $this->data;
       

$employee->where(function ($q) use ($thisdata) {
        
        if (isset($thisdata->filter_percentage) && !empty($thisdata->filter_percentage)) {
          $q->where('employee_education.marksystem', 1)->where('employee_education.percentage', '>=', $thisdata->filter_percentage);
          

         
        }

        if (isset($thisdata->filter_cgpa4) && !empty($thisdata->filter_cgpa4)) {
            $q->orWhere('employee_education.marksystem', 2)->Where('employee_education.percentage', '>=', $thisdata->filter_cgpa4);
           
           

        }

         if (isset($thisdata->filter_cgpa10) && !empty($thisdata->filter_cgpa10)) {
            $q->orWhere('employee_education.marksystem', 3)->Where('employee_education.percentage', '>=', $thisdata->filter_cgpa10);
            
            
        }


    });

 


$employees = $employee->orderby('employees.firstname','asc')->groupBy('employees.id')->get();


        
       
        if (count($employees) > 0) {
          
         
        
           $datas['edu'] = '';
         $datas['exp'] = '';
         $datas['lag'] = '';
         $datas['ref'] = '';
         $datas['tra'] = '';
         $datas['fdt'] = [];
         $form_data = JobForm::where('jobs_id', $this->data->job_id)->orderBy('id', 'asc')->get();
        if (count($form_data) > 0) {

          foreach ($form_data as $value) {
            $datas['fdt'][] = [
              'id' => $value->id,
              'f_title' => $value->f_lable,
            ];
          }
          # code...
        }
        $edud = EmployeeEducation::whereIn('employees_id', $emp_ids)->groupBy('level_id')->get();
        $datas['edu'] = count($edud);
        $expd = EmployeeExperience::whereIn('employees_id', $emp_ids)->groupBy('sn')->get();
       $datas['exp'] = count($expd);
       $langd = EmployeeLanguage::whereIn('employees_id', $emp_ids)->groupBy('sn')->get();
       
        $datas['lag'] = count($langd);
        $trad = EmployeeTraining::whereIn('employees_id', $emp_ids)->groupBy('sn')->get();
       $datas['tra'] = count($trad);
       $refd = EmployeeReference::whereIn('employees_id', $emp_ids)->groupBy('sn')->get();
        $datas['ref'] = count($refd);
        
         
         
           $datas['employees'] = [];
          foreach ($employees as $employee) {
        $formdatas = [];
       if (count($datas['fdt']) > 0) {
        foreach ($datas['fdt'] as $key => $fdt) {
          $fd = \App\FormData::where('jobs_id', $this->data->job_id)->where('employees_id', $employee->id)->where('job_form_id', $fdt['id'])->first();
          $answer = '';
          if (isset($fd->id)) {
            if ($fd->type == 2) {
              $answer = $fd->f_description;
            } else{
              $answer = asset('/image/'.$fd->f_description);
            }
          }
          $formdatas[] = $answer;
        }
         
       }

       $diff = Carbon::parse($employee->dob)->diffInDays($deadline);
        $years = $diff / 365;
        $years = number_format((float)$years, 2, '.', '');
        
        
        
        $address = \App\EmployeeAddress::where('employees_id',$employee->id)->first();
        $setting = \App\EmployeeSetting::where('employees_id',$employee->id)->first();
        
         $address = \App\EmployeeAddress::where('employees_id',$employee->id)->first();
        $setting = \App\EmployeeSetting::where('employees_id',$employee->id)->first();
        $total_experience = $setting->total_experience;
        

        $datas['employees'][] = [
          'id' => $employee->id,
          'firstname' => $employee->firstname,
          'middlename' => $employee->middlename,
          'lastname' => $employee->lastname,
          'saluation' => Saluation::getTitle($employee->saluation),
          'email' => $employee->email,
          'gender' => $employee->gender,
          'dob' => $employee->dob,
          'age' => $years,
          'total_experience' => $total_experience,
          'marital_status' => $employee->marital_status,
          'nationality' => $employee->nationality,
          'image' => $employee->image,
          'resume' => $employee->resume,
          'coverletter' => $employee->coverletter,
          'permanent_address' => $address->permanent,
          'temporary_address' => $address->temporary,
          'home_phone' => $address->home_phone,
          'mobile' => $address->mobile,
          'fax' => $address->fax,
          'website' => $address->website,
          'vehicle' => $setting->vehical,
          'license_of' => $setting->licenseof,
          'created_at' => $employee->created_at,
          'education' => EmployeeEducation::where('employees_id', $employee->id)->orderBy('level_id','desc')->get(),
          'experience' => EmployeeExperience::where('employees_id', $employee->id)->get(),
          'language' => EmployeeLanguage::where('employees_id', $employee->id)->get(),
          'reference' => EmployeeReference::where('employees_id', $employee->id)->get(),
          'form_data' => $formdatas,
          'training' => EmployeeTraining::where('employees_id', $employee->id)->get(),
        ];
            
        }

       
        
      return view('employer.jobs.csv', [
            'datas' => $datas
        ]);
   } else{
    return '';
   }
      
        
    }
}