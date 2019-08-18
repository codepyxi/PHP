<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
	protected $table = "privilege";
	protected $primaryKey = "privilegeId";
	
	protected $fillable = [
	'privilege',
	];
	
	public $timestamps = false;
	
	public function privilegeSelect(){
		 $privilege =Privilege::Select()
		 ->orderBy ('privilege')
		 ->get();
		return $privilege;
	}
}
