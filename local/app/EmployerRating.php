<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerRating extends Model
{
    protected $table = 'employer_rating';
    protected $fillable = ['employers_id', 'employes_id', 'rating', 'question_id'];
}
