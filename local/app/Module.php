<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'module';  

    protected $fillable = array('title', 'setting', 'module_page' );
    protected $primaryKey = 'id';
	
    
    public function moduleDisplay()
    {
    	return $this->hasMany('App\ModuleDisplay');
    }

    public static function getModules($layout_id, $page)
       {
       

        $article=DB::table('module_display as a');
        $article->leftJoin('module as ad', 'a.module_id', '=', 'ad.id');
        
        $article->where('a.layout_id', $layout_id);
        
        $article->where('a.position', $page);
        $article->where('a.status', 1);
        
        
        $article->orderBy('a.sort_order', 'asc');
        $articles = $article->get();
        return $articles;
       }
    public static function getHeaderModules()
       {
       

        $article=DB::table('module_display as a');
        $article->leftJoin('module as ad', 'a.module_id', '=', 'ad.id');
        
        
        
        $article->where('a.position', 'content_header');
        $article->where('a.status', 1);
        
        
        $article->orderBy('a.sort_order', 'asc');
        $articles = $article->get();
        return $articles;
       }
   
}
