<?php
$mysqli = require __DIR__ . "/database.php";

$conn = new mysqli($host, $username, $password, $dbname);
$saved_data[] = array();
$Year = $_POST['year'];
$Month = $_POST['month'];
$Id = $_POST['id'];
$count = 0;
$time;
$first;
if ($Month < 10) {
    $Month = "0" . $Month;
}

for ($i = 1; $i < 32; $i++) {
    $time = 0;
    $first = 0;
    if ($i < 10) {
        $Day = "0" . $i;
    } else {
        $Day = $i;
    }

$Date = $Year. "-".$Month."-".$Day;
$sql = "SELECT * FROM saved_shift_data, attendance WHERE (saved_shift_data.id = attendance.planned_id AND saved_shift_data.saved_date='$Date' AND saved_shift_data.id_user=$Id AND saved_shift_data.id IN (SELECT planned_id FROM attendance));";
$check_get = mysqli_query($conn, $sql);
if (mysqli_num_rows($check_get) == 0) {
    /*$saved_data[$count] = 0;
    //$saved_data[$count][1] = null;
    //$saved_data[$count][1] = $i;
    //$saved_data[$count][2] = 0;
    $count++;*/
}else{
$result = $mysqli->query($sql);

while ($rows = $result->fetch_assoc()) {
    $time = 0;
    $time_row = 0;
    $first_row = 0;
    $first = 0;
    $log_from = $rows['log_from'];
    $log_to = $rows['log_to'];
    $plan_from = $rows['saved_from'];
    $plan_to = $rows['saved_to'];
    $delay_arr = $rows['delay_arr'];
    $delay_dep = $rows['delay_dep'];
    if(strtotime($log_from) <strtotime($plan_from) && $delay_arr == 0){
        if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null && $delay_dep ==0  ){
            $time = round(($time +strtotime($log_to) - strtotime($log_from))/3600, 3); 
            $time_row = ($time +strtotime($log_to) - strtotime($log_from))%3600;

        }else  if(strtotime($log_to) < strtotime($log_from) && strtotime($log_to)!= null){
        $time = round(($time +strtotime($log_to)+86400 - strtotime($log_from))/3600, 3); 
        $time_row = ($time +strtotime($log_to)+86400 - strtotime($log_from))%3600;
    }else if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null && $delay_dep ==1){
        $time = round((86400 + strtotime($log_to)-strtotime($log_from))/3600, 3);
        $time_row =( 86400 + strtotime($log_to)-strtotime($log_from))%3600;
    }else{
        //$time =$time  ;
    }

    }else{
    if(strtotime($log_to) > strtotime($log_from) && strtotime($log_to)!= null){
        $time = round(($time +strtotime($log_to) - strtotime($log_from))/3600, 3); 
        $time_row = ($time +strtotime($log_to) - strtotime($log_from))%3600;
    }else  if(strtotime($log_to) < strtotime($log_from) && strtotime($log_to)!= null){
        $time = round(($time +strtotime($log_to)+86400 - strtotime($log_from))/3600, 3); 
        $time_row = ($time +strtotime($log_to)+86400 - strtotime($log_from))%3600;
    }else{
        //$time = $time ;
    }

}
if(strtotime($plan_from) <strtotime($plan_to)){
    $first =  round((strtotime($plan_to) - strtotime($plan_from))/3600, 3);
    $first_row = (strtotime($plan_to) - strtotime($plan_from))%3600;
}else{
    $first = round((strtotime($plan_to)+84600 - strtotime($plan_from))/3600, 3);
    $first_row = (strtotime($plan_to)+84600 - strtotime($plan_from))%3600;
}
//$first = 1.99;
/** source rounding */

                        echo'<div class="row">';
                        echo'<div class="col-12 col-md-2">';
                       
                        echo'<p>'.$Date. '</p>';
                     
                        echo'</div>';
                        echo'<div class="col-12 col-md-3">';
                        echo'<div style="display:inline">';
                        echo' <p id="s'.$count.'" style="display:inline">'.$first.'</p>';
                        echo'</div>';
                        echo'<div style="display:inline">';
                        echo' <p style="display:inline">&nbsp;-&nbsp;&nbsp;'.round((int)$first).'h&nbsp;'.((int)($first_row/60)).'min</p>';
                        echo'</div>';
                        echo'</div>';
                        echo' <div class="col-12 col-md-2">';

                        echo'<div style="display:inline">';
                        echo'<p id="sr'.$count.'" style="display:inline">'.((round($first*4))/4).'</p>';
                        echo'</div>';
                        echo'<div style="display:inline">';
                        echo' <p style="display:inline">&nbsp;-&nbsp;&nbsp;'.round((int)((round($first*4))/4)).'h&nbsp;'.(int)((((round($first*4))/4)*3600)%3600/60).'min</p>';
                        echo'</div>';
                        echo'</div>';
                        echo'<div class="col-12 col-md-3">';
                        echo'<div style="display:inline">';
                        echo'<p id="l'.$count.'" style="display:inline">'.$time.'</p>';
                        echo'</div>';
                        echo'<div style="display:inline">';
                        echo' <p style="display:inline">&nbsp;-&nbsp;&nbsp;'.round((int)$time).'h&nbsp;'.((int)($time_row/60)).'min</p>';
                        echo'</div>';
                        echo'</div>';
                        echo'<div class="col-12 col-md-2">';
                        echo'<div style="display:inline">';
                        echo'<p id="lr'.$count.'" style="display:inline">'.((round($time*4))/4).'</p>';
                        echo'</div>';
                        echo'<div style="display:inline">';
                        echo' <p style="display:inline">&nbsp;-&nbsp;&nbsp;'.round((int) ((round($time*4))/4)).'h&nbsp;'.(int)((((round($time*4))/4)*3600)%3600/60).'min</p>';
                        echo'</div>';
                        echo'</div>';
                       
                        echo' </div>';

    //$time = $time +strtotime($log_to) - strtotime($log_from); 
    
    //$saved_data[$count] = $time;
    //$saved_data[$count][1] = $log_to;
    //$saved_data[$count][1] = $i;
    //$saved_data[$count][2] = $delay_arr;
    $count++;
}
}

}

function floorToFraction($number, $denominator = 1)
{
    $x = $number * $denominator;
    $x = floor($x);
    $x = $x / $denominator;
    return $x;
}
?>