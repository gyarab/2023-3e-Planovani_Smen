<?php
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];
$y = date('Y-m-d', strtotime("-1 days"));
$text = $_POST['text'];
$currentTime = date('H:i:s');
$td = date('Y-m-d');
/*$currentDate = date('Y-m-d',strtotime("-1 days"));
$currentTime = date('H:i:s',strtotime("-1 days"));*/
$end[] = array();
$start[] = array();
$t1[] = array();
$t2[] = array();
$status[] = array();
$b = false;
global $pos;
//$status[0] = 1;
//$status[1] = 0;
if (strlen($text) > 2) {
    $status[1] = 0;
} else {
    $status[1] = 1;
    $text = "";
}

$have = 0;
$checkfrom = 0;
$sqly = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
$fetchy = mysqli_query($conn, $sqly);
$sqltd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
$fetchtd = mysqli_query($conn, $sqltd);
if (mysqli_num_rows($fetchy) > 0) {
    while ($row_y = mysqli_fetch_assoc($fetchy)) {
        $id_plan = $row_y['id'];
        $st = $row_y['saved_from'];
        $en = $row_y['saved_to'];
    }
    if (strtotime($st) >= strtotime($en)){
        if(strtotime(date('H:i:s'))<strtotime($st)){

            //$have = 1;
            $checkfrom = 1;
            /*if (strtotime($en) < strtotime($currentTime)) {
                $status[0] = 0;
                $sqlupdate = "UPDATE attendance SET log_to='$currentTime' AND com_to='$text' WHERE planned_id=$id ";
    
                if (!mysqli_query($conn, $sqlupdate)) {
                    $status[0] = 5;
                }
                echo json_encode($status);
            } else {
                $status[0] = 1;
                echo json_encode($status);
            }*/

            if (strtotime($en) < strtotime($currentTime)) {
                $status[0] = 1;
                if ($status[1] == 0) {
                    $status[0] = 0;
                    //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
                    $sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                    //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_to='$close' AND att_from IS NOT NULL ";
                    if (!mysqli_query($conn, $sqlupdate)) {
                        $status[0] = 5;
                    }
        
                }
                echo json_encode($status);

                //echo json_encode($status);
            } else if (strtotime($en) > strtotime($currentTime) && strtotime($en) - 600 > strtotime($currentTime)) {
                $status[0] = 2;
                if ($status[1] == 0) {
                    $status[0] = 0;
                    $sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                    //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NOT NULL AND saved_to='$close'  ";
                    if (!mysqli_query($conn, $sqlupdate)) {
                        $status[0] = 5;
                    }
        
                }
                echo json_encode($status);

                //echo json_encode($status);
            } else {
                $status[0] = 0;
                $sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NOT NULL AND saved_to='$close' ";
                //echo json_encode($status);
                if (!mysqli_query($conn, $sqlupdate)) {
                    $status[0] = 5;
                }
                echo json_encode($status);
    
            }





        }
       }


}
if($checkfrom == 0){
    //echo json_encode($checkfrom+);
    if (mysqli_num_rows($fetchtd) > 0) {
        //sssssssssssssssssssssssssssssssssssssssssssssssssssecho json_encode($checkfrom."-");
        while ($row_td = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td = $row_td['id'];
            $st_td = $row_td['saved_from'];
            $en_td = $row_td['saved_to'];
            //echo json_encode($checkfrom."-");
        }
        if (strtotime($en_td) < strtotime($currentTime)) {
            $status[0] = 1;
            if ($status[1] == 0) {
                $status[0] = 0;
                //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
                $sqlupdate_td = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE planned_id=$id_plan_td  ";
                //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_to='$close' AND att_from IS NOT NULL ";
                if (!mysqli_query($conn, $sqlupdate_td)) {
                    $status[0] = 5;
                }
    
            }
            echo json_encode($status);

            //echo json_encode($status);
        } else if (strtotime($en_td) > strtotime($currentTime) && strtotime($en_td) - 600 > strtotime($currentTime)) {
            $status[0] = 2;
            if ($status[1] == 0) {
                $status[0] = 0;
                $sqlupdate_td  = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE planned_id=$id_plan_td  ";
                //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NOT NULL AND saved_to='$close'  ";
                if (!mysqli_query($conn, $sqlupdate_td)) {
                    $status[0] = 5;
                }
    
            }
            echo json_encode($status);

            //echo json_encode($status);
        } else {
            $status[0] = 0;
            $sqlupdate_td = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE planned_id=$id_plan_td  ";
            //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NOT NULL AND saved_to='$close' ";
            //echo json_encode($status);
            if (!mysqli_query($conn, $sqlupdate_td)) {
                $status[0] = 5;
            }
            echo json_encode($status);

        }
    }

}
/*if($checkfrom = 0){

}*/

/*else if (mysqli_num_rows($fetchy) > 1) {
}*/


//$status[2] =date('Y-m-d',strtotime("-1 days"));
/***$sql_check = "SELECT * FROM saved_shift_data WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NOT NULL  AND att_to IS NULL ";
$fetch_check = mysqli_query($conn, $sql_check);
if (mysqli_num_rows($fetch_check) == 0) {
    /*$currentDate = date('Y-m-d',strtotime("-1 days"));
    $currentTime = date('H:i:s',strtotime("-1 days"));*/
