<?php
$mysqli2 = require("../database.php");


$conn2 = new mysqli($host, $username, $password, $dbname);
$fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
$data2 = array();
$data3 = array();
$numberval = array();
$look1= array();

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



$find2[] = array();
$look = 0;
for ($x = 0; $x < count($data2); $x++) {
    if ($data3[$x] == null && $data1[$x] == $input) {
        static $dd = 1;
        $look = $data1[$x];

        echo "<div class='form-check form-check-inline'>";
        echo "<input class='form-check-input' style='display:inline;' type='checkbox' id='inlineCheckbox".$data1[$x]."' onclick='obj_click(this.value)' value='".$data1[$x]."'>";
        echo "<label class='form-check-label' style='display:inline;' for='inlineCheckbox".$data1[$x]."'>".$data2[$x]."</label>";
        echo "</div>";


        $search = $data1[$x] . "";
        $numberval[$count] = $data1[$x] . "";
        $count = 1;


        $dd++;

        $row = 0;

        for ($h = 0; $h < count($data2); $h++) {
            if ($search == $data4[$h]) {
                sub_object($search, $data1, $data2, $data3, $data4, $find2, $look, $input);
                $row++;
                break;
            }
        }

        break;


    }

}

function sub_object($searching, $dat1, $dat2, $dat3, $dat4, $find2, $look, $input)
{
    static $dd = 1;
    static $find3;
    $find = 0;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
            if ($find == 0) {
                $find = 1;

            } else {

            }

            echo "<div class='form-check form-check-inline'>";
            echo "<input class='form-check-input' style='display:inline;' type='checkbox' id='inlineCheckbox".$dat1[$i]."' onclick='obj_click(this.value)' value='".$dat1[$i]."'>";
            echo "<label class='form-check-label' style='display:inline;' for='inlineCheckbox".$dat1[$i]."'>".$dat2[$i]."</label>";
            echo "</div>";
            $dd++;
            $row = 0;
            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {
                        sub_object($sea, $dat1, $dat2, $dat3, $dat4, $find2, $look, $input);
                        break;
                    }
                }
            }

          
        }
    }


}

?>