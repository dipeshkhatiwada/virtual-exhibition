<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployerPackage;

class EmployerPackage extends Model
{
    protected $table = 'employers_packages';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'job_type', 'job_number', 'remaining', 'purchase_date', 'expiry_date', 'duration', 'order_id', 'status','type'
    ];
    
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }

    public static function countPackage()
    {
    	return EmployerPackage::where('employers_id', auth()->guard('employer')->user()->employers_id)->count();
    }


}

