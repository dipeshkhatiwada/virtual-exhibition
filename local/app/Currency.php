<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Currency extends Model
{
    protected $table = 'currency';  

    protected $fillable = array('title', 'symbol');
    protected $primaryKey = 'id';

    public static function getSymbol($id)
    {
    	$cur = DB::table('currency')->where('id', $id)->first();
    	if (isset($cur->symbol)) {
    		$symbol = $cur->symbol;
    	} else{
    		$symbol = '';
    	}
    	return $symbol;
    }
}
