<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Imagetool;
use App\Menu;
use App\Layout;
use App\library\Settings;
use Carbon\Carbon;
use App\Setting;
use DB;
use App\Employers;
use App\EmployerBlog;
use App\BlogCategory;
use Validator;
use App\BlogComment;
use App\EmployeeActivity;

class BlogController extends Controller
{
   public function categoryBlog($category_id,$category,Request $request)
   {
    $date = Carbon::now()->toDateString();
    if ($category == 2) {
      $datas['header'] = 'front/common/women_header';
       $layouts= Layout::where('layout_route', 'WomenBlog')->first();
    }elseif ($category == 3) {
      $datas['header'] = 'front/common/able_header';
       $layouts= Layout::where('layout_route', 'AbleBlog')->first();
    }
    elseif ($category == 4) {
      $datas['header'] = 'front/common/retaired_header';
       $layouts= Layout::where('layout_route', 'RetairedBlog')->first();
    } else{
      $datas['header'] = 'front/common/job_header';
      $layouts= Layout::where('layout_route', 'AllBlog')->first();
    }
       
    
     
      if(isset($data->layout_id))
      {
        $layout_id = $data->layout_id;
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }

      $blog_category = BlogCategory::where('seo_url',$category_id)->first();
      $category_id = 0;
      $title = '';
      $category_url = '';
      if (isset($blog_category->id)) {
        $category_id = $blog_category->id;
        $title = $blog_category->title;
        $category_url = $blog_category->seo_url;
      }
    
        $settings = Settings::getSettings();
        $images = Settings::getImages();
        
        $config = array(
              'app.meta_title' => $title,
              'app.meta_keyword' => $title,
              'app.meta_description' => $title,
              'app.meta_image' => asset('/image/'.$images->women),
              'app.meta_url' => url('/blog'.$category_url.''.$category),
              'app.meta_type' => 'website',
              
                );
            config($config);

    $datas['category'] = $category;
    $datas['blogs'] = EmployerBlog::where('category',$category)->where('category_id',$category_id)->where('status', 1)->paginate(20);
    $datas['title'] = $title;
   
    
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
    
    return view('front.blog.category_blog')->with('datas', $datas);

    }


    public function blogDetail($category,$seo_url,Request $request)
   {
    $date = Carbon::now()->toDateString();
    if ($category == 2) {
      $datas['header'] = 'front/common/women_header';
       $layouts= Layout::where('layout_route', 'WomenBlogDetail')->first();
    }elseif ($category == 3) {
      $datas['header'] = 'front/common/able_header';
       $layouts= Layout::where('layout_route', 'AbleBlogDetail')->first();
    }
    elseif ($category == 4) {
      $datas['header'] = 'front/common/retaired_header';
       $layouts= Layout::where('layout_route', 'RetairedBlogDetail')->first();
    } else{
      $datas['header'] = 'front/common/job_header';
      $layouts= Layout::where('layout_route', 'AllBlogDetail')->first();
    }
       
    
     
      if(isset($data->layout_id))
      {
        $layout_id = $data->layout_id;
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }

      $blog = EmployerBlog::where('seo_url',$seo_url)->where('status', 1)->first();
      $title = '';
      $description = '';
      $image = '';
      $publish_date = '';
      $views = 0;
      $video = '';
      $meta_title = '';
      $meta_keyword = '';
      $meta_description = '';
      $published_by = '';
      $comments = [];
      $id = 0;
      if (isset($blog->id)) {
        
        $title = $blog->title;
        $description = $blog->description;
        if (is_file(DIR_IMAGE.$blog->image)) {
                    $image = $blog->image;
                }
         $created = Carbon::parse($blog->created_at);
         $publish_date = $created->toFormattedDateString();
         $views = $blog->visits + 1;
         $video = $blog->video;
         $meta_title = $blog->meta_title;
         $meta_keyword = $blog->meta_keyword;
         $meta_description = $blog->meta_description;
         $published_by = $blog->employers_id;
         EmployerBlog::where('id',$blog->id)->update(['visits' => $views]);
         $comments = BlogComment::where('employer_blog_id',$blog->id)->where('parent_id', 0)->get();
         $id = $blog->id;
      }

      if ($image != '') {
        $image = Imagetool::mycrop($image,1080,600);
      }
    
        
        
        $config = array(
              'app.meta_title' => $meta_title,
              'app.meta_keyword' => $meta_keyword,
              'app.meta_description' => $meta_description,
              'app.meta_image' => asset($image),
              'app.meta_url' => url('/blog/'.$category.'/'.$seo_url),
              'app.meta_type' => 'website',
              
                );
            config($config);
      $publisher = 'Admin';
      if ($published_by != '') {
        $publisher = Employers::getName($published_by);
      }
    
    $datas['blog'] = [
      'title' => $title,
      'description' => $description,
      'image' => $image,
      'publish_date' => $publish_date,
      'views' => $views,
      'video' => $video,
      'publisher' => $publisher,
      'comments' => $comments,
      'id' => $id
    ];
   
   
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
    
    return view('front.blog.blog_detail')->with('datas', $datas);

    }


