<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeSearch;

class EmployeeSearch extends Model
{
    protected $table = 'employee_search';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'resume_number', 'duration', 'price', 'discount'
    ];

    public static function getTitle($value='')
    {
    	$title = '';
    	$package = EmployeeSearch::where('id',$value)->first();
    	if (isset($package->title)) {
    		$title = $package->title;
    	}
    	return $title;
    }
   
    
    
}
