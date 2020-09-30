<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerTicket extends Model
{
    protected $table = 'employer_ticket';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'department_id', 'name', 'email', 'subject', 'related_service', 'priority', 'message', 'status','attachments'
    ];

    public function Files()
    {
    	return $this->hasMany('App\EmployerTicketFile');
    }

    public function Replies()
    {
    	return $this->hasMany('App\TicketMessage')->orderBy('id','desc');
    }

    public static function getPriority($value='')
    {
    	$data = '';
    	if ($value == 1) {
    		$data = 'High Priority';
    	}elseif ($value == 2) {
    		$data = 'Medium Priority';
    	}elseif ($value == 3) {
    		$data = 'Low Priority';
    	}
    	return $data;
    }

     public static function getStatus($value='')
    {
        $data = '';
        if ($value == '0') {
            $data = '<span class="btn whitegradient rt5m">Waiting Reply</span>';
        }elseif ($value == 1) {
            $data = '<span class="btn lightgreen_gradient">Replied<span>';
        }elseif ($value == 2) {
            $data = '<span class="btn black_gradient">Closed</span>';
        }
        return $data;
    }
}

