<?php
$mysqli = require __DIR__ . "/database.php";


    //$mysqli = require __DIR__ . "/database.php";
  //include("database.php");
    $conn = new mysqli($host, $username, $password, $dbname);

    $input = $_POST['input'];

    $query = "SELECT * FROM user2 WHERE firstname LIKE '{$input}%' OR middlename LIKE '{$input}%' OR lastname LIKE '{$input}%' OR position LIKE '{$input}%'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)>0){?>
    <!--<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Firts name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>Position</th>
            </tr>
        </thead>

        <tbody>-->
            <?php

while($row = mysqli_fetch_assoc($result)){
           $id = $row['id'];
           $firstname = $row['firstname'];
           $middlename = $row['middlename'];
           $lastname = $row['lastname'];
           $position = $row['position'];
           $email = $row['email'];
           $code = $row['countryCode'];
           $phone = $row['phone'];
           $ps;
           if ($rows['position'] == "admin") {
            $ps = "Admin";
          } else if ($rows['position'] == "fulltime_employee") {
            $ps = "HPP";
          } else if($rows['position'] == "manager") {
            $ps =  "Manager";
          }else{
            $ps = "DPP";
          }
           //echo $firstname;
           
           //echo "<br><button onClick='closebtn(this.id)' id='b".$idbtn.$id."'>". $firstname. " ".$middlename. " ". $lastname. " - ". $position . "</button>";
           //echo "<input type='hidden' id=hn".$idbtn.$id." value='".$id."'>";
        echo "<div id='".$id."div' class='cont' style='margin-bottom: 35px;'>";
        echo "<p>".$firstname." ".$middlename." ".$lastname." - ".$ps."</p>";
        echo "<div class='popup'>";
        echo "<button id='".$id."' class='btn btn-light btn-outline-success' style='display:inline;height:20px;width:20px;' onclick='copyfunction1(this.id)'></button>";
        echo "<p style='display:inline'>&nbsp;&nbsp;</p>";
        echo "<p id='".$id." p1' style='display:inline;height:20px;width:20px'> ".$email."</p>";
        echo "<span class='popuptext' id='".$id." pop1'>Email copied</span>";
        echo "</div><br>";
        
        echo "<div class='popup'>";
    
        echo "<button id='".$id."' class='btn btn-light btn-outline-success' style='display:inline;height:20px;width:20px' onclick='copyfunction2(this.id)'></button>";
        echo " <p style='display:inline'>&nbsp;&nbsp;</p>";
        echo "<p id='".$id. " p2+' style='display:inline;height:20px;width:20px'> +".$code."</p>";
        echo "<p style='display:inline'>&nbsp;</p>";
        echo "<p id='".$id. " p2' style='display:inline'> ".$phone."</p>";
        echo " <span class='popuptext' id='".$id." pop2'>Phone copied</span>";
        echo "</div>";
        echo "</div>";
        }
?>

    <!--    <tr>
            <td><?php //echo $id;?></td>
            <td><?php //echo $firstname;?></td>
            <td><?php //echo $middlename;?></td>
            <td><?php //echo $lastname;?></td>
            <td><?php //echo $position;?></td>
        </tr>
        </tbody>
    </table>-->
    
    <?php


    }else{
        echo"<h6>No data found<h6>";
    }
    //echo"Hello";
//echo "Hello";

?> 