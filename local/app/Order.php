<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';  

    protected $fillable = array('order_by', 'invoice_no', 'customer_name','email','telephone','comment','amount','order_status','payment_type', 'created_by' );
    protected $primaryKey = 'id';
	
     
    public function orderItem()
    {
    	return $this->hasMany('App\OrderItem');
    }

    public function orderHistory()
    {
    	return $this->hasMany('App\OrderHistory');
    }

    
}
