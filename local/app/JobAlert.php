<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobAlert extends Model
{
    
    protected $table = 'job_alert';
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'job_ids','project_ids','event_ids','training_ids'
    ];
}
