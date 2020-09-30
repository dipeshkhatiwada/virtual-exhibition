<?php

namespace App\Http\Controllers\front;
use DB;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Mail;

use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;
use App\EmployeeActivity;


class ContactController extends Controller
{


     


    public function index($data = array(), Request $request)
    {
      
      $layouts= DB::table('layout')->where('layout_route', 'Contact')->first();
      if(isset($data['layout_id']))
      {
        $layout_id = $data['layout_id'];
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }

      
        $menu=\App\Menu::where('id', $data['menu_id'])->first();
        if(isset($menu->id))
        {

          if (is_file(DIR_IMAGE.$menu->image)) {
                $meta_image = asset('/image/'.$menu->image);
              }else{
                $meta_image = '';
              }


          $config = array(
              'app.meta_title' => $menu->meta_title,
              'app.meta_keyword' => $menu->meta_keyword,
              'app.meta_description' => $menu->meta_description,
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('web/'.$menu->se_url),
              'app.meta_type' => 'Single Article',
              
                );
            config($config);

         $datas['datas'] = array(
          'name' => Settings::getSettings()->name,
          'address' => Settings::getSettings()->address,
          'phone' => Settings::getSettings()->telephone,
          'fax' => Settings::getSettings()->fax,
          'email' => Settings::getSettings()->email,
          'latitude' => Settings::getSettings()->latitude,
          'longitude' => Settings::getSettings()->longitude,

          );

         //dd($datas);


         $datas['image'] = $meta_image;
        $main_content = \App\Module::getModules($layout_id, 'content_main');
      
        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
          $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
          $content_main = new $cont();
             $datas['main_modules'][] = array(
            'module' => $content_main->index($main->module_id,json_decode($main->setting)), ); 
            }


    $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
          $left_module = new $lcontent();
            $datas['left_content'][] = array(
            'module' => $left_module->index($left->module_id,json_decode($left->setting)),
              );  
            }
    $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
          $right_module = new $lcontent();
            $datas['right_content'][] = array(
            'module' => $right_module->index($right->module_id,json_decode($right->setting)),
              );  
            }
     $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
          $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
              );  
            }
       $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
          $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
            'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
              );  
            }
        
           
        return view('front.contact')->with('datas', $datas);










        }else{
          $config = array(
              'app.meta_title' => 'Page Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Page Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/web/Page/'.$url),
              'app.meta_type' => 'Page',
              
                );
            config($config);
        return view('errors.404');
        }
       
        
        
       

    }


    public function inquery(Request $request)
   {
    $this->validate($request,[
      'organization_name' => 'required|min:3',
      'organization_type' => 'required|min:3',
      'fullname' => 'required|min:3',
      'mobileno' => 'required|min:10',
      'email' => 'required|email',
      'message' => 'required|min:10'
    ]);

    $mydata = array(
                    'name' => $request->fullname, 
                    'email' => $request->email,
                    'subject' => 'Service Inquiry',
                    'org_name' => $request->organization_name,
                    'org_type' => $request->organization_type,
                    'mobile' => $request->mobileno,
                    'message' => $request->message,
                    'store_name' => Settings::getSettings()->name,
                    'logo' => Settings::getImages()->logo,
                    'toadd' => Settings::getSettings()->email,
                   
                                      
                    );
    set_time_limit(600);
         myFunctions::setEmail();
        Mail::send('mail.inquery', ['data' => $mydata], function($mail) use ($mydata){
                  $mail->to($mydata['toadd'],$mydata['store_name'])->from($mydata['email'],$mydata['name'])->subject('Contact From Website('.$mydata['subject'].')');
                });

         \Session::flash('alert-success','Message has been Sent Successfully');
                    return redirect()->back();
        
   }

     
    public function save(Request $request)
    {
       
        
        $v= Validator::make($request->all(),
            [
                    'name'=>'required|min:3',
                    'email' => 'required|email',
                    'message' => 'required|min:20',
                    'subject' => 'required|min:5',
                    
                    
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v)
                        ->withInput();
        } else 
            {
              myFunctions::setEmail();             
            
    
              
                $logo = Settings::getImages()->logo;
                $mydata = array(
                    'name' => $request->name, 
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'store_name' => Settings::getSettings()->name,
                    'logo' => $logo,
                    'toadd' => Settings::getSettings()->email,
                   
                                      
                    );
                Mail::send('mail.contact', ['data' => $mydata], function($mail) use ($mydata){
                  $mail->to($mydata['toadd'],$mydata['store_name'])->from($mydata['email'],$mydata['name'])->subject('Contact From Website('.$mydata['subject'].')');
                });
                
               
               
                    \Session::flash('alert-success','Message has been Sent Successfully');
                    return redirect()->back();

               
               
                }

            
        
    }

    public function send(Request $request)
    {
       
        
        
              $mail=Settings::getEmails();
              
            if($mail->protocal == 'smtp'){
              $config = array(
              'driver' => $mail->protocal,
              'host' => $mail->host_name,
              'port' => $mail->smtp_port,
              'from' => array('address' => $mail->parameter, 'name' => Settings::getSettings()->name),
              'encryption' => $mail->encription,
              'username' => $mail->username,
              'password' => $mail->password,
                );
            \Config::set('mail',$config);
            } elseif ($mail->protocal == 'mail') {
             $config = array(
              'driver' => $mail->protocal,
              
                );
            \Config::set('mail',$config);
            } elseif ($mail->protocal == 'mailgun') {
             $config = array(
              'driver' => $mail->protocal,
              
              
                );
            \Config::set('mail',$config);
            $mailgun = array('domain' => $mail->host_name,  'secret' => $mail->encription, );
            $services = array('mailgun' => $mailgun, );
            \Config::set('services', $services);
            }
            elseif ($mail->protocal == 'mandrill') {
             $config = array(
              'driver' => $mail->protocal,
              
                );
            \Config::set('mail',$config);
            $mailgun = array('secret' => $mail->encription, );
            $services = array('mandrill' => $mailgun, );
            \Config::set('services', $services);
            }
             $all = $request->all();
              
                $logo = Settings::getImages()->logo;
                $mydata = array(
                    'name' => 'Somebody', 
                    'email' => 'noreply@noreply.com',
                    'subject' => 'Form Submitted from Website.',
                    'store_name' => Settings::getSettings()->name,
                    'logo' => $logo,
                    'toadd' => Settings::getSettings()->email,
                    'datas' => $all,
                   
                                      
                    );
                Mail::send('mail.Formcontact', ['data' => $mydata], function($mail) use ($mydata){
                  $mail->to($mydata['toadd'],$mydata['store_name'])->from($mydata['email'],$mydata['name'])->subject($mydata['subject']);
                });
                
               
               
                    \Session::flash('alert-success','Your Message has been Sent Successfully');
                    return redirect()->back();

               
               
               

            
        
    }

    public function formSave(Request $request)
    {
       
               
               
                    \Session::flash('alert-success','Your Request has been Submitted Successfully');
                    return redirect()->back();

               
               
               

            
        
    }

