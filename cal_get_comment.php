<?php

$saved_data[][] = array();
$test_arr[] = array();
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
$first = 0;
for ($i = 1; $i < 9; $i++) {
    if ($i < 10) {
        $qq = "0" . $i;
    } else {
        $qq = $i;
    }
}
if ($Month < 9) {
    $Month = "0" . $Month;
}
$aa = "\"2024-01\"";
$d = "2024-01-" . $qq;
$mysqli_sav = require __DIR__ . "/database.php";

$coll = 0;
$con = new mysqli($host, $username, $password, $dbname);
//$test_arr[] = count($idArr);
/*$test_arr[] = $Year;
$test_arr[] = $Month;
$test_arr[] = $idArr[0];*/

for ($x = 0; $x < count($idArr); $x++) {
    $sql_check = " SELECT * FROM shift_check WHERE id_shift='$idArr[$x]' AND year_shift=$Year AND month_shift =$Month ";
    $check_existance = mysqli_query($con, $sql_check);
    //$test_arr[] = $sql_check;
    if (mysqli_num_rows($check_existance) != 0) {
        //$test_arr[] = $idArr[$x];
        for ($i = 0; $i < 31; $i++) {
            if (($i + 1) < 10) {
                $dt = "0" . ($i + 1);
            } else {
                $dt = ($i+ 1);
            }


            $t = "-";

            $d = $Year . "-" . $Month . "-" . $dt;


            $sql_get = " SELECT * FROM saved_shift_data WHERE id_of_shift='$idArr[$x]' AND saved_date='$d' ";
            //if($idArr[$x] == 361){
            $test_arr[] = $sql_get;
            //}
            if ($first == 0) {
                //echo json_encode($sql_get);
                $first++;
            }
            $get_com = "";
            $check_get = mysqli_query($con, $sql_get);
            $result_get = $mysqli_sav->query($sql_get);
            if (mysqli_num_rows($check_get) == 0) {
                $saved_data[$coll][$i] = "";
              }else{
                $test_arr[] = $sql_get;
            
            while ($rows_get = $result_get->fetch_assoc()) {
                //$get_id = $rows_get['id_of_shift'];
                $get_com = $rows_get['comments'];

            }

            //$saved_data[$coll][$i] = $get_id. "|".$get_com . "+" . $x . "/" . $i;
            $saved_data[$coll][$i] = $get_com;
        }
        }
        $coll++;
    }else{
        for ($i = 0; $i < 31; $i++) {
            $saved_data[$coll][$i] = "";
        }
        $coll++;
    }
}
$con->close();




//print $saved_data;
//echo json_encode($Year);
//echo $Year;
//$response = new WP_REST_Response($final_price_return, 200);
echo json_encode($saved_data);
//echo json_encode($test_arr);
//exit();



?>