<?php

//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$date = $_POST['date'];
$id = $_POST['id'];

$sql = " SELECT * FROM saved_shift_data WHERE saved_date = '$date' AND id_of_shift = $id";
$get = mysqli_query($conn, $sql);
$content;
while ($row = $get->fetch_assoc()) {
    //$saved_data[0] = $row['caption'];
    $content = $row['comments'];
    /*$saved_data[2] = $row['color'];
    $saved_data[3] = $row['employee_full'];
    $saved_data[4] = $row['employee_part'];
    $saved_data[5] = $row['manager'];
    $saved_data[1] = str_replace("\n","&#13;",$saved_data[1]);*/

}
$conn->close();
echo json_encode($content);
?>