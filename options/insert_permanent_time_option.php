<?php
$mysqli = require ("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);



$mon_f = $_POST['monf'];
$mon_f = substr($mon_f, 1, -1);
$mon_t = $_POST['mont'];
$mon_t = substr($mon_t, 1, -1);
$mon = $_POST['mond'];

$tue_f = $_POST['tuef'];
$tue_f = substr($tue_f, 1, -1);
$tue_t = $_POST['tuet'];
$tue_t = substr($tue_t, 1, -1);
$tue = $_POST['tued'];

$wed_f = $_POST['wedf'];
$wed_f = substr($wed_f, 1, -1);
$wed_t = $_POST['wedt'];
$wed_t = substr($wed_t, 1, -1);
$wed = $_POST['wedd'];

$thu_f = $_POST['thuf'];
$thu_f = substr($thu_f, 1, -1);
$thu_t = $_POST['thut'];
$thu_t = substr($thu_t, 1, -1);
$thu = $_POST['thud'];

$fri_f = $_POST['frif'];
$fri_f = substr($fri_f, 1, -1);
$fri_t = $_POST['frit'];
$fri_t = substr($fri_t, 1, -1);
$fri = $_POST['frid'];

$sat_f = $_POST['satf'];
$sat_f = substr($sat_f, 1, -1);
$sat_t = $_POST['satt'];
$sat_t = substr($sat_t, 1, -1);
$sat = $_POST['satd'];

$sun_f = $_POST['sunf'];
$sun_f = substr($sun_f, 1, -1);
$sun_t = $_POST['sunt'];
$sun_t = substr($sun_t, 1, -1);
$sun = $_POST['sund'];

$id = $_POST['id'];

$check_unique_row = mysqli_query($conn, "SELECT * FROM permanent_time_options WHERE id_user='$id'");
if (mysqli_num_rows($check_unique_row) == 0) {
    $sqlt = "INSERT INTO permanent_time_options (monday, mon_from, mon_to, tuesday, tue_from, tue_to, wednesday, wed_from, wed_to, thursday, thu_from, thu_to, friday, fri_from, fri_to, saturday, sat_from, sat_to, sunday, sun_from, sun_to, id_user)
VALUES
('$mon','$mon_f','$mon_t','$tue','$tue_f','$tue_t','$wed','$wed_f','$wed_t','$thu','$thu_f','$thu_t','$fri','$fri_f','$fri_t','$sat','$sat_f','$sat_t','$sun','$sun_f','$sun_t',$id)";
} else {
    $sqlt = "UPDATE permanent_time_options SET monday='$mon', mon_from='$mon_f', mon_to='$mon_t', tuesday='$tue', tue_from='$tue_f', tue_to='$tue_t', wednesday='$wed', wed_from='$wed_f', wed_to='$wed_t', thursday='$thu', thu_from='$thu_f', thu_to='$thu_t', friday='$fri', fri_from='$fri_f', fri_to='$fri_t', saturday='$sat', sat_from='$sat_f', sat_to='$sat_t', sunday='$sun', sun_from='$sun_f', sun_to='$sun_t' WHERE id_user='$id'";

}



if (!mysqli_query($conn, $sqlt)) {
    die('Error: ' . mysqli_error($conn));
}
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>