<?php

/** soubor pridava do pridelene smeny k zamestnanci ze souboru rights.php  */
//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");


/** parametry */
$id_user = $_POST['id_user'];
$name_object = $_POST['name'];
$arrshi = $_POST['id'];

/** smeny se pridavaji z arraye */
$conn = new mysqli($host, $username, $password, $dbname);
if (count($arrshi) != 0) {
    
    for ($i = 0; $i < count($arrshi); $i++) {
        /** forcyklus ktery pridava do tabulky shift_assignment */
        /** id_user = 28
         *  name_object = [0]'Poklad' [1]'Dozor' -- tehle retezec je tu pro abecedni razeni pri dalsim pouzivani dat
         *  arrshi = [0] 231 [1] 245
         *  SQL INSERT==>
         *  user_id | shift_id | shift_name
         *  28      | 231      | Pokladna
         *  28      | 245      | Dozor
         */
        /** check_right kontroluje zda-li v databazi neni uzivatel nema uz tu smenu pridelenou -- zabranuje duplikaci  */
        $check_right = "SELECT * FROM shift_assignment WHERE user_id = '$id_user' AND shift_id='$arrshi[$i]' ";
        $check_unique_save = mysqli_query($conn, $check_right);
        if (mysqli_num_rows($check_unique_save) == 0) {
            $sql = "INSERT INTO shift_assignment (user_id, shift_id, shift_name)
        VALUES ('$id_user','$arrshi[$i]','$name_object[$i]')";

            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }
    }

}
?>