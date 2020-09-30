<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    protected $table = 'horoscope';  

    protected $fillable = array('date', 'rashi1', 'rashi2', 'rashi3', 'rashi4', 'rashi5', 'rashi6', 'rashi7', 'rashi8', 'rashi9', 'rashi10', 'rashi11', 'rashi12', 'zodiac1', 'zodiac2', 'zodiac3', 'zodiac4', 'zodiac5', 'zodiac6', 'zodiac7', 'zodiac8', 'zodiac9', 'zodiac10', 'zodiac11', 'zodiac12');
    protected $primaryKey = 'id';
    
}
