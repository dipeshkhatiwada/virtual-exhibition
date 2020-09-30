<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrganizationType extends Model
{
    protected $table = 'organization_type';  

    protected $fillable = array('name', 'description', 'parent', 'seo_url');
    protected $primaryKey = 'id';

    public function EmployeeExperience()
    {
        return $this->hasMany('App\EmployeeExperience');
    }

    public function EmployeeOrganization()
    {
        return $this->hasMany('App\EmployeeOrganization');
    }

    public static function getOrgTypeTitle($id)
    {
    	$type = DB::table('organization_type')->where('id', $id)->first();
    	if (isset($type->name)) {
    		$title = $type->name;
    		# code...
    	} else{
    		$title = '';
    	}
    	return $title;
    }

}
