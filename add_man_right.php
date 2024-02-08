<?php
 $mysqli = require __DIR__ . "/database.php";

$id_user = $_POST['id_user'];
$id_object = $_POST['id_object'];
$name_object = $_POST['name_object'];
 $conn = new mysqli($host, $username, $password, $dbname);
 $sql = "INSERT INTO manager_rights (id_user, object_id, object_name)
 VALUES ('$id_user','$id_object','$name_object')";


if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn));
}
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>