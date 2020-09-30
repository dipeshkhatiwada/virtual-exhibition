<?php

namespace App\Http\Controllers\front;
use DB;
use App\Http\Controllers\Controller;

use App\Testimonial;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;
use Image;


class TestimonialController extends Controller
{


     


    public function index($data = array(), Request $request)
    {
       if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }
      $layouts= DB::table('layout')->where('layout_route', 'Testimonial')->first();
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

      $controller = array();
        $menu=\APP\Menu::specificMenu($data['menu_id']);
        $perpage=Settings::getSettings()->item_perpage;
        $path = $menu->se_url;
        $menu_title = $menu->title;
        $meta_title=$menu->meta_title;
        $meta_description=$menu->meta_description;
        $meta_keyword=$menu->meta_keyword;
        $start= ($page - 1) * $perpage;
        
         $total = Testimonial::where('status', 1)->count();
        $testimonials = Testimonial::where('status', 1)->orderBy('id', 'DESC')->skip($start)->take($perpage)->get();
               
                        $thumb_height = Settings::getImages()->thumb_height;
                        $thumb_width = Settings::getImages()->thumb_width;
                        $limit=Settings::getSettings()->description_limit;
                        $datas = array();
                            foreach ($testimonials as $value) {
                                if(isset($value->image) && $value->image != ''){
                                  $thumbs = Imagetool::mycrop($value->image,$thumb_width,$thumb_height);
                                  $image = asset($thumbs);
                                } 
                                else{
                                    $image = '';
                                }
                        $description = Settings::getLimitedWords($value->description,0,$limit);

                              $datas[] = array(
                                'name' => $value->name,
                                'description' => $description,
                                'image' => $image,
                                'dates' => $value->created_at,
                                'href' => $value->se_url,
                                );

                            }

                        $module = \App\Module::getModules($layout_id, 'content_right');
      
                        $modules = array();
                        foreach ($module as $value) {
                            $cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
                            $module = new $cont();
                            $modules[] = array(
                            'module' => $module->index($value->module_id,$value->module_title,$value->module_text,$value->c_a_ids,$value->per_page), ); 
                            }
                        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($datas, $total, $perpage);
                        $paginator->setPath($path);

                        $controller = view('front.Testimonial')->with('testimonials', $paginator)->with('modules', $modules)->with('title', $menu_title);
                   

        $datas = array(
      'header' => \App\Http\Controllers\front\Common\HeaderController::index($meta_title,$meta_keyword,$meta_description),
      'footer' => \App\Http\Controllers\front\Common\FooterController::index(),
      'left' => \App\Http\Controllers\front\Common\LeftController::index($layout_id),
      'right' => $controller,
      'top' => \App\Http\Controllers\front\Common\TopController::index($layout_id),
      'bottom' => \App\Http\Controllers\front\Common\BottomController::index($layout_id),
      'full' => \App\Http\Controllers\front\Common\FullwidthController::index($layout_id),
      );
    

    return view('front.common.home')->with('datas', $datas);

    }

     
    public function save(Request $request)
    {
       
        
         $v= Validator::make($request->all(),
            [
                    'name'=>'required|min:3',
                    'email' => 'required|email',
                    'message' => 'required|min:20',
                    'address' => 'required|min:5',
                    'image' => 'max:2000|mimes:jpeg,bmp,png',
                    
                    
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v)
                        ->withInput();
        } else 
            {
               $sur=myFunctions::removeSpace($request->name);
               $su=$sur.'-'.date('ymdhis');
                $ip = $request->getClientIp();
                if(!empty($request->File('image'))){
                $directory = DIR_IMAGE . 'testimoni';
                $image = $request->File('image');
                $image_name= date('Y-m-d-H-i-s');
                $path = $directory.'/' . $image_name;
                $myimage= 'testimoni/'.$image_name;
                 Image::make($image->getRealPath())->save($path);
               } else{
                $myimage = '';
               }
                
                $mydata = array(
                    'name' => $request->name, 
                    'email' => $request->email,
                    'address' => $request->address,
                    'description' => $request->message,
                    'ip_address' => $ip,
                    'status' => 0,
                    'image' => $myimage,
                    'se_url' =>$su,
                    
                    );
                $video = Testimonial::create($mydata);
                //$videos = $video->album_id;
                
               
                if($video)
                {
                    

                    
                    

                    $seo = array(
                        'type_id' => $video->id, 
                        'type' => 'testimonial',
                        's_url' => $su,
                        );
                    DB::table('seo_url')->insert($seo);
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect()->back();

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on saving record');
                    return redirect()->back(); 
                
                }
               
                }

            
        
    }

   

     

   
    
  
   

}
