<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\library\Settings;
use App\library\myFunctions;
use App\Employees;
use App\Layout;
use App\EmployeeReference;
use App\ReferenceComment;


class ReferenceController extends Controller
{


  public function index(Request $request)
    {
        $email = '';
        $ref_email = 'my@my.com';
        if (isset($request->email)) {
            $email = $request->email;
        }
        if (isset($request->ref_email)) {
            $ref_email = $request->ref_email;
        }
        $employee = Employees::where('email', $email)->first();
        if (isset($employee->id)) {
            $reference = EmployeeReference::where('employees_id', $employee->id)->where('email', $ref_email)->first();
            if (isset($reference->id)) {
                $check = ReferenceComment::where('employee_reference_id', $reference->id)->first();
                if (isset($check->id)) {
                    $config = array(
                          'app.meta_title' => 'Reference Comment',
                          'app.meta_keyword' => 'Reference Comment',
                          'app.meta_description' => 'Reference Comment',
                          'app.meta_image' => '',
                          'app.meta_url' => url('/referencevalidation'),
                          'app.meta_type' => 'Reference Comment',
                      );
                         config($config);
                        $controller =  view('front.comment')->with('message', 'You had already Commented on '.$employee->firstname.' '.$employee->middlename.' '.$employee->lastname);
                } else{
                    $datas = [];
                    $datas['employee_name'] = $employee->firstname.' '.$employee->middlename.' '.$employee->lastname;
                    $datas['reference_name'] = $reference->name;
                    $datas['phone'] = $reference->mobile;
                    $datas['email'] = $reference->email;
                    $datas['reference_id'] = $reference->id;
                    $datas['company'] = $reference->company;

                    $config = array(
                              'app.meta_title' => 'Reference Comment',
                              'app.meta_keyword' => 'Reference Comment',
                              'app.meta_description' => 'Reference Comment',
                              'app.meta_image' => '',
                              'app.meta_url' => url('/referencevalidation'),
                              'app.meta_type' => 'Reference Comment',
                          );
                             config($config);
                            $controller =  view('front.reference_comment_form')->with('data', $datas);
                }
            } else{
                $config = array(
                  'app.meta_title' => 'Reference Comment',
                  'app.meta_keyword' => 'Reference Comment',
                  'app.meta_description' => 'Reference Comment',
                  'app.meta_image' => '',
                  'app.meta_url' => url('/referencevalidation'),
                  'app.meta_type' => 'Reference Comment',
              );
                 config($config);
                $controller =  view('front.comment')->with('message', 'These credentials do not match our records.');
            }
        } else{
            $config = array(
                  'app.meta_title' => 'Reference Comment',
                  'app.meta_keyword' => 'Reference Comment',
                  'app.meta_description' => 'Reference Comment',
                  'app.meta_image' => '',
                  'app.meta_url' => url('/referencevalidation'),
                  'app.meta_type' => 'Reference Comment',
              );
                 config($config);
                $controller =  view('front.comment')->with('message', 'These credentials do not match our records.');
        }


         return $controller;
    }

    public function save(Request $request)
    {
      $this->validate($request, [
        'id' => 'required|integer',
        'name' => 'required',
        'email' => 'required|email',
        'company' => 'required',
        'phone' => 'required|min:10',
        'relationship' => 'required',
        'capacity' => 'required|min:20', 
        'duties' => 'required|min:20', 
        'leaving_reason' => 'required|min:20', 
        'strengths' => 'required|min:20', 
        'overall_work' => 'required|min:20', 
        'weakness' => 'required|min:5', 
        'reliability' => 'required|min:5', 
        'punctuality' => 'required|min:5', 
        'attendance' => 'required|min:5', 
        'professionalism' => 'required|min:20', 
        're_employe' => 'required', 
        'final_comment' => 'required|min:20'
      ]);

      
      $data = [
        'employee_reference_id' => $request->id,
        'name' => $request->name,
        'email' => $request->email,
        'company' => $request->company,
        'phone' => $request->phone,
        'relationship' => $request->relationship,
        'capacity' => $request->capacity,
        'duties' => $request->duties,
        'leaving_reason' => $request->leaving_reason,
        'overall_work' => $request->overall_work,
        'weakness' => $request->weakness,
        'reliability' => $request->reliability,
        'punctuality' => $request->punctuality,
        'attendance' => $request->attendance,
        'professionalism' => $request->professionalism,
        're_employe' => $request->re_employe,
        'comment' => $request->final_comment

      ];

      $action = ReferenceComment::create($data);
      if ($action) {
        return redirect('/reference/success');

      } else{
        \Session::flash('alert-danger','Something went wrong. Please contact webmaster!!');
        return redirect()->back()->withInput();
      }


    }

    public function success(Request $request)
    {

      $config = array(
                  'app.meta_title' => 'Reference Comment',
                  'app.meta_keyword' => 'Reference Comment',
                  'app.meta_description' => 'Reference Comment',
                  'app.meta_image' => '',
                  'app.meta_url' => url('/referencevalidation'),
                  'app.meta_type' => 'Reference Comment',
              );
                 config($config);
                $controller =  view('front.comment')->with('message', 'Thank you for giving comment to client!!');


                $layouts= Layout::where('layout_route', 'ReferenceComment')->first();
      
     
            if(isset($layouts->layout_id))
            {
              $layout_id = $layouts->layout_id;
            }
            else
            {
              $layout_id = '';
            }
         

         return $controller;

    }


 


    
}
