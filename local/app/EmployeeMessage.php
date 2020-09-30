<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeMessage extends Model
{
    protected $table = 'employee_message';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'message_from', 'message_to', 'subject', 'message' , 'status', 'from_delete', 'to_delete'
    ];

    public function employee()
	{
		return $this->belongsTo('\App\Employee','message_to');
    }
    public function employee_from()
	{
		return $this->belongsTo('\App\Employee','message_from');
    }
    public function employee_message_attachment()
	{
		return $this->hasMany('\App\EmployeeMessageAttachment', 'employee_message_id');
    }
    public static function getMyUnseenMessage()
    {
        return EmployeeMessage::where('message_to', auth()->guard('employee')->user()->id)->where('status', 0)->where('to_delete', 0)->count();
    }
    
}
