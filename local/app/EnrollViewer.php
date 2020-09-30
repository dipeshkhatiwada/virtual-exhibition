<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollViewer extends Model
{
    protected $table = 'enroll_viewers';
    protected $fillable = ['reservation_id', 'employee_id', 'count'];

}
