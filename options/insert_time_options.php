<?php
$fromArr = json_decode($_POST["from"]);
$toArr = json_decode($_POST["to"]);
$dateArr = json_decode($_POST["date"]);
$id_user = $_POST["id"];
$YM = $_POST['dateym'];
$time = time();
$mysqli = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

for ($x = 0; $x < count($fromArr); $x++) {
    if ($fromArr[$x] != "" && $toArr[$x] != "") { /*not allowing empty values and the row which has been removed.*/


$check_unique_row = mysqli_query($conn, "SELECT * FROM time_options WHERE saved_date = '$dateArr[$x]' AND id_user='$id_user'");

        if (mysqli_num_rows($check_unique_row) == 0) {

            $sql = "INSERT INTO time_options (id_user, saved_date, opt_from, opt_to, up_timestamp)
VALUES
($id_user,'$dateArr[$x]','$fromArr[$x]','$toArr[$x]','$time')";

            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }

        } else {
            $sqlsav = "UPDATE time_options SET opt_from='$fromArr[$x]', opt_to='$toArr[$x]' , up_timestamp='$time' WHERE saved_date='$dateArr[$x]' AND id_user='$id_user'";
            $conn->query($sqlsav);
        }
    }
}
$day = "";

for ($x = 0; $x < count($fromArr); $x++) {
    for( $z = 1; $z < 32; $z++) {
        if($z <10){
            $day = "0" . $z;
        }else{
            $day = $z;
        }
        $date = $YM . "-". $day;
        $up_time = "SELECT * FROM time_options WHERE saved_date = '$date' AND id_user = $id_user";
        $result = $conn->query($up_time);
        while($row = $result->fetch_assoc()) {
            $last_up = $row['up_timestamp'];
        }
        if($last_up < $time) {
            $sqldel = "DELETE FROM time_options WHERE saved_date = '$date' AND id_user = $id_user";
            $conn->query($sqldel);
        }
    }
}
print "Data added Successfully !";
mysqli_close($conn)
?>