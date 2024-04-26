<?php
/** soubor zaznamenava odchody uzivatele */

$mysqli = require ("../database.php");
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];/** id uzivatele*/
$ip_address = $_POST['ip_address'];/** ip addressa pouzivaneho zarizeni */
$y = date('Y-m-d', strtotime("-1 days"));/** vcerejsi datum */
$text = $_POST['text'];/** text z komentare */
$currentTime = date('H:i:s');/** soucasny cas */
$td = date('Y-m-d');/** soucasny den */
$status[] = array();/**vraceni zpatecnich dat */
/**Vracene hodnoty
 * status[0] = 0 - vse v poradku 
 * status[0] = 1 - chybi komentar k pozdnimu odchodu 
 * status[0] = 2 - chybi komentar k brzkemu odchodu 
 * status[0] = 4 - ip zarizeni neni v databazi
 * status[0] = 5 - kod neprosel do databaze
 * 
 * status[1] = 0 - je pridany komentar
 * status[1] = 1 - neni pridany komentar
 */


$ip_list = array();/**list na ip v databazi */

/**kontroluje zda-li je komentar dostatecne dlouhy */
if (strlen($text) > 2) {
    $status[1] = 0;
} else {
    $status[1] = 1;
    $text = "";
}
/** Ziskani IP adres z databaze */
$sqlip = "SELECT * FROM IPS";
$fetchip = mysqli_query($conn, $sqlip);
while ($rowip = mysqli_fetch_assoc($fetchip)) {
    array_push($ip_list, $rowip['ip_address']);
}


$checkfrom = 0;/** promena udava zdal-li existuje validni smena co zacala vcera */
/** SQL prikaz na vyhledani vcerejsich smen */
$sqly = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
/** SQL prikaz na vyhledani dnesnich smen */
$fetchy = mysqli_query($conn, $sqly);
$sqltd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
$fetchtd = mysqli_query($conn, $sqltd);
if (mysqli_num_rows($fetchy) > 0) {
    while ($row_y = mysqli_fetch_assoc($fetchy)) {
        $id_plan = $row_y['id'];
        $st = $row_y['saved_from'];
        $en = $row_y['saved_to'];
    }
    if (strtotime($st) >= strtotime($en)) {
        if (strtotime(date('H:i:s')) < strtotime($st)) {

            $checkfrom = 1;

            if (strtotime($en) < strtotime($currentTime)) {
                $status[0] = 1;
                if ($status[1] == 0) {
                    $status[0] = 0;
                    $sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                    checkip($ip_address);
                    if ($status[0] != 4) {
                        if (!mysqli_query($conn, $sqlupdate)) {
                            $status[0] = 5;
                        }
                    }

                }
                echo json_encode($status);

            } else if (strtotime($en) > strtotime($currentTime) && strtotime($en) - 600 > strtotime($currentTime)) {
                $status[0] = 2;
                if ($status[1] == 0) {
                    $status[0] = 0;
                    $sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                    checkip($ip_address);
                    if ($status[0] != 4) {
                        if (!mysqli_query($conn, $sqlupdate)) {
                            $status[0] = 5;
                        }
                    }

                }
                echo json_encode($status);

            } else {
                $status[0] = 0;
                $sqlupdate = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=1 WHERE planned_id=$id_plan  ";
                checkip($ip_address);
                if ($status[0] != 4) {
                    if (!mysqli_query($conn, $sqlupdate)) {
                        $status[0] = 5;
                    }
                }
                echo json_encode($status);

            }





        }
    }


}
if ($checkfrom == 0) {
    if (mysqli_num_rows($fetchtd) > 0) {
        while ($row_td = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td = $row_td['id'];
            $st_td = $row_td['saved_from'];
            $en_td = $row_td['saved_to'];
        }
        if (strtotime($en_td) < strtotime($currentTime)) {
            $status[0] = 1;
            if ($status[1] == 0) {
                $status[0] = 0;
                $sqlupdate_td = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE planned_id=$id_plan_td  ";
                checkip($ip_address);
                if ($status[0] != 4) {
                    if (!mysqli_query($conn, $sqlupdate_td)) {
                        $status[0] = 5;

                    }
                }

            }
            echo json_encode($status);

        } else if (strtotime($en_td) > strtotime($currentTime) && strtotime($en_td) - 600 > strtotime($currentTime)) {
            $status[0] = 2;
            if ($status[1] == 0) {
                $status[0] = 0;
                $sqlupdate_td = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE planned_id=$id_plan_td  ";
                checkip($ip_address);
                if ($status[0] != 4) {
                    if (!mysqli_query($conn, $sqlupdate_td)) {
                        $status[0] = 5;
                    }
                }

            }
            echo json_encode($status);

        } else {
            $status[0] = 0;
            $sqlupdate_td = "UPDATE attendance SET log_to='$currentTime', com_to='$text', delay_dep=0 WHERE planned_id=$id_plan_td  ";
            checkip($ip_address);
            if ($status[0] != 4) {
                if (!mysqli_query($conn, $sqlupdate_td)) {
                    $status[0] = 5;
                }
            }
            echo json_encode($status);

        }
    }

}



/**funkce kontroluje ip adresu zarizeni*/
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