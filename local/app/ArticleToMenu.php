<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleToMenu extends Model
{
    protected $table = 'article_to_menu';  

    protected $fillable = array('article_id', 'menu_id' );

    public $timestamps = false;
    public function article()
    {
    	return $this->belongsTo('App\Article');
    }

    public function menu()
    {
    	return $this->belongsTo('App\Menu');
    }
}
