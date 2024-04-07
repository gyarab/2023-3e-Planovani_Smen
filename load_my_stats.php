<?php
$mysqli = require __DIR__ . "/database.php";

$conn = new mysqli($host, $username, $password, $dbname);
$saved_data[] = array();
$Year = $_POST['year'];
$Month = $_POST['month'];
$Id = $_POST['id'];
$count = 0;
$time;
if ($Month < 10) {
    $Month = "0" . $Month;
}
for ($i = 1; $i < 32; $i++) {
    if ($i < 10) {
        $Day = "0" . $i;
    } else {
        $Day = $i;
    }
    //break;

$Date = $Year. "-".$Month."-".$Day;
//$sql = " SELECT * FROM attendace WHERE id_shift='$idArr[$x]' AND year_shift=$Year AND month_shift =$Month ";
//$sql = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$Date' AND saved_shift_data.id_user='$Id' AND saved_shift_data.id IN (SELECT planned_id FROM attendance));";
$sql = "SELECT * FROM saved_shift_data, attendance WHERE (saved_shift_data.id = attendance.planned_id AND saved_shift_data.saved_date='$Date' AND saved_shift_data.id_user=$Id AND saved_shift_data.id IN (SELECT planned_id FROM attendance));";
$check_get = mysqli_query($conn, $sql);
if (mysqli_num_rows($check_get) == 0) {
    $saved_data[$count] = 0;
    //$saved_data[$count][1] = null;
    //$saved_data[$count][1] = $i;
    //$saved_data[$count][2] = 0;
    $count++;
}else{
$result = $mysqli->query($sql);

while ($rows = $result->fetch_assoc()) {
    $log_from = $rows['log_from'];
    $log_to = $rows['log_to'];
    $plan_from = $rows['saved_from'];
    $plan_to = $rows['saved_to'];
    $delay_arr = $rows['delay_arr'];
    $delay_dep = $rows['delay_dep'];
    if(strtotime($log_from) <strtotime($plan_from) && $delay_arr == 0){
        if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null && $delay_dep ==0  ){
            $time = $time +strtotime($log_to) - strtotime($log_from); 

        }else  if(strtotime($log_to) < strtotime($log_from) && strtotime($log_to)!= null){
        $time = $time +strtotime($log_to)+86400 - strtotime($log_from); 
    }else if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null && $delay_dep ==1){
        $time = 86400 + strtotime($log_to)-strtotime($log_from);
    }else{
        $time = $time;
    }

    }else{
    if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null){
        $time = $time +strtotime($log_to) - strtotime($log_from); 
    }else  if(strtotime($log_to) < strtotime($log_from) && strtotime($log_to)!= null){
        $time = $time +strtotime($log_to)+86400 - strtotime($log_from); 
    }else{
        $time = $time;
    }
}
    //$time = $time +strtotime($log_to) - strtotime($log_from); 
    
    $saved_data[$count] = $time;
    //$saved_data[$count][1] = $log_to;
    //$saved_data[$count][1] = $i;
    //$saved_data[$count][2] = $delay_arr;
    $count++;
}
}

}
echo json_encode($saved_data);

?>