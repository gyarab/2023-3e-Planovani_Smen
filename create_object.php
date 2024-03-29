<?php
/** This files creates objects in which admin can create object */
/** There is some problem wist session in this file - it appears that PHP fuction can not be called while running session,
 * therefore session in this file is not currently running.
 **/

/** code for session */
 /**tree source https://codepen.io/philippkuehn/pen/QbrOaN */
session_start();

if (isset($_SESSION["user2_id"])) {

  $mysqli = require __DIR__ . "/database.php";

  $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
  $mysqli->close();
}

$mysqli1 = require __DIR__ . "/database.php";
$sql1 = " SELECT * FROM user2 ORDER BY id DESC ";
$result1 = $mysqli1->query($sql1);
$mysqli1->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/main_page.css">
  <link rel="stylesheet" href="css/tree.css">
  <link rel="stylesheet" href="css/success.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <title>Creation of objects</title>
</head>
<style>
  /**css for div */
  .cont {
    margin-bottom: 25px;
    border: 1px solid;
    margin: auto;
    width: 100%;
    padding: 10px;
    box-shadow: 5px 10px #888888;
  }

  .head {
    margin: auto;
    width: 80%;
    padding: 10px;
    margin-bottom: 25px;
  }

  /**css for table */
  table,
  th,
  td {
    border: 1px solid black;
  }

  .popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}




</style>


