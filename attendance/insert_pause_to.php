<?php
/** soubor zaznamenava konce pauz */
$mysqli = require("../database.php");
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];/**id uzivatele */
$y = date('Y-m-d', strtotime("-1 days"));/** vcerejsi datum */
$currentTime = date('H:i:s');/** soucasny cas */
$td = date('Y-m-d');/** soucasny den */

$checkfrom = 0;/** promena udava zdal-li existuje validni smena co zacala vcera */
/** SQL prikaz na vyhledani vcerejsich smen */
$sqly = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
$fetchy = mysqli_query($conn, $sqly);
/** SQL prikaz na vyhledani dnesnich smen */
$sqltd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$id' AND saved_shift_data.id  IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
$fetchtd = mysqli_query($conn, $sqltd);
/**vcerejsi hledani */
if (mysqli_num_rows($fetchy) > 0) {
    $checkfrom = 1;
    while ($row_y = mysqli_fetch_assoc($fetchy)) {
        $id_plan_y = $row_y['id'];
        $fetch_from_y = mysqli_query($conn, "SELECT pause_to FROM attendance WHERE planned_id = $id_plan_y ");
        while ($row_y_from = mysqli_fetch_assoc($fetch_from_y)) {
            $pause_to_y = $row_y_from['pause_to'];
        }
    }
    /**pokud uzivatel uz mel pauzu uzivatel, program pripise novou pauzu a oddeli je znaky || */
    if($pause_to_y != null){
        $sqly_insert = "UPDATE attendance SET pause_to='$pause_to_y||$currentTime' WHERE planned_id=$id_plan_y";

    }else{
    $sqly_insert = "UPDATE attendance SET pause_to='$currentTime' WHERE planned_id=$id_plan_y";
    }
    if (!mysqli_query($conn, $sqly_insert)) {
        
    }


}
/**dnesni hledani */
if($checkfrom == 0){
    if (mysqli_num_rows($fetchtd) > 0) {
        while ($row_td = mysqli_fetch_assoc($fetchtd)) {
            $id_plan_td = $row_td['id'];
            $fetch_from_td = mysqli_query($conn, "SELECT pause_to FROM attendance WHERE planned_id = $id_plan_td ");
            while ($row_td_from = mysqli_fetch_assoc($fetch_from_td)) {
                $pause_to_td = $row_td_from['pause_to'];
            }
        }
        if($pause_to_td != null){
            $sqltd_insert = "UPDATE attendance SET pause_to= '$pause_to_td||$currentTime' WHERE planned_id=$id_plan_td";
            echo json_encode($pause_to_td);

        }else{
        $sqltd_insert = "UPDATE attendance SET pause_to='$currentTime' WHERE planned_id=$id_plan_td";
        echo json_encode( $pause_to_td);

        }
        if (!mysqli_query($conn, $sqltd_insert)) {
            
        }
    
    
    }
}
?>