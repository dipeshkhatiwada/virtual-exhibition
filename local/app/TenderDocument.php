<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenderDocument extends Model
{
    protected $table = 'tender_document';  

    protected $fillable = array('tender_id', 'title', 'document');

    public function tender()
    {
    	return $this->belongsTo('\App\Tender');
    }

    public $timestamps = false;
}