public function referFriend(Request $request)
    {

       
      
        
        $v= Validator::make($request->all(),
            [
                    'name'=>'required|min:3',
                    'from_email' => 'required|email',
                    'to_email' => 'required|email',
                    'job_url' => 'required|url',
                    'enquiry' => 'required|min:5',
                    'employer_url' => 'required',
                    'employer_name' => 'required',
                    'job_title' => 'required',
                    'publish_date' => 'required',
                    'deadline' => 'required'
                    
                    
            ]);
        if($v->fails())
        {
            echo 'You must fill all the fields.';
            exit();
        } else 
            {
              myFunctions::setEmail();             
           
                    
    
              
                $logo = Settings::getImages()->logo;
                $mydata = array(
                    'name' => $request->name, 
                    'from_email' => $request->from_email,
                    'to_email' => $request->to_email,
                    'to_name' => $request->friend_name,
                    'message' => $request->enquiry,
                    'job_url' => $request->job_url,
                    'employer_url' => $request->employer_url,
                    'employer_logo' => $request->employer_logo,
                    'employer_fl' => $request->employer_fl,
                    'employer_name' => $request->employer_name,
                    'job_title' => $request->job_title,
                    'publish_date' => $request->publish_date,
                    'deadline' => $request->deadline
                   
                                      
                    );


                Mail::send('mail.recomended', ['data' => $mydata], function($mail) use ($mydata){
                  $mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['name'])->subject('Job Recomended from your friend');
                });
                
               if(isset(auth()->guard('employee')->user()->id)){
               
                 $check = EmployeeActivity::where('employees_id',auth()->guard('employee')->user()->id)->first();
                  if (isset($check->id)) {
                      $total_share = 1;
                      if($check->total_share > 0)
                      {
                          $total_share = $check->total_share + 1;
                      }
                      EmployeeActivity::where('id',$check->id)->update(['total_share' => $total_share]);
                  }else{
                      EmployeeActivity::create(['employees_id' => auth()->guard('employee')->user()->id, 'total_share' => 1]);
                  }
                }
               
                   echo 'Thank you for recomending this job to your friend.';
                   exit();
               
               
                }

            
        
    }
   
     

}
