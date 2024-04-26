<?php
$mysqli = require("../database.php");

$input = $_POST['input'];
$conn = new mysqli($host, $username, $password, $dbname);
$sql = "SELECT * FROM manager_rights WHERE id_user='$input' ";


$fetch = mysqli_query($conn, "SELECT * FROM list_of_objects");
$data2 = array();
$data3 = array();
$data1 = array();
$data4 = array();
$get_id = array();
$numberval = array();
$arr = array();

$result_get = $mysqli->query($sql);
while ($rows_get = $result_get->fetch_assoc()) {
    $get = $rows_get['shift_name'];
    $ge = $rows_get['object_id'];
    array_push($get_id,$ge);
    array_push($get_name,$get);

}

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
    for ($x = 0; $x < count($data2); $x++) {
        if ($data3[$x] == null) {
            static $dd =1;
            $b = false;

          $search = $data1[$x] . "";
          $numberval[$count] = $data1[$x] . "";
          $count++;
          $b = includes($search,$data1,$data2,$data3,$data4,$get_id,$count);
          $dd++;
          if($b == true){
          echo "<p>Rights for : <b>".$data2[$x]."</b></p>";
          
          $arr = []; 

           
          $row = 0;
          echo "<p style='display: inline'>";
          if(in_array($data1[$x],$get_id)){
            array_push($arr,$data2[$x]);
          }
          for ($h = 0; $h < count($data2); $h++) {
            if($search==$data4[$h]){
                sub_object($search,$data1,$data2,$data3,$data4,$get_id,$count);
                $row++;
                break;
            }
          }
          sort($arr);
          if(count($arr)>0){
            for ($h = 0; $h < count($arr); $h++) {
                if($h +1 == count($arr)){
                    echo $arr[$h];

                }else{
                echo $arr[$h]. ", " ;
                }
            }
          }
          echo "</p>";   
          echo "<br>";
          echo "<hr>";
        }


        }

      }
      function includes($searching,$dat1,$dat2, $dat3,$dat4,$id,$co){
        static $dd = 1;
        $find = 0;
        for ($i = 0; $i < count($dat2); $i++) {
            if ($searching == $dat4[$i]) {
            if (in_array($dat1[$i], $id)){
                return true;
            }
            
           
            $dd++;
            $row = 0;
            $sea = $dat1[$i]. "";
            if ($sea != null) {
            for ($h = 0; $h < count($dat2); $h++) {
              if($sea==$dat4[$h]){
                  includes($sea,$dat1,$dat2,$dat3,$dat4,$id,$co);
                  break;
              }
            }
        }

        }
        }
      }

      function sub_object($searching,$dat1,$dat2, $dat3,$dat4,$id,$co)
      {
        global $arr;
       static $dd = 1;
        $find = 0;
        for ($i = 0; $i < count($dat2); $i++) {
            if ($searching == $dat4[$i]) {
            if ($find == 0){
                $find = 1;

            }else{
                
            }
            if (in_array($dat1[$i], $id)){
                array_push($arr,$dat2[$i]);
            }
            
           
            $dd++;
            $row = 0;
            $sea = $dat1[$i]. "";
            if ($sea != null) {
            for ($h = 0; $h < count($dat2); $h++) {
              if($sea==$dat4[$h]){
                  sub_object($sea,$dat1,$dat2,$dat3,$dat4,$id,$co);
                  break;
              }
            }
        }
            
          
        }
        }

      }




?>