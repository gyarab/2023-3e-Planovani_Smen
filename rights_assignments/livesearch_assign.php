<?php
//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");

if (isset($_POST['input'])) {

  //$mysqli = require __DIR__ . "/database.php";
  //include("database.php");
  $idbtn = $_POST['btns'];
  $conn = new mysqli($host, $username, $password, $dbname);

  $input = $_POST['input'];
  $shi_id = $_POST['id_sh'];


  $arr = array();
  $arr = explode(" ", $input);
  $query = "SELECT * FROM user2 WHERE firstname LIKE '$arr[0]%' AND middlename LIKE '$arr[1]%' AND lastname LIKE '$arr[2]%' ";
  if (count($arr) != 0) {

    for ($i = 0; $i < count($arr); $i++) {
      if ($arr[$i] == " ") {
        array_splice($arr, $i);
      }
    }
    for ($i = 0; $i < count($arr); $i++) {
      //echo"<p>".$i."-".$arr[$i]."-</p>";
    }
  }

  if (count($arr) > 2 && ($arr[count($arr) - 1] != "" || $arr[count($arr) - 1] != " ")) {

    for ($i = 2; $i < count($arr) - 1; $i++) {
      /*if($arr[$i] == " "){
        array_splice($arr, $i);
      }**/
      $arr[1] = $arr[1] . " " . $arr[$i];

    }
    $arr[3] = $arr[count($arr) - 1];

    for ($i = 0; $i < count($arr); $i++) {
      //echo"<p>".$i."-".$arr[$i]."-</p>";
    }
  }



  $quer = array();
  $quer2 = array();
  $quer3 = array();
  $id_arr = array();
  $firstname_arr = array();
  $middlename_arr = array();
  $lastname_arr = array();
  $position_arr = array();
  $email_arr = array();
  $code_arr = array();
  $phone_arr = array();

  $c = 0;

  if ($arr[0] == null) {
    $quer[$c] = "SELECT * FROM user2";
    $c++;
  } else if ($arr[0] != " " && $arr[1] == null) {
    for ($i = 0; $i < 1; $i++) {
      for ($x = 0; $x < 1; $x++) {
        for ($z = 0; $z < 1; $z++) {
          /*$quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND middlename LIKE '$arr[$x]%' AND lastname LIKE '$arr[$z]%' ";
          $c++;*/
          //echo "<h6>One</h6>";
          $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE middlename LIKE '$arr[$x]%' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE lastname LIKE '$arr[$z]%' ";
          $c++;
        }
      }
    }
  } else if ($arr[0] != " " && $arr[1] != null && $arr[2] == null) {
    for ($i = 0; $i < 2; $i++) {
      for ($x = 0; $x < 2; $x++) {

        if ($i != $x) {
          $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND middlename LIKE '$arr[$x]%' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' ";
          $c++;
          $quer[$c] = "SELECT * FROM user2 WHERE middlename LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' ";
          $c++;
        }
        //}
      }
    }
  } else {
    for ($i = 0; $i < 3; $i++) {
      for ($x = 0; $x < 3; $x++) {
        for ($z = 0; $z < 3; $z++) {
          //echo "<h6>three</h6>";
          if ($i != $x && $i != $z && $z != $x) {
            $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '{$arr[$i]}%' AND middlename LIKE '{$arr[$x]}%' AND lastname LIKE '{$arr[$z]}%' ";
            $c++;
          }

        }
      }
    }
  }
  for ($i = 0; $i < $c; $i++) {
    //echo "<p>".$quer[$i]."</p>";
  }
  for ($d = 0; $d < $c; $d++) {
    //echo "<p>Went</p>";
    $result = mysqli_query($conn, $quer[$d]);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        //if (mysqli_num_rows($fetch2) > 0) {
        $id = $row['id'];
        $q_s = "SELECT * FROM shift_assignment WHERE user_id =$id AND shift_id =$shi_id ";
        /*if (!mysqli_query($conn, $q_s)) {
          echo "<p>".mysqli_error($conn)."</p>";
      }*/
        //echo "<p>".$q_s."</p>";
        $result2 = mysqli_query($conn, $q_s);
        if (mysqli_num_rows($result2) > 0) {
        //echo"<p>true</p>";
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $lastname = $row['lastname'];
        $position = $row['position'];
        $email = $row['email'];
        $code = $row['countryCode'];
        $phone = $row['phone'];

        //$result = mysqli_query($conn, $quer[$d]);
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
        //}
      }
    }
    //$conn->close();
    //$mysqli->close();


  }
  if (0 == count($id_arr)) {
    echo "<h3>No data found<h3>";
  } else {
    echo "<select id='se_man' class='form-select' size='15' style=' font-size: 20px;' aria-label='size 3 select example'>";
    for ($i = 0; $i < count($id_arr); $i++) {
      echo "<option onclick='Pick_em(this.id,this.value)' id='b" . $idbtn . $id_arr[$i] . "' value='" . $lastname_arr[$i] . " " . $middlename_arr[$i] . " " . $firstname_arr[$i] . "' >" . $lastname_arr[$i] . " " . $middlename_arr[$i] . " " . $firstname_arr[$i] . "</option>";

    }
    echo "</select>";
    /*for ($i = 0; $i < count($id_arr); $i++) {
        //echo "<p>".$id_arr[$i]."</p>";
        echo "<br><button onClick='closebtn(this.id)' id='b".$idbtn.$id_arr[$i]."'>". $firstname_arr[$i]. " ".$middlename_arr[$i]. " ". $lastname_arr[$i]. " - ". $position_arr[$i] . "</button>";
     }*/

  }


}
//echo "Hello";
?>