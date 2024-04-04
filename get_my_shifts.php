<?php
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$Month = $_POST['month'];
$Year = $_POST['year'];
$Id = $_POST['id'];
$saved_data[][] = array();
$counter = 0;
//$sql_check = " SELECT * FROM saved_shift_data WHERE id_shift='$idArr[$x]' AND year_shift=$Year AND month_shift =$Month ";

for ($i = 1; $i < 32; $i++) {
    if($i < 10){
       $day = "0". $i;
    }else{
        $day = $i;
    }
    $Date = $Year."-".$Month."-".$day;
    $sql_get = " SELECT * FROM saved_shift_data, create_shift WHERE id_user=$Id AND saved_date='$Date' AND id_shift = id_of_shift ";
    $check_existance = mysqli_query($conn, $sql_get);
    if(mysqli_num_rows($check_existance) != 0){
    $result_get = $mysqli->query($sql_get);
    while ($rows_get = $result_get->fetch_assoc()) {
        $saved_data[$counter][0] = $i; 
        $saved_data[$counter][1] = $rows_get['id']; 
        $saved_data[$counter][2] = $rows_get['shift_name']; 
        $saved_data[$counter][3] = $rows_get['object_name'];
        $saved_data[$counter][4] = $rows_get['comments'];
        $saved_data[$counter][5] = $rows_get['saved_from'];
        $saved_data[$counter][6] = $rows_get['saved_to'];
        $saved_data[$counter][7] = $rows_get['color'];
        $id_p = $rows_get['id']; 
        $sql_att = "SELECT * FROM attendance WHERE planned_id = $id_p";
        $check_existance_p = mysqli_query($conn, $sql_att);
        if(mysqli_num_rows($check_existance_p) != 0){
            $result_get_p = $mysqli->query($sql_att);
            while ($rows_get_p = $result_get_p->fetch_assoc()) {
            $saved_data[$counter][8] = $rows_get_p['log_from']; 
            $saved_data[$counter][9] = $rows_get_p['log_to'];
            $saved_data[$counter][10] = $rows_get_p['com_from']; 
            $saved_data[$counter][11] = $rows_get_p['com_to'];
            }
        }else{
            $saved_data[$counter][8] = "--:--:--"; 
            $saved_data[$counter][9] = "--:--:--";
            $saved_data[$counter][10] = "//"; 
            $saved_data[$counter][11] = "//";
        }
        $counter++;
    }
}else{
    /*for ($z = 0; $z < 10; $z++) {
        $saved_data[$counter][$z] = "";
    }
    $counter++;*/
}

}

echo json_encode($saved_data);
?>