<?php

/**tento soubor slouzi pro zaznamenavani prichodu na smenu */
$mysqli = require ("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id']; /** id uzivatele*/
$ip_address = $_POST['ip_address']; /** ip addressa pouzivaneho zarizeni */
$y = date('Y-m-d', strtotime("-1 days"));/** vcerejsi datum */
$text = $_POST['text']; /** text z komentare */
$currentTime = date('H:i:s');/** soucasny cas */
$td = date('Y-m-d');/** soucasny den */
$ip_list = array(); /**list na ip v databazi */
$status[] = array();/**vraceni zpatecnich dat */
/**Vracene hodnoty
 * status[0] = 0 - vse v poradku 
 * status[0] = 1 - chybi komentar k pozdnimu prichodu 
 * status[0] = 2 - chybi komentar k brzkemu prichodu 
 * status[0] = 4 - ip zarizeni neni v databazi
 * status[0] = 5 - kod neprosel do databaze
 * 
 * status[1] = 0 - je pridany komentar
 * status[1] = 1 - neni pridany komentar
 */

$id_plan_arr = array();/**arr pro id vcerejsi smeny   */
$st_arr = array();/**arr pro casy zacatku vcerejsich smen   */
$en_arr = array();/**arr pro casy koncu vcerejsich smen   */
$id_plan_arr_td = array();/**arr pro id dnesni smeny   */
$st_arr_td = array();/**arr pro casy zacatku dnesnich smen   */
$en_arr_td = array();/**arr pro casy koncu dnesnich smen   */


/**kontroluje zda-li je komentar dostatecne dlouhy */
if (strlen($text) > 2) {
    $status[1] = 0;
} else {
    $status[1] = 1;
}


$have = 0;/** promena udava zdal-li existuje validni smena co zacala vcera */

/** Ziskani IP adres z databaze */
$sqlip = "SELECT * FROM IPS";
$fetchip = mysqli_query($conn, $sqlip);
while ($rowip = mysqli_fetch_assoc($fetchip)) {
    array_push($ip_list, $rowip['ip_address']);
}

/** SQL prikaz na vyhledani vcerejsich smen */
$sqly = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$id' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance /*WHERE log_from IS NULL*/))";
$fetchy = mysqli_query($conn, $sqly);
/** SQL prikaz na vyhledani dnesnich smen */
$sqltd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$id' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance /*WHERE log_from IS NULL*/))";
$fetchtd = mysqli_query($conn, $sqltd);

/** nalezeni pouze jedne validni vcerejsi smeny */
if (mysqli_num_rows($fetchy) > 0 && mysqli_num_rows($fetchy) == 1) {
    while ($row_y = mysqli_fetch_assoc($fetchy)) {
        $id_plan = $row_y['id'];
        $st = $row_y['saved_from'];
        $en = $row_y['saved_to'];
        if (strtotime($st) >= strtotime($en)) {

            if (strtotime(date('H:i:s')) < strtotime($en)) {
                $have = 1;
            }
        } else {
            $have = 0;
        }
    }

    if ($have == 1) {
        if ($status[1] == 0) {
            $status[0] = 0;
            $sqlinsert = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan,'$currentTime',$id,'$text',1)";
            checkip($ip_address);
            if($status[0] != 4){
            if (!mysqli_query($conn, $sqlinsert)) {
                $status[0] = 5;
            }
        }
            echo json_encode($status);
        } else {
            $status[0] = 1;
            checkip($ip_address);

            echo json_encode($status);

        }
    }
    /** nalezeni vicero validni vcerejsi smeny */
} else if (mysqli_num_rows($fetchy) > 1) {
    while ($row_y2 = mysqli_fetch_assoc($fetchy)) {
        $id_plan = $row_y2['id'];
        $st = $row_y2['saved_from'];
        $en = $row_y2['saved_to'];
        if (strtotime($st) >= strtotime($en)) {

            if (strtotime(date('H:i:s')) < strtotime($en)) {
                array_push($id_plan_arr, $id_plan);
                $st = strtotime($st) - 86400;
                array_push($st_arr, $st);
                $have = 1;
            }
        }
    }
    if ($have == 1) {
        array_multisort($st_arr, $id_plan_arr);
        $n = sizeof($st_arr);
        $closest = findClosest($st_arr, $n, strtotime(date('H:i:s')));
        for ($i = 0; $i < count($id_plan_arr); $i++) {
            if ($st_arr[$i] == $closest) {
                if ($status[1] == 0) {
                    $status[0] = 0;
                    $sqlinsert_arr = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr[$i],'$currentTime',$id,'$text',1)";
                    checkip($ip_address);
                    if($status[0] != 4){
                    if (!mysqli_query($conn, $sqlinsert_arr)) {
                        $status[0] = 5;
                    }
                }
                    echo json_encode($status);
                } else {
                    $status[0] = 1;
                    checkip($ip_address);

                    echo json_encode($status);
                }
                break;
            }

        }
    }


}
if ($have == 0) {
/** nalezeni pouze jedne validni dnesni smeny */
    if (mysqli_num_rows($fetchtd) > 0 && mysqli_num_rows($fetchtd) == 1) {

        while ($row_td = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td = $row_td['id'];
            $st_td = $row_td['saved_from'];
            $en_td = $row_td['saved_to'];
            if (strtotime($st_td) >= strtotime($en_td)) {
                $have = 1;
            } else if (strtotime($en_td) > strtotime(date('H:i:s'))) {
                $have = 1;
            }
        }

        if ($have == 1) {

            if (strtotime($st_td) < strtotime($currentTime)) {
                $status[0] = 1;
                if ($status[1] == 0) {
                    $status[0] = 0;
                    $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
                    checkip($ip_address);
                    if($status[0] != 4){
                    if (!mysqli_query($conn, $sqlinsert_td)) {
                        $status[0] = 5;

                    }
                }

                }

                echo json_encode($status);

            } else if (strtotime($st_td) > strtotime($currentTime) && strtotime($st_td) - 600 > strtotime($currentTime)) {
                $status[0] = 2;
                if ($status[1] == 0) {
                    $status[0] = 0;
                    $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
                    checkip($ip_address);
                    if($status[0] != 4){
                    if (!mysqli_query($conn, $sqlinsert_td)) {
                        $status[0] = 5;
                    }
                }

                }

                echo json_encode($status);

            } else {
                $status[0] = 0;
                $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_td,'$currentTime',$id,'$text',0)";
                checkip($ip_address);
                if($status[0] != 4){
                if (!mysqli_query($conn, $sqlinsert_td)) {
                    $status[0] = 5;
                }
            }

                echo json_encode($status);

            }
        }
/** nalezeni vicero validnich dnesnich smen */
    } else if (mysqli_num_rows($fetchtd) > 1) {

        while ($row_td2 = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td2 = $row_td2['id'];
            $st_td2 = $row_td2['saved_from'];
            $en_td2 = $row_td2['saved_to'];

            if (strtotime($st_td2) >= strtotime($en_td2) || strtotime($en_td2) > strtotime(date('H:i:s'))) {

                array_push($id_plan_arr_td, $id_plan_td2);
                $st_td2 = strtotime($st_td2);
                array_push($st_arr_td, $st_td2);
                $have = 1;
            }
        }
        if ($have == 1) {
            array_multisort($st_arr_td, $id_plan_arr_td);
            $n_td = sizeof($st_arr_td);
            $closest_td = findClosest($st_arr_td, $n_td, strtotime(date('H:i:s')));
            for ($i = 0; $i < count($id_plan_arr_td); $i++) {
                if ($st_arr_td[$i] == $closest_td) {
                    if ($st_arr_td[$i] < strtotime($currentTime)) {
                        $status[0] = 1;
                        if ($status[1] == 0) {
                            $status[0] = 0;
                            $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                            checkip($ip_address);
                            if($status[0] != 4){
                            if (!mysqli_query($conn, $sqlinsert_td)) {
                                $status[0] = 5;
                            }
                        }

                        }

                        echo json_encode($status);

                    } else if ($st_arr_td[$i] > strtotime($currentTime) && $st_arr_td[$i] - 600 > strtotime($currentTime)) {
                        $status[0] = 2;
                        if ($status[1] == 0) {
                            $status[0] = 0;
                            $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                            checkip($ip_address);
                            if($status[0] != 4){
                            if (!mysqli_query($conn, $sqlinsert_td)) {
                                $status[0] = 5;
                            }
                        }

                        }
                        echo json_encode($status);

                    } else {
                        $status[0] = 0;
                        $sqlinsert_td = "INSERT INTO attendance (planned_id,log_from,user_id,com_from,delay_arr) VALUES ($id_plan_arr_td[$i] ,'$currentTime',$id,'$text',0)";
                        checkip($ip_address);
                        if($status[0] != 4){
                        if (!mysqli_query($conn, $sqlinsert_td)) {
                            $status[0] = 5;
                        }
                    }
                        echo json_encode($status);

                    }


                }
            }
        }


    }
}





