<?php
$saved_data[][] = array();
$vacant = 0;
$vacant_arr_count;
$id_user[] = array();
$time_user[] = array();
$name_user[] = array();
$count_arr[] = array();
$id_user= [];
$time_user = [];
$name_user = [];
$count_arr = [];
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
$position = 0;
for ($i = 1; $i < 9; $i++) {
    if ($i < 10) {
        $qq = "0" . $i;
    } else {
        $qq = $i;
    }
}
$aa = "\"2024-01\"";
$d = "2024-01-" . $qq;
//substr($color[$r], 1, 2);
//$cha = substr($aa, 3, 8);
//$mysqli_sav = require __DIR__ . "/database.php";
$mysqli_sav = require("../database.php");


$con = new mysqli($host, $username, $password, $dbname);
for ($x = 0; $x < count($idArr); $x++) {


    for ($i = 1; $i < 32; $i++) {
        if ($i < 10) {
            $dt = "0" . $i;
        } else {
            $dt = $i;
        }

        //$d = $Year."-".$Month."-".$i;
        //$d = "2024-01-01";
        $t = "-";

        //$d = "{$ch}{$t}{$i}";
        $d = $Year . "-" . $Month . "-" . $dt;

        $sql_get = " SELECT * FROM saved_shift_data WHERE id_of_shift='$idArr[$x]' AND saved_date='$d' ";
        
        $check_get = mysqli_query($con, $sql_get);
        if (mysqli_num_rows($check_get) != 0) {

            $result_get = $mysqli_sav->query($sql_get);
            while ($rows_get = $result_get->fetch_assoc()) {
                $get_from = $rows_get['saved_from'];
                $get_to = $rows_get['saved_to'];
                $get_id = $rows_get['id_user'];
                $get_name = $rows_get['user_name'];
            }
            if ($get_id == null) {
                $vacant_arr_count++;
                if (strtotime($get_to) > strtotime($get_from)) {
                    $time = strtotime($get_to) - strtotime($get_from);
                } else {
                    $time = strtotime($get_to) + 86400 - strtotime($get_from);
                }
                $vacant = $vacant + $time;
                //echo"<p style='font-size: 15px'>". $sql_get. "</p>";
            } else if (in_array($get_id, $id_user)) {
                for ($u = 0; $u < count($id_user); $u++) {
                    if ($id_user[$u] == $get_id) {
                        if (strtotime($get_to) > strtotime($get_from)) {
                            $time = strtotime($get_to) - strtotime($get_from);
                        } else {
                            $time = strtotime($get_to) + 86400 - strtotime($get_from);
                        }
                        $time_user[$u] = $time_user[$u] + $time;
                        $count_arr[$u] = $count_arr[$u] + 1;
                        break;
                    }
                }
            } else {
                if (strtotime($get_to) > strtotime($get_from)) {
                    $time = strtotime($get_to) - strtotime($get_from);
                } else {
                    $time = strtotime($get_to) + 86400 - strtotime($get_from);
                }
                array_push($time_user, $time);
                array_push($count_arr, 1);
                array_push($id_user, $get_id);
                array_push($name_user, $get_name);
            }
        }

    }
}
array_multisort($name_user,$count_arr,$id_user,$count_arr);
//echo "<p>".$id_user[0]."</p>";
echo "<div class='container'>";
if (count($id_user) != null) {
    for ($k = 0; $k < count($id_user); $k++) {
        if($k == 0 && $vacant != null){
            echo "<div class='row'><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Name'>Name </p></strong></div><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Scheduled time'>Planned</p></strong></div><div class='col-2'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Amount'>N</p></strong></div> <hr></div>";
            $hour = round($vacant/3600, 3);
            $minute = $vacant%3600;
            echo "<div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Vacant'>Vacant </p></div><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='".round((int)$hour)." h ".((int)($minute/60))." min'>".round((int)$hour)." h ".((int)($minute/60))." min </p></div><div class='col-2'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;'>".$vacant_arr_count."</p></div> <hr></div>";
        }
        $hour = round($time_user[$k]/3600, 3);
        $minute = $time_user[$k]%3600;
        echo "<div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='".$name_user[$k]."'>".$name_user[$k]." </p></div><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='".round((int)$hour)." h ".((int)($minute/60))." min'>".round((int)$hour)." h ".((int)($minute/60))." min </p></div><div class='col-2'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;'>".$count_arr[$k]."</p></div> <hr></div>";
    }
}
echo "</div>";

//$con->close();




//print $saved_data;
//echo json_encode($Year);
//echo $Year;
//$response = new WP_REST_Response($final_price_return, 200);
//echo json_encode($saved_data);
//exit();
?>