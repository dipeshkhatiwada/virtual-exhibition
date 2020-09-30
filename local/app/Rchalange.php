<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RchalangeParticipation;
use App\Rchalange;

class Rchalange extends Model
{
    protected $table = 'rchalange';  

    protected $fillable = array('title', 'category_id', 'status', 'number_of_question', 'seo_url', 'created_by','publish_date');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$cat = Rchalange::where('id', $id)->first();
    	if (isset($cat->title)) {
    		return $cat->title;
    	}else{
    		return '';
    	}
    }

    public function Questions()
    {
        return $this->hasMany('App\RchalangeQuestion');
    }

    public static function countTests($id='')
    {
        return RchalangeParticipation::where('rchalange_id', $id)->count();
    }

    public static function checkVeriable($value='')
    {
        $words = ['Lado', 'lado', 'puti', 'Puti'];
        $count = 0;
        str_replace($words, '', $value, $count);
       return $count;
    }

    public static function checkParticipation()
    {
        $circle = \App\UserCircle::where('user_id',auth()->guard('employee')->user()->id)->where('status', 1)->pluck('staff_id');
        $chalanges = Rchalange::whereIn('created_by',$circle)->where('publish_date', '<=', date('Y-m-d'))->where('status', 1)->get();
        $return  = [];
        foreach ($chalanges as $key => $value) {
            $parti = RchalangeParticipation::where('rchalange_id',$value->id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
            if ($parti < 1) {
                # code...
           
            $return[] = [
                'title' => $value->title,
                'seo_url' => $value->seo_url,
                'category' => \App\TestCategory::getTitle($value->category_id),
                'posted_by' => \App\Employees::getName($value->created_by),
                'id' => $value->id,
            ];
             }
        }
        return $return;
    }

     public static function getParticipation()
    {
        $circle = \App\UserCircle::where('user_id',auth()->guard('employee')->user()->id)->where('status', 1)->pluck('staff_id');
        $chalanges = Rchalange::whereIn('created_by',$circle)->where('publish_date', '<=', date('Y-m-d'))->where('status', 1)->get();
        $return  = [];
        foreach ($chalanges as $key => $value) {
            $parti = RchalangeParticipation::where('rchalange_id',$value->id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
            
                # code...
           
            $return[] = [
                'title' => $value->title,
                'seo_url' => $value->seo_url,
                'category' => \App\TestCategory::getTitle($value->category_id),
                'posted_by' => \App\Employees::getName($value->created_by),
                'id' => $value->id,
                'participation' => $parti
            ];
             
        }
        return $return;
    }

    public static function countParticipation($id='')
    {
        return RchalangeParticipation::where('rchalange_id',$id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
    }

    public static function countFrind()
    {
        return UserCircle::where('staff_id',auth()->guard('employee')->user()->id)->where('status',1)->count();
    }
}

