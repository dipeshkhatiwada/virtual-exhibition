<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    protected $table = 'trash';  

    protected $fillable = array('table_name', 'table_id', 'table_title');
    protected $primaryKey = 'id';
}
