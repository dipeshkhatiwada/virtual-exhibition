<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FaqCategory;

class FaqCategory extends Model
{
    protected $table = 'faq_category';  

    protected $fillable = array('title', 'seo_url','sort_order');
    protected $primaryKey = 'id';

    public static function getTitle($id='')
    {
    	$title = '';
    	$category = FaqCategory::select('title')->where('id',$id)->first();
    	if (isset($category->title)) {
    		$title = $category->title;
    	}
    	return $title;
    }
}
