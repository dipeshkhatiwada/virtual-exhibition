<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventApply extends Model
{
     protected $table = 'event_apply';  

    protected $fillable = array('event_id', 'employees_id', 'apply_date');
    


    public function Event()
    {
    	return $this->belongsTo('App\Event');
    }

   public function Employees()
    {
    	return $this->belongsTo('App\Employees');
    }
}
