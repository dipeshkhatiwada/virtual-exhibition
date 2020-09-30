<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMilestones extends Model
{
    protected $table = 'project_milestone';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'project_apply_id', 'amount', 'description'
    ];
    
    public function ProjectApply()
    {
    	return $this->belongsTo('App\ProjectApply');
    }
}
