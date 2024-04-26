<?php
$mysqli2 = require ("../database.php");


$input = $_POST['input'];
$date = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime($date . ' - 1 days'));
$sql2 = " SELECT * FROM list_of_objects ORDER BY object_name ASC";
$result3 = $mysqli2->query($sql2);
$mysqli2->close();
$data_name = array();


$mysqli2 = require ("../database.php");


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
  if ($data3[$x] == null && $data1[$x] == $input) {
    static $dd = 1;

    $search = $data1[$x] . "";
    $numberval[$count] = $data1[$x] . "";
    $count = 1;
    echo "<div>";
    echo "<p style='margin:auto'>" . $data2[$x] . "<p>";

    $dd++;


    $row = 0;
    $shi_idm = array();
    $shi_namem = array();
    $sqlshm = "SELECT * FROM create_shift WHERE object_id='$data1[$x]' ";
    $fetchcm = mysqli_query($conn2, $sqlshm);
    if (mysqli_num_rows($fetchcm) > 0) {


      while ($rows_cm = mysqli_fetch_assoc($fetchcm)) {
        array_push($shi_idm, $rows_cm['id_shift']);
        array_push($shi_namem, $rows_cm['shift_name']);

      }
      for ($k = 0; $k < count($shi_idm); $k++) {

        $sqldd[$k] = "SELECT * FROM saved_shift_data LEFT JOIN attendance ON saved_shift_data.id = attendance.planned_id WHERE (id_of_shift='$shi_idm[$k]' AND saved_date='$date') OR (id_of_shift='$shi_idm[$k]' AND saved_date='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL) ";
      }
      for ($k = 0; $k < count($shi_idm); $k++) {

        $fetchddm = mysqli_query($conn2, $sqldd[$k]);

        while ($rows_dm = mysqli_fetch_assoc($fetchddm)) {
          if ($rows_dm['saved_date'] == $yesterday) {
            $add_ym = "(yesterday)";
          } else {
            $add_ym = "";
          }
          echo "<small><div ><p style='display:inline'>" . substr($rows_dm['saved_from'], 0, -3) . "-" . substr($rows_dm['saved_to'], 0, -3) . " " . $shi_namem[$k] . " " . $add_ym . " | " . $rows_dm['user_name'] . " </p><p style='margin:auto;float:right'>";
          /**Smena jeste nezacala */
          if ($rows_dm['log_from'] == null && strtotime($rows_dm['saved_from']) > strtotime(date('H:i:s'))) {
            echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>--:-- / --:--</div><div style='float:right'>Has not started:&nbsp;&nbsp;</div>";
            /**Smena zacal, ale prichod neni potvrzeny */
          } else if ($rows_dm['log_from'] == null) {
            echo "<div style='border-width: thin;float:right;color:red;padding-left:2px;padding-right:2px'>--:-- / --:--</div><div style='float:right;color:red'>Has not started:&nbsp;&nbsp;</div>";
            /**Potvrzeny prichod, nepotvrzeny odchod */
          } else if ($rows_dm['log_to'] == null && $rows_dm['log_from'] != null) {
            if (strtotime($rows_dm['saved_to']) > strtotime($rows_dm['saved_from'])) {
              if (strtotime($rows_dm['saved_to']) < strtotime(date('H:i:s'))) {
                echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F'>Active:&nbsp;&nbsp;</div>";
              } else {
                echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:green'>Active:&nbsp;&nbsp;</div>";
              }
            } else {
              if (strtotime($rows_dm['saved_to']) + 86400 < strtotime(date('H:i:s'))) {
                echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F'>Active:&nbsp;&nbsp;</div>";
              } else {
                echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:green'>Active:&nbsp;&nbsp;</div>";
              }
            }
            /**Potvrzeny prichod, potvrzeny odchod */
          } else if ($rows_dm['log_to'] != null && $rows_dm['log_from'] != null) {
            if (strtotime($rows_dm['saved_to']) > strtotime($rows_dm['saved_from'])) {
              if (strtotime($rows_dm['saved_to']) + 420 > strtotime($rows_dm['log_to'])) {
                echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / " . substr($rows_dm['log_to'], 0, -3) . "</div><div style='float:right'>Ended:&nbsp;&nbsp;</div>";

              } else {
                echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / " . substr($rows_dm['log_to'], 0, -3) . "</div><div style='float:right;color:#E49B0F'>Ended:&nbsp;&nbsp;</div>";
              }

            } else {
              if (strtotime($rows_dm['saved_from']) < strtotime($rows_dm['log_to'])) {
                $plus = 0;
              } else {
                $plus = 86400;
              }
              if (strtotime($rows_dm['saved_to']) + 86820 > strtotime($rows_dm['log_to']) + $plus) {
                echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / " . substr($rows_dm['log_to'], 0, -3) . "</div><div style='float:right'>Ended:&nbsp;&nbsp;</div>";
              } else {
                echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_dm['log_from'], 0, -3) . " / " . substr($rows_dm['log_to'], 0, -3) . "</div><div style='float:right;color:#E49B0F'>Ended:&nbsp;&nbsp;</div>";
              }

            }
          }
          echo "</p></div></small>";
        }

      }

    }















    for ($h = 0; $h < count($data2); $h++) {
      if ($search == $data4[$h]) {
        sub_object($search, $data1, $data2, $data3, $data4);
        $row++;
        break;
      }
    }

    echo "</div>";




  }

}

