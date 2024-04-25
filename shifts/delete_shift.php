<?php
// $mysqli = require __DIR__ . "/database.php";
 $mysqli = require("../database.php");

 $conn = new mysqli($host, $username, $password, $dbname);

 $input = $_POST['input'];

 $sqlt = "DELETE FROM create_shift WHERE id_shift='$input' ";
 if (!mysqli_query($conn, $sqlt)) {
    die('Error: ' . mysqli_error($conn));
}
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>