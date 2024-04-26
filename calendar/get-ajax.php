<?php
$saved_data[][] = array();
$Year = $_POST['year'];
$Month = $_POST['month'];
$idArr = json_decode($_POST["id"]);
$cha = $_POST['cha'];
$nns = $_POST['nn'];
$dt = "";
$hh = "2024-01-01";
$e = $cha;
$A = 1;
$R = "0" . $A;
$d = "";
for ($i = 1; $i < 9; $i++) {
  if ($i < 10) {
    $qq = "0" . $i;
  } else {
    $qq = $i;
  }
}
$aa = "\"2024-01\"";
$d = "2024-01-" . $qq;
$mysqli_sav = require ("../database.php");


$con = new mysqli($host, $username, $password, $dbname);
for ($x = 0; $x < count($idArr); $x++) {
  $sql_check = " SELECT * FROM shift_check WHERE id_shift='$idArr[$x]' AND year_shift=$Year AND month_shift =$Month ";
  $check_existance = mysqli_query($con, $sql_check);
  if (mysqli_num_rows($check_existance) == 0) {
    $saved_data[$x][0] = "0";
    for ($i = 1; $i < 32; $i++) {
      $saved_data[$x][$i] = "empty";
    }
  } else {
    $saved_data[$x][0] = "1";
    for ($i = 1; $i < 32; $i++) {
      if ($i < 10) {
        $dt = "0" . $i;
      } else {
        $dt = $i;
      }
      $t = "-";
      $d = $Year . "-" . $Month . "-" . $dt;

      $sql_get = " SELECT * FROM saved_shift_data WHERE id_of_shift='$idArr[$x]' AND saved_date='$d' ";
      $check_get = mysqli_query($con, $sql_get);
      if (mysqli_num_rows($check_get) == 0) {
        $saved_data[$x][$i] = "empty";
      } else {
        $result_get = $mysqli_sav->query($sql_get);
        while ($rows_get = $result_get->fetch_assoc()) {
          $get_from = $rows_get['saved_from'];
          $get_to = $rows_get['saved_to'];
          $get_id = $rows_get['id_user'];
          $get_name = $rows_get['user_name'];
        }
        $saved_data[$x][$i] = $get_from . "//" . $get_to . "//" . $get_id . "//" . $get_name;
      }
    }
  }
}
$con->close();




echo json_encode($saved_data);

?>