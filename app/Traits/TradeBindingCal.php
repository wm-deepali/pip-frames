<?php

namespace App\Traits;

use App\Models\TradeBindingPrice;
use Illuminate\Http\Request;


trait TradeBindingCal{

	public function calculateTradeBinding(Request $request)
	{
		// dd($request->all());
		$copies = $request->copies;
		$paper_type = $request->paper_size;
		$book_type = $request->book_type;
		$pages = explode('-', $request->pages);
		$pageFrom = $pages[0];
		$pageTo = $pages[1];
		// dd($pageFrom, $pageTo);
		$data = TradeBindingPrice::where('paper_type', $paper_type)
				->where('book_type', $book_type)
				->where('paper_size_from', $pageFrom)
				->where('paper_size_to', $pageTo)
				->first();
		if ($data) {
			$respons['cal_c'] = $copies * $data->price;
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