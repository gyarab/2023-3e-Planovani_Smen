<?php
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];
$text = $_POST['text'];
$currentTime = date('H:i:s');
$currentDate = date('Y-m-d');
$start = array();
$status[] = array();
$test = 0;
$comment = 0;
$s;
global $pos;
if (strlen($text) > 2) {
    $status[1] = 0;
} else {
    $status[1] = 1;
}
$sql = "SELECT * FROM saved_shift_data WHERE saved_date='$currentDate' AND id_user='$id' ORDER BY saved_from";
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

}
echo json_encode($status);

/*if (mysqli_connect_errno()) {
    echo json_encode ("Failed to connect to MySQL: " . mysqli_connect_error());
}*/
//echo json_encode(strtotime($start[0]));

function getClosest($search, $arr)
{
    $closest = null;
    global $pos;
    //foreach ($arr as $item) {
    for ($x = 0; $x < count($arr); $x++) {
        if ($closest === null || abs($search - $closest) > abs($arr[$x] - $search)) {
            //$closest = $arr[$x];
            $pos = $x;
        }
    }
    //}
    //return $closest;
}



function roundTime($timestamp, $precision = 15)
{
    $timestamp = strtotime($timestamp);
    $precision = 60 * $precision;
    return date('H:i:s', round($timestamp / $precision) * $precision);
}

?>