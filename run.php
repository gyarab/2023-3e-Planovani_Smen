<?php
          $mysqli_cal = require __DIR__ . "/database.php";
          $sql_cal = " SELECT * FROM create_shift ORDER BY id_shift ASC";
          $cols[] = array();
          $result_cal = $mysqli_cal->query($sql_cal);
          $r = 0;
          while ($rows_cal = $result_cal->fetch_assoc()) {
              $cols[$r] = $rows_cal['shift_name'];
              $r++;
          }
          $number = count($cols);
          $col_code = "";
          for($i = 0; $i < $number;  $i++){
            $col_code = $col_code. "<th>". $cols[$i]. "</th>";
            /*echo $students[$i];
            echo "<br>";*/
          }
          $final_col_code = "<table><tr>".$col_code."</tr></table>";
          echo $final_col_code ;
          $mysqli_cal->close();
          ?>