<?php
//$mysqli2 = require __DIR__ . "/database.php";
$mysqli2 = require("../database.php");


$input = $_POST['input'];
$date = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime($date. ' - 1 days'));
$sql2 = " SELECT * FROM list_of_objects ORDER BY object_name ASC";
      $result3 = $mysqli2->query($sql2);
      $mysqli2->close();
      $data_name = array();


      //$mysqli2 = require __DIR__ . "/database.php";
      $mysqli2 = require("../database.php");


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
          //echo "<p>".$yesterday."</p>";


          
            
        }

      }
     
        function sub_object($searching,$dat1,$dat2, $dat3,$dat4)
      {
       static $dd = 1;
       global $conn2;
       global $date;
       global $yesterday;
        $find = 0;
        $shi_id = array();
        $shi_name = array();

        //echo "<p>".$yesterday."</p>";
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
                   
                    //$sqldd[$k] = "SELECT * FROM saved_shift_data WHERE (id_of_shift='$shi_id[$k]' AND saved_date='$date') OR (id_of_shift='$shi_id[$k]' AND saved_date='$yesterday' AND att_from IS NOT NULL AND att_to IS NULL) ";
                    //$sqldd[$k] = "SELECT * FROM saved_shift_data WHERE (id_of_shift='$shi_id[$k]' AND saved_date='$date') OR (id_of_shift='$shi_id[$k]' AND saved_date='$yesterday' AND att_from IS NOT NULL AND att_to IS NULL) ";
                    $sqldd[$k] = "SELECT * FROM saved_shift_data LEFT JOIN attendance ON saved_shift_data.id = attendance.planned_id WHERE (id_of_shift='$shi_id[$k]' AND saved_date='$date') OR (id_of_shift='$shi_id[$k]' AND saved_date='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL) ";
                  }
                for($k = 0; $k < count($shi_id); $k++){
                  
                    $fetchdd = mysqli_query($conn2, $sqldd[$k]);
                    //echo"<p>".$sqldd[$k]."</p>";
                    //if (mysqli_num_rows($fetchdd) > 0) {
                      
                        //echo"<p>".$date."1111</p>";
                        while ($rows_d = mysqli_fetch_assoc($fetchdd)) {
                          if($rows_d['saved_date'] == $yesterday){
                             $add_y = "(yesterday)";
                          }else{
                            $add_y = "";
                          }
                            echo"<small><div ><p style='display:inline'>".substr($rows_d['saved_from'], 0, -3)."-".substr($rows_d['saved_to'], 0, -3)." ".$shi_name[$k]." ".$add_y." | ".$rows_d['user_name']." </p><p style='margin:auto;float:right'>";
                            /**Smena jeste nezacala */
                            if($rows_d['log_from'] == null && strtotime($rows_d['saved_from']) > strtotime(date('H:i:s'))){
                              echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>--:-- / --:--</div><div style='float:right'>Has not started:&nbsp;&nbsp;</div>";
                            /**Smena zacal, ale prichod neni potvrzeny */
                            }else if($rows_d['log_from'] == null){
                              echo "<div style='border-width: thin;float:right;color:red;padding-left:2px;padding-right:2px'>--:-- / --:--</div><div style='float:right;color:red'>Has not started:&nbsp;&nbsp;</div>";
                            /**Potvrzeny prichod, nepotvrzeny odchod */
                            }else if($rows_d['log_to'] == null && $rows_d['log_from'] != null ){
                              if(strtotime($rows_d['saved_to']) > strtotime($rows_d['saved_from'])){
                                if(strtotime($rows_d['saved_to']) < strtotime(date('H:i:s'))){
                                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / --:--</div><div style='float:right;color:#E49B0F'>Active:&nbsp;&nbsp;</div>";
                                }else{
                                  echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / --:--</div><div style='float:right;color:green'>Active:&nbsp;&nbsp;</div>";
                                }
                              }else{
                                if(strtotime($rows_d['saved_to'])+86400 < strtotime(date('H:i:s'))){
                                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / --:--</div><div style='float:right;color:#E49B0F'>Active:&nbsp;&nbsp;</div>";
                                }else{
                                  echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / --:--</div><div style='float:right;color:green'>Active:&nbsp;&nbsp;</div>";
                                }
                              }
                              /**Potvrzeny prichod, potvrzeny odchod */
                            }else if($rows_d['log_to'] != null && $rows_d['log_from'] != null){
                              if(strtotime($rows_d['saved_to']) > strtotime($rows_d['saved_from'])){
                                if(strtotime($rows_d['saved_to'])+420 > strtotime($rows_d['log_to'])){
                                  echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / ".substr($rows_d['log_to'], 0, -3)."</div><div style='float:right'>Ended:&nbsp;&nbsp;</div>";
                                 
                                }else{
                                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / ".substr($rows_d['log_to'], 0, -3)."</div><div style='float:right;color:#E49B0F'>Ended:&nbsp;&nbsp;</div>";
                                }
                              
                              }else{
                                if(strtotime($rows_d['saved_from']) < strtotime($rows_d['log_to'])){
                                    $plus = 0;
                                }else{
                                  $plus = 86400;
                                }
                                if(strtotime($rows_d['saved_to'])+86820 > strtotime($rows_d['log_to'])+$plus){
                                  echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / ".substr($rows_d['log_to'], 0, -3)."</div><div style='float:right'>Ended:&nbsp;&nbsp;</div>";
                                  //echo "<p> 1 ".(strtotime($rows_d['saved_to'])+86820)."-".(strtotime($rows_d['att_to'])+$plus)."- ".$plus."</p>";
                                }else{
                                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>".substr($rows_d['log_from'], 0, -3)." / ".substr($rows_d['log_to'], 0, -3)."</div><div style='float:right;color:#E49B0F'>Ended:&nbsp;&nbsp;</div>";
                                  //echo "<p> 2 ".(strtotime($rows_d['saved_to'])+86820)."-".(strtotime($rows_d['att_to'])+$plus)."- ".$plus."</p>";
                                }

                              }
                            }
                            
                            /*else if($rows_d['att_to'] == null && $rows_d['att_from'] != null){
                              echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px'>".substr($rows_d['att_from'], 0, -3)." / --:--</div><div style='float:right;color:green'>Active:&nbsp;&nbsp;</div>";
                            }*/
                            //echo "<p>".strtotime($rows_d['saved_from'])."--". strtotime(date('H:i:s'))."</p>";
                            echo "</p></div></small>";
                        }
                    //}
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