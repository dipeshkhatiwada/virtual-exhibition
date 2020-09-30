<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeesGame extends Model
{
    protected $table = 'employees_game';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'game_title', 'high_score', 'total_attempts'
    ];
    
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
