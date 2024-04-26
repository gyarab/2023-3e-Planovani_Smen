<?php
$mysqli2 = require ("../database.php");


$conn2 = new mysqli($host, $username, $password, $dbname);
$fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
$data2 = array();
$data3 = array();
$numberval = array();
$look1 = array();
$arr2 = array();
$admin = false;
$man = false;
$arr1 = array();
$rights[] = array();
$id = $_POST['id'];
$position = "";
$fetchid = mysqli_query($conn2, "SELECT position FROM user WHERE id='$id'");
while ($row_id = mysqli_fetch_assoc($fetchid)) {
    $position = $row_id['position'];
}

if ($position == "admin") {
    $admin = true;
} else if ($position == "manager") {
    $man = true;
    $fetchright = mysqli_query($conn2, "SELECT * FROM manager_rights WHERE id_user='$id'");
    if (mysqli_num_rows($fetchright) > 0) {
        while ($rows_obj = mysqli_fetch_assoc($fetchright)) {
            array_push($rights, $rows_obj['object_id']);
        }
    }
}

$input = $_POST['input'];
if (mysqli_num_rows($fetch) > 0) {
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
        array_push($arr1, $data1[$x]);
        array_push($arr2, $data2[$x]);


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
        $first = 0;
        array_multisort($arr2, $arr1);
        if (count($arr1) != 0) {

            for ($q = 0; $q < count($arr1); $q++) {

                if ($admin == true || in_array($arr1[$q], $rights) == true) {

                    if ($first == 0) {
                        echo "<p> &nbsp;&nbsp;</p>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' style='display:inline;height:15px;width:15px' type='checkbox' id='inlineCheckboxall' onclick='object_all()' checked value='ALL'>";
                        echo "<p class='form-check-label' style='display:inline;font-size: 15px' for='inlineCheckboxall'>ALL</p>";
                        echo "</div>";
                        $first++;
                    }
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input class='form-check-input' style='display:inline;height:15px;width:15px' type='checkbox' id='inlineCheckbox" . $arr1[$q] . "' name='nobj' onclick='object_search(this.value)' value='" . $arr1[$q] . "'>";
                    echo "<p class='form-check-label' style='display:inline;font-size: 15px' for='inlineCheckbox" . $arr1[$q] . "'>" . $arr2[$q] . "</p>";
                    echo "</div>";
                }

            }

        }

        break;


    }

}

function sub_object($searching, $dat1, $dat2, $dat3, $dat4, $find2, $look, $input)
{
    static $dd = 1;
    static $find3;
    global $arr1;
    global $arr2;
    $find = 0;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
            if ($find == 0) {
                $find = 1;

            } else {

            }
            array_push($arr1, $dat1[$i]);
            array_push($arr2, $dat2[$i]);
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