<body>
  <?php if (isset($user)): ?>


     <!--start of the navbar -->
     <div class="container">
  <nav>
    <div class="navbar container">

      <i class='bx bx-menu'></i>
      <div class="logo"><a href="admin_main_page.php">Home :
          <?= $cons ?>
          <?= htmlspecialchars($user["firstname"]) ?>
          <?= htmlspecialchars($user["middlename"]) ?>
          <?= htmlspecialchars($user["lastname"]) ?>
        </a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name">Home page</span>
          <i class='bx bx-x'></i>
        </div>
        <ul class="links">
          <li>
            <a href="#">EMPLOYEES</a>
            <i class='bx bxs-chevron-down js-emarrow arrow '></i>
            <ul class="em-sub-menu sub-menu">
              <li><a href="signup.php">ADD TO SYSTEM</a></li>
              <li><a href="list_of_employees.php">LIST</a></li>
              <li><a href="#">CHANGE DATA</a></li>
            </ul>
          </li>
          <li>
            <a href="#">DATABASE</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="create_object.php">CREATE OBJECT</a></li>
              <li><a href="create_shift.php">CREATE SHIFT</a></li>
              <li><a href="#">CURRENT SCHEDULE</a></li>
              <li class="more">
                <span><a href="#">More</a>
                  <i class='bx bxs-chevron-right arrow more-arrow'></i>
                </span>
                <ul class="more-sub-menu sub-menu">
                  <li><a href="#"></a></li>
                  <li><a href="#">Pre-loader</a></li>
                  <li><a href="#">Glassmorphism</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">HISTORY</a>
            <i class='bx bxs-chevron-down js-arrow arrow '></i>
            <ul class="js-sub-menu sub-menu">
              <li><a href="#">Dynamic Clock</a></li>
              <li><a href="#">Form Validation</a></li>
              <li><a href="#">Card Slider</a></li>
              <li><a href="#">Complete Website</a></li>
            </ul>
          </li>
          <li><a href="#">STATISTICS</a></li>
          <li><a href="logout.php">LOG OUT</a></li>
        </ul>
      </div>

      <div class="search-box">
        <i class='bx bx-search'></i>
        <div class="input-box">
          <input type="text" placeholder="Search...">
        </div>
      </div>
    </div>
  </nav>
  <script src="js/main_page.js"></script>

   <!--end of the navbar -->
  <br>
  <br>
  <br>

  <div class="head">
    <h1>List of objects</h1>
  </div>
  <div class="cont">
    <h2>Create new object: </h2>
    <form method="post" name="myform" novalidate>
      <label for="new_object"></label>
      <?php
      function create_table()
      {
        $is_empty = true;
        $empty_string = "";
        if (!empty($_POST["new_object"])) {
          $is_empty = false;
        }
        if ($is_empty == false) {
          $name = $_POST['new_object'];
          $mysqli = require __DIR__ . "/database.php";


          $conn = new mysqli($host, $username, $password, $dbname);
          $check_unique = mysqli_query($conn, "SELECT * FROM list_of_objects WHERE object_name = '$name'");

          if (mysqli_num_rows($check_unique) == 0) {
            $sql1 = "INSERT INTO list_of_objects (object_name, superior_object_name)
        VALUES (?,?)";

            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sql1);

            $stmt->bind_param(
              "ss",
              $_POST["new_object"],
              $empty_string
            );
            $stmt->execute();
            $conn->close();
          } else {
            echo "Table exists";
            $conn->close();
          }
        }
      }
      ?>
      <input id="new_object" name="new_object" style="display:inline" type="text">
     <!-- <button onclick="<?php create_table() ?>" style="display:inline">Submit</button>-->
     
     <div class="popup">
     <input id="savemain" type="button" onclick="submit_table()" style="display:inline" value="Submit 2a">

     
    </div>
    <br>
     <label id="label1" style="visibility:hidden;color:red">Needs to be filled *</label>
      <br>

      <br>

      <?php

      $mysqli2 = require __DIR__ . "/database.php";
      $sql2 = " SELECT * FROM list_of_objects ORDER BY id_object ASC";
      $result2 = $mysqli2->query($sql2);
      $result3 = $mysqli2->query($sql2);
      ?>

      <!-- source: https://www.geeksforgeeks.org/how-to-fetch-data-from-localserver-database-and-display-on-html-table-using-php/ -->
      <table>
        <tr>
          <th>ID</th>
          <th>OBJECT NAME</th>
          <th>SUPERIOR OBJECT</th>
        </tr>
        <section>
          <?php
          /**prints the row of list_of_objects*/
          /**is here for just testing  */
          while ($rows = $result2->fetch_assoc()) {
            ?>
            <tr>
              <td>
                <?php echo $rows['id_object']; ?>
              </td>
              <td>
                <?php echo $rows['object_name']; ?>
              </td>
              <td>
                <?php echo $rows['superior_object_name']; ?>
              </td>
            </tr>
            <?php
          }
          ?>
        </section>
      </table>
      <br>

      <h2>Create new sub object: </h2>
      <input id="new_sub_object" name="new_sub_object" style="display:inline" type="text">
      <!--<button style="display:inline" onclick="<?php //create_sub_table() ?>">Submit</button>-->
    
      <input id="savesub" type="button" onclick="submit_subtable()" style="display:inline" value="Submit sub">
      <br>
     <label id="label2" style="visibility:hidden;color:red"></label>

      <br>








      <?php
      /**Start of the printing process for object hierarchie */
   /*--   $mysqli2 = require __DIR__ . "/database.php";
      $sql2 = " SELECT * FROM list_of_objects ORDER BY id_object ASC";
      $result3 = $mysqli2->query($sql2);
      $mysqli2->close();
      $data_name = array();


      $mysqli2 = require __DIR__ . "/database.php";
      require __DIR__ . '/load_object.php';

      $conn2 = new mysqli($host, $username, $password, $dbname);
      $fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
      $data2 = array();
      $data3 = array();


      if (mysqli_num_rows($fetch) > 0) {
        /**Sorting data alphabetically */
       /*-- while ($rows_dat = mysqli_fetch_assoc($fetch)) {
          $data2[] = $rows_dat['object_name'];
          $data3[] = $rows_dat['superior_object_name'];
        }
        array_multisort($data2, $data3);
      }
      $search;

      $nm = "box";
      /**This part looks for row with any object without superior object (highest standing in hierarchie)  */
      /*--for ($x = 0; $x < count($data2); $x++) {
        if ($data3[$x] == null) {

          $search = $data2[$x] . "";
          $count = 1;
         ---*/ ?>
          <!--<input id="box" type="radio" name="box" value="<?php //echo $data2[$x]; ?>">
          <label for="box">-->
            <?php //--echo $data2[$x]; ?>
          <!--</label>
          <br>-->
          <?php
          /**This part calls the function in order to check if this object is superior to some other object*/
          //require __DIR__ . '/load_object.php';
          //include "/load_object.php";
         /*--- sub_object($search, $data2, $data3, $count, $nm);
          
        }

      }

--*/
      ?>



<button id="butsave"></button>

<div class="tree">
  <div id="res">

<script>

var input = 0;
        //alert("ff");
        var ChA = JSON.parse(input);
            $.ajax({
            url:"load_object3.php",
            method: "POST",
            data:{input : ChA},
            success:function(data){
              //$("#searchresult").css("display", "inline");
              $("#res").html(data);
              //alert(data);
            }
           });




</script>


  </div>

