<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait CSC{

	public function getCountryList()
	{
		return \DB::table('countries')->select('id', 'name')->get();
	}

	public function getStateList(Request $request)
	{
		$states = \DB::table("states")
						->where("country_id",$request->country_id)
						->select("name","id")->get();
		return response()->json($states);
	}

	public function getCityList(Request $request)
	{
		$cities = \DB::table("cities")
						->where("state_id",$request->state_id)
						->select("name","id")->get();
		return response()->json($cities);
	}
}


?>