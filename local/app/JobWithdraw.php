<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobWithdraw extends Model
{
    protected $table = 'job_withdraw';  

    protected $fillable = array('jobs_id', 'employees_id', 'reason');
}
