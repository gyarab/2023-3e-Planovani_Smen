<?php
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];
$y = date('Y-m-d', strtotime("-1 days"));
$text = $_POST['text'];
$currentTime = date('H:i:s');
$td = date('Y-m-d');
$start = array();
$status[] = array();
$id_plan_arr = array();
$st_arr = array();
$en_arr = array();
$id_plan_arr_td = array();
$st_arr_td = array();
$en_arr_td = array();
$test = 0;
$comment = 0;
$s;
global $pos;
if (strlen($text) > 2) {
    $status[1] = 0;
} else {
    $status[1] = 1;
}
$have = 0;

$sqly = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$id' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance WHERE log_from IS NULL))";
$fetchy = mysqli_query($conn, $sqly);
$sqltd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$id' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance WHERE log_from IS NULL))";
$fetchtd = mysqli_query($conn, $sqltd);
if (mysqli_num_rows($fetchy) > 0 && mysqli_num_rows($fetchy) == 1) {
    while ($row_y = mysqli_fetch_assoc($fetchy)) {
        $id_plan = $row_y['id'];
        $st = $row_y['saved_from'];
        $en = $row_y['saved_to'];
        //echo json_encode($have);
        if (strtotime($st) >= strtotime($en)) {

            if (strtotime(date('H:i:s')) < strtotime($en)) {
                $have = 1;
            }
        } else {
            $have = 0;
        }
    }

    if ($have == 1) {
        //$sqlinsert = "UPDATE saved_shift_data SET att_from='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_from='$close' AND att_from IS NULL ";
        if ($status[1] == 0) {
            $status[0] = 0;
            $sqlinsert = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan,'$currentTime',$id,'$text',1)";

            if (!mysqli_query($conn, $sqlinsert)) {
                $status[0] = 5;
            }
            echo json_encode($status);
        } else {
            $status[0] = 1;
            echo json_encode($status);
        }
        //break;
    }
} else if (mysqli_num_rows($fetchy) > 1) {
    while ($row_y2 = mysqli_fetch_assoc($fetchy)) {
        $id_plan = $row_y2['id'];
        $st = $row_y2['saved_from'];
        $en = $row_y2['saved_to'];
        if (strtotime($st) >= strtotime($en)) {

            if (strtotime(date('H:i:s')) < strtotime($en)) {
                array_push($id_plan_arr, $id_plan);
                $st = strtotime($st) - 86400;
                array_push($st_arr, $st);
                //array_push($en_arr, $en);
                $have = 1;
            }
        }
    }
    if ($have == 1) {
        array_multisort($st_arr, $id_plan_arr);
        $n = sizeof($st_arr);
        $closest = findClosest($st_arr, $n, strtotime(date('H:i:s')));
        for ($i = 0; $i < count($id_plan_arr); $i++) {
            if ($st_arr[$i] == $closest) {
                if ($status[1] == 0) {
                    $status[0] = 0;
                    $sqlinsert_arr = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr[$i],'$currentTime',$id,'$text',1)";

                    if (!mysqli_query($conn, $sqlinsert_arr)) {
                        $status[0] = 5;
                    }
                    echo json_encode($status);
                } else {
                    $status[0] = 1;
                    echo json_encode($status);
                }
                break;
            }

        }
    }
    //echo json_encode($id . " - " . $id_plan . " - " . $currentTime); 

    //getClosest($currentTime, $st_arr);
