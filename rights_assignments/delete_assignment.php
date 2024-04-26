<?php
 $mysqli = require("../database.php");

 $conn = new mysqli($host, $username, $password, $dbname);

 $input = $_POST['input'];
 $id = $_POST['id'];
 $sqlt = "DELETE FROM shift_assignment WHERE shift_id='$id' AND user_id='$input' ";
 if (!mysqli_query($conn, $sqlt)) {
    die('Error: ' . mysqli_error($conn));
}
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>