<?php
/**tento soubor nacita ulozena data z databaze a vklada je do kalendare */
$mysqli = require ("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);

$shi_arr = $_POST['shift_arr']; /**id smen na nacteni */
$obj_arr = $_POST['object_arr'];/**id objektu na nacteni */
$user = $_POST['user']; /**id uzivatele */
$sql[] = array(); /**arr na sql prikazy */
$final[][] = array();/**return arr */

/**arraye pro nacteni objektu */
$data2[] = array();
$data3[] = array();
$data1[] = array();
$data4[] = array();
$arr1 = array();
$arr2 = array();
$arr3 = array();
$arr4 = array();
$arr5 = array();
$r_filter[] = array();

if (count($shi_arr) == 0) {
    $shi_arr[0] = "";
}

sort($shi_arr);

$input = $_POST['input'];
$fetchobj = mysqli_query($conn, "SELECT * FROM list_of_objects");
if (mysqli_num_rows($fetchobj) > 0) {
    /**Sorting data alphabetically */
    while ($rows_dat = mysqli_fetch_assoc($fetchobj)) {
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
        if (in_array($data1[$x], $obj_arr) == true) {
            $fetchshim = mysqli_query($conn, "SELECT shift_name, id_shift FROM create_shift WHERE object_id='$data1[$x]' ");
            if (mysqli_num_rows($fetchshim) > 0) {
                while ($row_shim = mysqli_fetch_assoc($fetchshim)) {
                    array_push($arr3, $row_shim['id_shift']);
                    array_push($arr4, $data1[$x]);
                    array_push($arr5, $row_shim['shift_name']);
                }
            }
        }


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
        array_multisort($arr2, $arr1);

        break;


    }

}
$sort_arr[] = array();
$sort_arr_id[] = array();
$sort_arr_obj[] = array();
array_multisort($arr5, $arr4, $arr3);

$us = 0;
$position = "";
if (count($arr3) != 0) {

    $sql_admin = "SELECT position FROM user WHERE id='$user'";
    $fetchadmin = mysqli_query($conn, $sql_admin);
    if (mysqli_num_rows($fetchadmin) > 0) {
        while ($rowadm = mysqli_fetch_assoc($fetchadmin)) {
            $position = $rowadm['position'];
        }
    }
    if ($position == "admin" || $position == "manager") {
        for ($i = 0; $i < count($arr3); $i++) {
            array_push($sort_arr_id, $arr3[$i]);
            array_push($sort_arr_obj, $arr4[$i]);
        }
    } else {

        /* ***Nefunguje, pojistka, neni potrebna***/
        for ($i = 0; $i < count($arr3); $i++) {

            $sql_fil = "SELECT * FROM manager_rights WHERE object_id='$arr3[$i]' AND id_user='$user'";
            $fetchfil = mysqli_query($conn, $sql_fil);
            if (mysqli_num_rows($fetchfil) > 0) {
                array_push($sort_arr_id, $arr3[$i]);
                array_push($sort_arr_obj, $$arr4[$i]);
            }
        }

    }
}
if (count($shi_arr) != 0) {
    $index = 0;
    for ($i = 0; $i < count($shi_arr); $i++) {
        $sqlkk = "SELECT * FROM create_shift WHERE shift_name='$shi_arr[$i]'";
        $fetchkk = mysqli_query($conn, $sqlkk);
        if (mysqli_num_rows($fetchkk) > 0) {
            while ($rowkk = mysqli_fetch_assoc($fetchkk)) {
                $checkk = $rowkk['object_id'];

                if (in_array($checkk, $arr1) == true) {

                    if (in_array($rowkk['id_shift'], $sort_arr_id) == false) {
                        array_push($sort_arr_id, $rowkk['id_shift']);
                        array_push($sort_arr_obj, $rowkk['object_id']);
                    }
                }
            }
        }
    }
}
for ($i = 0; $i < count($arr1); $i++) {
    $srch = $arr1[$i];
    for ($l = 0; $l < count($sort_arr_id); $l++) {
        if ($sort_arr_obj[$l] == $srch) {
            array_push($sort_arr, $sort_arr_id[$l]);

        }
    }
}
for ($i = 0; $i < count($sort_arr); $i++) {
    $sql[0] = "SELECT * FROM create_shift WHERE id_shift='$sort_arr[$i]'";
    $fetch = mysqli_query($conn, $sql[0]);
    if (mysqli_num_rows($fetch) > 0) {
        $us = 1;
        while ($rows = mysqli_fetch_assoc($fetch)) {
            $check = $rows['object_id'];
            $final[$index][0] = $rows['id_shift'];
            $final[$index][1] = $rows['shift_name'];
            $final[$index][2] = $rows['color'];
            $red = substr($rows['color'], 1, 2);
            $green = substr($rows['color'], 3, 2);
            $blue = substr($rows['color'], 5, 2);
            $red = base_convert($red, 16, 10);
            $green = base_convert($green, 16, 10);
            $blue = base_convert($blue, 16, 10);
            $red = round($red - $red / 100 * 30);
            $green = round($green - $green / 100 * 30);
            $blue = round($blue - $blue / 100 * 30);
            $red = base_convert($red, 10, 16);
            $green = base_convert($green, 10, 16);
            $blue = base_convert($blue, 10, 16);
            if (strlen($red) < 2) {
                $red = "0" . $red;
            }
            if (strlen($green) < 2) {
                $green = "0" . $green;
            }
            if (strlen($blue) < 2) {
                $blue = "0" . $blue;
            }
            $colordark = "#" . $red . $green . $blue;
            $final[$index][3] = $colordark;
            $final[$index][4] = $rows['monday'];
            $final[$index][5] = $rows['tuesday'];
            $final[$index][6] = $rows['wednesday'];
            $final[$index][7] = $rows['thursday'];
            $final[$index][8] = $rows['friday'];
            $final[$index][9] = $rows['saturday'];
            $final[$index][10] = $rows['sunday'];
            $final[$index][11] = $rows['mon_from'];
            $final[$index][12] = $rows['mon_to'];
            $final[$index][13] = $rows['tue_from'];
            $final[$index][14] = $rows['tue_to'];
            $final[$index][15] = $rows['wed_from'];
            $final[$index][16] = $rows['wed_to'];
            $final[$index][17] = $rows['thu_from'];
            $final[$index][18] = $rows['thu_to'];
            $final[$index][19] = $rows['fri_from'];
            $final[$index][20] = $rows['fri_to'];
            $final[$index][21] = $rows['sat_from'];
            $final[$index][22] = $rows['sat_to'];
            $final[$index][23] = $rows['sun_from'];
            $final[$index][24] = $rows['sun_to'];
            $final[$index][25] = $rows['object_id'];
            $final[$index][26] = $rows['object_name'];
            $index++;
        }
    }
}







function sub_object($searching, $dat1, $dat2, $dat3, $dat4, $find2, $look, $input)
{

    global $arr1;
    global $arr2;
    global $arr3;
    global $arr4;
    global $arr5;
    global $obj_arr;
    global $conn;
    $find = 0;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
            array_push($arr1, $dat1[$i]);
            array_push($arr2, $dat2[$i]);
            if (in_array($dat1[$i], $obj_arr) == true) {
                $fetchshi = mysqli_query($conn, "SELECT shift_name, id_shift FROM create_shift WHERE object_id='$dat1[$i]'");
                if (mysqli_num_rows($fetchshi) > 0) {
                    while ($row_shi = mysqli_fetch_assoc($fetchshi)) {
                        array_push($arr3, $row_shi['id_shift']);
                        array_push($arr4, $dat1[$i]);
                        array_push($arr5, $row_shi['shift_name']);
                    }
                }
            }
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


echo json_encode($final);
?>