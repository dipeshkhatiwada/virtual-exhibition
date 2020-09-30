<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table = 'diary';  

    protected $fillable = array('title', 'description', 'staff_id', 'date');
    protected $primaryKey = 'id';
}
