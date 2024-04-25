<?php
//$mysqli_sav = require __DIR__ . "/database.php";
$mysqli_sav = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['input'];
$sql = " SELECT * FROM permanent_time_options WHERE id_user='$id'";
$get = mysqli_query($conn, $sql);
$saved_data[]= array();
while ($row = $get->fetch_assoc()) {
    $saved_data[0] = $row['monday'];
    $saved_data[1] = $row['mon_from'];
    $saved_data[2] = $row['mon_to'];
    $saved_data[3] = $row['tuesday'];
    $saved_data[4] = $row['tue_from'];
    $saved_data[5] = $row['tue_to'];
    $saved_data[6] = $row['wednesday'];
    $saved_data[7] = $row['wed_from'];
    $saved_data[8] = $row['wed_to'];
    $saved_data[9] = $row['thursday'];
    $saved_data[10] = $row['thu_from'];
    $saved_data[11] = $row['thu_to'];
    $saved_data[12] = $row['friday'];
    $saved_data[13] = $row['fri_from'];
    $saved_data[14] = $row['fri_to'];
    $saved_data[15] = $row['saturday'];
    $saved_data[16] = $row['sat_from'];
    $saved_data[17] = $row['sat_to'];
    $saved_data[18] = $row['sunday'];
    $saved_data[19] = $row['sun_from'];
    $saved_data[20] = $row['sun_to'];
    $saved_data[21] = $row['id_user'];
}
$conn->close();
echo json_encode($saved_data);
?>