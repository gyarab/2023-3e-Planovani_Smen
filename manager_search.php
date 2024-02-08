<?php
$mysqli = require __DIR__ . "/database.php";

$conn = new mysqli($host, $username, $password, $dbname);

$input = $_POST['input'];
if($input != null && $input != ""){
$query = "SELECT * FROM user2 WHERE position='manager' AND firstname LIKE '{$input}%' OR middlename LIKE '{$input}%' OR lastname LIKE '{$input}%' ";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $lastname = $row['lastname'];
        //$position = $row['position'];
        //$email = $row['email'];
        //$code = $row['countryCode'];
        //$phone = $row['phone'];
        //$ps;
        echo "<input id='manager-".$id."' type='button' onclick='Pick_manger(this.id)' class='btn btn-outline-dark' value='".$firstname." ".$middlename." ".$lastname."'>";
    }
}else{
    echo"<h6>No data found<h6>";
}
}
?>