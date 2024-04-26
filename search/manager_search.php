<?php
$mysqli = require ("../database.php");


$conn = new mysqli($host, $username, $password, $dbname);

$input = $_POST['input'];


if ($input != null && $input != "") {
  $arr = array();
  $arr = explode(" ", $input);

  $query = "SELECT * FROM user2 WHERE firstname LIKE '$arr[0]%' AND middlename LIKE '$arr[1]%' AND lastname LIKE '$arr[2]%' ";

  $quer = array();

  $c = 0;

  if ($arr[0] == null) {
    $quer[$c] = "SELECT * FROM user2";
    $c++;
  } else if ($arr[0] != null && $arr[1] == null) {
    for ($i = 0; $i < 1; $i++) {
      for ($x = 0; $x < 1; $x++) {
        for ($z = 0; $z < 1; $z++) {
          $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND position='manager' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE middlename LIKE '$arr[$x]%' AND position='manager' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE lastname LIKE '$arr[$z]%' AND position='manager' ";
          $c++;
        }
      }
    }
  } else if ($arr[0] != null && $arr[1] != null && $arr[2] == null) {
    for ($i = 0; $i < 2; $i++) {
      for ($x = 0; $x < 2; $x++) {
        if ($i != $x) {
          $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND middlename LIKE '$arr[$x]%' AND position='manager' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' AND position='manager' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE middlename LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' AND position='manager' ";
          $c++;
        }

      }
    }
  } else {
    for ($i = 0; $i < 3; $i++) {
      for ($x = 0; $x < 3; $x++) {
        for ($z = 0; $z < 3; $z++) {
          if ($i != $x && $i != $z && $z != $x) {
            $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '{$arr[$i]}%' AND middlename LIKE '{$arr[$x]}%' AND lastname LIKE '{$arr[$z]}%' AND position='manager' ";
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

  for ($d = 0; $d < $c; $d++) {
    $result = mysqli_query($conn, $quer[$d]);
    if (mysqli_num_rows($result) > 0) { ?>

      <?php

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
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
      ?>


      <?php


    } else {

    }

  }

  if (0 == count($id_arr)) {
    echo "<h6>No data found<h6>";
  } else {
    echo "<select id='se_man' class='form-select' size='7' aria-label='size 3 select example'>";
    for ($i = 0; $i < count($id_arr); $i++) {

      echo "<option onclick='Pick_manger(this.value)' id='op_man" . $id_arr[$i] . "' value='" . $id_arr[$i] . "' >" . $lastname_arr[$i] . " " . $middlename_arr[$i] . " " . $firstname_arr[$i] . "</option>";


    }
    echo "</select>";
  }
}


?>