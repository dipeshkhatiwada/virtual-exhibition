<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenderFormData extends Model
{
	
    protected $table = 'tender_form_data';  

    protected $fillable = array('tender_id', 'tender_form_id', 'employers_id','description','type');
   public $timestamps = false;

    public function tender()
    {
    	return $this->belongsTo('\App\Tender');
    }
    public function tenderForm()
    {
    	return $this->belongsTo('\App\TenderForm');
    }
    public function employers()
    {
    	return $this->belongsTo('\App\Employers');
    }
}
