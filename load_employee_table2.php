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

$id = $_POST['id'];
$name = $_POST['name'];
$to = $_POST["to"];
$from = $_POST['from'];
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
//echo"<p>". $from[0] ."</p>";

for ($k = 0; $k < count($id); $k++) {
    $get_id = $id[$k];
    $get_name = $name[$k];
    $get_from = $from[$k];
    $get_to = $to[$k];
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



array_multisort($name_user,$time_arr,$id_user,$count_arr);
//echo "<p>".$id_user[0]."</p>";

echo "<div class='container'>";
if (count($id_user) != null) {
    for ($k = 0; $k < count($id_user); $k++) {
        if($k == 0 && $vacant != null){
            echo "<div class='row'><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Name'>Name </p></strong></div><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Scheduled time'>Planned</p></strong></div><div class='col-2'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Amount'>N</p></strong></div> <hr></div>";
            $hour = round($vacant/3600, 3);
            $minute = $vacant%3600;
            echo "<div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Vacant'>Vacant </p></div><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='".round((int)$hour)." h ".((int)($minute/60))." min'>".round((int)$hour)." h ".((int)($minute/60))." min </p></div><div class='col-2'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;'>".$vacant_arr_count."</p></div> <hr></div>";
        }else if($k == 0){
            echo "<div class='row'><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Name'>Name </p></strong></div><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Scheduled time'>Planned</p></strong></div><div class='col-2'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Amount'>N</p></strong></div> <hr></div>";
        }
        $hour = round($time_user[$k]/3600, 3);
        $minute = $time_user[$k]%3600;
        echo "<div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='".$name_user[$k]."'>".$name_user[$k]." </p></div><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='".round((int)$hour)." h ".((int)($minute/60))." min'>".round((int)$hour)." h ".((int)($minute/60))." min </p></div><div class='col-2'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;'>".$count_arr[$k]."</p></div> <hr></div>";
    }
}else if($vacant != null){
    echo "<div class='row'><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Name'>Name </p></strong></div><div class='col-5'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Scheduled time'>Planned</p></strong></div><div class='col-2'><strong><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Amount'>N</p></strong></div> <hr></div>";
    $hour = round($vacant/3600, 3);
    $minute = $vacant%3600;
    echo "<div class='row'><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='Vacant'>Vacant </p></div><div class='col-5'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;' title='".round((int)$hour)." h ".((int)($minute/60))." min'>".round((int)$hour)." h ".((int)($minute/60))." min </p></div><div class='col-2'><p style='font-size: 15px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;'>".$vacant_arr_count."</p></div> <hr></div>";
}
echo "</div>";


?>