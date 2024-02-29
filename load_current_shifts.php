<?php
$mysqli2 = require __DIR__ . "/database.php";

$input = $_POST['input'];
$date = date('Y-m-d');
$sql2 = " SELECT * FROM list_of_objects ORDER BY object_name ASC";
      $result3 = $mysqli2->query($sql2);
      $mysqli2->close();
      $data_name = array();


      $mysqli2 = require __DIR__ . "/database.php";

      $conn2 = new mysqli($host, $username, $password, $dbname);
      $fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
      $data2 = array();
      $data3 = array();
      $numberval = array();


      if (mysqli_num_rows($fetch) > 0) {
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
$dd = 1;
    for ($x = 0; $x < count($data2); $x++) {
        if ($data3[$x] == null && $data1[$x] == $input ) {
            static $dd =1;

          $search = $data1[$x] . "";
          $numberval[$count] = $data1[$x] . "";
          $count = 1;
          echo "<div>";
          echo "<p style='margin:auto'>".$data2[$x]."<p>";

          $dd++;


          $row = 0;
         
          for ($h = 0; $h < count($data2); $h++) {
            if($search==$data4[$h]){
                sub_object($search,$data1,$data2,$data3,$data4);
                $row++;
                break;
            }
          }

          echo "</div>";


          
            
        }

      }
     
        function sub_object($searching,$dat1,$dat2, $dat3,$dat4)
      {
       static $dd = 1;
       global $conn2;
       global $date;
        $find = 0;
        $shi_id = array();
        $shi_name = array();
        for ($i = 0; $i < count($dat2); $i++) {
            $shi_id = [];
            if ($searching == $dat4[$i]) {
            if ($find == 0){
                $find = 1;

            }else{
                
            }
            echo "<div style='border: solid #aaa;padding: 5px;border-width: thin'>";
            echo "<h6 >".$dat2[$i]." : </h6>";
            $sqlsh = "SELECT * FROM create_shift WHERE object_id='$dat1[$i]' ";
            $fetchc = mysqli_query($conn2, $sqlsh);
            //echo"<p>".$date."</p>";
            if (mysqli_num_rows($fetchc) > 0) {
                
                while ($rows_c = mysqli_fetch_assoc($fetchc)) {
                    //$shi_id[] = $rows_c['id_shift'];
                    array_push($shi_id, $rows_c['id_shift']);
                    array_push($shi_name, $rows_c['shift_name']);
                }
                for($k = 0; $k < count($shi_id); $k++){
                    //echo"<p>".$shi_id[$k]."adsads</p>";
                    //$sqldd= "";
                    $sqldd[$k] = "SELECT * FROM saved_shift_data WHERE id_of_shift='$shi_id[$k]' AND saved_date='$date' ";
                }
                for($k = 0; $k < count($shi_id); $k++){
                    $fetchdd = mysqli_query($conn2, $sqldd[$k]);
                    if (mysqli_num_rows($fetchdd) > 0) {
                        //echo"<p>".$date."1111</p>";
                        while ($rows_d = mysqli_fetch_assoc($fetchdd)) {
                            echo"<small><div ><p style='display:inline'>".substr($rows_d['saved_from'], 0, -3)."-".substr($rows_d['saved_to'], 0, -3)." ".$shi_name[$k]." | ".$rows_d['user_name']."</p><p style='margin:auto;float:right'>asd</p></div></small>";
                        }
                    }
                }
                
            }

           
            $dd++;
            $row = 0;
            $sea = $dat1[$i]. "";
            if ($sea != null) {
            for ($h = 0; $h < count($dat2); $h++) {
              if($sea==$dat4[$h]){
                  sub_object($sea,$dat1,$dat2,$dat3,$dat4);
                  break;
              }
            }
        }
            
         
            
            echo "</div>";
            echo "<br>";
        }
        }


      }

    
?>