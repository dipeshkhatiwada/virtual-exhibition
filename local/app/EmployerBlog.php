<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class EmployerBlog extends Model
{
    protected $table = 'employer_blog';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'title', 'meta_title', 'meta_keyword', 'meta_description', 'description', 'seo_url', 'image', 'video', 'status', 'from','category','category_id','visits'
    ];
   
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }
    
    public static function Category($title='')
    {

   
    	$return  = '';
    	if ($title == 1) {
    		$return = 'All';
    	}elseif ($title == 2) {
    		$return = 'Women';
    	}
    	elseif ($title == 3) {
    		$return = 'Able';
    	}
    	elseif ($title == 4) {
    		$return = 'Retaired';
    	}
    	return $return;
    }

    public static function getTitle($id='')
    {
    	$title = '';
    	$blog = DB::table('employer_blog')->select('title')->where('id',$id)->first();
    	if (isset($blog->title)) {
    		$title = $blog->title;
    		# code...
    	}
    	return $title;
    }
}
