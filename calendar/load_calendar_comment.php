<?php

$mysqli = require ("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$date = $_POST['date'];
$id = $_POST['id'];

$sql = " SELECT * FROM saved_shift_data WHERE saved_date = '$date' AND id_of_shift = $id";
$get = mysqli_query($conn, $sql);
$content;
while ($row = $get->fetch_assoc()) {
    $content = $row['comments'];

}
$conn->close();
echo json_encode($content);
?>