<?php

$mysqli = require("database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$firstname = "Plan";
$middlename = "&";
$lastname = "Go";
$email = "plangotester@gmail.com";
$password = "Qwerty123#";
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$countryCode = 420;
$phone = 0;
$position = "admin";
$sql = "INSERT INTO user (firstname, middlename, lastname, email, password_hash, countryCode, phone, position)
VALUES ('$firstname','$middlename', '$lastname', '$email', '$password_hash',$countryCode, $phone ,'$position' )";
if (!mysqli_query($conn, $sql)) {
    die("SQL prikaz se nepodaril inicializovat");
}else{
    die("SQL prukaz se podaril inicializovat");
}


?>