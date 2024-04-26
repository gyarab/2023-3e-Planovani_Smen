<?php
$data;
$mysqli = require ("../database.php");
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_POST['id'];
$old_hash;
$old_password = $_POST['old_p'];
$new_password = $_POST['new_p'];
$again_password = $_POST['again_p'];
$status = array();
$sql_user = "SELECT password_hash FROM user2 WHERE id=$id";
$fetch = mysqli_query($conn, $sql_user);
while ($row = mysqli_fetch_assoc($fetch)) {
    $old_hash = $row['password_hash'];
}


if (password_verify($old_password, $old_hash)) {
    if (strlen($new_password) < 8) {
        array_push($status, 2);
    }


    if (!preg_match("/[a-z]/i", $new_password)) {
        array_push($status, 3);
    }


    if (!preg_match("/[0-9]/", $new_password)) {
        array_push($status, 4);
    }

    if (!preg_match("/[A-Z]/", $new_password)) {
        array_push($status, 5);
    }
    if ($new_password != $again_password) {
        array_push($status, 6);
    }
} else {
    array_push($status, 1);
}

if (count($status) == 0) {
    $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE user2 SET password_hash = '$new_hash'  WHERE id=$id";
    if (!mysqli_query($conn, $sql)) {

    }
}

echo json_encode($status);
?>