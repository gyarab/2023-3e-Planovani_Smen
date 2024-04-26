<?php
/**tento soubor nacita zpravu pro nastenku z databaze
 * (nenacita text zpravy) */
$mysqli = require("../database.php");
$conn = new mysqli($host, $username, $password, $dbname);
$input = $_POST['input'];/**id zpavy */
$sql = " SELECT * FROM board WHERE id_board= $input";
$get = mysqli_query($conn, $sql);
$saved_data = array();
while ($row = $get->fetch_assoc()) {
    $saved_data[0] = $row['color'];
    $saved_data[1] = $row['employee_full'];
    $saved_data[2] = $row['employee_part'];
    $saved_data[3] = $row['manager'];
    $saved_data[4] = $row['caption'];

}
$conn->close();
echo json_encode($saved_data);
?>