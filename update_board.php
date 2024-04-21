<?php
$text = $_POST['text'];
$caption = $_POST['caption'];
$color = $_POST['color'];
$man = $_POST['man'];
$part = $_POST['part'];
$full = $_POST['full'];
$input = $_POST['input'];


$mysqli = require __DIR__ . "/database.php";

$conn = new mysqli($host, $username, $password, $dbname);

$sql = "UPDATE board SET caption = '$caption', content = '$text', color = '$color', employee_full = $full, employee_part = $part, manager = $man  WHERE id_board = $input";

    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn));
    }
    if (mysqli_connect_errno()) {
        print "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>