<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TemporaryJobForm extends Model
{
    protected $table = 'temporary_job_form';  

    protected $fillable = array('session_id', 'f_lable', 'f_type', 'list_menu', 'requ', 'parent_id', 'marks', 'extra');

    public $timestamps = false;

    public static function getTitle($id)
    {
      $form = DB::table('temporary_job_form')->where('id', $id)->first();
      if (isset($form->f_lable)) {
        $title = $form->f_lable;
      } else {
        $title = 'Root';
      }

      return $title;
    }


     public static function getTitleEdit($id)
    {
      $form = DB::table('job_form')->where('id', $id)->first();
      if (isset($form->f_lable)) {
        $title = $form->f_lable;
      } else {
        $title = 'Root';
      }

      return $title;
    }

}
