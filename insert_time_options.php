<?php
$fromArr = json_decode($_POST["from"]);
$toArr = json_decode($_POST["to"]);
$dateArr = json_decode($_POST["date"]);
$id_user = $_POST["id"];
$YM = $_POST['dateym'];
$time = time();
$mysqli= require __DIR__ . "/database.php";
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
            /*$sql2 = "INSERT INTO attendance (planned_from, planned_to, date, user_id, user_name)
            VALUES
            ('$fromArr[$x]','$toArr[$x]','$dateArr[$x]','$namesidArr[$x]','$nameArr[$x]')";*/
            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            /*if (!mysqli_query($con, $sql2)) {
                die('Error: ' . mysqli_error($con));
            }*/
        } else {
            $sqlsav = "UPDATE time_options SET opt_from='$fromArr[$x]', opt_to='$toArr[$x]' , up_timestamp='$time' WHERE saved_date='$dateArr[$x]' AND id_user='$id_user'";
            //$sqlsav = "UPDATE saved_shift_data SET saved_from='$fromArr[$x]', saved_to='$toArr[$x]' , up_timestamp='$time', id_user='$namesidArr[$x]', user_name='$nameArr[$x]' WHERE saved_date='$dateArr[$x]' AND id_of_shift='$idArr[$x]'";
            $conn->query($sqlsav);
        }
    }
}
$day = "";

for ($x = 0; $x < count($fromArr); $x++) {
    
    /*$year = substr($YM, 0,-3);
    $month = substr($YM, -2);
    $check_shift = "SELECT * FROM shift_check WHERE id_shift = '$deleteArr[$x]' AND year_shift='$year' AND month_shift='$month'";
    $check_unique_save = mysqli_query($con, $check_shift);*/
    /*if (mysqli_num_rows($check_unique_save) == 0) {
        $sql_shift = "INSERT INTO shift_check (id_shift, year_shift, month_shift)
        VALUES
('$deleteArr[$x]','$year','$month')";
            if (!mysqli_query($con, $sql_shift)) {
                die('Error: ' . mysqli_error($con));
            }
    }*/
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