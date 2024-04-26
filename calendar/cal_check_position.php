<?php
$saved_data[][] = array();
$Year = $_POST['year'];
$Month = $_POST['month'];
$idArr = json_decode($_POST["id"]);
$cha = $_POST['cha'];
$y_exist = 0;
$td_exist = 0;
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
            $y_exist = 0;
            $time_difference = 0;

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
                $date_stamp = strtotime($d);

                $ydate = strtotime(date("Y-m-d", $date_stamp - 86400));
                $saved_data[$x][$i] = "";

                $yesterday = date("Y-m-d", $ydate);
                $sql_y = " SELECT * FROM saved_shift_data, create_shift WHERE id_user = $get_id AND saved_date='$yesterday' AND id_shift = id_of_shift ";
                $check_y = mysqli_query($con, $sql_y);
                if (mysqli_num_rows($check_y) != 0) {
                    while ($rows_y = mysqli_fetch_assoc($check_y)) {
                        $from_y = $rows_y['saved_from'];
                        $to_y = $rows_y['saved_to'];
                        $name_y = $rows_y['shift_name'];
                        if (strtotime($from_y) >= strtotime($to_y)) {
                            if (strtotime($to_y) < strtotime($get_from)) {
                            } else {
                                $y_exist = 1;
                                $saved_data[$x][$i] = "2||Shift overlaps with yesterday's shift (" . $name_y . ")";
                                break;
                            }

                        } else {
                            $abs1 = abs(strtotime($to_y) - strtotime("24:00:00"));

                            $abs2 = abs(strtotime($get_from) - strtotime("00:00:00"));
                            $abs3 = $abs1 + $abs2;
                            if (14400 > $abs3) {
                                $hour = $abs3 / 3600;
                                $minute = $abs3 % 3600;

                                $saved_data[$x][$i] = "4||The shift is only apart from an another shift (" . $name_y . ") only for " . round((int) $hour) . "h&nbsp;" . ((int) ($minute / 60)) . "min";
                            }
                        }
                    }
                    if ($y_exist == 0) {


                        $sql_td = " SELECT * FROM saved_shift_data, create_shift WHERE id_user = $get_id  AND saved_date='$d' AND id_shift = id_of_shift  ";
                        $check_td = mysqli_query($con, $sql_td);
                        if (mysqli_num_rows($check_td) != 0) {
                            while ($rows_td = mysqli_fetch_assoc($check_td)) {
                                $from_td = $rows_td['saved_from'];
                                $to_td = $rows_td['saved_to'];
                                $name_td = $rows_td['shift_name'];
                                $id_td = $rows_td['id_of_shift'];

                                if ($id_td != $idArr[$x]) {
                                    if (strtotime($from_td) >= strtotime($to_y)) {
                                        $td_exist = 1;
                                        $saved_data[$x][$i] = "3||Shift overlaps with today's another shift (" . $name_td . ")";
                                        break;
                                    } else {
                                        if (strtotime($to_td) > strtotime($get_from)) {

                                            $td_exist = 1;
                                            $saved_data[$x][$i] = "3||Shift overlaps with today's another shift (" . $name_td . ")";
                                            break;
                                        }
                                    }

                                }

                            }

                        }
                    }


                } else {





                    $sql_td = " SELECT * FROM saved_shift_data, create_shift WHERE id_user = $get_id  AND saved_date='$d' AND id_shift = id_of_shift  ";
                    $check_td = mysqli_query($con, $sql_td);

                    if (mysqli_num_rows($check_td) != 0) {
                        while ($rows_td = mysqli_fetch_assoc($check_td)) {
                            $from_td = $rows_td['saved_from'];
                            $to_td = $rows_td['saved_to'];
                            $name_td = $rows_td['shift_name'];
                            $id_td = $rows_td['id_of_shift'];


                            if ($id_td != $idArr[$x]) {
                                $saved_data[$x][$i] = "22";
                                if (strtotime($from_td) >= strtotime($to_td)) {
                                    $td_exist = 1;
                                    $saved_data[$x][$i] = "3||Shift overlaps with today's another shift " . $name_td . "";
                                    break;
                                } else {
                                    if (strtotime($to_td) > strtotime($get_from)) {

                                        $td_exist = 1;
                                        $saved_data[$x][$i] = "3||Shift overlaps with today's another shift " . $name_td . "";
                                        break;
                                    }
                                }

                            }

                        }


                    }

                }
                if ($saved_data[$x][$i] == "") {
                    $saved_data[$x][$i] = "1//Everything is alright";

                }
            }
        }
    }
}
$con->close();




echo json_encode($saved_data);
?>