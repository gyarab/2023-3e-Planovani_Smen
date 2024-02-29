<?php
$mysqli2 = require __DIR__ . "/database.php";
//require __DIR__ . '/load_object2.php';

$conn2 = new mysqli($host, $username, $password, $dbname);
$fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
$data2 = array();
$data3 = array();
$numberval = array();
$look_arr = array();

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
    if ($data1[$x] == $input) {
        static $dd = 1;
        //$look = $data1[$x];
        /*if ($input == $data1[$x]){
            $find2[1] = $look;
            $find2[0] = 0;
            //echo json_encode($obj);
            echo json_encode($find2);
            //break;
        }*/
        
        $search = $data1[$x] . "";
        $numberval[$count] = $data1[$x] . "";
        $count = 1;


        $dd++;

        $row = 0;

        for ($h = 0; $h < count($data2); $h++) {
            if ($search == $data4[$h]) {
            sub_object($search, $data1, $data2, $data3, $data4, $find2, $look, $input/*, $look_arr*/);
                $row++;
                break;
            }
        }

     break;
    }

}

function sub_object($searching, $dat1, $dat2, $dat3, $dat4, $find2, $look, $input/*, $look_arr*/)
{
    static $dd = 1;
    static $ff = 0;
    static $find3;
    global $look_arr;
    $find = 0;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
            if ($find == 0) {
                $find = 1;

            } else {

            }
            /*if ($input == $dat1[$i]){
                $find2[1] = $look;
                $find2[0] = 1;
                //echo json_encode($obj);
                echo json_encode($find2);
                //break;
            }*/
            //echo /*json_encode(*/$dat1[$i]/*)*/. ",";
            //$p = $dat1[$i]."!";
            
            //echo /*json_encode*/($p);
            array_push($look_arr,$dat1[$i]);
            //$look_arr[] =  $dat1[$i];
            $dd++;
            $ff++;
            $row = 0;
            $sea = $dat1[$i] . "";
            if ($sea != null) {
                for ($h = 0; $h < count($dat2); $h++) {
                    if ($sea == $dat4[$h]) {
                    sub_object($sea, $dat1, $dat2, $dat3, $dat4, $find2, $look, $input/*, $look_arr*/);
                        break;
                    }
                }
            }
            //return $dat1[$i];


        }
    }

  //return $look_arr;
}
$looka = 0;
echo json_encode($look_arr);
//echo $look;
?>