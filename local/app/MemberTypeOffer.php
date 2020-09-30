<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberTypeOffer extends Model
{
    protected $table = 'member_type_offer';  

    protected $fillable = array('member_type_id', 'title', 'discount_percent','start_date','end_date');
    

    public function MemberType()
    {
    	return $this->belongsTo('App\MemberType');
    }
}
