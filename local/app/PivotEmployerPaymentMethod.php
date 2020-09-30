<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PivotEmployerPaymentMethod extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pivot_employer_payment_method';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
