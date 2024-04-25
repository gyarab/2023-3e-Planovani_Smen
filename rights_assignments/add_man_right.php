<?php
/**tento soubor pridava do dotabaze editovaci prova managerum */

//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");


$id_user = $_POST['id_user'];/**- id managera */
$id_object = $_POST['id_object']; /** -id objektu na pridani  */
$name_object = $_POST['name_object'];/** -jmena objektu na pridani - slozi pro abecedni razeni  */
$arr = $_POST['arr'];/** -id seznam vsech objetku podrazeny objektu */
$branch = $_POST['branch'];/** -udava zdali se bude pridavat jeden objekt (hodnota je 1) nebo vicero objektu (hodnota je 0) */
$type = $_POST['type']; /** -udava zda-li se do database budou pridavat prava (hodnota je 0) nebo odebirat prava (hodnota je 1)*/
$conn = new mysqli($host, $username, $password, $dbname);
/**pridavani prav */
if ($type == 0) {
    if ($branch == 1) {
        $check_right = "SELECT * FROM manager_rights WHERE id_user = '$id_user' AND object_id='$id_object' ";
        $check_unique_save = mysqli_query($conn, $check_right);
        /**predtim nez se do databaze prida pravo, program zkontroluje zda-li uzivatel uz nema tato prava
         * --> zabranuje duplikaci
          */
        if (mysqli_num_rows($check_unique_save) == 0) {
            $sql = "INSERT INTO manager_rights (id_user, object_id, object_name)
        VALUES ('$id_user','$id_object','$name_object')";


            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }
    } else {
        $check_right = "SELECT * FROM manager_rights WHERE id_user = '$id_user' AND object_id='$id_object' ";
        $check_unique_save = mysqli_query($conn, $check_right);
        if (mysqli_num_rows($check_unique_save) == 0) {
            /**pridani hlavniho objekt  */
            $sql = "INSERT INTO manager_rights (id_user, object_id, object_name)
        VALUES ('$id_user','$id_object','$name_object')";


            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }
        /**pridani pod-objektu ze seznamu pres forcyklus  */
        for ($i = 0; $i < count($arr); $i++) {
            $sel = "SELECT * FROM list_of_objects WHERE id_object = '$arr[$i]' ";
            $result = mysqli_query($conn, $sel);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id_object'];
                $name = $row['object_name'];
            }
            $select_check = "SELECT * FROM manager_rights WHERE id_user = '$id_user' AND object_id='$arr[$i]' ";
            $check_unique = mysqli_query($conn, $select_check);
            if (mysqli_num_rows($check_unique) == 0) {
                $sql_sub = "INSERT INTO manager_rights (id_user, object_id, object_name)
 VALUES ('$id_user','$arr[$i]','$name')";


                if (!mysqli_query($conn, $sql_sub)) {
                    die('Error: ' . mysqli_error($conn));
                }
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
            }
        }
    }
    /**odebirani prav */
} else {
    if ($branch == 1) {
        $check_right = "SELECT * FROM manager_rights WHERE id_user = '$id_user' AND object_id='$id_object' ";
        $check_unique_save = mysqli_query($conn, $check_right);
        if (mysqli_num_rows($check_unique_save) == 0) {

        } else {
             /**odebrani hlavniho objekt  */
            $sql = "DELETE FROM manager_rights WHERE id_user = '$id_user' AND object_id='$id_object' ";
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }
    } else {
        $check_right = "SELECT * FROM manager_rights WHERE id_user = '$id_user' AND object_id='$id_object' ";
        $check_unique_save = mysqli_query($conn, $check_right);
        if (mysqli_num_rows($check_unique_save) == 0) {

        }else{
            $sql = "DELETE FROM manager_rights WHERE id_user = '$id_user' AND object_id='$id_object' ";
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }
           /**odebrani pod-objektu ze seznamu pres forcyklus  */
        for ($i = 0; $i < count($arr); $i++) {
            $sel = "SELECT * FROM list_of_objects WHERE id_object = '$arr[$i]' ";
            $result = mysqli_query($conn, $sel);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id_object'];
                $name = $row['object_name'];
            }
            $select_check = "SELECT * FROM manager_rights WHERE id_user = '$id_user' AND object_id='$arr[$i]' ";
            $check_unique = mysqli_query($conn, $select_check);
            if (mysqli_num_rows($check_unique) == 0) {

            }else{
                $sql_sub = "DELETE FROM manager_rights WHERE id_user = '$id_user' AND object_id='$arr[$i]' ";
                if (!mysqli_query($conn, $sql_sub)) {
                    die('Error: ' . mysqli_error($conn));
                }
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
            }
        }
    }
    

}
echo json_encode("Saved successfully");
?>