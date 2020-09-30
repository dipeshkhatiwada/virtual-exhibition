<?php

namespace App\Http\Controllers\front;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\library\myFunctions;
use App\library\Settings;

use App\library\document;




class MultipleArticleController extends Controller
{

     


    public function index($data = array(), Request $request) {
      if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }
      $layouts= DB::table('layout')->where('layout_route', 'MultipleArticle')->first();
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
      if(isset($data['menu_id']))
      {
        $controller = array();
        $menu=\APP\Menu::specificMenu($data['menu_id']);
        $perpage=Settings::getSettings()->item_perpage;
        $path = $menu->se_url;
        $menu_title = $menu->title;
        $meta_title=$menu->meta_title;
      $meta_description=$menu->meta_description;
      $meta_keyword=$menu->meta_keyword;
      $start= ($page - 1) * $perpage;
        $mydata = array(
            'page' => $page,
            'id' => $data['menu_id'],
            'onPage' => $perpage,
            'start' => $start,
            
            );
        $articles= \App\Article::getMArticles($mydata);
        $total = \App\Article::countMArticles($data['menu_id']);
        if(count($articles)>0)
        {
          $thumb_height = Settings::getImages()->thumb_height;
        $thumb_width = Settings::getImages()->thumb_width;
        $limit=Settings::getSettings()->description_limit;
          $datas = array();
          foreach ($articles as $value) {
            if(isset($value->image) && $value->image != ''){
              $thumbs = Imagetool::mycrop($value->image,$thumb_width,$thumb_height);
              $image = asset($thumbs);
            } elseif (isset($value->video) && $value->video != '') {
       
              $image = \App\Video::getVideoImage($value->video);
            }
            else{
              $image = '';
              }
              $description = Settings::getLimitedWords($value->description,0,$limit);

              $datas[] = array(
                'title' => $value->title,
                'description' => $description,
                'image' => $image,
                'published' => $value->created_at,
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

          $controller = view('front.Multiarticle')->with('articles', $paginator)->with('modules', $modules)->with('title', $menu_title);
        }
        else {
          $controller = view('errors.notFound');
        }
        
        

      }
      
      else{
        $controller = \App\Http\Controllers\front\ErrorController::index();

       return $controller;
       exit();
      }
    
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
   
  
   

}