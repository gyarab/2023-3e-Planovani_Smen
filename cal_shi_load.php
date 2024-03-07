<?php
$mysqli = require __DIR__ . "/database.php";
$input = $_POST['input'];
$conn = new mysqli($host, $username, $password, $dbname);
//$sql = "SELECT * FROM shift_assignment WHERE user_id='$input' ";
$result_get = $mysqli->query($sql);
$fetch = mysqli_query($conn, "SELECT * FROM list_of_objects ");
$data2 = array();
$data3 = array();
$data1 = array();
$data4 = array();
$get_id = array();
$get_name = array();
$sm = array();
$get_object = array();
$numberval = array();
$arr[][] = array();
$arr2[][] = array();
$arr_help = array();
$arr_help2= array();
$rows = 0;
$help = 0;
$shi_name = array();
$shi_id = array();
$shi_help = array();
$admin= false;
$man= false;

$rights[]= array();
$id = $_POST['id'];
//echo"<p>".$id."asd</p>";
$position = "";
$fetchid = mysqli_query($conn, "SELECT position FROM user2 WHERE id='$id'");
while ($row_id = mysqli_fetch_assoc($fetchid)) {
    $position = $row_id['position'];
}
//echo"<p>".$position."lkjjkl</p>";
if($position=="admin"){
    $admin= true;
}else if($position=="manager"){
    $man= true;
    //echo"<p>asd</p>";
    $fetchright = mysqli_query($conn, "SELECT * FROM manager_rights WHERE id_user='$id'");
    if (mysqli_num_rows($fetchright) > 0) {
        while ($rows_obj = mysqli_fetch_assoc($fetchright)) {
            array_push($rights,$rows_obj['object_id']);
        }
    }
}

/*while ($rows_get = $result_get->fetch_assoc()) {
    $ge = $rows_get['shift_id'];
    array_push($get_id, $ge);
    $get = $rows_get['shift_name'];
    array_push($get_name, $get);
}

for ($i = 0; $i < count($get_id); $i++) {
    $sql_obj = "SELECT * FROM create_shift WHERE id_shift='$get_id[$i]'";
    $result_obj = $mysqli->query($sql_obj);
    while ($rows_obj = $result_obj->fetch_assoc()) {
        $gee = $rows_obj['object_id'];
        array_push($get_object, $gee);
        if (in_array($gee, $sm)) {
        } else {
            array_push($sm, $gee);
        }
    }

}*/

if (mysqli_num_rows($fetch) > 0) {
    /**Sorting data alphabetically */
    while ($rows_dat = mysqli_fetch_assoc($fetch)) {
        $data1[] = $rows_dat['id_object'];
        $data2[] = $rows_dat['object_name'];
        $data3[] = $rows_dat['superior_object_name'];
        $data4[] = $rows_dat['superior_object_id'];
    }
    array_multisort($data2, $data1, $data3, $data4);
}

