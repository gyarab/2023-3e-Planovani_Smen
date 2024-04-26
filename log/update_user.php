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


$mysqli = require ("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$status = array();

if (empty($_POST["firstname"])) {
    array_push($status, 1);
}

if (empty($_POST["lastname"])) {
    array_push($status, 2);
}

$email = $_POST["email"];
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    array_push($status, 3);
} else {

}

if (strlen($_POST["password"]) != 0) {
if (strlen($_POST["password"]) < 8) {
    array_push($status, 4);
}




    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        array_push($status, 5);
    }


    if (!preg_match("/[0-9]/", $_POST["password"])) {
        array_push($status, 6);
    }

    if (!preg_match("/[A-Z]/", $_POST["password"])) {
        array_push($status, 7);
    }

if ($_POST["password"] != $_POST["password_confirmation"]) {
    array_push($status, 8);
}
}
if (strlen($_POST["phone"]) > 0) {
    $g = isNumeric($_POST["phone"]);
} else {
    $g = true;
}
if ($g == false) {
    array_push($status, 9);
}

function isNumeric($str)
{
    return ctype_digit($str);
}
if (count($status) == 0) {

    if ($phone == null) {
        $phone = 000000000;
    }    
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    
    $countryCode = $_POST["countryCode"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    $id = $_POST["id"];
    if(strlen($_POST["password"]) != 0){
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "UPDATE user SET firstname = '$firstname'  ,middlename = '$middlename',lastname = '$lastname' ,email = '$email' ,password_hash = '$password_hash',countryCode = $countryCode ,phone =  $phone  ,position = '$position' WHERE id = $id";
    }else{
    
    $sql = "UPDATE user SET firstname = '$firstname'  ,middlename = '$middlename',lastname = '$lastname' ,email = '$email',countryCode = $countryCode ,phone =  $phone  ,position = '$position' WHERE id = $id";
    }
    if (!mysqli_query($conn, $sql)) {
    }
}



function generateRandomString($length = 6)
{

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
echo json_encode($status);

?>