<?php
      /**Start of the printing process for object hierarchie */
     /*--- $mysqli2 = require __DIR__ . "/database.php";
      $sql2 = " SELECT * FROM list_of_objects ORDER BY id_object ASC";
      $result3 = $mysqli2->query($sql2);
      $mysqli2->close();
      $data_name = array();


      $mysqli2 = require __DIR__ . "/database.php";
      require __DIR__ . '/load_object2.php';

      $conn2 = new mysqli($host, $username, $password, $dbname);
      $fetch = mysqli_query($conn2, "SELECT * FROM list_of_objects");
      $data2 = array();
      $data3 = array();
      $numberval = array();


      if (mysqli_num_rows($fetch) > 0) {
        /**Sorting data alphabetically */
        /*---while ($rows_dat = mysqli_fetch_assoc($fetch)) {
          $data2[] = $rows_dat['object_name'];
          $data3[] = $rows_dat['superior_object_name'];
        }
        array_multisort($data2, $data3);
      }
      $search;
      
   
      $nm = "box";
      /**This part looks for row with any object without superior object (highest standing in hierarchie)  */
     /*---for ($x = 0; $x < count($data2); $x++) {
        if ($data3[$x] == null) {

          $search = $data2[$x] . "";
          $numberval[$count] = $data2[$x] . "";
          $count = 1;
          ?>
          <ul>
          <li>
          <a href="#"><?php echo $data2[$x]; ?></a>
    
         
          <?php
          /**This part calls the function in order to check if this object is superior to some other object*/
          //require __DIR__ . '/load_object.php';
          //include "/load_object.php";
          //--sub_object($search, $data2, $data3, $count, $nm);
          ?>
          
       <!-- </li>
        </ul>-->
            <?php
        //--}

      ///---}


      ?>
      </div>
      </div>


<script>
  var ff;
  var previous;
  function Helal(clicked){
    let vjvj = document.getElementById(clicked);
    ff = clicked.substring(3); 
    if(previous != ff){
    vjvj.style.backgroundColor = '#4CAF50';
    vjvj.style.color= '#fff';
    vjvj.style.border= "solid #4CAF50";
    //alert(ff);]
   
    if(previous != "0" && previous != null ){

    var kka = "box" + previous;
    //alert(kka);
    let ffa = document.getElementById(kka);
    ffa.style.color= '';
    ffa.style.backgroundColor = '';
    ffa.style.border= "";
    }
    previous = ff;
    
    }else{
      //alert("succes");
      vjvj.style.color= '';
      vjvj.style.backgroundColor = '';
      vjvj.style.border= "";
      
      previous =0;
    }
  }

  $("#savemain").click(function () {
  $(".check-icon").hide();
  setTimeout(function () {
    $(".check-icon").show();
  }, 10);
});



  $("#savemain").click(function () {

   let g  = document.getElementById("new_object").value;
    //alert("dassda");
    if(g == ""){
      var popup = document.getElementById("label1");
      popup.style.visibility = "visible";
      }else{
        //var gg = JSON.stringify(g);
            $.ajax({
            url:"insert-object.php",
            method: "POST",
            data:{input : g},
            success:function(data){
              //$("#searchresult").css("display", "inline");
              //$("#res").html(data);
              //alert(data);
              //alert(data);
            }
           });


           var newa = document.getElementById("res");
           newa.value = "";
           var input4 = 0;
           document.getElementById("new_object").value = "";
        //alert("ff");
        var ChA = JSON.parse(input4);
            $.ajax({
            url:"load_object3.php",
            method: "POST",
            data:{input : ChA},
            success:function(data){
              //$("#searchresult").css("display", "inline");
              $("#res").html(data);
              //alert(data);
              alert("New object is saved");
            }
           });
      var popup = document.getElementById("label1");
      popup.style.visibility = "hidden";
      }
   
    
  });

  function submit_subtable(){
    let q  = document.getElementById("new_sub_object").value;
    if(q == ""){
      var popup = document.getElementById("label2");
      popup.style.visibility = "visible";
      popup.innerText = "Needs to be filled *";
    }else{
      if(previous != "0" && previous != null ){
      var popup = document.getElementById("label2");
      popup.style.visibility = "hidden";
      var bb = "box" + previous;
      var hh = "hid" + previous;
      var pj = document.getElementById(bb).value;
      var jj = document.getElementById(hh).value;
      $.ajax({
            url:"insert-sub_object.php",
            method: "POST",
            data:{name : q, sup : pj, id : jj},
            success:function(data){

            }
           });
           document.getElementById("new_sub_object").value = "";

           var newa = document.getElementById("res");
           newa.value = "";
           var input4 = 0;
           document.getElementById("new_object").value = "";
        //alert("ff");
        var ChA = JSON.parse(input4);
            $.ajax({
            url:"load_object3.php",
            method: "POST",
            data:{input : ChA},
            success:function(data){
              //$("#searchresult").css("display", "inline");
              $("#res").html(data);
              //alert(data);
              alert("New sub-object is saved");
            }
           });
      }else{
      var popup = document.getElementById("label2");
      popup.style.visibility = "visible";
      popup.innerText = "Sub object needs to be selected*";
      }

    }
  }



