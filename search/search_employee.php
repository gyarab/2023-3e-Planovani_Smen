<?php
$mysqli = require ("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);
$input = $_POST['input'];

$arr = array();
$arr = explode(" ", $input);
$query = "SELECT * FROM user WHERE firstname LIKE '$arr[0]%' AND middlename LIKE '$arr[1]%' AND lastname LIKE '$arr[2]%' ";
if (count($arr) != 0) {

  for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i] == " ") {
      array_splice($arr, $i);
    }
  }
  for ($i = 0; $i < count($arr); $i++) {
  }
}

if (count($arr) > 2 && ($arr[count($arr) - 1] != "" || $arr[count($arr) - 1] != " ")) {

  for ($i = 2; $i < count($arr) - 1; $i++) {

    $arr[1] = $arr[1] . " " . $arr[$i];

  }
  $arr[3] = $arr[count($arr) - 1];

  for ($i = 0; $i < count($arr); $i++) {
    echo "<p>" . $i . "-" . $arr[$i] . "-</p>";
  }
}

$quer = array();
$quer2 = array();
$quer3 = array();

$c = 0;

if ($arr[0] == null) {
  $quer[$c] = "SELECT * FROM user";
  $c++;
} else if ($arr[0] != " " && $arr[1] == null) {
  for ($i = 0; $i < 1; $i++) {
    for ($x = 0; $x < 1; $x++) {
      for ($z = 0; $z < 1; $z++) {
        $quer[$c] = "SELECT * FROM user WHERE firstname LIKE '$arr[$i]%' ";
        $c++;
        $quer[$c] = "SELECT * FROM user WHERE middlename LIKE '$arr[$x]%' ";
        $c++;
        $quer[$c] = "SELECT * FROM user WHERE lastname LIKE '$arr[$z]%' ";
        $c++;
      }
    }
  }
} else if ($arr[0] != " " && $arr[1] != null && $arr[2] == null) {
  for ($i = 0; $i < 2; $i++) {
    for ($x = 0; $x < 2; $x++) {

      if ($i != $x) {
        $quer[$c] = "SELECT * FROM user WHERE firstname LIKE '$arr[$i]%' AND middlename LIKE '$arr[$x]%' ";
        $c++;
        $quer[$c] = "SELECT * FROM user WHERE firstname LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' ";
        $c++;
        $quer[$c] = "SELECT * FROM user WHERE middlename LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' ";
        $c++;
      }
    }
  }
} else {
  for ($i = 0; $i < 3; $i++) {
    for ($x = 0; $x < 3; $x++) {
      for ($z = 0; $z < 3; $z++) {
        if ($i != $x && $i != $z && $z != $x) {
          $quer[$c] = "SELECT * FROM user WHERE firstname LIKE '{$arr[$i]}%' AND middlename LIKE '{$arr[$x]}%' AND lastname LIKE '{$arr[$z]}%' ";
          $c++;
        }

      }
    }
  }
}

$id_arr = array();
$firstname_arr = array();
$middlename_arr = array();
$lastname_arr = array();
$position_arr = array();
$email_arr = array();
$code_arr = array();
$phone_arr = array();
$pos = $_POST['position'];
$obj = $_POST['object'];
$shi = $_POST['shift'];
if (count($pos) != 0) {
  for ($d = 0; $d < $c; $d++) {
    for ($e = 0; $e < count($pos); $e++) {
      if ($arr[0] == null) {
        if ($e == 0) {
          $quer[$d] = $quer[$d] . " WHERE (position='" . $pos[$e] . "' ";
        } else {
          $quer[$d] = $quer[$d] . "OR position='" . $pos[$e] . "' ";
        }
        if ($e == count($pos) - 1) {
          $quer[$d] = $quer[$d] . ")";
        }
      } else {
        if ($e == 0) {
          $quer[$d] = $quer[$d] . " AND (position='" . $pos[$e] . "' ";
        } else {
          $quer[$d] = $quer[$d] . "OR position='" . $pos[$e] . "' ";
        }
        if ($e == count($pos) - 1) {
          $quer[$d] = $quer[$d] . ")";
        }
      }
    }
  }
}

