<?php 
$mysqli2 = require("../database.php");



$sql2 = " SELECT * FROM list_of_objects ORDER BY id_object ASC";
$result3 = $mysqli2->query($sql2);
$mysqli2->close();
$data_name = array();


$mysqli2 = require("../database.php");


$conn2 = new mysqli($host, $username, $password, $dbname);
$fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
$data2 = array();
$data3 = array();
$numberval = array();

$input = $_POST['input'];
if (mysqli_num_rows($fetch) > 0) {
    /**Sorting data alphabetically */
    while ($rows_dat = mysqli_fetch_assoc($fetch)) {
        $data1[] = $rows_dat['id_object'];
        $data2[] = $rows_dat['object_name'];
        $data3[] = $rows_dat['superior_object_name'];
        $data4[] = $rows_dat['superior_object_id'];
    }
    array_multisort($data1, $data2, $data3, $data4);
}
$search;


$nm = "box";
/**This part looks for row with any object without superior object (highest standing in hierarchie)  */
$dd = 1;
echo "<div class='row' style='justify-content : space-between' >";

for ($x = 0; $x < count($data2); $x++) {
    if ($data3[$x] == null && $data1[$x] == $input) {
        static $dd = 1;

        $search = $data1[$x] . "";
        $numberval[$count] = $data1[$x] . "";
        $count = 1;

        echo "<div class='col-12  p-2'>";
        echo "<div class='overflow-auto'>";
        echo "<ul>";
        echo "<li>";
        
        echo "<input id='shi" . $dd . "m' type='hidden' name='hid' value='" . $data1[$x] . "'>";

        echo "<input id='spa" . $dd . "m' type='button' style='position: relative;' onclick='Sel(this.id)' name='s".$data1[$x] ."' value='" . $data2[$x] . "'>";
        $dd++;


        $row = 0;

        for ($h = 0; $h < count($data2); $h++) {
            if ($search == $data4[$h]) {
                sub_object($search, $data1, $data2, $data3, $data4);
                $row++;
                break;
            }
        }

        echo "</li>";
        echo "</ul>";
        echo "<br>";
        echo "<br>";
        echo "</div>";
        echo "</div>";

        /**This part calls the function in order to check if this object is superior to some other object*/
    }

}
echo "</div>";
function sub_object($searching, $dat1, $dat2, $dat3, $dat4)
{
    static $dd = 1;
    $find = 0;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
            if ($find == 0) {
                $find = 1;
                echo "<ul>";
                echo "<hr>";
            } else {

            }

            echo "<li>";
            echo "<input id='shi" . $dd . "' type='hidden' name='hid' value='" . $dat1[$i] . "'>";

            echo "<input id='spa" . $dd . "' type='button' onclick='Sel(this.id)' name='s".$dat1[$i] ."' value='" . $dat2[$i] . "'>";

            $dd++;
            $row = 0;
            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {
                        sub_object($sea, $dat1, $dat2, $dat3, $dat4);
                        break;
                    }
                }
            }

            echo "</li>";

        }
    }
    echo "</ul>";

}
?>