<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectedCandidates extends Model
{
     protected $table = 'selected_candidates';  

    protected $fillable = array('jobs_id', 'employees_id');
    protected $primaryKey = 'id';

    public function Jobs()
    {
    	return $this->belongsTo('App\Jobs');
    }

    public function Employees()
    {
    	return $this->belongsTo('App\Employees');
    }
}
