<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait SpineCal{

	public function spineCalculation(Request $request)
	{
		// dd($request->all());
		$page_count = $request->page_count;
	    $paper_type = $request->paper_type;
	    $book_type = $request->back;
	    
		$per_pp_mm = ($paper_type / 100);
    	$per_pp_mm_f = ($per_pp_mm * $page_count) + $book_type;

		if ($per_pp_mm_f) {
			$respons['cal_c'] = $per_pp_mm_f;
			$respons['status'] = "success";
		    $respons['msg'] = "Calculation Result ";
		    return json_encode($respons);
		    
		}
		$respons['status'] = "error";
	    $respons['msg'] = "Calculation Failed!!";
	    return json_encode($respons);
	    
	    
	}
	
}

?>