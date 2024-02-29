<?php
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];
$text = $_POST['text'];
$currentTime = date('H:i:s'); 
$currentDate= date('Y-m-d'); 
$start = array();
$status[] = array();
$status[0] = 1;
$status[1] = 0;
echo json_encode($status);
?>