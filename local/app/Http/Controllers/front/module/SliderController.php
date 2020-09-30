<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\EmployerBlog;



class SliderController extends Controller
{
     

public function index($id,$setting)
    {

       
       
        if(is_array($setting->article_id)){
        $datas['blogs'] = [];
        foreach ($setting->article_id as $ids) {

            $blog = EmployerBlog::where('id',$ids)->first();
               if (isset($blog->id)) {
                   if ($blog->image != '') {
                       $datas['blogs'][] = array(
                        'title' => $blog->title,
                        
                        'image' => 'image/'.$blog->image,
                        'href' => url('/blog/'.$setting->category.'/'.$blog->seo_url),
                        );
                   }
               }
               
        }

        $datas['title'] = $setting->title;
        $datas['id'] = $id;
       
        
        return view('front.module.slider')->with('datas', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
