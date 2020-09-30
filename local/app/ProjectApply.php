<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProjectApply extends Model
{
    protected $table = 'project_apply';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'project_id', 'duration', 'amount', 'description', 'status', 'complete_status'
    ];
    
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public function Project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function ProjectMilestone()
    {
        return $this->hasMany('App\ProjectMilestones');
    }

    public static function getAverage($id='')
    {
        return DB::table('project_apply')->where('project_id', $id)->avg('amount');
    }

    public static function totalBidder($id='')
    {
        return DB::table('project_apply')->where('project_id', $id)->count();
    }

    public static function completionPercent($id='')
    {
        $totalget = DB::table('project_apply')->where('employees_id', $id)->where('status', 1)->count();
        $totalcomplete = DB::table('project_apply')->where('employees_id', $id)->where('status', 1)->where('complete_status', 1)->count();
        if ($totalcomplete == 0) {
            return '0.00';
        } 
        else{
        return number_format((($totalcomplete / $totalget) * 100), 2, '.', '');
    }

    }

    public static function getStatus($status='', $complete='')
    {
        if ($complete == 1) {
            return '<span class="label label-success">Completed</span>';
        } else{
            if ($status == 1) {
                return '<span class="label label-info">In Process</span>';
            } elseif($status == 2){
                 return '<span class="label label-danger">Not Selected</span>';
            } else{
                 return '<span class="label label-primary">Waiting Approval</span>';
            }
        }
    }
    
    public static function getApplyStatus($status='', $complete='')
    {
        if ($complete == 1) {
            return 'Completed';
        } else{
            if ($status == 1) {
                return 'In Process';
            } elseif($status == 2){
                 return 'Not Selected';
            } else{
                 return 'Waiting Approval';
            }
        }
    }

   
}
