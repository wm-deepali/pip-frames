<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die(); exit();
}

// error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $page_count = $_POST['page_count'];
    $paper_type = $_POST['paper_type'];
    $book_type = $_POST['back'];

    $per_pp_mm = ($paper_type / 100);
    
    $per_pp_mm_f = ($per_pp_mm * $page_count) + $book_type;
  
    $respons['cal_c'] = $per_pp_mm_f;
    $respons['status'] = "success";
    $respons['msg'] = "Calculation Result ";
    echo json_encode($respons);
    exit();
    
} else {
    
    $respons['status'] = "error";
    $respons['msg'] = "Calculation Failed!!";
    echo json_encode($respons);
    exit();
}
?>
