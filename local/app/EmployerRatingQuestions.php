<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerRatingQuestions extends Model
{
    protected $table = 'employer_rating_question';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'title'
    ];
}
