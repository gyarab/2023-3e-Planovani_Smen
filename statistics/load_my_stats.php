<?php
$mysqli = require("../database.php");

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
    $time = 0;
    if ($i < 10) {
        $Day = "0" . $i;
    } else {
        $Day = $i;
    }

$Date = $Year. "-".$Month."-".$Day;
$sql = "SELECT * FROM saved_shift_data, attendance WHERE (saved_shift_data.id = attendance.planned_id AND saved_shift_data.saved_date='$Date' AND saved_shift_data.id_user=$Id AND saved_shift_data.id IN (SELECT planned_id FROM attendance));";
$check_get = mysqli_query($conn, $sql);
if (mysqli_num_rows($check_get) == 0) {
    $saved_data[$count] = 0;

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
    
    $saved_data[$count] = $time;

    $count++;
}
}

}
echo json_encode($saved_data);

?>