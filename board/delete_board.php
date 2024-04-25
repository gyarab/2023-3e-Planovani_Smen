<?php
//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");
$conn = new mysqli($host, $username, $password, $dbname);
$input = $_POST['input'];
$sql = "DELETE FROM board WHERE id_board= $input";
if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn));
}

?>