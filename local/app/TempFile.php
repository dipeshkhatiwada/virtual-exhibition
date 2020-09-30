<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempFile extends Model
{
    protected $table = 'temp_file';  

    protected $fillable = array('session_id', 'title', 'images', 'type', 'others');
    protected $primaryKey = 'id';
   
       
    
}
