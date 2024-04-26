<?php
/**tento soubor aktualizuje zvolenou zpravu na nastence */

$text = $_POST['text'];/**text zpravy */
$caption = $_POST['caption'];/**nadpis zpravy */
$color = $_POST['color'];/**barva zpravy */
$man = $_POST['man'];/**hodnota pro manazera (0,1)*/
$part = $_POST['part'];/**hodnota pro zamestnance na polovicni uvazek (0,1) */
$full = $_POST['full'];/**hodnota pro zamestnance na plny uvazek(0,1)  */
$input = $_POST['input'];/** id zpravy */


$mysqli = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);

$sql = "UPDATE board SET caption = '$caption', content = '$text', color = '$color', employee_full = $full, employee_part = $part, manager = $man  WHERE id_board = $input";

    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn));
    }
    if (mysqli_connect_errno()) {
        print "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>