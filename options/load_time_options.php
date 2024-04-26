<?php
$saved_data[] = array();
$Year = $_POST['year'];
$Month= $_POST['month'];
$id = $_POST["id"];

$dt = "";
$hh = "2024-01-01";
$e = $cha;
$A = 1;
$R = "0" . $A;
$d = "";

$mysqli_sav = require("../database.php");

  
          $con = new mysqli($host, $username, $password, $dbname);
          


              for ($i = 1; $i < 32; $i++) {
                  if($i<10){
                    $dt = "0".$i;
                  }else{
                    $dt = $i;
                  }


                $t = "-";
                
           
                $d = $Year."-".$Month."-".$dt;
                
                $sql_get = " SELECT * FROM time_options WHERE id_user='$id' AND saved_date='$d' ";
                $check_get = mysqli_query($con, $sql_get);
                if (mysqli_num_rows($check_get) == 0) {
                  $saved_data[$i-1] = "empty";
                }else{
                  $result_get = $mysqli_sav->query($sql_get);
                  while ($rows_get = $result_get->fetch_assoc()) {
                  $get_from = $rows_get['opt_from'];
                  $get_to = $rows_get['opt_to'];

                  }
                  $saved_data[$i-1] =   $get_from."//".  $get_to ;
                }
              
          
          }
$con->close();

echo json_encode($saved_data);

?>