<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $table = "city";
	protected $primaryKey = "cityId";
	
	protected $fillable = [
	'cityName',
	];
	
	public $timestamps = false;
	
	public function citySelect(){
		 $city =City::Select()
		 ->orderBy ('cityName')
		 ->get();
		return $city;
	}
}
