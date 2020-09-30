<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class article extends Model
{
  

   

    protected $table = 'article';  

    protected $fillable = array('image', 'video', 'status', 'visit', 'se_url', 'file_path', 'title', 'description', 'meta_title', 'meta_keyword', 'meta_description'  );
    protected $primaryKey = 'id';

   
   

    public function articleToMenu()
    {
      return $this->hasMany('App\ArticleToMenu');
    }

    public static function getArticleTitle($id)
       {
            $album = DB::table('article')->where('id', $id)->first();
            if (isset($album->title)) {
                return $album->title;
            } else{
                return '';
            }

        
        
       }

     public static function getSingleMenuArticle($id){
        $article=DB::table('article_to_menu');
        $article->where('menu_id', $id);
        return $article->first();
       }

    public static function selectLimitedRelatedArticle($mid,$pid,$limit){

         $article=DB::table('article_to_menu as am');
        $article->leftJoin('article as a', 'am.article_id', '=', 'a.id');
        
       
        $article->where('am.menu_id', $mid);
        $article->whereNotIn('am.article_id', [$pid]);
        $article->where('a.status', 1);
        $article->orderByRaw('RAND()');
        $article->take($limit);
        return $article->get();

       }

       
}
