<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Imagetool;
use App\UserGroup;
use App\Setting;

class SettingController extends Controller
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

     


    public function index()
    {
        $permission = UserGroup::checkPermission('SettingController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        
      $setting = Setting::where('id', '1')->first();
                
       if($setting){
        $email= $setting->settingEmail;
        $image= $setting->settingImage;
        $social= $setting->settingSocial;
        
        
        return view('admin.setting.editform')->with('setting', $setting)->with('emails', $email)->with('image', $image)->with('socials', $social);
    } else {
        return 'No Data Found';
    }
        
    }

  

    public function update(Request $request)
    {
       
       $permission = UserGroup::checkPermission('SettingController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        $data=$request->all();
        $v= Validator::make($request->all(),
            [
                    'email'=>'required|email',
                    'meta_keyword' => 'required|min:5',
                    'meta_description' => 'required|min:5',
                    'item_perpage' => 'required|numeric',
                    'description_limit' => 'required|numeric',
                    'thumb_height' => 'required|numeric',
                    'thumb_width' => 'required|numeric',
                    'image_height' => 'required|numeric',
                    'image_width' => 'required|numeric',
                    
                    'meta_title' => 'required|min:5',
                    'company' => 'required|min:5'
                    
            ]);
        if($v->fails())
        {
            \Session::flash('alert-danger','Some Fields are required, Please check again.');
            return redirect()->back()->withErrors($v)
                        ->withInput();
        } else 
            {
                $data = array(
                    
                    'meta_keyword' => $data['meta_keyword'],
                    'meta_description' => $data['meta_description'],
                    'email' => $data['email'],
                    'item_perpage' => $data['item_perpage'],
                    'description_limit' => $data['description_limit'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'google_analytics' => $data['google_analytic'],
                    'meta_title'  => $data['meta_title'],
                    'name' => $data['company'],
                    'telephone' => $data['telephone'],
                    'fax' => $data['fax'],
                    'address' => $data['address'],
                    'project_commission' => $data['project_commission'],
                    );
                 Setting::where('id', $request->setting_id)->update($data);
                 
                    $datas= '';
                    $datas = array(
                        
                        'logo' => $request['logo'],
                        'icon' => $request['icon'],
                        'job' => $request['job'],
                        'tender' => $request['tender'],
                        'training' => $request['training'],
                        'test' => $request['test'],
                        'project' => $request['project'],
                        'event' => $request['event'],
                        'women' => $request['women'],
                        'able' => $request['able'],
                        'retaired' => $request['retaired'],
                        'thumb_height' => $request['thumb_height'],
                        'thumb_width' => $request['thumb_width'],
                        'image_height' => $request['image_height'],
                        'image_width' => $request['image_width'],
                        );
                   
                    \App\SettingImage::where('setting_id', $request->setting_id)->update($datas);
                    
                    

                     $datas= '';
                    $datas = array(
                        
                        'protocal' => $request['protocal'],
                        'parameter' => $request['parameter'],
                        'host_name' => $request['host_name'],
                        'username' => $request['username'],
                        'password' => $request['password'],
                        'smtp_port' => $request['smtp_port'],
                        'encription' => $request['encription'],
                        );
                   
                    \App\SettingEmail::where('setting_id', $request->setting_id)->update($datas);
                    

                     $datas= '';
                    $datas = array(
                        'setting_id' => $request->setting_id, 
                        'facebook' => $request['facebook'],
                        'twitter' => $request['twitter'],
                        'gplus' => $request['gplus'],
                        'youtube' => $request['youtube'],
                        'linkedin' => $request['linkedin'],
                        );
                    
                    \App\SettingSocial::where('setting_id', $request->setting_id)->update($datas);
                   

                    \Session::flash('alert-success','Record have been updateds Successfully');
                    return redirect('admin/setting');

                
               
                

            }
        
    }
}