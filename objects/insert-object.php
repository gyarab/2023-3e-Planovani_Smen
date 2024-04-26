<?php
 $mysqli = require("../database.php");

 $conn = new mysqli($host, $username, $password, $dbname);

 $in = $_POST['input'];
 $emp = "";
 $id = 0;
 $sql = "INSERT INTO list_of_objects (object_name,superior_object_name, superior_object_id)
 VALUES
 ('$in','$emp','$id')";
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
?>