<?php
$mysqli = require __DIR__ . "/database.php";

$id_user = $_POST['id_user'];
$name_object = $_POST['name'];
$arrshi = $_POST['id'];
/*$branch = $_POST['branch'];
$type = $_POST['type'];*/
$conn = new mysqli($host, $username, $password, $dbname);
if (count($arrshi) != 0) {
    for ($i = 0; $i < count($arrshi); $i++) {
        $check_right = "SELECT * FROM shift_assignment WHERE user_id = '$id_user' AND shift_id='$arrshi[$i]' ";
        $check_unique_save = mysqli_query($conn, $check_right);
        if (mysqli_num_rows($check_unique_save) == 0) {
            $sql = "INSERT INTO shift_assignment (user_id, shift_id, shift_name)
        VALUES ('$id_user','$arrshi[$i]','$name_object[$i]')";

            if (!mysqli_query($conn, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }
    }

}
?>