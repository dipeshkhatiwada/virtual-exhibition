<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingApply extends Model
{
     protected $table = 'training_apply';  

    protected $fillable = array('training_id', 'employees_id', 'apply_date');
    


    public function Training()
    {
    	return $this->belongsTo('App\Training');
    }

   public function Employees()
    {
    	return $this->belongsTo('App\Employees');
    }
}
