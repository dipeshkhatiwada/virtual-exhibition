<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeMessageAttachment extends Model
{
    protected $table = 'employee_message_attachment';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employee_message_id', 'file_name', 'file_type', 'file_path'
    ];
}
