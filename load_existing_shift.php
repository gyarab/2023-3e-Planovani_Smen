<?php


$mysqli = require __DIR__ . "/database.php";
//require __DIR__ . '/load_object2.php';




$conn2 = new mysqli($host, $username, $password, $dbname);
$fetch2 = mysqli_query($conn2, "SELECT * FROM list_of_objects");
$data2 = array();
$data3 = array();
$numberval = array();
$type = $_POST['type'];

if (mysqli_num_rows($fetch2) > 0) {
  /**Sorting data alphabetically */
  while ($rows_dat = mysqli_fetch_assoc($fetch2)) {
    $data1[] = $rows_dat['id_object'];
    $data2[] = $rows_dat['object_name'];
    $data3[] = $rows_dat['superior_object_name'];
    $data4[] = $rows_dat['superior_object_id'];
  }
  array_multisort($data1, $data2, $data3, $data4);
}

$input = $_POST['input'];

//$type = 1;

for ($x = 0; $x < count($data2); $x++) {
    if ($data1[$x] == $input) {
        static $dd =1;

      $search = $data1[$x] . "";
      //$numberval[$count] = $data1[$x] . "";
      //$count = 1;
      //$conn = new mysqli($host, $username, $password, $dbname);
      //$fetch = mysqli_query($conn, "SELECT * FROM create_shift WHERE ");
      certain_shift($data1[$x]);

      $dd++;


      $row = 0;
     
      for ($h = 0; $h < count($data2); $h++) {
        if($search==$data4[$h]){
            sub_object($search,$data1,$data2,$data3,$data4);
            $row++;
            break;
        }
      }
        
    }

  }


  function sub_object($searching,$dat1,$dat2, $dat3,$dat4)
  {
   static $dd = 1;
    $find = 0;
    for ($i = 0; $i < count($dat2); $i++) {
        if ($searching == $dat4[$i]) {
        if ($find == 0){
            $find = 1;
            //echo "<ul>";
            //echo "<hr>";
        }else{
            
        }
        certain_shift($dat1[$i]);
        //echo "<li>";
        //echo " <button>".$dat2[$i]."</button>";
        //echo "<input id='hid".$dd."' type='hidden' name='hid' value='".$dat1[$i]."'>";

        //echo "<input id='box".$dd."' type='button' onclick='Helal(this.id)' name='box' value='".$dat2[$i]."'>";
      //  echo "<input id='hid".$dd."' type='hidden' name='hid' value='".$dat1[$i]."'>";
       
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
        
        //echo "</li>";          
      
    }
    }
    //echo "</ul>";  

  }
 
  //certain_shift();
