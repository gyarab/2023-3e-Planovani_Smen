<?php
//$mysqli = require __DIR__ . "/database.php";
$mysqli = require("../database.php");


$conn = new mysqli($host, $username, $password, $dbname);

$input = $_POST['input'];
/*if($input != null && $input != ""){
$query = "SELECT * FROM user2 WHERE position='manager' AND (firstname LIKE '{$input}%' OR middlename LIKE '{$input}%' OR lastname LIKE '{$input}%' )";
$result = mysqli_query($conn,$query);
echo "<div style='position: absolute;'>";
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $lastname = $row['lastname'];
        //$position = $row['position'];
        //$email = $row['email'];
        //$code = $row['countryCode'];
        //$phone = $row['phone'];
        //$ps;
        echo "<input id='manager-".$id."' type='button' onclick='Pick_manger(this.id)' class='btn btn-outline-dark' value='".$firstname." ".$middlename." ".$lastname."'>";
    }
}else{
    echo"<h6>No data found<h6>";
}
echo "</div>";
}*/


if($input != null && $input != ""){
$arr = array();
$arr = explode(" ", $input);
//if($arr[0] == ""){
//$query = "SELECT * FROM user2 WHERE firstname LIKE '$input%' OR middlename LIKE '$input%' OR lastname LIKE '$input%' ";
//}else /*if ($arr[1] == "")*/{
  //if($arr[1] == ""){
$query = "SELECT * FROM user2 WHERE firstname LIKE '$arr[0]%' AND middlename LIKE '$arr[1]%' AND lastname LIKE '$arr[2]%' ";
  //}else{
    //$query = "SELECT * FROM user2 WHERE (firstname LIKE '$arr[0]%' OR firstname LIKE '$arr[1]%') AND middlename LIKE '$arr[1]%' AND lastname LIKE '$arr[2]%' ";
  //}
$quer = array();

$c = 0;

if($arr[0] == null){
  $quer[$c] = "SELECT * FROM user2";
  $c++;
}else if($arr[0] != null && $arr[1] == null){
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
}else if($arr[0] != null && $arr[1] != null && $arr[2] == null){
  for ($i = 0; $i < 2; $i++) {
    for ($x = 0; $x < 2; $x++) {
        if($i != $x ){
        $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND middlename LIKE '$arr[$x]%' AND position='manager' ";
        $c++;
        $quer[$c] = "SELECT * FROM user2 WHERE firstname LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' AND position='manager' ";
        $c++;
        $quer[$c] = "SELECT * FROM user2 WHERE middlename LIKE '$arr[$i]%' AND lastname LIKE '$arr[$x]%' AND position='manager' ";
        $c++;
        }

    }
  }
}else{
  for ($i = 0; $i < 3; $i++) {
    for ($x = 0; $x < 3; $x++) {
      for ($z = 0; $z < 3; $z++) {
        if($i != $x && $i != $z && $z != $x ){
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
/*$pos = $_POST['position'];
if(count($pos) != 0){
  for ($d = 0; $d < $c; $d++) {
    for ($e = 0; $e < count($pos); $e++) {
      if($arr[0] == null){
        if($e == 0){
        $quer[$d] = $quer[$d]. " WHERE (position='".$pos[$e]."' ";
        }else{
          $quer[$d] = $quer[$d]. "OR position='".$pos[$e]."' ";
        }
        if($e == count($pos)-1){
          $quer[$d] = $quer[$d]. ")";
        }
      }else{
        if($e == 0){
          $quer[$d] = $quer[$d]. " AND (position='".$pos[$e]."' ";
          }else{
            $quer[$d] = $quer[$d]. "OR position='".$pos[$e]."' ";
          }
          if($e == count($pos)-1){
            $quer[$d] = $quer[$d]. ")";
          }   
    }
  }
  }
}*/
//$ps_arr = array();
//echo "<h6>".$quer[0]."</h6>";
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
    if(in_array($id,$id_arr)){

    }else{
      array_push($id_arr,$id);
      array_push($firstname_arr,$firstname);
      array_push($middlename_arr,$middlename);
      array_push($lastname_arr,$lastname);
      array_push($position_arr,$position);
      array_push($email_arr,$email);
      array_push($code_arr,$code);
      array_push($phone_arr,$phone);

  }
  }
  ?>


  <?php


} else {
  //echo "<h6>No data found<h6>";
}

}
//echo "<h6>k".count($pos)."</h6>";
if(0 == count($id_arr)){
  echo "<h6>No data found<h6>";
}else{
  echo "<select id='se_man' class='form-select' size='7' aria-label='size 3 select example'>";
  for($i = 0; $i < count($id_arr); $i++ ){

    /*$ps;
    if ($position_arr[$i] == "admin") {
      $ps = "Admin";
    } else if ($position_arr[$i]== "fulltime_employee") {
      $ps = "HPP";
    } else if ($position_arr[$i] == "manager") {
      $ps = "Manager";
    } else {
      $ps = "DPP";
    }*/

    echo "<option onclick='Pick_manger(this.value)' id='op_man".$id_arr[$i]."' value='" .$id_arr[$i]."' >".$lastname_arr[$i]." ".$middlename_arr[$i]." ".$firstname_arr[$i]."</option>";

    //echo "<input id='manager-".$id_arr[$i]."' type='button' onclick='Pick_manger(this.id)' class='btn btn-outline-dark' value='".$firstname_arr[$i]." ".$middlename_arr[$i]." ".$lastname_arr[$i]."'>";
    //echo "<br>";



    /*echo "<div id='" . $id_arr[$i] . "div' class='cont' style='margin-bottom: 35px;'>";
    echo "<p>" . $firstname_arr[$i] . " " . $middlename_arr[$i] . " " . $lastname_arr[$i] . " - " . $ps . "</p>";
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
    echo "</div>";*/
  }
  echo "</select>";
}
}


?>