/**nachazi nejblizsi volnou smenu */
function findClosest($arr, $n, $target)
{
    if ($target <= $arr[0])
        return $arr[0];
    if ($target >= $arr[$n - 1])
        return $arr[$n - 1];

    $i = 0;
    $j = $n;
    $mid = 0;
    while ($i < $j) {
        $mid = ($i + $j) / 2;

        if ($arr[$mid] == $target)
            return $arr[$mid];

        /* If target is less than array element, 
            then search in left */
        if ($target < $arr[$mid]) {

            // If target is greater than previous 
            // to mid, return closest of two 
            if ($mid > 0 && $target > $arr[$mid - 1])
                return getClosest(
                    $arr[$mid - 1],
                    $arr[$mid],
                    $target
                );

            /* Repeat for left half */
            $j = $mid;
        }

        // If target is greater than mid 
        else {
            if (
                $mid < $n - 1 &&
                $target < $arr[$mid + 1]
            )
                return getClosest(
                    $arr[$mid],
                    $arr[$mid + 1],
                    $target
                );

            // update i 
            $i = $mid + 1;
        }
    }

    // Only single element left after search 
    return $arr[$mid]; //$arr[$mid]; 
}

// Method to compare which one is the more close. 
// We find the closest by taking the difference 
// between the target and both values. It assumes 
// that val2 is greater than val1 and target lies 
// between these two. 
function getClosest($val1, $val2, $target)
{
    if ($target - $val1 >= $val2 - $target)
        return $val2;
    else
        return $val1;
}


array_multisort($st_arr, $id_plan_arr);
$n = sizeof($st_arr);



/**funkce kontroluje ip adresu zarizeni */
function checkip($ip_search)
{
    global $ip_list;
    global $status;
    if (in_array($ip_search, $ip_list)) {
    } else {
        $status[0] = 4;
    }
}




?>