    public function postComment(Request $request)
    {
      if (!isset(auth()->guard('employee')->user()->id)) {
        \Session::flash('alert-danger', 'You must login to do comment the blog');
        return redirect()->back();

      }
      $this->validate($request, [
        'blog_id' => 'required|integer',
        'comment' => 'required|min:2'
      ]);
      if(is_null($request->comment_id)){
        $comment_id = '0';
      }else{
        $comment_id = $request->comment_id;
      }
      //dd($comment_id);

      BlogComment::create([
        'employer_blog_id' => $request->blog_id,
        'employees_id'      => auth()->guard('employee')->user()->id,
        'parent_id'         => $comment_id, 
        'comment'           => $request->comment, 
        'like'              => 0, 
        'dislike'           => 0
      ]);
      $check = EmployeeActivity::where('employees_id',auth()->guard('employee')->user()->id)->first();

            if (isset($check->id)) {
                $comment = 1;
                if($check->comment > 0)
                {
                    $comment = $check->comment + 1;
                }
                
                EmployeeActivity::where('id',$check->id)->update(['comment' => $comment]);
            }else{
                EmployeeActivity::create(['employees_id' => auth()->guard('employee')->user()->id, 'comment' => 1]);
            }
            
            return redirect()->back();
    }

    public function LikeDislike(Request $request)
    {
      if (!isset(auth()->guard('employee')->user()->id)) {
        return 'Error| Pleae Login';

      }
       $ses_like = [];
    $ses_dislike = [];
    if (session()->has('like')) {

       $ses_like = session()->get('like');
     } 
     if (session()->has('dislike')) {
       $ses_dislike = session()->get('dislike');
     } 

     //dd($ses_like);
      if (isset($request->comment_id)) {
        if ($request->comment_id > 0) {
          $comment = BlogComment::where('id', $request->comment_id)->first();
          if (isset($comment->id)) {

            if ($request->type == 'Like') {
              
              if (in_array($comment->id, $ses_like)) {
                return 'Error|You already liked this comment';
              } else{
              $like = $comment->like + 1;
              BlogComment::where('id',$comment->id)->update(['like' => $like]);
              $nses = [$comment->id];
              $sess = array_merge($ses_like,$nses);
              session(['like' => $sess]);
              }
              
            } elseif ($request->type == 'Dislike') {

              
              if (in_array($comment->id, $ses_dislike)) {
                return 'Error|You already liked this comment';
              } else{
                $like = $comment->dislike + 1;
               
              BlogComment::where('id',$comment->id)->update(['dislike' => $like]);
              $nses = [$comment->id];
              $sess = array_merge($ses_dislike,$nses);
              session(['dislike' => $sess]);
              }

              
            }

            return 'Success|';
          } else{
            return 'Error|Data Not Fouond';
          }
        } else{
          return 'Error|Comment is required';
        }
      } else{
        return 'Error|Comment is required';
      }
    }

    
}
