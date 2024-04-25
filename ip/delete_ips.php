<?php
//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$description = $_POST['description'];
$id = $_POST['id'];

$sql_check = "SELECT * FROM IPS WHERE id_ip = $id ";
$sql = "DELETE FROM IPS WHERE id_ip = $id ";
$check = mysqli_query($conn, $sql_check);
if (mysqli_num_rows($check) != 0) {
    if (!mysqli_query($conn, $sql)) {
        print "Data was not deleted Successfully !";
    } else {
        print "Data deleted Successfully !";
    }
} else {
    print "Data was not deleted Successfully !";

}


?>