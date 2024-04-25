<?php
//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");

$input = $_POST['input'];
$conn = new mysqli($host, $username, $password, $dbname);
$sql = "SELECT * FROM manager_rights WHERE id_user='$input' ";
$result = mysqli_query($conn, $sql);
$arr = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $l =$row['object_id'];
        array_push($arr,$l);
    }
}
echo json_encode($arr);
?>