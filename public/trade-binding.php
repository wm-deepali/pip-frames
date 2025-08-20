<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die(); exit();
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paper_size = $_POST['paper_size'];
    $hardback = false;
    $softback = false;
    if (isset($_POST['back']) && $_POST['back'] != "") {
        if ($_POST['back'] == 40) {
            $hardback = true;
        } else if ($_POST['back'] == 30) {
            $softback = true;
        }
    }

    switch ($paper_size) {
        case 'A5':
            //Code to be executed if n = label1;
            $copies = $_POST['copies'];
            $pages_pp = $_POST['pages'];

            if ($pages_pp == '1-50' || $pages_pp == '1-100') {
                $respons['cal_c'] = copies_pp_set_a($copies, $hardback, $softback);
            } elseif ($pages_pp == '51-200') {
                $respons['cal_c'] = copies_pp_set_b($copies, $hardback, $softback);
            } elseif ($pages_pp == '201-300') {
                $respons['cal_c'] = copies_pp_set_c($copies, $hardback, $softback);
            } elseif ($pages_pp == '301-400' || $pages_pp == '401-500' || $pages_pp == '500+') {
                $respons['cal_c'] = copies_pp_set_d($copies, $hardback, $softback);
            }

            break;
        case 'Royal':
            //Code to be executed if n = label1;
            $copies = $_POST['copies'];
            $pages_pp = $_POST['pages'];

            if ($pages_pp == '1-50' || $pages_pp == '1-100') {
                $respons['cal_c'] = copies_pp_set_aa($copies, $hardback, $softback);
            } elseif ($pages_pp == '51-200') {
                $respons['cal_c'] = copies_pp_set_bb($copies, $hardback, $softback);
            } elseif ($pages_pp == '201-300') {
                $respons['cal_c'] = copies_pp_set_cc($copies, $hardback, $softback);
            } elseif ($pages_pp == '301-400' || $pages_pp == '401-500' || $pages_pp == '500+') {
                $respons['cal_c'] = copies_pp_set_dd($copies, $hardback, $softback);
            }
            break;
        case 'A4':
            //Code to be executed if n = label1;
            $copies = $_POST['copies'];
            $pages_pp = $_POST['pages'];

            if ($pages_pp == '1-50' || $pages_pp == '1-100') {
                $respons['cal_c'] = copies_pp_set_aaa($copies, $hardback, $softback);
            } elseif ($pages_pp == '51-200') {
                $respons['cal_c'] = copies_pp_set_bbb($copies, $hardback, $softback);
            } elseif ($pages_pp == '201-300') {
                $respons['cal_c'] = copies_pp_set_ccc($copies, $hardback, $softback);
            } elseif ($pages_pp == '301-400' || $pages_pp == '401-500' || $pages_pp == '500+') {
                $respons['cal_c'] = copies_pp_set_ddd($copies, $hardback, $softback);
            }
            break;
        default:
        //code to be executed if n is different from all labels;
    }

    $respons['status'] = "success";
    $respons['msg'] = "Calculation Result ";
    echo json_encode($respons);
    exit();
} elseif ($softback == true) {
    $respons['status'] = "error";
    $respons['msg'] = "Calculation Failed!!";
    echo json_encode($respons);
    exit();
}
/* -------------- A5  ---------------- */

