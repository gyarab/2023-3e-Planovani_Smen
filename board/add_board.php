<?php
/**tento soubor uklada do database zpravy na nastenku */
$text = $_POST['text'];/** - text */
$caption = $_POST['caption'];/** - nadpis */
$color = $_POST['color'];/** - barva */
/**indexy pro managery - $man, part-time emplyees - $part, full-time employess - $full
 * -tyto indexy udavaji, ktera pozice muze vydet muze vydet prispevek na nastence 
 * -0 znamena,ze pozice nemuze prispevek videt 
 * -1 znamena,ze pozice muze prispevek videt 
 */
$man = $_POST['man'];
$part = $_POST['part'];
$full = $_POST['full'];

//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);

$sql = "INSERT INTO board (caption, content, color, employee_full, employee_part, manager) VALUES ('$caption','$text','$color','$full','$part','$man')";

    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn));
    }
    if (mysqli_connect_errno()) {
        print "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>