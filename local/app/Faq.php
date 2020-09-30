<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';  

    protected $fillable = array('faq_category_id', 'type','question','answer');
    protected $primaryKey = 'id';
}
