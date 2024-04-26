<?php
/**tento soubor nacita text zpravy pro nastenku z databaze */
$mysqli = require("../database.php");
$conn = new mysqli($host, $username, $password, $dbname);
$input = $_POST['input']; /** id zpravy */
$sql = " SELECT * FROM board WHERE id_board= $input";
$get = mysqli_query($conn, $sql);
$content;
while ($row = $get->fetch_assoc()) {
    $content = $row['content'];
}
$conn->close();
echo json_encode($content);
?>