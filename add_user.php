<?php
$mysqli = require __DIR__ . "/database.php";
$conn = new mysqli($host, $username, $password, $dbname);
$status = array();

if (empty($_POST["firstname"])) {
    //$firstnameis_invalid = false;
    array_push($status,1);
}

if (empty($_POST["lastname"])) {
    //$lastnameis_invalid = false;

    array_push($status,2);
}
$email = $_POST["email"];
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    //$emailis_invalid = true;
    array_push($status,3);
}else{
    $sql_check = "SELECT * FROM user2 WHERE email = '$email'";
    $fetch_check = mysqli_query($conn, $sql_check);
    if(mysqli_num_rows($fetch_check) != 0){
        array_push($status,10);
    }
}


if (strlen($_POST["password"]) < 8) {
    //$passwordlenghtis_invalid = true;
    array_push($status,4);
}


if (!preg_match("/[a-z]/i", $_POST["password"])) {
    //$passwordcharis_invalid = true;
    array_push($status,5);
}


if (!preg_match("/[0-9]/", $_POST["password"])) {
    //$passwordnumberis_invalid = true;
    array_push($status,6);
}
if (!preg_match("/[A-Z]/", $_POST["password"])) {
    //$passwordnumberis_invalid = true;
    array_push($status,7);
}

if ($_POST["password"] !== $_POST["password_confirmation"] /*&& $_POST["password"] != null && $_POST["password_confirmation"] != null*/) {
    //$passwordmatchis_invalid = true;
    array_push($status,8);
}
if (strlen($_POST["phone"]) > 0) {
$g = isNumeric($_POST["phone"]);
}else{
    $g  =true;
}
if($g == false){
    array_push($status,9);
}

function isNumeric($str) 
{ 
    return ctype_digit($str); 
} 
//echo json_encode($g);
if(count($status) == 0){
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $countryCode = $_POST["countryCode"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    //echo json_encode($phone);
    $sql = "INSERT INTO user2 (firstname, middlename, lastname, email, password_hash, countryCode, phone, position)
    VALUES ('$firstname','$middlename', '$lastname', '$email', '$password_hash',$countryCode, $phone ,'$position' )";
 //echo json_encode($sql);
    if (!mysqli_query($conn, $sql)) {
        //die('Error: ' . mysqli_error($conn));
        //echo json_encode(mysqli_error($conn));
    }
}

echo json_encode($status);
?>