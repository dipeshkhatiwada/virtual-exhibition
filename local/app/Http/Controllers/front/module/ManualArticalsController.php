<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;




class ManualArticalsController extends Controller
{
     

public function index($id,$title,$text,$caids,$perpage)
    {
       
        $limit = Settings::getSettings()->description_limit;
        $thumb_height = Settings::getImages()->thumb_height;
        $thumb_width = Settings::getImages()->thumb_width;
        $datas = array('title' => $title );
        if($caids != ''){
        $id = explode(',', $caids);    
        $products = array_slice($id, 0, $perpage);
        $mydata = array();
        foreach ($products as $ids) {

            $article=DB::table('article as a');
            $article->leftJoin('article_description as ad', 'a.article_id', '=', 'ad.article_id');
            $article->where('ad.language_id', $_SESSION['language']);
            $article->where('a.status', 1);
            $article->where('a.article_id', $ids);
            $value = $article->first();
             if(!empty($value->image)){
                    $thumbs = Imagetool::mycrop($value->image,$thumb_width,$thumb_height);
                    $thumb = asset($thumbs);
                    
                } elseif (!empty($value->video)) {
                    $thumb = \App\Video::getVideoImage($value->video);
                } else {
                    $thumb = '';
                   
                }
               $description = Settings::getLimitedWords($value->description,0,$limit);
               $mydata[] = array(
                'title' => $value->title,
                'description' => $description,
                'thumb' => $thumb,
                'href' => $value->se_url,
                );
        }


       
        
        return view('front.module.popularArticle')->with('data', $datas)->with('articles', $mydata);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