//echo json_encode($st_arr); 

}
if($have == 0 ){
    if (mysqli_num_rows($fetchtd) > 0 && mysqli_num_rows($fetchtd) == 1) {
        while ($row_td = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td = $row_td['id'];
            $st_td = $row_td['saved_from'];
            $en_td = $row_td['saved_to'];
            //echo json_encode($have);
            if (strtotime($st_td) >= strtotime($en_td)) {
                $have = 1;
            }else if(strtotime($en3) > strtotime(date('H:i:s'))){
                /*if (strtotime(date('H:i:s')) < strtotime($en)) {
                    $have = 1;
                } */  
                $have = 1;
            }
        }
        if ($have == 1) {

    if (strtotime($st_td) < strtotime($currentTime)) {
        $status[0] = 1;
        if ($status[1] == 0) {
            $status[0] = 0;
            //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
            $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
            //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_to='$close' AND att_from IS NOT NULL ";
            if (!mysqli_query($conn, $sqlinsert_td )) {
                $status[0] = 5;
            }

        }
        echo json_encode($status);

        //echo json_encode($status);
    } else if (strtotime($st_td) > strtotime($currentTime) && strtotime($st_td) - 600 > strtotime($currentTime)) {
        $status[0] = 2;
        if ($status[1] == 0) {
            $status[0] = 0;
            $sqlinsert_td  = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
            //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NOT NULL AND saved_to='$close'  ";
            if (!mysqli_query($conn, $sqlinsert_td )) {
                $status[0] = 5;
            }

        }
        echo json_encode($status);

        //echo json_encode($status);
    } else {
        $status[0] = 0;
        $sqlinsert_td  = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
        //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NOT NULL AND saved_to='$close' ";
        //echo json_encode($status);
        if (!mysqli_query($conn, $sqlinsert_td )) {
            $status[0] = 5;
        }
        echo json_encode($status);

    }
}

    }else if (mysqli_num_rows($fetchtd) > 1) {
        //echo json_encode($status);
        while ($row_td2 = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td2 = $row_td2['id'];
            $st_td2 = $row_td2['saved_from'];
            $en_td2 = $row_td2['saved_to'];
            //if (strtotime($st_td2) >= strtotime($en_td2)) {
    
                //if (strtotime(date('H:i:s')) < strtotime($en_)) {
                    if (strtotime($st_td2) >= strtotime($en_td2) || strtotime($en_td2) > strtotime(date('H:i:s'))) {
     
                    array_push($id_plan_arr_td, $id_plan_td2);
                    $st_td2 = strtotime($st_td2);
                    array_push($st_arr_td, $st_td2);
                    //array_push($en_arr, $en);
                    $have = 1;
                    }
                //}
            //}
        }
        //echo json_encode($have);
        if ($have == 1) {
            array_multisort($st_arr_td, $id_plan_arr_td);
            $n_td = sizeof($st_arr_td);
            $closest_td = findClosest($st_arr_td, $n_td, strtotime(date('H:i:s')));
            for ($i = 0; $i < count($id_plan_arr_td); $i++) {
                if ($st_arr_td[$i] == $closest_td) {
                    if ($st_arr_td[$i] < strtotime($currentTime)) {
                        $status[0] = 1;
                        if ($status[1] == 0) {
                            $status[0] = 0;
                            //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
                            $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                            //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_to='$close' AND att_from IS NOT NULL ";
                            if (!mysqli_query($conn, $sqlinsert_td )) {
                                $status[0] = 5;
                            }
                
                        }
                        echo json_encode($status);
                
                        //echo json_encode($status);
                    } else if ($st_arr_td[$i] > strtotime($currentTime) && $st_arr_td[$i] - 600 > strtotime($currentTime)) {
                        $status[0] = 2;
                        if ($status[1] == 0) {
                            $status[0] = 0;
                            $sqlinsert_td  = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                            //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NOT NULL AND saved_to='$close'  ";
                            if (!mysqli_query($conn, $sqlinsert_td )) {
                                $status[0] = 5;
                            }
                
                        }
                        echo json_encode($status);
                
                        //echo json_encode($status);
                    } else {
                        $status[0] = 0;
                        $sqlinsert_td  = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                        //$sqlin = "UPDATE saved_shift_data SET att_to='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NOT NULL AND saved_to='$close' ";
                        //echo json_encode($status);
                        if (!mysqli_query($conn, $sqlinsert_td )) {
                            $status[0] = 5;
                        }
                        echo json_encode($status);
                
                    }


                }
            }
        }


    }
}



//$sql = "SELECT * FROM saved_shift_data WHERE saved_date='$currentDate' AND id_user='$id' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance) ORDER BY saved_from";
/***$sql = "SELECT * FROM saved_shift_data WHERE saved_date='$currentDate' AND id_user='$id' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance) ORDER BY saved_from";
$fetch = mysqli_query($conn, $sql);
if (mysqli_num_rows($fetch) > 0) {
    if (mysqli_num_rows($fetch) > 1) {
        $j = 0;
        while ($row = mysqli_fetch_assoc($fetch)) {

            $start[$j] = $row['saved_from'];
            //$s =  $start[0];
            $start[$j] = strtotime($start[$j]);
            $j++;


        }
        getClosest($currentTime, $start);
        $status[2] = $pos;
        //$status[8] = $end[$pos];
        $close = date('H:i:s',$start[$pos]);


        if (strtotime($close) < strtotime($currentTime)) {
            $status[0] = 1;
            if ($status[1] == 0) {
                $status[0] = 0;
                //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
                $sqlin = "UPDATE saved_shift_data SET att_from='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_from='$close' AND att_from IS NULL ";
            }
            //echo json_encode($status);
        } else if (strtotime($close) > strtotime($currentTime) && strtotime($close) - 600 > strtotime($currentTime)) {
            $status[0] = 2;
            if ($status[1] == 0) {
                $status[0] = 0;
                $sqlin = "UPDATE saved_shift_data SET att_from='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NULL AND saved_from='$close'  ";
            }
            //echo json_encode($status);
        } else {
            $status[0] = 0;
            $sqlin = "UPDATE saved_shift_data SET att_from='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NULL AND saved_from='$close' ";
            //echo json_encode($status);
        }
        if (!mysqli_query($conn, $sqlin)) {
            //die('Error: ' . mysqli_error($conn));
        }
    

    } else {
        while ($row = mysqli_fetch_assoc($fetch)) {
            $start[0] = $row['saved_from'];
            //break;
            //$s =  $start[0];
            //break;
        }



        //echo json_encode($status);
/*if($start[0] == "00:00:00"){
    if(strtotime($start[0]) < strtotime($currentTime)){
    $status[2] = "true";
    }
}*/


