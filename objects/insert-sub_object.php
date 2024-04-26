<?php
 $mysqli = require("../database.php");

 $conn = new mysqli($host, $username, $password, $dbname);

 $in = $_POST['name'];
 $sup = $_POST['sup'];
 $id = $_POST['id'];
 $sql = "INSERT INTO list_of_objects (object_name,superior_object_name, superior_object_id)
 VALUES
 ('$in','$sup','$id')";
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
?>