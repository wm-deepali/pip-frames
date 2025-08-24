<?php

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\MasterSetting;
use App\Models\Country;


// Helper to round up to nearest even integer
function roundUpToEven($num) {
    $int = ceil($num);
    return ($int % 2 === 0) ? $int : $int + 1;
}


if (!function_exists('ageInYear')) {
	function ageInYear($dob) 
	{
		return \Carbon\Carbon::parse($dob)->diff(\Carbon\Carbon::now())->format('%y');
		// format('%y years, %m months and %d days');
	}
}

if (!function_exists('dateWithoutTime')) {
	function dateWithoutTime($dob) 
	{
		return \Carbon\Carbon::parse($dob)->format('Y-m-d');
	}
}

if (!function_exists('dateWithMonth')) {
	function dateWithMonth($dob) 
	{
		return \Carbon\Carbon::parse($dob)->format('d-M-Y');
	}
}

if (!function_exists('_replace')) {
	function _replace($value) 
	{
		return str_replace("_"," ", $value);
	}
}

if (!function_exists('ar2str')) {
	function ar2str($value) 
	{
		if(is_array($value)){
			return implode(',', $value);

		}
		return $value;
	}
}

if (!function_exists('str2ar')) {
	function str2ar($value) 
	{
		$arr = [];
		$data = explode(',', $value);
		return array_merge($arr, $data);
	}
}

if (!function_exists('_allMasterSettings')) {
	function _allMasterSettings(){
		return MasterSetting::whereNotIn('id', [3,4,5])->where('is_enable', '1')->get();
	}
	
}

if (!function_exists('_getParentCategoryName')) {
	function _getParentCategoryName($category_id){
		$category = Category::where('id', $category_id)->first('category_name');
		return $category->category_name;
	}
	
}

if (!function_exists('_subCategory')) {
	function _subCategory($category_id){
		$category = Category::where('id', $category_id)->first('category_name');
		return $category->category_name;
	}
	
}

if (!function_exists('menuCategories')) {
	function menuCategories(){
		$categories = Category::with('subcategories')->where('status', 'active')->get();
		
		return $categories;
	}
	
}
if (!function_exists('footerSubCategories')) {
	function footerSubCategories(){
		$subcategories = Subcategory::where('status', 'active')->where('is_premium', 'yes')->get();
		return $subcategories;
	}
	
}
if (!function_exists('countrylist')) {
	function countrylist(){
		$countries = Country::get();
		return $countries;
	}
	
}

?>