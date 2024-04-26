<?php
$mysqli = require ("../database.php");


$conn = new mysqli($host, $username, $password, $dbname);
$saved_data[] = array();
$Year = $_POST['year'];
$Month = $_POST['month'];
$Id = $_POST['id'];
$count = 0;
$time;
$first;
if ($Month < 10) {
    $Month = "0" . $Month;
}

for ($i = 1; $i < 32; $i++) {
    $time = 0;
    $first = 0;
    if ($i < 10) {
        $Day = "0" . $i;
    } else {
        $Day = $i;
    }

    $Date = $Year . "-" . $Month . "-" . $Day;
    $sql = "SELECT * FROM saved_shift_data, attendance WHERE (saved_shift_data.id = attendance.planned_id AND saved_shift_data.saved_date='$Date' AND saved_shift_data.id_user=$Id AND saved_shift_data.id IN (SELECT planned_id FROM attendance));";
    $check_get = mysqli_query($conn, $sql);
    if (mysqli_num_rows($check_get) == 0) {

    } else {
        $result = $mysqli->query($sql);

        while ($rows = $result->fetch_assoc()) {
            $from_arr = [];
            $to_arr = [];
            $not_unlog = "";


            $pause_from = $rows['pause_from'];
            $pause_to = $rows['pause_to'];
            if ($pause_from != null) {
                $from_arr = explode("||", $pause_from);
                $to_arr = explode("||", $pause_to);
                if (count($from_arr) != 0) {
                    for ($r = 0; $r < count($from_arr); $r++) {
                        echo '<div class="row">';
                        echo '<div class="col-12 col-md-4">';
                        echo '<p>' . $Date . '</p>';
                        echo '</div>';
                        echo '<div class="col-12 col-md-4">';
                        echo '<p>' . $from_arr[$r] . '</p>';
                        echo '</div>';
                        echo '<div class="col-12 col-md-4">';
                        echo '<p>' . $to_arr[$r] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }

            $count++;
        }
    }

}
echo '<hr style="height: 3px;">';


function floorToFraction($number, $denominator = 1)
{
    $x = $number * $denominator;
    $x = floor($x);
    $x = $x / $denominator;
    return $x;
}
?>