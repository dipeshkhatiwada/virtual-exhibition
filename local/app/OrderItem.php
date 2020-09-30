<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';  

    protected $fillable = array('order_id', 'product_id', 'product_type','name','type','duration','amount');
    protected $primaryKey = 'id';
	

	
     
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