for ($d = 0; $d < $c; $d++) {
  $result = mysqli_query($conn, $quer[$d]);
  if (mysqli_num_rows($result) > 0) { ?>

    <?php

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $k = 0;
      if (count($obj) != 0 || count($shi) != 0) {
        if (count($obj) != 0) {
          $quer2[0] = "SELECT * FROM manager_rights WHERE id_user='$id' ";

          for ($p = 0; $p < count($obj); $p++) {
            if ($p == 0) {
              $quer2[0] = $quer2[0] . "AND (object_id='" . $obj[$p] . "' ";
            } else {
              $quer2[0] = $quer2[0] . "OR object_id='" . $obj[$p] . "' ";
            }
            if ($p == count($obj) - 1) {
              $quer2[0] = $quer2[0] . ")";
            }
          }

          $fetch2 = mysqli_query($conn, $quer2[0]);
          if (mysqli_num_rows($fetch2) > 0) {
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $position = $row['position'];
            $email = $row['email'];
            $code = $row['countryCode'];
            $phone = $row['phone'];
            if (in_array($id, $id_arr)) {

            } else {
              array_push($id_arr, $id);
              array_push($firstname_arr, $firstname);
              array_push($middlename_arr, $middlename);
              array_push($lastname_arr, $lastname);
              array_push($position_arr, $position);
              array_push($email_arr, $email);
              array_push($code_arr, $code);
              array_push($phone_arr, $phone);

            }
          }
        }
        if (count($shi) != 0 && count($obj) != 0) {


          for ($n = 0; $n < count($shi); $n++) {
            $quer4 = "SELECT * FROM shift_assignment WHERE user_id='$id' ";
            $pos_boo = false;
            $obj_boo = false;

            $quer4 = $quer4 . "AND shift_name='" . $shi[$n] . "' ";

            $fetch4 = mysqli_query($conn, $quer4);
            if (mysqli_num_rows($fetch4) > 0) {
              $pos_boo = true;
            }
            if ($pos_boo == true) {

              $quer5 = "SELECT * FROM create_shift WHERE shift_name='$shi[$n]' ";
              $fetch5 = mysqli_query($conn, $quer5);
              $id_sh_ob = array();
              if (mysqli_num_rows($fetch5) > 0) {

                $result_id = mysqli_query($conn, $quer5);
                while ($row_id = mysqli_fetch_assoc($result_id)) {
                  array_push($id_sh_ob, $row_id['object_id']);
                }
                for ($j = 0; $j < count($obj); $j++) {

                  if (in_array($obj[$j], $id_sh_ob)) {
                    $obj_boo = true;
                  }
                }
              } else {
                $obj_boo = false;
              }

              if ($pos_boo == true && $obj_boo == true) {
                $firstname = $row['firstname'];
                $middlename = $row['middlename'];
                $lastname = $row['lastname'];
                $position = $row['position'];
                $email = $row['email'];
                $code = $row['countryCode'];
                $phone = $row['phone'];
                if (in_array($id, $id_arr)) {

                } else {
                  array_push($id_arr, $id);
                  array_push($firstname_arr, $firstname);
                  array_push($middlename_arr, $middlename);
                  array_push($lastname_arr, $lastname);
                  array_push($position_arr, $position);
                  array_push($email_arr, $email);
                  array_push($code_arr, $code);
                  array_push($phone_arr, $phone);

                }
              }
            }


          }

        } else if (count($shi) != 0) {

          $quer3[0] = "SELECT * FROM shift_assignment WHERE user_id='$id' ";
          for ($r = 0; $r < count($shi); $r++) {
            if ($r == 0) {
              $quer3[0] = $quer3[0] . "AND (shift_name='" . $shi[$r] . "' ";
            } else {
              $quer3[0] = $quer3[0] . "OR shift_name='" . $shi[$r] . "' ";
            }
            if ($r == count($shi) - 1) {
              $quer3[0] = $quer3[0] . ")";
            }
          }

          $fetch3 = mysqli_query($conn, $quer3[0]);
          if (mysqli_num_rows($fetch3) > 0) {
            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $position = $row['position'];
            $email = $row['email'];
            $code = $row['countryCode'];
            $phone = $row['phone'];
            if (in_array($id, $id_arr)) {

            } else {
              array_push($id_arr, $id);
              array_push($firstname_arr, $firstname);
              array_push($middlename_arr, $middlename);
              array_push($lastname_arr, $lastname);
              array_push($position_arr, $position);
              array_push($email_arr, $email);
              array_push($code_arr, $code);
              array_push($phone_arr, $phone);

            }
          }


        }
      } else {
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $lastname = $row['lastname'];
        $position = $row['position'];
        $email = $row['email'];
        $code = $row['countryCode'];
        $phone = $row['phone'];
        if (in_array($id, $id_arr)) {

        } else {
          array_push($id_arr, $id);
          array_push($firstname_arr, $firstname);
          array_push($middlename_arr, $middlename);
          array_push($lastname_arr, $lastname);
          array_push($position_arr, $position);
          array_push($email_arr, $email);
          array_push($code_arr, $code);
          array_push($phone_arr, $phone);

        }
      }
    }
    ?>


    <?php


  } else {
  }

}
if (0 == count($id_arr)) {
  echo "<h6>No data found<h6>";
} else {
  for ($i = 0; $i < count($id_arr); $i++) {

    $ps;
    if ($position_arr[$i] == "admin") {
      $ps = "Admin";
    } else if ($position_arr[$i] == "fulltime_employee") {
      $ps = "HPP";
    } else if ($position_arr[$i] == "manager") {
      $ps = "Manager";
    } else {
      $ps = "DPP";
    }
    echo "<div id='" . $id_arr[$i] . "div' class='cont' style='margin-bottom: 35px;'>";
    echo "<p>" . $lastname_arr[$i] . " " . $middlename_arr[$i] . " " . $firstname_arr[$i] . " - " . $ps . "</p>";
    echo "<div class='popup'>";
    echo "<button id='" . $id_arr[$i] . "' class='btn btn-light btn-outline-success' style='display:inline;height:20px;width:20px;' onclick='copyfunction1(this.id)'></button>";
    echo "<p style='display:inline'>&nbsp;&nbsp;</p>";
    echo "<p id='" . $id_arr[$i] . " p1' style='display:inline;height:20px;width:20px'> " . $email_arr[$i] . "</p>";
    echo "<span class='popuptext' id='" . $id_arr[$i] . " pop1'>Email copied</span>";
    echo "</div><br>";

    echo "<div class='popup'>";

    echo "<button id='" . $id_arr[$i] . "' class='btn btn-light btn-outline-success' style='display:inline;height:20px;width:20px' onclick='copyfunction2(this.id)'></button>";
    echo " <p style='display:inline'>&nbsp;&nbsp;</p>";
    echo "<p id='" . $id_arr[$i] . " p2+' style='display:inline;height:20px;width:20px'> +" . $code_arr[$i] . "</p>";
    echo "<p style='display:inline'>&nbsp;</p>";
    echo "<p id='" . $id_arr[$i] . " p2' style='display:inline'> " . $phone_arr[$i] . "</p>";
    echo " <span class='popuptext' id='" . $id_arr[$i] . " pop2'>Phone copied</span>";
    echo "</div>";





    if ($position_arr[$i] == "manager") {
      echo "<br>";
      echo "<br>";
      echo "<font size='+1'><label>Editing rights for :</label></font>";
      echo "<br>";
      $input = $id_arr[$i];
      $sql = "SELECT * FROM manager_rights WHERE id_user='$input' ";


      $fetch = mysqli_query($conn, "SELECT * FROM list_of_objects");
      $data2 = array();
      $data3 = array();
      $data1 = array();
      $data4 = array();
      $get_id = array();
      $numberval = array();
      $arr2 = array();

      $result_get = $mysqli->query($sql);
      while ($rows_get = $result_get->fetch_assoc()) {
        $get = $rows_get['object_name'];
        $ge = $rows_get['object_id'];
        array_push($get_id, $ge);

      }

      if (mysqli_num_rows($fetch) > 0) {
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
          static $dd = 1;
          $b = false;

          $search = $data1[$x] . "";
          $numberval[$count] = $data1[$x] . "";
          $count++;
          $b = includes($search, $data1, $data2, $data3, $data4, $get_id, $count);
          $dd++;
          if ($b == true) {
            echo "<p>Rights for : <b>" . $data2[$x] . "</b></p>";

            $arr2 = [];


            $row = 0;
            echo "<p style='display: inline'>";
            if (in_array($data1[$x], $get_id)) {
              array_push($arr2, $data2[$x]);
            }
            for ($h = 0; $h < count($data2); $h++) {
              if ($search == $data4[$h]) {
                sub_object($search, $data1, $data2, $data3, $data4, $get_id, $count);
                $row++;
                break;
              }
            }
            sort($arr2);
            if (count($arr2) > 0) {
              for ($h = 0; $h < count($arr2); $h++) {
                if ($h + 1 == count($arr2)) {
                  echo $arr2[$h];

                } else {
                  echo $arr2[$h] . ", ";
                }
              }
            }
            echo "</p>";
            echo "<br>";
            echo "<hr>";
          }


        }

      }

    }
    if ($position_arr[$i] != "manager") {
      echo "<br>";
    }
    echo "<br>";
    echo "<font size='+1'><label>Assigned shifts :</label></font>";
    echo "<br>";


    $input = $id_arr[$i];

    $sql2 = "SELECT * FROM shift_assignment WHERE user_id='$input' ";
    $result_get2 = $mysqli->query($sql2);
    $fetch2 = mysqli_query($conn, "SELECT * FROM list_of_objects ");
    $data2 = array();
    $data3 = array();
    $data1 = array();
    $data4 = array();
    $data2 = [];
    $data3 = [];
    $data1 = [];
    $data4 = [];
    $get_id2 = array();
    $get_name2 = array();
    $sm2 = array();
    $get_object2 = array();
    $numberval2 = array();
    $arr3[][] = array();
    $arr_help2 = array();
    $rows2 = 0;
    $help2 = 0;


    while ($rows_get2 = $result_get2->fetch_assoc()) {
      $ge2 = $rows_get2['shift_id'];
      array_push($get_id2, $ge2);
      $get2 = $rows_get2['shift_name'];
      array_push($get_name2, $get2);
    }

    for ($d = 0; $d < count($get_id2); $d++) {
      $sql_obj2 = "SELECT * FROM create_shift WHERE id_shift='$get_id2[$d]'";
      $result_obj2 = $mysqli->query($sql_obj2);
      while ($rows_obj2 = $result_obj2->fetch_assoc()) {
        $gee2 = $rows_obj2['object_id'];
        array_push($get_object2, $gee2);
        if (in_array($gee2, $sm2)) {
        } else {
          array_push($sm2, $gee2);
        }
      }

    }

    if (mysqli_num_rows($fetch2) > 0) {
      /**Sorting data alphabetically */
      while ($rows_dat3 = mysqli_fetch_assoc($fetch2)) {
        $data1[] = $rows_dat3['id_object'];
        $data2[] = $rows_dat3['object_name'];
        $data3[] = $rows_dat3['superior_object_name'];
        $data4[] = $rows_dat3['superior_object_id'];
      }
      array_multisort($data2, $data1, $data3, $data4);
    }

    $count2 = 0;
    $dd2 = 1;
    for ($x = 0; $x < count($data2); $x++) {
      if ($data3[$x] == null) {
        static $dd2 = 1;
        $help2 = 0;
        $search2 = $data1[$x] . "";
        $numberval2[$count2] = $data1[$x] . "";
        $count2++;
        $rows2 = 0;
        $help2 = 0;
        $pus = 1;

        $dd2++;
        $arr3 = [];
        if ($help2 != 1) {

          $arr3 = [];
          $row2 = 0;

          if (in_array($data1[$x], $sm2)) {
            $arr3[$rows2][0] = $data2[$x];
            for ($u = 0; $u < count($get_object2); $u++) {
              if ($get_object2[$u] == $data1[$x]) {
                $arr3[$rows2][$pus] = $get_name2[$u];
                $pus++;
              }

            }
            $rows2++;
          }
          for ($h = 0; $h < count($data2); $h++) {
            if ($search2 == $data4[$h]) {
              sub_object2($search2, $data1, $data2, $data3, $data4, $get_id2, $count2, $get_object2, $get_name2, $sm2);
              $row2++;
              break;
            }
          }

          if (count($arr3) > 0) {
            echo "<p>Asigned shifts for : <b>" . $data2[$x] . "</b></p>";
            echo "<p style='display: inline'>";
            $rrt2 = 0;
            for (; ; ) {
              if ($arr3[$rrt2][0] == "" || $arr3[$rrt2][0] == null) {
                break;

              } else {
                echo "<p>" . $arr3[$rrt2][0] . " - ";
                $arr_help2 = [];
                $raz2 = 1;
                for (; ; ) {
                  if ($arr3[$rrt2][$raz2] == "" || $arr3[$rrt2][$raz2] == null) {
                    break;
                  } else {
                    array_push($arr_help2, $arr3[$rrt2][$raz2]);
                    $raz2++;
                  }
                }
                sort($arr_help2);
                for ($h = 0; $h < count($arr_help2); $h++) {
                  if ($h + 1 == count($arr_help2)) {
                    echo $arr_help2[$h];

                  } else {
                    echo $arr_help2[$h] . ", ";
                  }
                }
                echo "</p>";
                $rrt2++;
              }
            }
            echo "</p>";
            echo "<hr>";
          }

        }


      }

    }

    echo "</div>";
  }

}


