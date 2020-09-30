<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketerPasswordReset extends Model
{
    protected $table = 'marketer_password_resets';  

    
   
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    public $timestamps = false;
}