</script>



      <?php

      /** Recursion function - main purpose of this function is to look for objects in the sub hierarchie*/
      /*function sub_object($searching, $dat2, $dat3, $counter)
      {
        for ($i = 0; $i < count($dat2); $i++) {
          if ($searching == $dat3[$i]) {
            ?>
            <p style="display:inline">
              <?php for ($q = 0; $q < $counter; $q++) {
                echo " -  ";
              } ?>
            </p>
            <input id="box" type="radio" name="box" value="<?php echo $dat2[$i]; ?>">
            <label for="box"> 
              <?php echo $dat2[$i]; ?>
            </label>
            <br> 
            <?php
           $co = $counter + 1;

            $sea = $dat2[$i];
            if (!$searching == null) {
              sub_object($sea, $dat2, $dat3, $co);
            } else {
              break;
            }
          }
        }

      }
       /**End of the printing process for object hierarchie */
      ?>

      <br>
      <br>
      <div class="tree">
	<!--<ul>
  <li>
    <a href="#">Parent</a>
    
    <ul>
    
    <hr>
      <li>
        <a href="#">Child</a>
        <ul>
        <hr>
          <li>
            <a href="#">Grand Child</a>
          </li><li>
            <a href="#">Grand Child</a>
            <ul>
            <hr>
              <li>
                <a href="#">Grand Child</a>
              </li><li>
                <a href="#">Grand Child</a>
              </li>
            </ul>
          </li>
        </ul>
      </li><li>
        <a href="#">Child</a>
        <ul>
        <hr>
          <li>
            <a href="#">Grand Child</a>
            <ul>
            <hr>
              <li>
                <a href="#">Grand Grand Child</a>
              </li>
            </ul>
          </li><li>
            <a href="#">Grand Child</a>
          </li>
        </ul>
      </li>
      </li><li>
        <a href="#">Child</a>
        <ul>
        <hr>
          <li>
            <a href="#">Grand Child</a>
            <ul>
            <hr>
              <li>
                <a href="#">Grand Grand Child</a>
              </li>
            </ul>
          </li><li>
            <a href="#">Grand Child</a>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</ul>
    -->
</div>
</div>


    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <?php else: ?>
  <br> USER IS NOT SET <BR>
  <?php endif; ?>

</body>
<?php

/**Function, which addes new objects with superior object into database*/
function create_sub_table()
{
  $sub_is_empty = true;
  if (!empty($_POST["new_sub_object"])) {
    $sub_is_empty = false;
  }
  if ($sub_is_empty == false) {
    $name2 = $_POST['new_sub_object'];
    $name3 = $_POST['box'];


    $mysqli2 = require __DIR__ . "/database.php";


    $conn2 = new mysqli($host, $username, $password, $dbname);
    $check_unique2 = mysqli_query($conn2, "SELECT * FROM list_of_objects WHERE object_name = '$name2'");
    $conn2->close();



    if (mysqli_num_rows($check_unique2) == 0) {
      $sql4 = "INSERT INTO list_of_objects (object_name, superior_object_name)
        VALUES (?,?)";

      $stmt2 = $mysqli2->stmt_init();
      $stmt2->prepare($sql4);

      $stmt2->bind_param(
        "ss",
        $name2,
        $name3
      );
      $stmt2->execute();
      $conn2->close();
      $mysqli2->close();
    } else {
      echo "Table exists";
      $conn2->close();
      $mysqli2->close();
    }

  }

}
?>

</html>
<script>
  /**Some code for AJAX - It is not in use */
  function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML =
          this.responseText;
      }
    };
    xhttp.open("GET", "xmlhttp_info.txt", true);
    xhttp.send();
  }
</script>