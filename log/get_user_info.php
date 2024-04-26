<?php
$data = array();
$id = $_POST['id'];

$mysqli = require ("../database.php");


$conn = new mysqli($host, $username, $password, $dbname);

$sql = " SELECT * FROM user2 WHERE id='$id' ";
$fetch = mysqli_query($conn, $sql);
while ($rows = $fetch->fetch_assoc()) {
    $data[0] = $rows['id'];
    $data[1] = $rows['firstname'];
    $data[2] = $rows['middlename'];
    $data[3] = $rows['lastname'];
    $data[4] = $rows['email'];
    $data[5] = $rows['countryCode'];
    $data[6] = $rows['phone'];
    $data[7] = $rows['position'];
}




echo json_encode($data);
?>