function includes($searching, $dat1, $dat2, $dat3, $dat4, $id, $co)
{
  static $dd = 1;
  $find = 0;
  for ($i = 0; $i < count($dat2); $i++) {
    if ($searching == $dat4[$i]) {
      if (in_array($dat1[$i], $id)) {
        return true;
      }


      $dd++;
      $row = 0;
      $sea = $dat1[$i] . "";
      if ($sea != null) {
        for ($h = 0; $h < count($dat2); $h++) {
          if ($sea == $dat4[$h]) {
            includes($sea, $dat1, $dat2, $dat3, $dat4, $id, $co);
            break;
          }
        }
      }

    }
  }
}

function sub_object($searching, $dat1, $dat2, $dat3, $dat4, $id, $co)
{
  global $arr2;
  static $dd = 1;
  $find = 0;
  for ($i = 0; $i < count($dat2); $i++) {
    if ($searching == $dat4[$i]) {
      if ($find == 0) {
        $find = 1;
      } else {

      }
      if (in_array($dat1[$i], $id)) {
        array_push($arr2, $dat2[$i]);
      }


      $dd++;
      $row = 0;
      $sea = $dat1[$i] . "";
      if ($sea != null) {
        for ($h = 0; $h < count($dat2); $h++) {
          if ($sea == $dat4[$h]) {
            sub_object($sea, $dat1, $dat2, $dat3, $dat4, $id, $co);
            break;
          }
        }
      }
    }
  }

}


function sub_object2($searching, $dat1, $dat2, $dat3, $dat4, $id, $co, $object, $name, $s)
{
  global $arr3;
  global $rows2;
  static $dd2 = 1;
  $find2 = 0;
  $push2 = 1;
  for ($i = 0; $i < count($dat2); $i++) {
    if ($searching == $dat4[$i]) {
      if ($find2 == 0) {
        $find2 = 1;

      } else {

      }

      if (in_array($dat1[$i], $s)) {
        $arr3[$rows2][0] = $dat2[$i];
        for ($u = 0; $u < count($object); $u++) {
          if ($object[$u] == $dat1[$i]) {
            $arr3[$rows2][$push2] = $name[$u];
            $push2++;
          }

        }
        $rows2++;


      }


      $dd2++;
      $row2 = 0;
      $sea = $dat1[$i] . "";
      if ($sea != null) {
        for ($h = 0; $h < count($dat2); $h++) {
          if ($sea == $dat4[$h]) {
            sub_object2($sea, $dat1, $dat2, $dat3, $dat4, $id, $co, $object, $name, $s);
            break;
          }
        }
      }
    }
  }

}
?>