<?php
$id_arr = array();
$name_arr = array();
$position_arr = array();
$from = $_POST['from'];
$to = $_POST['to'];
$date = $_POST['date'];
$id_shift = $_POST['id'];
$y_id = $_POST['y_id'];
$y_from = $_POST['y_from'];
$y_to = $_POST['y_to'];
$c_id = $_POST['c_id'];
$c_from = $_POST['c_from'];
$c_to = $_POST['c_to'];
$ees;
$is_right = 0;
$return_data = 0;
$is_right_yesterday = 0;
$typ = 0;
$typ2 = 0;
$multiple2 = 0;
$add_posible_users2_constant = 0;
$add_posible_users3_constant = 0;

$posible_users1 = array();
$posible_users2 = array();
$posible_users3 = array();
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);


$sql = "SELECT * FROM shift_assignment, user2 WHERE shift_id = $id_shift AND user2.id=shift_assignment.user_id";

$fetch = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_assoc($fetch)) {
    array_push($id_arr, $rows['user_id']);
    $first_name = $rows['firstname'];
    $middle_name = $rows['middlename'];
    $last_name = $rows['lastname'];
    $name = $last_name . " " . $middle_name . " " . $first_name;
    array_push($name_arr, $name);
    array_push($position_arr, $rows['position']);

    //$saved_data$rows['employee_full'];
}
if (count($id_arr) != 0) {
     /**source : https://techvblogs.com/blog/get-last-day-of-month-from-date-in-php */
    // Converting string to date 
    $date_stamp = strtotime($date); 
       
    // Last date of current month. 
    $ydate = strtotime(date("Y-m-d", $date_stamp -86400 )); 
    
    // Day of the last date  
    $yesterday = date("Y-m-d", $ydate); 
      
    $sql_yesterday = "SELECT * FROM saved_shift_data WHERE saved_date = '$yesterday' ";
    
    $check_y = mysqli_query($conn, $sql_yesterday);
    if (mysqli_num_rows($check_y) != 0) {
        $fetch_y = mysqli_query($conn, $sql_yesterday);
        while ($rows_y = mysqli_fetch_assoc($fetch_y)) {
            array_push($y_from, $rows_y['saved_from']);
            array_push($y_to, $rows_y['saved_to']);
            array_push($y_id, $rows_y['id_user']);
        }
    }
    $sql_today = "SELECT * FROM saved_shift_data WHERE saved_date = '$date' ";
    $check_t = mysqli_query($conn, $sql_today);
    if (mysqli_num_rows($check_t) != 0) {
        $fetch_t = mysqli_query($conn, $sql_today);
        while ($rows_t = mysqli_fetch_assoc($fetch_t)) {
            array_push($c_from, $rows_t['saved_from']);
            array_push($c_to, $rows_t['saved_to']);
            array_push($c_id, $rows_t['id_user']);
        }
    }





    $dayofweek = date('D', strtotime($date));
    for ($i = 0; $i < count($id_arr); $i++) {
        if ($position_arr[$i] == "parttime_employee") {
            $sql_time = "SELECT * FROM time_options WHERE id_user=$id_arr[$i] AND saved_date='$date'";
            $is_right = 0;
            $check_time = mysqli_query($conn, $sql_time);
            if (mysqli_num_rows($check_time) != 0) {
                $fetch_time = mysqli_query($conn, $sql_time);
                $from_time = null;
                while ($rows_time = mysqli_fetch_assoc($fetch_time)) {
                    $from_time = $rows_time['opt_from'];
                    $to_time = $rows_time['opt_to'];
                }
            }
            if ($from_time != null) {
                if (strtotime($from) >= strtotime($to)) {
                    if (strtotime($from_time) >= strtotime($to_time)) {
                        if (strtotime($from_time) <= strtotime($from) && strtotime($to_time) >= strtotime($to)) {
                            $is_right = 1;
                        }
                        $typ = 1;
                    }
                } else {
                    if (strtotime($from_time) >= strtotime($to_time)) {
                        if (strtotime($from_time) <= strtotime($from)) {
                            $is_right = 1;
                        }
                        $typ = 2;
                    } else {
                        if (strtotime($from_time) <= strtotime($from) && strtotime($to_time) >= strtotime($to)) {
                            $is_right = 1;
                        }
                        $typ = 3;

                    }
                }

            }
            if ($is_right == 1) {
                array_push($posible_users1, $id_arr[$i]);
            }
            $ees = $typ . "//" . $id_arr[$i] . "---" . $date . "---" . $dayofweek . "-" . $is_right . "--" . $from_time . "--" . $to_time;

        } else {
            if ($dayofweek == "Mon") {
                $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND monday=1";
                $check_permanent = mysqli_query($conn, $sql_permanent);
                if (mysqli_num_rows($check_permanent) != 0) {
                    $fetch_permanent = mysqli_query($conn, $sql_permanent);
                    $from_permanent = null;
                    while ($rows_permanent = mysqli_fetch_assoc($fetch_permanent)) {
                        $from_permanent = $rows_permanent['mon_from'];
                        $to_permanent = $rows_permanent['mon_to'];
                    }
                    //$ees = "l;kasd";
                }
            } else if ($dayofweek == "Tue") {
                $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND tuesday=1";
                $check_permanent = mysqli_query($conn, $sql_permanent);
                if (mysqli_num_rows($check_permanent) != 0) {
                    $fetch_permanent = mysqli_query($conn, $sql_permanent);
                    $from_permanent = null;
                    while ($rows_permanent = mysqli_fetch_assoc($fetch_permanent)) {
                        $from_permanent = $rows_permanent['tue_from'];
                        $to_permanent = $rows_permanent['tue_to'];
                    }
                    //$ees = "l;kasd";
                }

            } else if ($dayofweek == "Wed") {
                $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND wednesday=1";
                $check_permanent = mysqli_query($conn, $sql_permanent);
                if (mysqli_num_rows($check_permanent) != 0) {
                    $fetch_permanent = mysqli_query($conn, $sql_permanent);
                    $from_permanent = null;
                    while ($rows_permanent = mysqli_fetch_assoc($fetch_permanent)) {
                        $from_permanent = $rows_permanent['wed_from'];
                        $to_permanent = $rows_permanent['wed_to'];
                    }
                    //$ees = "l;kasd";
                }

            } else if ($dayofweek == "Thu") {
                $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND thursday=1";
                $check_permanent = mysqli_query($conn, $sql_permanent);
                if (mysqli_num_rows($check_permanent) != 0) {
                    $fetch_permanent = mysqli_query($conn, $sql_permanent);
                    $from_permanent = null;
                    while ($rows_permanent = mysqli_fetch_assoc($fetch_permanent)) {
                        $from_permanent = $rows_permanent['thu_from'];
                        $to_permanent = $rows_permanent['thu_to'];
                    }
                    //$ees = "l;kasd";
                }
            } else if ($dayofweek == "Fri") {
                $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND friday=1";
                $check_permanent = mysqli_query($conn, $sql_permanent);
                if (mysqli_num_rows($check_permanent) != 0) {
                    $fetch_permanent = mysqli_query($conn, $sql_permanent);
                    $from_permanent = null;
                    while ($rows_permanent = mysqli_fetch_assoc($fetch_permanent)) {
                        $from_permanent = $rows_permanent['fri_from'];
                        $to_permanent = $rows_permanent['fri_to'];
                    }
                    //$ees = "l;kasd";
                }
            } else if ($dayofweek == "Sat") {
                $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND saturday=1";
                $check_permanent = mysqli_query($conn, $sql_permanent);
                if (mysqli_num_rows($check_permanent) != 0) {
                    $fetch_permanent = mysqli_query($conn, $sql_permanent);
                    $from_permanent = null;
                    while ($rows_permanent = mysqli_fetch_assoc($fetch_permanent)) {
                        $from_permanent = $rows_permanent['sat_from'];
                        $to_permanent = $rows_permanent['sat_to'];
                    }
                    //$ees = "l;kasd";
                }
            } else {
                $sql_permanent = "SELECT * FROM permanent_time_options WHERE id_user=$id_arr[$i] AND sunday=1";
                $check_permanent = mysqli_query($conn, $sql_permanent);
                if (mysqli_num_rows($check_permanent) != 0) {
                    $fetch_permanent = mysqli_query($conn, $sql_permanent);
                    $from_permanent = null;
                    while ($rows_permanent = mysqli_fetch_assoc($fetch_permanent)) {
                        $from_permanent = $rows_permanent['sun_from'];
                        $to_permanent = $rows_permanent['sun_to'];
                    }
                    //$ees = "l;kasd";
                }
            }
            $is_right = 0;
            if ($from_permanent != null) {
                if (strtotime($from) >= strtotime($to)) {
                    if (strtotime($from_permanent) >= strtotime($to_permanent)) {
                        if (strtotime($from_permanent) <= strtotime($from) && strtotime($to_permanent) >= strtotime($to)) {
                            $is_right = 1;
                        }
                        $typ = 1;
                    }
                } else {
                    if (strtotime($from_permanent) >= strtotime($to_permanent)) {
                        if (strtotime($from_permanent) <= strtotime($from)) {
                            $is_right = 1;
                        }
                        $typ = 2;
                    } else {
                        if (strtotime($from_permanent) <= strtotime($from) && strtotime($to_permanent) >= strtotime($to)) {
                            $is_right = 1;
                        }
                        $typ = 3;

                    }
                }

            }
            if ($is_right == 1) {
                array_push($posible_users1, $id_arr[$i]);
            }
            //$ees =$typ."//". $id_arr[$i]."---".$date."---". $dayofweek."-".$is_right ."--".$from_permanent."--".$to_permanent; 


        }


    }
    if (count($posible_users1) != 0) {
        if (count($y_id) != 0) {

            for ($e = 0; $e < count($posible_users1); $e++) {
                $add_posible_users2_constant = 0;
                if (in_array($posible_users1[$e], $y_id)) {
                    for ($w = 0; $w < count($y_id); $w++) {
                        //$multiple2 = 1;
                        if ($posible_users1[$e] == $y_id[$w]) {
                            if (strtotime($y_from[$w]) >= strtotime($y_to[$w])) {
                                if (strtotime($y_to[$w]) <= strtotime($from)) {
                                    //$typ2 = 1;
                                    //array_push($posible_users2, $posible_users1[$e]);
                                } else {
                                    $add_posible_users2_constant = 1;
                                }
                                //break;

                            } else {
                                //$typ2 = 2;
                                //array_push($posible_users2, $posible_users1[$e]);
                            }

                        }
                    }
                    if ($add_posible_users2_constant == 0) {
                        array_push($posible_users2, $posible_users1[$e]);
                    }

                } else {
                    $typ2 = 3;
                    array_push($posible_users2, $posible_users1[$e]);
                }

            }
        } else {



            for ($e = 0; $e < count($posible_users1); $e++) {
                array_push($posible_users2, $posible_users1[$e]);

                //echo json_encode($posible_users1[$e]);
                //echo json_encode($posible_users[$e]);
                //break;
            }
        }
    }
    if (count($posible_users2) != 0) {
        if (count($c_id) != 0) {

            for ($e = 0; $e < count($posible_users2); $e++) {
                $add_posible_users3_constant = 0;
                if (in_array($posible_users2[$e], $c_id)) {
                    for ($w = 0; $w < count($c_id); $w++) {
                        //$multiple2 = 1;
                        if ($posible_users2[$e] == $c_id[$w]) {
                            if (strtotime($c_from[$w]) >= strtotime($c_to[$w])) {

                                    $add_posible_users3_constant = 1;
          

                            } else {

                                if (strtotime($c_to[$w]) <= strtotime($from)) {
                                    //$typ2 = 1;
                                    //array_push($posible_users2, $posible_users1[$e]);
                                } else {
                                    $add_posible_users3_constant = 1;
                                }
                            }

                        }
                    }
                    if ($add_posible_users3_constant == 0) {
                        array_push($posible_users3, $posible_users2[$e]);
                    }

                } else {
                    $typ2 = 3;
                    array_push($posible_users3, $posible_users2[$e]);
                }

            }
        } else {

            for ($e = 0; $e < count($posible_users2); $e++) {
                array_push($posible_users3, $posible_users2[$e]);
            }
        }
    }







    /*if(){
        //echo json_encode($saved_data);
    }else{

    }*/
    //$return_data = $posible_users2[]
    $final_name;
    if (count($posible_users3) != 0) {
        for ($t = 0; $t < count($id_arr); $t++) {
            if ($posible_users3[0] == $id_arr[$t]) {
                $final_name = $name_arr[$t];
                break;
            }
        }

        $return_data = $posible_users3[0] . "||" . $final_name;
        echo json_encode($return_data);

    } else {

        $return_data = "0" . "||" . "--vacant--";
        echo json_encode($return_data);
    }
} else {
    //echo json_encode($ees);
    //echo json_encode($ees);
    $return_data = "0" . "||" . "--vacant--";
    echo json_encode($return_data);

}


?>