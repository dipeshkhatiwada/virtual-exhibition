<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\EmployerBlog;
use Carbon\Carbon;


class LatestBlogController extends Controller
{
     

public function index($id,$setting)
    {

       
       
        
        $datas['blogs'] = [];
        $blogs = EmployerBlog::where('category',$setting->category)->where('status', 1)->orderBy('id','desc')->limit($setting->per_page)->get();
        foreach ($blogs as $blog) {
                $image = 'images/noimg.png';
                if (is_file(DIR_IMAGE.$blog->image)) {
                    $image = $blog->image;
                }
                $publish_date = Carbon::parse($blog->created_at);

                        
                       $datas['blogs'][] = array(
                        'title' => $blog->title,
                        'date' => $publish_date->toFormattedDateString(),
                        'image' => Imagetool::mycrop($image,540,300),
                        'href' => url('/blog/'.$setting->category.'/'.$blog->seo_url),
                        'description' => Settings::getLimitedWords(trim($blog->description),0,8),
                        'view' => $blog->visits,
                        );
                  
               
        }

        $datas['title'] = $setting->title;
        $datas['id'] = $id;
       
        
        return view('front.module.latestblog')->with('datas', $datas);
        

    }
    
     
     
  
   

}