function sub_object($searching, $dat1, $dat2, $dat3, $dat4)
{
  static $dd = 1;
  global $conn2;
  global $date;
  global $yesterday;
  $find = 0;
  $shi_id = array();
  $shi_name = array();

  for ($i = 0; $i < count($dat2); $i++) {
    $shi_id = [];
    if ($searching == $dat4[$i]) {
      if ($find == 0) {
        $find = 1;

      } else {

      }
      echo "<div style='border: solid #aaa;padding: 5px;border-width: thin'>";

      echo "<h6 >" . $dat2[$i] . " : </h6>";
      $sqlsh = "SELECT * FROM create_shift WHERE object_id='$dat1[$i]' ";
      $fetchc = mysqli_query($conn2, $sqlsh);
      if (mysqli_num_rows($fetchc) > 0) {


        while ($rows_c = mysqli_fetch_assoc($fetchc)) {
          array_push($shi_id, $rows_c['id_shift']);
          array_push($shi_name, $rows_c['shift_name']);

        }
        for ($k = 0; $k < count($shi_id); $k++) {

          $sqldd[$k] = "SELECT * FROM saved_shift_data LEFT JOIN attendance ON saved_shift_data.id = attendance.planned_id WHERE (id_of_shift='$shi_id[$k]' AND saved_date='$date') OR (id_of_shift='$shi_id[$k]' AND saved_date='$yesterday' AND log_from IS NOT NULL AND log_to IS NULL) ";
        }
        for ($k = 0; $k < count($shi_id); $k++) {

          $fetchdd = mysqli_query($conn2, $sqldd[$k]);

          while ($rows_d = mysqli_fetch_assoc($fetchdd)) {
            if ($rows_d['saved_date'] == $yesterday) {
              $add_y = "(yesterday)";
            } else {
              $add_y = "";
            }
            echo "<small><div ><p style='display:inline'>" . substr($rows_d['saved_from'], 0, -3) . "-" . substr($rows_d['saved_to'], 0, -3) . " " . $shi_name[$k] . " " . $add_y . " | " . $rows_d['user_name'] . " </p><p style='margin:auto;float:right'>";
            /**Smena jeste nezacala */
            if ($rows_d['log_from'] == null && strtotime($rows_d['saved_from']) > strtotime(date('H:i:s'))) {
              echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>--:-- / --:--</div><div style='float:right'>Has not started:&nbsp;&nbsp;</div>";
              /**Smena zacal, ale prichod neni potvrzeny */
            } else if ($rows_d['log_from'] == null) {
              echo "<div style='border-width: thin;float:right;color:red;padding-left:2px;padding-right:2px'>--:-- / --:--</div><div style='float:right;color:red'>Has not started:&nbsp;&nbsp;</div>";
              /**Potvrzeny prichod, nepotvrzeny odchod */
            } else if ($rows_d['log_to'] == null && $rows_d['log_from'] != null) {
              if (strtotime($rows_d['saved_to']) > strtotime($rows_d['saved_from'])) {
                if (strtotime($rows_d['saved_to']) < strtotime(date('H:i:s'))) {
                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F'>Active:&nbsp;&nbsp;</div>";
                } else {
                  echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:green'>Active:&nbsp;&nbsp;</div>";
                }
              } else {
                if (strtotime($rows_d['saved_to']) + 86400 < strtotime(date('H:i:s'))) {
                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:#E49B0F'>Active:&nbsp;&nbsp;</div>";
                } else {
                  echo "<div style='border-width: thin;float:right;color:green;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / --:--</div><div style='float:right;color:green'>Active:&nbsp;&nbsp;</div>";
                }
              }
              /**Potvrzeny prichod, potvrzeny odchod */
            } else if ($rows_d['log_to'] != null && $rows_d['log_from'] != null) {
              if (strtotime($rows_d['saved_to']) > strtotime($rows_d['saved_from'])) {
                if (strtotime($rows_d['saved_to']) + 420 > strtotime($rows_d['log_to'])) {
                  echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / " . substr($rows_d['log_to'], 0, -3) . "</div><div style='float:right'>Ended:&nbsp;&nbsp;</div>";

                } else {
                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / " . substr($rows_d['log_to'], 0, -3) . "</div><div style='float:right;color:#E49B0F'>Ended:&nbsp;&nbsp;</div>";
                }

              } else {
                if (strtotime($rows_d['saved_from']) < strtotime($rows_d['log_to'])) {
                  $plus = 0;
                } else {
                  $plus = 86400;
                }
                if (strtotime($rows_d['saved_to']) + 86820 > strtotime($rows_d['log_to']) + $plus) {
                  echo "<div style='border-width: thin;float:right;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / " . substr($rows_d['log_to'], 0, -3) . "</div><div style='float:right'>Ended:&nbsp;&nbsp;</div>";
                } else {
                  echo "<div style='border-width: thin;float:right;color:#E49B0F;padding-left:2px;padding-right:2px'>" . substr($rows_d['log_from'], 0, -3) . " / " . substr($rows_d['log_to'], 0, -3) . "</div><div style='float:right;color:#E49B0F'>Ended:&nbsp;&nbsp;</div>";
                }

              }
            }
            echo "</p></div></small>";
          }

        }

      }


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



      echo "</div>";
      echo "<br>";
    }
  }


}


?>