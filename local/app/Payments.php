<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';  

    protected $fillable = array('title', 'setting', 'payment_page', 'status' );
    protected $primaryKey = 'id';
}
