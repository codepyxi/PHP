<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $table = "employee";
	protected $primaryKey = "employeeId";
	
	protected $fillable = [
	'employeeName',
	'employeeAddress',
	'employeePhone',
	'employeeEmail',
	'employeeCityId',
	'employeePrivilegeId',
	'username',
	'password',
	];
	
	public $timestamps = false;
	
	public function employeeHasPrivilege(){
        return $this->hasOne('App\Privilege','privilegeId','employeePrivilegeId');

    }
		
		
	public function employeeHasCity(){
        return $this->hasOne('App\City','cityId','employeeCityId');

    }
}
