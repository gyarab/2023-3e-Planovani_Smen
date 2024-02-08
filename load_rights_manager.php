<?php
$mysqli = require __DIR__ . "/database.php";
$input = $_POST['input'];
$conn = new mysqli($host, $username, $password, $dbname);
$sql = "SELECT * FROM manager_rights WHERE id_user='$input' ";
$result_get = $mysqli->query($sql);
echo "<p style='display: inline'>";
while ($rows_get = $result_get->fetch_assoc()) {
    $get_name = $rows_get['object_name'];
    $get_id = $rows_get['object_id'];
    /*$get_id = $rows_get['id_user'];
    $get_name = $rows_get['user_name'];*/

    echo $get_name. " - " . $get_id;
}
echo "</p>";
?>