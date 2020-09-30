<?php

namespace App\Http\Controllers\front;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imagetool;
use App\library\Settings;
use App\library\myFunctions;
use App\Article;
use App\Layout;



class ArticleController extends Controller
{

  public function index($url='', Request $request)
  {
     $layouts= Layout::where('layout_route', 'Article')->first();
     if(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }

      $article = Article::where('se_url',$url)->first();
      if (isset($article->id)) {
        $visit=$article->visit + 1;
       
         \App\Article::where('id', $article->id)->update(['visit' => $visit]);
        
          if(is_file(DIR_IMAGE.$article->image)){
          $meta_image = asset('/image/'.$article->image);
        } else{
          $meta_image = '';
        }
        
        $config = array(
              'app.meta_title' => $article->meta_title,
              'app.meta_keyword' => $article->meta_keyword,
              'app.meta_description' => $article->meta_description,
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('/web/article/'.$url),
              'app.meta_type' => 'article',
              
              
                );
            config($config);
        $datas['article'] = $article;
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
        
           
              return view('front.article.detail')->with('datas', $datas);
           
      } else{
        $config = array(
              'app.meta_title' => 'article Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'article Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/web/article/'.$url),
              'app.meta_type' => 'article',
              
                );
            config($config);
        return  view('front.article.article_not_found');
      }
  }
     


    public static function article($id,$layout_id)
    {

      $thumb_height = Settings::getImages()->thumb_height;
        $thumb_width = Settings::getImages()->thumb_width;

        $image_height = Settings::getImages()->image_height;
        $image_width = Settings::getImages()->image_width;

      $article= \App\Article::where('id', $id)->first();
      $relateds = array();
      $datas = array();
     
      if(isset($article->id) && !empty($article->id)){
        $visit=$article->visit + 1;
        $medata = array(
                    'visit' => $visit,
                                       
                    );
                \App\Article::where('id', $id)->update($medata);
              if(isset($article->image) && $article->image != ''){
                $thumbs = Imagetool::mycrop($article->image,$image_width,$image_height);
                $image = asset($thumbs);
              } elseif (isset($article->video) && $article->video != '') {
               
                $image = \App\Video::getVideoImage($article->video);
              }
              else{
                $image = '';
              }
              if (isset($article->video) && $article->video != '') {
                $video = $article->video;
              }
              else{
                $video = '';
              }
              $limit = Settings::getSettings()->description_limit;
              $mids=DB::table('article_to_menu')->where('article_id', $id)->first();
              $related = \App\Article::selectLimitedRelatedArticle($mids->menu_id,$id,3);
              
              foreach ($related as $value) {
                if(isset($value->image) && $value->image != ''){
                $thumbs = Imagetool::mycrop($value->image,$thumb_width,$thumb_height);
                $thumb = asset($thumbs);
              } elseif (isset($value->video) && $value->video != '') {
               
                $thumb = \App\Video::getVideoImage($value->video);
              }
              else{
                $thumb = '';
              }
              $description = Settings::getLimitedWords($value->description,0,$limit);

                $relateds[] = array(
                'title' => $value->title,
                'description' => $description,
                'image' => $thumb,
                'dates' => $value->created_at,
                'href' => $value->se_url,
                  );
              }
              $datas = array(
                'article_id' => $article->id,
                'layout_id' => $layout_id,
                'title' => $article->title,
                'description' => $article->description,
                'image' => $image,
                'video' => $video,
                'file' => $article->file_path,
                'published' => $article->created_at,
                'href' => $article->se_url,
                );
             
              
            }
              $hrf = myFunctions::curPageURL();

              $module = \App\Module::getModules($layout_id, 'content_main');
              
                $modules = array();
                foreach ($module as $value) {
                  $cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
                  $module = new $cont();
                    $modules[] = array(
                    'module' => $module->index($value->module_id,json_decode($value->setting)), ); 
                    }

              return view('front.article')->with('datas', $datas)->with('hrf', $hrf)->with('relateds', $relateds)->with('modules', $modules);



               
        
      

    }

   
  
   

}