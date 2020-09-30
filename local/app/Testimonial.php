<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonial';  

    protected $fillable = array('name', 'email', 'address', 'description', 'ip_address', 'status', 'image', 'se_url', 'created_at', 'updated_at' );
    
 
    
}
