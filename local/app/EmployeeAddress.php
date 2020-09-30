<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmployeeAddress extends Model
{
     protected $table = 'employee_address';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'permanent', 'temporary', 'home_phone', 'mobile', 'fax', 'website'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public static function getPermanenet($id='')
    {
        $address = DB::table('employee_address')->where('employees_id', $id)->first();
        if (isset($address->permanent)) {
            return $address->permanent;
        } else {
            return '';
        }
    }
    public static function getPhone($id='')
    {
        $address = DB::table('employee_address')->where('employees_id', $id)->first();
        if (isset($address->mobile)) {
            return $address->mobile;
        } else {
            return '';
        }
    }
    
    public static function getColour($value='')
    {
        $fl = strtolower($value[0]);
        if($fl == 'a'){
          $return = '#e5cccc';
        }
        elseif($fl == 'b'){
          $return = '#99e5e5';
        }
        elseif($fl == 'c'){
          $return = '#cccce5';
        }
        elseif($fl == 'd'){
          $return = '#7fe5e5';
        }
        elseif($fl == 'e'){
          $return = '#e57f19';
        }
        elseif($fl == 'f'){
          $return = '#007f99';
        }
        elseif($fl == 'g'){
          $return = '#cc9999';
        }
        elseif($fl == 'h'){
          $return = '#e50000';
        }
        elseif($fl == 'i'){
          $return = '#004c7f';
        }
        elseif($fl == 'j'){
          $return = '#e54c4c';
        }
        elseif($fl == 'k'){
          $return = '#7fcc19';
        }
        elseif($fl == 'l'){
          $return = '#cce599';
        }
        elseif($fl == 'm'){
          $return = '#99cc99';
        }
        elseif($fl == 'n'){
          $return = '#4c0019';
        }
        elseif($fl == 'o'){
          $return = '#e54c00';
        }
        elseif($fl == 'p'){
          $return = '#4c194c';
        }
        elseif($fl == 'q'){
          $return = '#19cce5';
        }
        elseif($fl == 'r'){
          $return = '#e5cce5';
        }
        elseif($fl == 's'){
          $return = '#4c7f7f';
        }
        elseif($fl == 't'){
          $return = '#cc9966';
        }
        elseif($fl == 'u'){
          $return = '#4c4c66';
        }
        elseif($fl == 'v'){
          $return = '#e5cc00';
        }
        elseif($fl == 'w'){
          $return = '#7f4c19';
        }
        elseif($fl == 'x'){
          $return = '#997f4c';
        }
        elseif($fl == 'y'){
          $return = '#4c0019';
        }
        elseif($fl == 'z'){
          $return = '#667f4c';
        }else{
            $return = '';
        }
        return $return;
    }
}
