<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmployeeRating extends Model
{
     protected $table = 'employee_rating';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'rating', 'comment_by', 'description','types'
    ];
    
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public static function getRating($id='')
    {
    	$rating_number = DB::table('employee_rating')->where('employees_id', $id)->count();
    	$total_rating = $rating_number * 5;
    	$employer_marks = DB::table('employee_rating')->where('employees_id', $id)->sum('rating');
        if ($total_rating > 0) {
            return number_format((($employer_marks / $total_rating) * 100), 2, '.', '');
        } else{
            return '0.00';
        }
    	 
    }

    public static function ratingNumber($id='')
    {
    	$rating_number = DB::table('employee_rating')->where('employees_id', $id)->count();
    	$total_rating = $rating_number * 5;
    	$employer_marks = DB::table('employee_rating')->where('employees_id', $id)->sum('rating');
    	$percent = number_format((($employer_marks / $total_rating) * 100), 2, '.', '');

    	return number_format((($percent / 100) * 5), 2, '.', '');
    }
       

    
}
