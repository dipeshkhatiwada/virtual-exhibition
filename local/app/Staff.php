<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';  

    protected $fillable = array( 'name', 'email', 'phone', 'address', 'designation', 'image');

    protected $primaryKey = 'id';

    
    
}