$count = 0;
$dd = 1;
/*echo "<br>";
echo "<font size='+2'><label>Assigned shifts :</label></font>";
echo "<br>";
echo "<br>";*/
for ($x = 0; $x < count($data2); $x++) {
    if ($data3[$x] == null && $data1[$x] == $input) {
        static $dd = 1;
        $b = false;
        $help = 0;
        $search = $data1[$x] . "";
        $numberval[$count] = $data1[$x] . "";
        $count++;
        $rows = 0;
        $help = 0;
        $pus = 1;

        $dd++;
        //$result_get = $mysqli->query($sql);
        if($admin== true || in_array($data1[$x], $rights) == true){
        $fetch_sh = mysqli_query($conn, "SELECT * FROM create_shift WHERE object_id='$data1[$x]' ");
        if (mysqli_num_rows($fetch_sh) > 0) {
            while ($rows = mysqli_fetch_assoc($fetch_sh)) {

                array_push($shi_name,$rows['shift_name']);
                array_push($shi_id,$rows['id_shift']);
                
            }

        }
    }
        //if ($help != 1) {

            /*$arr = [];
            $arr2 = [];
            $row = 0;
            if (in_array($data1[$x], $sm)) {
                $arr[$rows][0] = $data2[$x];
                $arr2[$rows][0] = $data1[$x];
                for ($u = 0; $u < count($get_object); $u++) {
                    if ($get_object[$u] == $data1[$x]) {
                        $arr[$rows][$pus] = $get_name[$u];
                        $arr2[$rows][$pus] = $get_id[$u];
                        $pus++;
                    }

                }
                $rows++;
            }*/




            for ($h = 0; $h < count($data2); $h++) {
                if ($search == $data4[$h]) {
                    sub_object($search, $data1, $data2, $data3, $data4, $get_id, $count, $get_object, $get_name, $sm);
                    $row++;
                    break;
                }
            }
            if (count($shi_id) > 0) {
                array_multisort($shi_name,$shi_id);

                for ($z = 0; $z < count($shi_id); $z++) {
                    if($z == 0){
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' style='display:inline;height:15px;width:15px' onclick='shift_all()' type='checkbox' id='shall' checked value='ALL'>";
                        echo "<p class='form-check-label' style='display:inline;font-size: 15px' for='shall'>ALL</p>";
                        echo "</div>";
                    }
                    if (in_array($shi_name[$z], $shi_help)) {
                    }else{
                        array_push($shi_help,$shi_name[$z]);
                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' style='display:inline;height:15px;width:15px' onclick='shift_search(this.value)' name='nshi' type='checkbox' id='sh".$shi_id[$z]."' value='".$shi_name[$z]."'>";
                echo "<p class='form-check-label' style='display:inline;font-size: 15px' for='sh".$shi_id[$z]."'>".$shi_name[$z]."</p>";
                echo "</div>";
                    }
                }
            }
            /*if (count($arr) > 0) {
                echo "<h5>Asigned shifts for : <b>" . $data2[$x] . "</b></h5>";
                echo "<br>";
                echo "<div class='row'>";
                $rrt = 0;
                for (; ; ) {
                    if ($arr[$rrt][0] == "" || $arr[$rrt][0] == null) {
                        break;

                    } else {
                        echo " <div class='col-12 col-md-4'>";
                        echo "<h6>" . $arr[$rrt][0] . "</h6>";
                        echo "<ul class='list-group'>";
                        $arr_help = [];
                        $arr_help2 = [];
                        $raz = 1;
                        for (; ; ) {
                            if ($arr[$rrt][$raz] == "" || $arr[$rrt][$raz] == null) {
                                break;
                            } else {
                                array_push($arr_help, $arr[$rrt][$raz]);
                                array_push($arr_help2, $arr2[$rrt][$raz]);
                                $raz++;
                            }
                        }
                        //sort($arr_help);
                        array_multisort($arr_help,$arr_help2);
                        for ($h = 0; $h < count($arr_help); $h++) {
                                echo "<li class='list-group-item'>" .$arr_help[$h]."<button id='dl" .$arr_help2[$h]."' class='btn btn-danger' onclick='Delete_assi(this.id)' style='float: right'><i class='bi bi-trash'></i></button></li>";

                        }
                        echo "</ul>";
                                                echo"</div>";
                        $rrt++;
                    }
                }
                echo"</div>";
                echo "<hr>";
            }*/

        //}


    }

}


function sub_object($searching, $dat1, $dat2, $dat3, $dat4, $id, $co, $object, $name, $s)
{
    global $arr;
    global $rights;
    global $admin;
    global $arr2;
    global $rows;
    global $conn;
    global $shi_id;
    global $shi_name;
    static $dd = 1;
    $find = 0;
    $push = 1;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {


            /*if (in_array($dat1[$i], $s)) {
                $arr[$rows][0] = $dat2[$i];
                $arr2[$rows][0] = $dat1[$i];
                for ($u = 0; $u < count($object); $u++) {
                    if ($object[$u] == $dat1[$i]) {
                        $arr[$rows][$push] = $name[$u];
                        $arr2[$rows][$push] = $id[$u];
                        $push++;
                    }

                }
                $rows++;
            }*/
            if($admin== true || in_array($dat1[$i], $rights) == true){
            $fetch_shi = mysqli_query($conn, "SELECT * FROM create_shift WHERE object_id='$dat1[$i]' ");
            if (mysqli_num_rows($fetch_shi) > 0) {
                while ($rowsh = mysqli_fetch_assoc($fetch_shi)) {
                    array_push($shi_name,$rowsh['shift_name']);
                    array_push($shi_id,$rowsh['id_shift']);
                }
            }
        }


            $dd++;
            $row = 0;
            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {
                        sub_object($sea, $dat1, $dat2, $dat3, $dat4, $id, $co, $object, $name, $s);
                        break;
                    }
                }
            }
        }
    }

}