<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class menu extends Model
{
 
 protected $table = 'menu';  

    protected $fillable = array('parent_id', 'sort_order', 'status', 'layout_id', 'image', 'se_url', 'title', 'description', 'meta_title', 'meta_keyword', 'meta_description' );
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function menuPath()
    {
      return $this->hasMany('App\MenuPath');
    }

    public function articleToMenu()
    {
      return $this->hasMany('App\ArticleToMenu');
    }

    public static function getMenuTitle($id)
       {
            $menu = DB::table('menu')->where('id', $id)->first();

            if(isset($menu->title))
            {
                $title = $menu->title;
            } else {
                $title = '';
            }
        return $title;
       }

    


}
