<?php
//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");


/** parametry */
$ip1 = $_POST['ip1'];
$ip2 = $_POST['ip2'];
$ip3 = $_POST['ip3'];
$ip4 = $_POST['ip4'];
$description = $_POST['description'];
$status = 0;

/** smeny se pridavaji z arraye */
$conn = new mysqli($host, $username, $password, $dbname);
ip_stat ($ip1);
ip_stat ($ip2);
ip_stat ($ip3);
ip_stat ($ip4);
function ip_stat ($ip){
global $status;
if($ip ==null){
    $status = 1;
}else{
    if(true == isNumeric($ip)){
        if((int)$ip > 255 || (int)$ip < 0){
            $status = 1;
        }

    }else{
        $status = 1;
    }
}
}

function isNumeric($str) 
{ 
    return ctype_digit($str); 
} 

if($status == 0){
    
    $final_ip = (int)$ip1. ".".  (int)$ip2. ".". (int)$ip3. ".". (int)$ip4;
    $sql_check = "SELECT * FROM IPS WHERE ip_address = '$final_ip' ";
    $check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($check) == 0) {

    $sql = "INSERT INTO IPS (ip_address, ip_description) VALUES ('$final_ip', '$description')";
    if (!mysqli_query($conn, $sql)) {

    }
}else{
    $status = 2;
}

}

echo json_encode($status);
?>