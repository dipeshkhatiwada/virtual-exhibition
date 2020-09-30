<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogComment;

class BlogComment extends Model
{

	 protected $table = 'blog_comment';  

    protected $fillable = array('employer_blog_id','employees_id', 'parent_id', 'comment', 'like', 'dislike');
    protected $primaryKey = 'id';
    
    public function Blogs()
    {
    	return $this->belongsTo('App\EmployerBlog');
    }

    public static function getSubComment($value='')
    {
    	return BlogComment::where('parent_id',$value)->get();
    }
}