function certain_shift($dat){
    global $type;
    $mysqli = require __DIR__ . "/database.php";
    $conn = new mysqli($host, $username, $password, $dbname);
$fetch = mysqli_query($conn, "SELECT * FROM create_shift WHERE object_id='$dat' /*ORDER BY object_name, shift_name*/ ");

$id_shift = array();
$start_shift = array();
$rep_non = array();
$monday = array();
$mon_from = array();
$mon_to = array();
$tuesday = array();
$tue_from = array();
$tue_to = array();
$wednesday = array();
$wed_from = array();
$wed_to = array();
$thursday = array();
$thu_from = array();
$thu_to = array();
$friday = array();
$fri_from = array();
$fri_to = array();
$saturday = array();
$sat_from = array();
$sat_to = array();
$sunday = array();
$sun_from = array();
$sun_to = array();
$shift_name = array();
$color = array();
if (mysqli_num_rows($fetch) > 0) {
    /**Sorting data alphabetically */
    while ($rows_dat = mysqli_fetch_assoc($fetch)) {
        $id_shift [] = $rows_dat['id_shift'];
        $start_shift[] = $rows_dat['start_shif'];
        $rep_non [] = $rows_dat['rep_no'];
        $monday [] = $rows_dat['monday'];
        $mon_from [] = $rows_dat['mon_from'];
        $mon_to [] = $rows_dat['mon_to'];
        $tuesday [] = $rows_dat['tuesday'];
        $tue_from [] = $rows_dat['tue_from'];
        $tue_to [] = $rows_dat['tue_to'];
        $wednesday[] = $rows_dat['wednesday'];
        $wed_from [] = $rows_dat['wed_from'];
        $wed_to [] = $rows_dat['wed_to'];
        $thursday [] = $rows_dat['thursday'];
        $thu_from [] = $rows_dat['thu_from'];
        $thu_to [] = $rows_dat['thu_to'];
        $friday [] = $rows_dat['friday'];
        $fri_from [] = $rows_dat['fri_from'];
        $fri_to [] = $rows_dat['fri_to'];
        $saturday[] = $rows_dat['saturday'];
        $sat_from [] = $rows_dat['sat_from'];
        $sat_to [] = $rows_dat['sat_to'];
        $sunday [] = $rows_dat['sunday'];
        $sun_from [] = $rows_dat['sun_from'];
        $sun_to [] = $rows_dat['sun_to'];
        $shift_name [] = $rows_dat['shift_name'];
        $color [] = $rows_dat['color'];
        $object_id [] = $rows_dat['object_id'];
        $object_name [] = $rows_dat['object_name'];

    }            
    //array_multisort($data1, $data2, $data3, $data4);
}
static $dd = 1;
if($dd == 1){
echo "<div class='row' >";
}
$dd = 2;
for ($x = 0; $x < count($id_shift); $x++) {
    echo "<div class='col-12 col-md-3 col-sm-6 p-2' style='border: 1px solid;box-shadow: 5px 10px #888888;paddling: 10px; '>";
    echo "<div class='row' >";
    echo "<div class='col-8'>";
   // $n1 = 
    echo "<h6 id='h_obj-".$id_shift[$x]."' style='display:inline'>".$object_name[$x]." - </h6><h6 id='h_shi-".$id_shift[$x]."' style='display:inline'>".$shift_name[$x]."</h6>";
    echo "</div>";
    echo "<div class='col-4'>";
    echo "<div class='text-end'>";
    echo "<input class='in' style='background-color: ".$color[$x]."'>";
    //echo "<p>".$color[$x]."</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    
    /*echo "<div class='justify-content-end' >";
    echo " $shift_name[$x]";
    echo "Top Right</div>";*/
    
    echo "<center>";
    /*if($monday[$x] == 1){
        echo "<p>Monday: ". $mon_from[$x]." - ".$mon_from[$x]."</p><br>";
    }
    if($tuesday[$x] == 1){
        echo "<p>Tuesday: ". $tue_from[$x]." - ".$tue_from[$x]."</p><br>";
    }
    if($wednesday[$x] == 1){
        echo "<p>Wednesday: ". $wed_from[$x]." - ".$wed_from[$x]."</p><br>";
    }
    if($thursday[$x] == 1){
        echo "<p>Thursday: ". $thu_from[$x]." - ".$thu_from[$x]."</p><br>";
    }
    if($friday[$x] == 1){
        echo "<p>Friday: ". $fri_from[$x]." - ".$fri_from[$x]."</p><br>";
    }
    if($saturday[$x] == 1){
        echo "<p>Saturday: ". $sat_from[$x]." - ".$sat_from[$x]."</p><br>";
    }
    if($sunday[$x] == 1){
        echo "<p>Sunday: ". $sun_from[$x]." - ".$sun_from[$x]."</p><br>";
    }*/
    echo "<p>";
    if($monday[$x] == 1){
        echo "Monday: ". substr($mon_from[$x], 0, -3)." - ".substr($mon_to[$x], 0, -3)."<br><br>";
    }
    if($tuesday[$x] == 1){
        echo "Tuesday: ". substr($tue_from[$x], 0, -3)." - ".substr($tue_to[$x], 0, -3)."<br><br>";
    }
    if($wednesday[$x] == 1){
        echo "Wednesday: ". substr($wed_from[$x], 0, -3)." - ".substr($wed_to[$x], 0, -3)."<br><br>";
    }
    if($thursday[$x] == 1){
        echo "Thursday: ". substr($thu_from[$x], 0, -3)." - ".substr($thu_to[$x], 0, -3)."<br><br>";
    }
    if($friday[$x] == 1){
        echo "Friday: ". substr($fri_from[$x], 0, -3)." - ".substr($fri_to[$x], 0, -3)."<br><br>";
    }
    if($saturday[$x] == 1){
        echo "Saturday: ". substr($sat_from[$x], 0, -3)." - ".substr($sat_to[$x], 0, -3)."<br><br>";
    }
    if($sunday[$x] == 1){
        echo "Sunday: ". substr($sun_from[$x], 0, -3)." - ".substr($sun_to[$x], 0, -3)."<br><br>";
    }
    echo "</p>";
    //echo "<div class='bottom-center'>";
    //$type2 = 1;
    //echo "<p>tue".$input."</p>";
    //$tsay = $input;
    if($type == 1){
    echo "<input type='button' class='btn btn-primary' id='edit-".$id_shift[$x]."' onclick='Open_edit(this.id)' value='EDIT'>";
    }else{
    echo "<input type='button' class='btn btn-primary' id='edit-".$id_shift[$x]."' onclick='Select_sh(this.id)' value='SELECT'>";
    }
    //echo "</div>";
    echo "</center>";
    echo "<br>";
    echo "</div>";

}


}
echo "</div>";
?>