function copies_pp_set_a($copies, $hardback, $softback) {
    /* ===================================== */
    //    1-10 copies	0.8
    //    11-107 copies	0.75
    //    108-199 copies	0.72
    //    200-279 copies	0.7
    //    280-354 copies	0.65
    //    355-401 copies	0.6
    //    402-475 copies	0.55
    //    476-735 copies	0.5
    //    736-999 copies	0.45
    //    1000 + 	        0.4
    /* ===================================== */
    if ($hardback == FALSE && $softback == FALSE) {

        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
        if ($copies >= 11 && $copies <= 107) {
            return $srt . '0.75' . $srt1 . $copies * 0.75;
        }
        if ($copies >= 108 && $copies <= 200) {
            return $srt . '0.72' . $srt1 . $copies * 0.72;
        }
        if ($copies >= 200 && $copies <= 279) {
            return $srt . '0.7' . $srt1 . $copies * 0.7;
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 0.65;
            return $srt . '0.65' . $srt1 . $copies * 0.65;
        }
        if ($copies >= 355 && $copies <= 401) {
            // return 0.6;
            return $srt . '0.6' . $srt1 . $copies * 0.6;
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.55;
            return $srt . '0.55' . $srt1 . $copies * 0.55;
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.5;
            return $srt . '0.5' . $srt1 . $copies * 0.5;
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.45;
            return $srt . '0.45' . $srt1 . $copies * 0.45;
        }
        if ($copies >= 1000) {
            //return 0.4;
            return $srt . '0.4' . $srt1 . $copies * 0.4;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            // return 1.15;
            return $srt . '10.00' . $srt1 . (float) ($copies * 10 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            // return 1.1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            // return 1.05;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            //return 1;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            //return 0.95;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            // return 0.9;
            return $srt . '4.5' . $srt1 . ($copies * 4.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            // return 0.85;
            return $srt . '4.00' . $srt1 . ($copies * 4 + 40) . '.00';
        }

        if ($copies >= 500) {
            //  return 0.75;
            return $srt . '3.75' . $srt1 . ($copies * 3.75 + 40);
        }
    } else if ($softback == TRUE) {

        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            return $srt . '0.75' . $srt1 . ($copies * 0.75 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            return $srt . '0.72' . $srt1 . ($copies * 0.72 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            return $srt . '0.7' . $srt1 . ($copies * 0.7 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 0.65;
            return $srt . '0.65' . $srt1 . ($copies * 0.65 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            // return 0.6;
            return $srt . '0.6' . $srt1 . ($copies * 0.6 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.55;
            return $srt . '0.55' . $srt1 . ($copies * 0.55 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.5;
            return $srt . '0.5' . $srt1 . ($copies * 0.5 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.45;
            return $srt . '0.45' . $srt1 . ($copies * 0.45 + 30);
        }
        if ($copies >= 1000) {
            //return 0.4;
            return $srt . '0.4' . $srt1 . ($copies * 0.4 + 30);
        }
    }
}

function copies_pp_set_b($copies, $hardback, $softback) {
    //    1-10 copies	      0.9
    //    11-107 copies	       0.85
    //    108-199 copies	0.82
    //    200-279 copies	0.8
    //    280-354 copies	0.75
    //    355-401 copies	0.7
    //    402-475 copies	0.65
    //    476-735 copies	0.6
    //    736-999 copies	0.55
    //    1000 + 	        0.5
    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 11 && $copies <= 107) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 0.82;
            return $srt . '0.82' . $srt1 . $copies * 0.82;
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 0.75;
            return $srt . '0.75' . $srt1 . $copies * 0.75;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.7;
            return $srt . '0.7' . $srt1 . $copies * 0.7;
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.65;
            return $srt . '0.65' . $srt1 . $copies * 0.65;
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.6;
            return $srt . '0.6' . $srt1 . $copies * 0.6;
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.55;
            return $srt . '0.55' . $srt1 . $copies * 0.55;
        }
        if ($copies >= 1000) {
            //return 0.5;
            return $srt . '0.5' . $srt1 . $copies * 0.5;
        }
    } elseif ($hardback == TRUE) {

        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            // return 1.15;
            return $srt . '10' . $srt1 . ($copies * 10 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            // return 1.1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            // return 1.05;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            //return 1;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            //return 0.95;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            // return 0.9;
            return $srt . '4.5' . $srt1 . ($copies * 4.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            // return 0.85;
            return $srt . '4.00' . $srt1 . ($copies * 4 + 40) . '.00';
        }
        if ($copies >= 500) {
            //  return 0.75;
            return $srt . '3.75' . $srt1 . ($copies * 3.75 + 40);
        }
    } else if ($softback == TRUE) {

        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 0.82;
            return $srt . '0.82' . $srt1 . ($copies * 0.82 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 0.75;
            return $srt . '0.75' . $srt1 . ($copies * 0.75 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.7;
            return $srt . '0.7' . $srt1 . ($copies * 0.7 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.65;
            return $srt . '0.65' . $srt1 . ($copies * 0.65 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.6;
            return $srt . '0.6' . $srt1 . ($copies * 0.6 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.55;
            return $srt . '0.55' . $srt1 . ($copies * 0.55 + 30);
        }
        if ($copies >= 1000) {
            //return 0.5;
            return $srt . '0.5' . $srt1 . ($copies * 0.5 + 30);
        }
    }
}

function copies_pp_set_c($copies, $hardback, $softback) {

    // 1-10 copies	1
    //11-107 copies	0.95
    //108-199 copies	0.92
    //200-279 copies	0.9
    //280-354 copies	0.85
    //355-401 copies	0.8
    //402-475 copies	0.75
    //476-735 copies	0.7
    //736-999 copies	0.65
    //1000 + 	0.6
    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 1;
            return $srt . '1' . $srt1 . $copies * 1;
        }
        if ($copies >= 11 && $copies <= 107) {
            return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 108 && $copies <= 199) {
            return 0.92;
            return $srt . '0.92' . $srt1 . $copies * 0.92;
        }
        if ($copies >= 200 && $copies <= 279) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.75;
            return $srt . '0.75' . $srt1 . $copies * 0.75;
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.7;
            return $srt . '0.7' . $srt1 . $copies * 0.7;
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.65;
            return $srt . '0.65' . $srt1 . $copies * 0.65;
        }
        if ($copies >= 1000) {
            // return 0.6;
            return $srt . '0.6' . $srt1 . $copies * 0.6;
        }
    } elseif ($hardback == true) {

        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            // return 1.15;
            return $srt . '10.00' . $srt1 . ($copies * 10 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            // return 1.1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            // return 1.05;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            //return 1;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            //return 0.95;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            // return 0.9;
            return $srt . '4.5' . $srt1 . ($copies * 4.5 + 40) . '.00';
        }
        if ($copies >= 51 && $copies <= 100) {
            // return 0.85;
            return $srt . '4.00' . $srt1 . ($copies * 4 + 40) . '.00';
        }

        if ($copies >= 500) {
            //  return 0.75;
            return $srt . '3.75' . $srt1 . ($copies * 3.75 + 40);
        }
    } elseif ($softback == true) {

        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 1;
            return $srt . '1' . $srt1 . ($copies * 1 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            return 0.92;
            return $srt . '0.92' . $srt1 . ($copies * 0.92 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.75;
            return $srt . '0.75' . $srt1 . ($copies * 0.75 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.7;
            return $srt . '0.7' . $srt1 . ($copies * 0.7 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.65;
            return $srt . '0.65' . $srt1 . ($copies * 0.65 + 30);
        }
        if ($copies >= 1000) {
            // return 0.6;
            return $srt . '0.6' . $srt1 . ($copies * 0.6 + 30);
        }
    }
}

function copies_pp_set_d($copies, $hardback, $softback) {


    //    1-10 copies	1.05
    //    11-107 copies	1
    //    108-199 copies	0.97
    //    200-279 copies	0.95
    //    280-354 copies	0.9
    //    355-401 copies	0.85
    //    402-475 copies	0.8
    //    476-735 copies	0.75
    //    736-999 copies	0.7
    //    1000 + 	0.65



    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 11 && $copies <= 107) {
            //return 1;
            return $srt . '1' . $srt1 . $copies * 1;
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 1.02;
            return $srt . '1.02' . $srt1 . $copies * 1.02;
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.75;
            return $srt . '0.75' . $srt1 . $copies * 0.75;
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.7;
            return $srt . '0.7' . $srt1 . $copies * 0.7;
        }
        if ($copies >= 1000) {
            //return 0.65;
            return $srt . '0.65' . $srt1 . $copies * 0.65;
        }
    } elseif ($hardback == TRUE) {

        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            // return 1.15;
            return $srt . '10.00' . $srt1 . ($copies * 10 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            // return 1.1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            // return 1.05;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            //return 1;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            //return 0.95;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            // return 0.9;
            return $srt . '4.5' . $srt1 . ($copies * 4.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            // return 0.85;
            return $srt . '4.00' . $srt1 . ($copies * 4 + 40) . '.00';
        }

        if ($copies >= 500) {
            //  return 0.75;
            return $srt . '3.75' . $srt1 . ($copies * 3.75 + 40);
        }
//         
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            //return 1;
            return $srt . '1' . $srt1 . ($copies * 1 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 1.02;
            return $srt . '1.02' . $srt1 . ($copies * 1.02 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.75;
            return $srt . '0.75' . $srt1 . ($copies * 0.75 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.7;
            return $srt . '0.7' . $srt1 . ($copies * 0.7 + 30);
        }
        if ($copies >= 1000) {
            //return 0.65;
            return $srt . '0.65' . $srt1 . ($copies * 0.65 + 30);
        }
    }
}

/* -------------- A5  ---------------- */
/* -------------- Royal  ---------------- */

function copies_pp_set_aa($copies, $hardback, $softback) {

    /* ===================================== */
    //  1-10 copies	1.1
    //11-107 copies	1.05
    //108-199 copies	1.02
    //200-279 copies	1
    //280-354 copies	0.95
    //355-401 copies	0.9
    //402-475 copies	0.85
    //476-735 copies	0.8
    //736-999 copies	0.75
    //1000 + 	0.7

    /* ===================================== */
    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";

        if ($copies >= 1 && $copies <= 10) {
            //return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 11 && $copies <= 107) {
            //return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 1.02;
            return $srt . '1.02' . $srt1 . $copies * 1.02;
        }
        if ($copies >= 200 && $copies <= 279) {
            //return 1;
            return $srt . '1' . $srt1 . $copies * 1;
        }
        if ($copies >= 280 && $copies <= 354) {
            return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 355 && $copies <= 401) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.75;
            return $srt . '0.75' . $srt1 . $copies * 0.75;
        }
        if ($copies >= 1000) {
            // return 0.7;
            return $srt . '0.7' . $srt1 . $copies * 0.7;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            //return 1.1;
            return $srt . '12.00' . $srt1 . ($copies * 12 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            //return 1.05;
            return $srt . '8.00' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            //return 1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            return 0.95;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.9;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.85;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.8;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }

        if ($copies >= 500) {
            // return 0.7;
            return $srt . '4' . $srt1 . ($copies * 4 + 40) . '.00';
        }
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            //return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 1.02;
            return $srt . '1.02' . $srt1 . ($copies * 1.02 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            //return 1;
            return $srt . '1' . $srt1 . ($copies * 1 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.75;
            return $srt . '0.75' . $srt1 . ($copies * 0.75 + 30);
        }
        if ($copies >= 1000) {
            // return 0.7;
            return $srt . '0.7' . $srt1 . ($copies * 0.7 + 30);
        }
    }
}

function copies_pp_set_bb($copies, $hardback, $softback) {

    //    1-10 copies	1.15
    //    11-107 copies	1.1
    //    108-199 copies	1.07
    //    200-279 copies	1.05
    //    280-354 copies	1
    //    355-401 copies	0.95
    //    402-475 copies	0.9
    //    476-735 copies	0.85
    //    736-999 copies	0.8
    //    1000 + 	0.75
    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.15;
            return $srt . '1.15' . $srt1 . $copies * 1.15;
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 108 && $copies <= 199) {
            // return 1.07;
            return $srt . '1.07' . $srt1 . $copies * 1.07;
        }
        if ($copies >= 200 && $copies <= 279) {
            return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 1;
            return $srt . '1.0' . $srt1 . $copies * 1.0;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.55;
            return $srt . '0.55' . $srt1 . $copies * 0.55;
        }
        if ($copies >= 1000) {
            //return 0.5;
            return $srt . '0.5' . $srt1 . $copies * 0.5;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            //return 1.1;
            return $srt . '12.00' . $srt1 . ($copies * 12 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            //return 1.05;
            return $srt . '8.00' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            //return 1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            return 0.95;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.9;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.85;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.8;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }

        if ($copies >= 500) {
            // return 0.7;
            return $srt . '4.00' . $srt1 . ($copies * 4 + 40) . '.00';
        }
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.15;
            return $srt . '1.15' . $srt1 . ($copies * 1.15 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            // return 1.07;
            return $srt . '1.07' . $srt1 . ($copies * 1.07 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 1;
            return $srt . '1.0' . $srt1 . ($copies * 1.0 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.55;
            return $srt . '0.55' . $srt1 . ($copies * 0.55 + 30);
        }
        if ($copies >= 1000) {
            //return 0.5;
            return $srt . '0.5' . $srt1 . ($copies * 0.5 + 30);
        }
    }
}

function copies_pp_set_cc($copies, $hardback, $softback) {

    //  1-10 copies	1.2
    //  11-107 copies	1.15
    //  108-199 copies	1.12
    //  200-279 copies	1.1
    //  280-354 copies	1.05
    //  355-401 copies	1
    //  402-475 copies	0.95
    //  476-735 copies	0.9
    //  736-999 copies	0.85
    //  1000 + 	0.8

    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.2;
            return $srt . '1.2' . $srt1 . $copies * 1.2;
        }
        if ($copies >= 11 && $copies <= 107) {
            ///  return 1.15;
            return $srt . '1.15' . $srt1 . $copies * 1.15;
        }
        if ($copies >= 108 && $copies <= 199) {
            ///  return 1.12;
            return $srt . '1.12' . $srt1 . $copies * 1.12;
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 1;
            return $srt . '1.0' . $srt1 . $copies * 1.0;
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 1000) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
    } elseif ($hardback == TRUE) {

        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            //return 1.1;
            return $srt . '12.00' . $srt1 . ($copies * 12 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            //return 1.05;
            return $srt . '8.00' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            //return 1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            return 0.95;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.9;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.85;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.8;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }

        if ($copies >= 500) {
            // return 0.7;
            return $srt . '4.00' . $srt1 . ($copies * 4 + 40) . '.00';
        }
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.2;
            return $srt . '1.2' . $srt1 . ($copies * 1.2 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            ///  return 1.15;
            return $srt . '1.15' . $srt1 . ($copies * 1.15 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            ///  return 1.12;
            return $srt . '1.12' . $srt1 . ($copies * 1.12 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 1;
            return $srt . '1.0' . $srt1 . ($copies * 1.0 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 1000) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
    }
}

function copies_pp_set_dd($copies, $hardback, $softback) {

    //   1-10 copies	1.15
    //   11-107 copies	1.1
    //   108-199 copies	1.07
    //   200-279 copies	1.05
    //   280-354 copies	1
    //   355-401 copies	0.95
    //   402-475 copies	0.9
    //   476-735 copies	0.85
    //   736-999 copies	0.8
    //   1000 + 	0.75
    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 1.15;
            return $srt . '1.15' . $srt1 . $copies * 1.15;
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 108 && $copies <= 199) {
            // return 1.07;
            return $srt . '1.07' . $srt1 . $copies * 1.07;
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1;
            return $srt . '1.0' . $srt1 . $copies * 1.0;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 402 && $copies <= 475) {
            ///  return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
        if ($copies >= 1000) {
            //  return 0.75;
            return $srt . '0.75' . $srt1 . $copies * 0.75;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            //return 1.1;
            return $srt . '12.00' . $srt1 . ($copies * 12 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            //return 1.05;
            return $srt . '8.00' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            //return 1;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            return 0.95;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.9;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.85;
            return $srt . '5.5' . $srt1 . ($copies * 5.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.8;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }

        if ($copies >= 500) {
            // return 0.7;
            return $srt . '4.00' . $srt1 . ($copies * 4 + 40) . '.00';
        }
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 1.15;
            return $srt . '1.15' . $srt1 . ($copies * 1.15 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            // return 1.07;
            return $srt . '1.07' . $srt1 . ($copies * 1.07 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1;
            return $srt . '1.0' . $srt1 . ($copies * 1.0 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            ///  return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
        if ($copies >= 1000) {
            //  return 0.75;
            return $srt . '0.75' . $srt1 . ($copies * 0.75 + 30);
        }
    }
}

/* -------------- Royal  ---------------- */
/* -------------- A4  ---------------- */

function copies_pp_set_aaa($copies, $hardback, $softback) {
    /* ===================================== */
    //    1-10 copies	1.15
    //11-107 copies	1.1
    //108-199 copies	1.07
    //200-279 copies	1.05
    //280-354 copies	1
    //355-401 copies	0.95
    //402-475 copies	0.9
    //476-735 copies	0.85
    //736-999 copies	0.8
    //1000 + 	0.75
    /* ===================================== */
    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.15;
            return $srt . '1.15' . $srt1 . $copies * 1.15;
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 108 && $copies <= 199) {
            // return 1.07;
            return $srt . '1.07' . $srt1 . $copies * 1.07;
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1;
            return $srt . '1.0' . $srt1 . $copies * 1.0;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
        if ($copies >= 1000) {
            //  return 0.75;
            return $srt . '0.75' . $srt1 . $copies * 0.75;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            return $srt . '15.00' . $srt1 . ($copies * 15 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            return $srt . '9.00' . $srt1 . ($copies * 9 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            return $srt . '8.00' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            // return 0.65;
            return $srt . '7.5' . $srt1 . ($copies * 7.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.6;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.55;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.5;
            return $srt . '6,00' . $srt1 . ($copies * 6 + 40) . '.00';
        }
        if ($copies >= 500) {
            //return 0.4;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }
//            
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.15;
            return $srt . '1.15' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            // return 1.07;
            return $srt . '1.07' . $srt1 . ($copies * 1.07 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1;
            return $srt . '1.0' . $srt1 . ($copies * 1.0 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
        if ($copies >= 1000) {
            //  return 0.75;
            return $srt . '0.75' . $srt1 . ($copies * 0.75 + 30);
        }
    }
}

function copies_pp_set_bbb($copies, $hardback, $softback) {

    //1-10 copies	1.2
    //11-107 copies	1.15
    //108-199 copies	1.12
    //200-279 copies	1.1
    //280-354 copies	1.05
    //355-401 copies	1
    //402-475 copies	0.95
    //476-735 copies	0.9
    //736-999 copies	0.85
    //1000 + 	0.8
    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 1.2;
            return $srt . '1.2' . $srt1 . $copies * 1.2;
        }
        if ($copies >= 11 && $copies <= 107) {
            //  return 1.15;
            return $srt . '1.15' . $srt1 . $copies * 1.15;
        }
        if ($copies >= 108 && $copies <= 199) {
            //  return 1.12;
            return $srt . '1.12' . $srt1 . $copies * 1.12;
        }
        if ($copies >= 200 && $copies <= 279) {
            //  return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 1;
            return $srt . '1.0' . $srt1 . $copies * 1.0;
        }
        if ($copies >= 402 && $copies <= 475) {
            //  return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
        if ($copies >= 1000) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . $copies * 0.8;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            return $srt . '15.00' . $srt1 . ($copies * 15 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            return $srt . '9.00' . $srt1 . ($copies * 9 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            return $srt . '8.00' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            // return 0.65;
            return $srt . '7.5' . $srt1 . ($copies * 7.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.6;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.55;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.5;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }

        if ($copies >= 500) {
            //return 0.4;
            return $srt . '5' . $srt1 . ($copies * 5 + 40) . '.00';
        }
//          
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //return 1.2;
            return $srt . '1.2' . $srt1 . ($copies * 1.2 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            //  return 1.15;
            return $srt . '1.15' . $srt1 . ($copies * 1.15 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            //  return 1.12;
            return $srt . '1.12' . $srt1 . ($copies * 1.12 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            //  return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            // return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 1;
            return $srt . '1.0' . $srt1 . ($copies * 1.0 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            //  return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
        if ($copies >= 1000) {
            // return 0.8;
            return $srt . '0.8' . $srt1 . ($copies * 0.8 + 30);
        }
    }
}

function copies_pp_set_ccc($copies, $hardback, $softback) {

//    1-10 copies	1.25
//    11-107 copies	1.2
//    108-199 copies	1.17
//    200-279 copies	1.15
//    280-354 copies	1.1
//    355-401 copies	1.05
//    402-475 copies	1
//    476-735 copies	0.95
//    736-999 copies	0.9
//    1000 + 	0.85

    if ($hardback == FALSE && $softback == FALSE) {
        $srt = "<br> Set up charge : £ 00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.25;
            return $srt . '1.25' . $srt1 . $copies * 1.25;
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.2;
            return $srt . '1.2' . $srt1 . $copies * 1.2;
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 1.17;
            return $srt . '1.17' . $srt1 . $copies * 1.17;
        }
        if ($copies >= 200 && $copies <= 279) {
            //return 1.15;
            return $srt . '1.15' . $srt1 . $copies * 1.15;
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 1;
            return $srt . '1.0' . $srt1 . $copies * 1.0;
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
        if ($copies >= 1000) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . $copies * 0.85;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            return $srt . '15' . $srt1 . ($copies * 15 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            return $srt . '9' . $srt1 . ($copies * 9 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            return $srt . '8' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            // return 0.65;
            return $srt . '7.5' . $srt1 . ($copies * 7.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.6;
            return $srt . '7' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.55;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.5;
            return $srt . '6' . $srt1 . ($copies * 6 + 40) . '.00';
        }

        if ($copies >= 500) {
            //return 0.4;
            return $srt . '5' . $srt1 . ($copies * 5 + 40) . '.00';
        }
//          
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            // return 1.25;
            return $srt . '1.25' . $srt1 . ($copies * 1.25 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            // return 1.2;
            return $srt . '1.2' . $srt1 . ($copies * 1.2 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            //return 1.17;
            return $srt . '1.17' . $srt1 . ($copies * 1.17 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            //return 1.15;
            return $srt . '1.15' . $srt1 . ($copies * 1.15 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            //return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 1;
            return $srt . '1.0' . $srt1 . ($copies * 1.0 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
        if ($copies >= 1000) {
            //return 0.85;
            return $srt . '0.85' . $srt1 . ($copies * 0.85 + 30);
        }
    }
}

function copies_pp_set_ddd($copies, $hardback, $softback) {

    //1-10 copies	1.3
    //11-107 copies	1.25
    //108-199 copies	1.22
    //200-279 copies	1.2
    //280-354 copies	1.15
    //355-401 copies	1.1
    //402-475 copies	1.05
    //476-735 copies	1
    //736-999 copies	0.95
    //1000 + 	0.9

    if ($hardback == FALSE && $softback == FALSE) {
        if ($copies >= 1 && $copies <= 10) {
            //  return 1.3;
            return $srt . '1.3' . $srt1 . $copies * 1.3;
        }
        if ($copies >= 11 && $copies <= 107) {
            //  return 1.25;
            return $srt . '1.25' . $srt1 . $copies * 1.25;
        }
        if ($copies >= 108 && $copies <= 199) {
            //  return 1.22;
            return $srt . '1.22' . $srt1 . $copies * 1.22;
        }
        if ($copies >= 200 && $copies <= 279) {
            //  return 1.2;
            return $srt . '1.2' . $srt1 . $copies * 1.2;
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1.15;
            return $srt . '1.15' . $srt1 . $copies * 1.15;
        }
        if ($copies >= 355 && $copies <= 401) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . $copies * 1.1;
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 1.05;
            return $srt . '1.05' . $srt1 . $copies * 1.05;
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 1;
            return $srt . '1.0' . $srt1 . $copies * 1.0;
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . $copies * 0.95;
        }
        if ($copies >= 1000) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . $copies * 0.9;
        }
    } elseif ($hardback == TRUE) {
        $srt = "<br> Set up charge : £ 40.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies == 1) {
            return $srt . '15.00' . $srt1 . ($copies * 15 + 40) . '.00';
        }
        if ($copies >= 2 && $copies <= 5) {
            return $srt . '9.00' . $srt1 . ($copies * 9 + 40) . '.00';
        }
        if ($copies >= 6 && $copies <= 10) {
            return $srt . '8.00' . $srt1 . ($copies * 8 + 40) . '.00';
        }
        if ($copies >= 11 && $copies <= 20) {
            // return 0.65;
            return $srt . '7.5' . $srt1 . ($copies * 7.5 + 40);
        }
        if ($copies >= 21 && $copies <= 30) {
            // return 0.6;
            return $srt . '7.00' . $srt1 . ($copies * 7 + 40) . '.00';
        }
        if ($copies >= 31 && $copies <= 50) {
            //return 0.55;
            return $srt . '6.5' . $srt1 . ($copies * 6.5 + 40);
        }
        if ($copies >= 51 && $copies <= 100) {
            //return 0.5;
            return $srt . '6.00' . $srt1 . ($copies * 6 + 40) . '.00';
        }

        if ($copies >= 500) {
            //return 0.4;
            return $srt . '5.00' . $srt1 . ($copies * 5 + 40) . '.00';
        }
//            
    } elseif ($softback == true) {
        $srt = "<br> Set up charge : £ 30.00<br>Cost Per Book : £ ";
        $srt1 = " <br> Total Cost : £ ";
        if ($copies >= 1 && $copies <= 10) {
            //  return 1.3;
            return $srt . '1.3' . $srt1 . ($copies * 1.3 + 30);
        }
        if ($copies >= 11 && $copies <= 107) {
            //  return 1.25;
            return $srt . '1.25' . $srt1 . ($copies * 1.25 + 30);
        }
        if ($copies >= 108 && $copies <= 199) {
            //  return 1.22;
            return $srt . '1.22' . $srt1 . ($copies * 1.22 + 30);
        }
        if ($copies >= 200 && $copies <= 279) {
            //  return 1.2;
            return $srt . '1.2' . $srt1 . ($copies * 1.2 + 30);
        }
        if ($copies >= 280 && $copies <= 354) {
            //return 1.15;
            return $srt . '1.15' . $srt1 . ($copies * 1.15 + 30);
        }
        if ($copies >= 355 && $copies <= 401) {
            // return 1.1;
            return $srt . '1.1' . $srt1 . ($copies * 1.1 + 30);
        }
        if ($copies >= 402 && $copies <= 475) {
            //return 1.05;
            return $srt . '1.05' . $srt1 . ($copies * 1.05 + 30);
        }
        if ($copies >= 476 && $copies <= 735) {
            // return 1;
            return $srt . '1.0' . $srt1 . ($copies * 1.0 + 30);
        }
        if ($copies >= 736 && $copies <= 999) {
            // return 0.95;
            return $srt . '0.95' . $srt1 . ($copies * 0.95 + 30);
        }
        if ($copies >= 1000) {
            // return 0.9;
            return $srt . '0.9' . $srt1 . ($copies * 0.9 + 30);
        }
    }
}

/* -------------- A4  ---------------- */
    