/***     $currentTime = date('H:i:s');
    $currentDate = date('Y-m-d');
}else{
    $r = 0;
    while ($row = mysqli_fetch_assoc($fetch_check)) {
        $t1[$r] = $row['saved_from'];
        $t2[$r] = $row['saved_to'];
        if (strtotime($t1[$r]) >= strtotime(date('H:i:s'))) {
            $b =true;
            $status[2] = true;
        }

        $r++;
    }
}

$sql = "SELECT * FROM saved_shift_data WHERE saved_date='$currentDate' AND id_user='$id' ORDER BY saved_to";
$fetch = mysqli_query($conn, $sql);
if (mysqli_num_rows($fetch) > 0) {
    if (mysqli_num_rows($fetch) > 1) {
        $j = 0;
        while ($row = mysqli_fetch_assoc($fetch)) {
            $start[$j] = $row['saved_from'];
            $end[$j] = $row['saved_to'];
            //$s =  $start[0];
            //$status[3] = $start[0];
            if (strtotime($end[$j]) <= strtotime($start[$j])) {
                //$status[2] = 1;
                $end[$j] = strtotime($end[$j]) + 86400;
                //$status[2] = date('H:i:s',$middle);
            } else {
                //$status[2] = 0;
                $end[$j] = strtotime($end[$j]);
            }
            //$status[$j+4] = $end[$j];



            $j++;

        }
        //$status[3] =  getClosest($currentTime, $end);
        //$status[7] = $pos;
        //$status[8] = $end[$pos];
        //$close = date('H:i:s',$end[$pos]);
        //$status[2] =$close;
        //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_to='$close' ";
        if (!mysqli_query($conn, $sqlin)) {
            //die('Error: ' . mysqli_error($conn));
        }

    } else {
        $j = 0;
        while ($row = mysqli_fetch_assoc($fetch)) {
            $end[0] = $row['saved_to'];
            $start[0] = $row['saved_from'];
            /*
            if(strtotime($end[$j]) >= strtotime($start[$j])){
                $status[2] = 1;
            }else{
                $status[2] = 0;
            }
            $j++;*/
            //break;
            //$s =  $start[0];
            //break;
 /***            if (strtotime($end[0]) <= strtotime($start[0])) {
                //$status[2] = 1;
                $end[0] = strtotime($end[0]) + 86400;
                $mov = 1;
                //$status[2] = date('H:i:s',$middle);
            } else {
                //$status[2] = 0;
                $end[0] = strtotime($end[0]);
                $mov = 0;
            }
        }
        $close = date('H:i:s', $end[0]);


        if ($end[0] < strtotime($currentTime)) {
            $status[0] = 1;
            if ($status[1] == 0) {
                $status[0] = 0;
                //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
                $sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_to='$close' AND att_from IS NOT NULL ";
            }
            //echo json_encode($status);
        } else if ($end[0] > strtotime($currentTime) && $end[0] - 600 > strtotime($currentTime)) {
            $status[0] = 2;
            if ($status[1] == 0) {
                $status[0] = 0;
                $sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NOT NULL AND saved_to='$close'  ";
            }
            //echo json_encode($status);
        } else {
            $status[0] = 0;
            $sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NOT NULL AND saved_to='$close' ";
            //echo json_encode($status);
        }
        if ($sqlin != "") {
            $fetch1 = mysqli_query($conn, $sqlin);
            if (mysqli_num_rows($fetch) > 0) {
            }
            /*if (!mysqli_query($conn, $sqlin)) {
                //die('Error: ' . mysqli_error($conn));
            }*/
 /***       }
    }

}*/
/**source: https://stackoverflow.com/questions/5464919/find-a-matching-or-closest-value-in-an-array */
function getClosest($search, $arr)
{
    $closest = null;
    global $pos;
    //foreach ($arr as $item) {
    for ($x = 0; $x < count($arr); $x++) {
        if ($closest === null || abs($search - $closest) > abs($arr[$x] - $search)) {
            $closest = $arr[$x];
            $pos = $x;
        }
    }
    //}
    return $closest;
}

/*if (strtotime($end[0]) < strtotime($currentTime)){
    $status[0] = 1;
    if($status[1] == 0){
        $status[0] = 0;
        //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
        $sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_from='$end[0]' AND att_from IS NOT NULL ";
    }
//echo json_encode($status);
}else if(strtotime($end[0]) > strtotime($currentTime)&&strtotime($end[0])-600  > strtotime($currentTime)){
    $status[0] = 2;
    if($status[1] == 0){
        $status[0] = 0;
        $sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NOT NULL AND saved_from='$end[0]'  ";
    }
    //echo json_encode($status);
}else{
    $status[0] = 0;
    $sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NOT NULL AND saved_from='$end[0]' ";
    //echo json_encode($status);
}*/
//echo json_encode($status);
/*if (!mysqli_query($conn, $sqlin)) {
    //die('Error: ' . mysqli_error($conn));
}*/

//echo json_encode($status);
?>