<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
     protected $table = 'order_history';  

    protected $fillable = array('order_id', 'order_status', 'notify','comment','document');
    protected $primaryKey = 'id';
	

	
     
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
