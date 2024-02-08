
<?php
$mysqli = require __DIR__ . "/database.php";
if(isset($_POST['input'])){

    //$mysqli = require __DIR__ . "/database.php";
  //include("database.php");
  $idbtn = $_POST['btns'];
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
           
           //echo $firstname;
           
           echo "<br><button onClick='closebtn(this.id)' id='b".$idbtn.$id."'>". $firstname. " ".$middlename. " ". $lastname. " - ". $position . "</button>";
           //echo "<input type='hidden' id=hn".$idbtn.$id." value='".$id."'>";
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
}
//echo "Hello";
?> 