/*** 
        if (strtotime($start[0]) < strtotime($currentTime)) {
            $status[0] = 1;
            if ($status[1] == 0) {
                $status[0] = 0;
                //$currentTim =date('H:i:s',round(strtotime($currentTime) / (15 * 60)) * (15 * 60));
                $sqlin = "UPDATE saved_shift_data SET att_from='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND saved_from='$start[0]' AND att_from IS NULL ";
            }
            //echo json_encode($status);
        } else if (strtotime($start[0]) > strtotime($currentTime) && strtotime($start[0]) - 600 > strtotime($currentTime)) {
            $status[0] = 2;
            if ($status[1] == 0) {
                $status[0] = 0;
                $sqlin = "UPDATE saved_shift_data SET att_from='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id'AND att_from IS NULL AND saved_from='$start[0]'  ";
            }
            //echo json_encode($status);
        } else {
            $status[0] = 0;
            $sqlin = "UPDATE saved_shift_data SET att_from='$currentTime' WHERE saved_date='$currentDate' AND id_user='$id' AND att_from IS NULL AND saved_from='$start[0]' ";
            //echo json_encode($status);
        }
        if (!mysqli_query($conn, $sqlin)) {
            //die('Error: ' . mysqli_error($conn));
        }
    }

}*/
//echo json_encode($status);

/*if (mysqli_connect_errno()) {
    echo json_encode ("Failed to connect to MySQL: " . mysqli_connect_error());
}*/
//echo json_encode(strtotime($start[0]));


function findClosest($arr, $n, $target)
{
    // Corner cases 
    if ($target <= $arr[0])
        return $arr[0];
    if ($target >= $arr[$n - 1])
        return $arr[$n - 1];

    // Doing binary search 
    $i = 0;
    $j = $n;
    $mid = 0;
    while ($i < $j) {
        $mid = ($i + $j) / 2;

        if ($arr[$mid] == $target)
            return $arr[$mid];

        /* If target is less than array element, 
            then search in left */
        if ($target < $arr[$mid]) {

            // If target is greater than previous 
            // to mid, return closest of two 
            if ($mid > 0 && $target > $arr[$mid - 1])
                return getClosest(
                    $arr[$mid - 1],
                    $arr[$mid],
                    $target
                );

            /* Repeat for left half */
            $j = $mid;
        }

        // If target is greater than mid 
        else {
            if (
                $mid < $n - 1 &&
                $target < $arr[$mid + 1]
            )
                return getClosest(
                    $arr[$mid],
                    $arr[$mid + 1],
                    $target
                );

            // update i 
            $i = $mid + 1;
        }
    }

    // Only single element left after search 
    return $arr[$mid]; //$arr[$mid]; 
}

// Method to compare which one is the more close. 
// We find the closest by taking the difference 
// between the target and both values. It assumes 
// that val2 is greater than val1 and target lies 
// between these two. 
function getClosest($val1, $val2, $target)
{
    if ($target - $val1 >= $val2 - $target)
        return $val2;
    else
        return $val1;
}


//$arr = array( 1, 2, 4, 5, 6, 6, 8, 9 ); 
array_multisort($st_arr, $id_plan_arr);
$n = sizeof($st_arr);
//findClosest($arr, $n, $target);
//echo json_encode (findClosest($st_arr, $n, strtotime(date('H:i:s'))));
//echo json_encode ($st_arr[0]."*--".$st_arr[1]."-".strtotime(date('H:i:s')));
/**function getClosest($search, $arr)
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
    //return $closest;
}*/



function roundTime($timestamp, $precision = 15)
{
    $timestamp = strtotime($timestamp);
    $precision = 60 * $precision;
    return date('H:i:s', round($timestamp / $precision) * $precision);
}

//echo json_encode($st_arr); 

?>