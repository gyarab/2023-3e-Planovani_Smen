<?php
/** tento soubor pridava do databaze uzivatele, 
 * zaroven vraci arr s hodnotami co je postreba v formulari vyplnit  */

 /**Statusy
  * - 1 - uzivatel neuvedl jmeno
  * - 2 - uzivatel neuvedl prijmeni
  * - 3 - enail neodpozi stavbe emailove adresy 
  * - 4 - heslo je moc kratke (musi byt alespon 8 znaku dlouhe)
  * - 5 - heslo neobsahuje male pismeno
  * - 6 - heslo neobsahuje cislici
  * - 7 - heslo neobsahuje velke pismeno
  * - 8 - heslo se nerovna s druhym heslem pro vertifikaci
  * - 9 - telefoni cislo obsahuje jine znaky nez cislice
  * - 10 - email uz v databazi existuje  
  *
  */


  
  $firstname = "";
  $middlename = "";
  $lastname = "";
  
  $password_hash = "";
  $countryCode = "";
  $phone = "";
  $position = "";
  $pass = "jkj";
  $sql = "";

  
$mysqli = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$status = array();

if (empty($_POST["firstname"])) {
    array_push($status,1);
}

if (empty($_POST["lastname"])) {
    array_push($status,2);
}

$email = $_POST["email"];
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    array_push($status,3);
}else{
    $sql_check = "SELECT * FROM user WHERE email = '$email'";
    $fetch_check = mysqli_query($conn, $sql_check);
    $sql_check2 = "SELECT * FROM verification WHERE email = '$email'";
    $fetch_check2 = mysqli_query($conn, $sql_check2);
    if(mysqli_num_rows($fetch_check) != 0){
        array_push($status,10);
    }else if(mysqli_num_rows($fetch_check2) != 0){
        array_push($status,10);
    }
}


if (strlen($_POST["password"]) < 8) {
    array_push($status,4);
}


if (!preg_match("/[a-z]/i", $_POST["password"])) {
    array_push($status,5);
}


if (!preg_match("/[0-9]/", $_POST["password"])) {
    array_push($status,6);
}

if (!preg_match("/[A-Z]/", $_POST["password"])) {
    array_push($status,7);
}

if ($_POST["password"] != $_POST["password_confirmation"]) {
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
if(count($status) == 0){
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $countryCode = $_POST["countryCode"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    /**posilani overovaciho emailu */
    $verification_code = generateRandomString();

    $subject = "PLAN & GO verification Code";

    $message = '
    <!DOCTYPE html>
    <html>
    <head>
      <title>PLAN & GO verification Code</title>
      <style>
      
      </style>
    </head>
    <body style="width:100%;height: 600px;backgroundColor: rgba(118,184,82,1)">
    
    <center>
    <h1 style="font-size:40px">You had been added to a PLAN & GO organization</h1>
    <p>Here is your verification code: <strong>'.$verification_code.'</strong></p>
    
    </center>
    
    </body>
    </html>
    ';
    
    $headers = "From: michal.vakula@gmail.com" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8";
    
    if (mail($email, $subject, $message, $headers)) {
    } else {
    }


    if($phone == null){
        $phone = 000000000;
    }
    $sql = "INSERT INTO verification (firstname, middlename, lastname, email, password_hash, countryCode, phone, position, verificationCode)
    VALUES ('$firstname','$middlename', '$lastname', '$email', '$password_hash',$countryCode, $phone ,'$position','$verification_code' )";
    if (!mysqli_query($conn, $sql)) {

    }
}


/**generace nahodneho vertifikacniho kodu */
function generateRandomString($length = 6) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

echo json_encode($status);

?>