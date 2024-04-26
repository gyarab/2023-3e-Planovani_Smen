<?php
/**tento soubor nacita vsechny nastenky, na ktere ma  uzivatel pravo videt */
$mysqli = require("../database.php");

$conn = new mysqli($host, $username, $password, $dbname);

$position = $_POST['position']; /**pozice registrovaneho uzivatele */
$type = $_POST['type'];/**typ nacteni 
 1 - s edit buttonem
 0 - bez edit buttonu
*/


if($position  == "admin"){
    $sql = "SELECT * FROM  board";

}else if($position == "manager"){
$sql = "SELECT * FROM  board WHERE manager=1 ";
}else if($position == "fulltime_employee"){
    $sql = "SELECT * FROM  board WHERE employee_full=1 ";
}else{
    $sql = "SELECT * FROM  board WHERE employee_part=1 ";
}
$fetch = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_assoc($fetch)) {
    $positions = "Administrators";
   $inside  = str_replace("\n","<br>",$rows['content']);
   $inside  = str_replace(" ","&nbsp;",$inside);
   if($rows['manager'] == 1){
    $positions = $positions. ", Managers";
   }
   if($rows['employee_full'] == 1){
    $positions = $positions. ", Part-time employees";
   }
   if($rows['employee_part'] == 1){
    $positions = $positions. ", Full-time employees";
   }
   echo '<div class="row">';
   echo '<div>';
   echo '<div style="background-color:'.$rows['color'].';border-width: thin; border-top-left-radius: 10px 10px;border-top-right-radius: 10px 10px;border: solid black; padding-top: 10px;">';
   echo '<center>';
   echo '<h2 class="text-light">'.$rows['caption'].'</h2>';
   echo '</center>';

   echo '</div>';
   echo '<div style="min-height:100px;border-left: solid black;border-right: solid black;border-bottom: solid black;border-width: thin; padding:10px">';
   echo '<p id="pp">'. $inside .'</p>';
   if($type == 1){
   echo '<p><strong>For :  </strong>'.$positions.'</p>';

    echo '<button id="d'.$rows['id_board'].'" type="button" class="btn btn-primary" style="float:right" onclick="Edit(this.id)" >Edit</button>';
   echo '<br>';
   echo '<br>';
   }
   echo '</div>';
   echo '</div>';
   echo '</div>';
   echo '<br>';
}

?>