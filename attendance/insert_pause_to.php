<?php
$mysqli = require("../database.php");
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];
$y = date('Y-m-d', strtotime("-1 days"));
//$text = $_POST['text'];
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
/*if (strlen($text) > 2) {
    $status[1] = 0;
} else {
    $status[1] = 1;
    $text = "";
}*/

$have = 0;
$checkfrom = 0;
$sqly = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
$fetchy = mysqli_query($conn, $sqly);
$sqltd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
$fetchtd = mysqli_query($conn, $sqltd);
if (mysqli_num_rows($fetchy) > 0) {
    $checkfrom = 1;
    while ($row_y = mysqli_fetch_assoc($fetchy)) {
        $id_plan_y = $row_y['id'];
        $fetch_from_y = mysqli_query($conn, "SELECT pause_to FROM attendance WHERE planned_id = $id_plan_y ");
        while ($row_y_from = mysqli_fetch_assoc($fetch_from_y)) {
            $pause_to_y = $row_y_from['pause_to'];
        }
    }
    if($pause_to_y != null){
        $sqly_insert = "UPDATE attendance SET pause_to='$pause_to_y||$currentTime' WHERE planned_id=$id_plan_y";

    }else{
    $sqly_insert = "UPDATE attendance SET pause_to='$currentTime' WHERE planned_id=$id_plan_y";
    }
    if (!mysqli_query($conn, $sqly_insert)) {
        
    }


}
if($checkfrom == 0){
    if (mysqli_num_rows($fetchtd) > 0) {
        while ($row_td = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td = $row_td['id'];
            $fetch_from_td = mysqli_query($conn, "SELECT pause_to FROM attendance WHERE planned_id = $id_plan_td ");
            while ($row_td_from = mysqli_fetch_assoc($fetch_from_td)) {
                $pause_to_td = $row_td_from['pause_to'];
            }
            
            //$pause_from_td = $row_td['pause_from'];
        }
        if($pause_to_td != null){
            $sqltd_insert = "UPDATE attendance SET pause_to= '$pause_to_td||$currentTime' WHERE planned_id=$id_plan_td";
            echo json_encode($pause_to_td);

        }else{
        $sqltd_insert = "UPDATE attendance SET pause_to='$currentTime' WHERE planned_id=$id_plan_td";
        echo json_encode("123" + $pause_to_td);

        }
        if (!mysqli_query($conn, $sqltd_insert)) {
            
        }
    
    
    }
    //echo json_encode($id_plan_td);
}
?>