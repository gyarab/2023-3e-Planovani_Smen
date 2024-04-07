<?php

session_start();

if (isset($_SESSION["user2_id"])) {

  $mysqli = require __DIR__ . "/database.php";

  $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
  $sqlp = "SELECT position, id FROM user2 WHERE id = {$_SESSION["user2_id"]}";
  $resultp = $mysqli->query($sqlp);
  while ($rrr = $resultp->fetch_assoc()) {
    $userp = $rrr['position'];
    $userid = $rrr['id'];

  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!--<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">-->
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>-->
  <link rel="stylesheet" href="css/main_page.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    table,
    th,
    td {
      border: 1px solid black;
    }

    /* td:nth-child(even) {
  background-color: #D6EEEE;
}*/
    /*
    .hoverTable {
      width: 100%;
      border-collapse: collapse;
    }

    .hoverTable td {
      padding: 7px;
      border: #4e95f4 1px solid;
    }>

    /* Define the default color for all the table rows */
    /*.hoverTable tr {
      background: #b8d1f3;
    }*/

    /* Define the hover highlight color for the table row */
    /* tr:hover {
      background-color: #e8e8e8;
    }*/
    /*.container {
      position: relative;
    }*/

    .topright {
      position: absolute;
      top: 0px;
      right: 0px;
      font-size: 3px;
    }



    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 100px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }





    .myBox {
      border: none;
      font: 24px/36px sans-serif;
      width: 400px;
      height: 400px;
      overflow: scroll;
    }

    p {
      font-size: 30px;
    }

    /* Scrollbar styles */
    /*::-webkit-scrollbar {
width: 12px;
height: 12px;
}

::-webkit-scrollbar-track {
border: 1px solid yellowgreen;
border-radius: 10px;
}

::-webkit-scrollbar-thumb {
background: yellowgreen;  
border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
background: #88ba1c;  
}*/
  </style>
</head>

<body>
  <?php if (isset($user) /*&& $userp == "admin"*/): ?>
    <?php
    $today = date("Y-m-d");

    ?>
    <script>
      var usid = <?php echo json_encode($userid); ?>;
    </script>
    <div class="container">

      <nav>

        <div class="navbar container">

          <i class='bx bx-menu'></i>
          <div class="logo"><a href="admin_main_page.php" style="padding-left: 0px;">Home :
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
                <ul class="em-sub-menu sub-menu " style="padding-left: 0px;">
                  <div>
                    <li><a href="signup.php">ADD TO SYSTEM</a></li>
                    <li><a href="list_of_employees.php">LIST</a></li>
                    <li><a href="#">CHANGE DATA</a></li>
                    <li><a href="rights.php">RIGTHS & ASSIGNMENT</a></li>
                  </div>
                </ul>

              </li>
              <li>
                <a href="#">DATABASE</a>
                <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                <ul class="htmlCss-sub-menu sub-menu" style="padding-left: 0px;">
                  <li><a href="create_object.php">CREATE OBJECT</a></li>
                  <li><a href="create_shift.php">CREATE SHIFT</a></li>
                  <li><a href="calendar.php">CURRENT SCHEDULE</a></li>
                  <li class="more">
                    <span><a href="#">More</a>
                      <i class='bx bxs-chevron-right arrow more-arrow'></i>
                    </span>
                    <ul class="more-sub-menu sub-menu" style="padding-left: 0px;">
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
                <ul class="js-sub-menu sub-menu" style="padding-left: 0px;">
                  <li><a href="#">Dynamic Clock</a></li>
                  <li><a href="#">Form Validation</a></li>
                  <li><a href="#">Card Slider</a></li>
                  <li><a href="#">Complete Website</a></li>
                </ul>
              </li>
              <li><a href="#">STATISTICS</a></li>
              <li><a href="logout.php" style="color :#b2d2f2;">LOG OUT</a></li>
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
      <br>
      <br>
      <br>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    </div>











    <div class="container">

      <input type="hidden" id="kpk" name="kpk" value="2024-01">
      <div>
        <input type="hidden" id="help" name="help">
        <input type="hidden" id="help2" name="help2">
        <input type="hidden" id="hideYM">
        <form id="form1" name="form1" method="post">

          <header>
            <br>
            <br>
            <br>
            <br>
            <center>
              <h1 class="current-date"></h1>
            </center>

          </header>
          <br>
          <br>
          <div style="float: left">
            <p>Objects:&nbsp;&nbsp;</p>


            <select id="select_obj" class="form-select form-select-sm" name="option" id="option"
              style="font-size:15px;display:inline">
              <?php
              $mysqli2 = require __DIR__ . "/database.php";
              $sql2 = " SELECT * FROM list_of_objects ORDER BY object_name ASC";
              $result3 = $mysqli2->query($sql2);
              $mysqli2->close();
              $counter = 0;
              while ($rows_dat = mysqli_fetch_assoc($result3)) {
                if (null == $rows_dat['superior_object_name']) {
                  if ($counter == 0) {
                    $first = $rows_dat['id_object'];
                  }
                  $counter++;
                  ?>
                  <option style="font-size:15px" value="<?php echo $rows_dat['id_object'] ?>">
                    <?php echo $rows_dat['object_name']; ?>
                  </option>
                  <?php
                }
              }
              ?>
            </select>
          </div>

          <div id="object" style="display:inline;"></div>
          <br>
          <br>
          <p style="display:inline">Shift:&nbsp;&nbsp;</p>
          <div id="shi_load" style="display:inline;"></div>
          <br>
          <input type="button" class="btn btn-primary" value="Filter" onclick="filter()" style="float:left;font-size: 16px;">
          <br>
          <br>
          <br>
          <div class="icons">
              <span id="prev" class="material-symbols-rounded" style="float:left"><i
                  class="bi bi-arrow-left-circle h2"></i></span>
              <h2 style="display:inline;float:left">&nbsp;&nbsp;Previous month</h2>
              <span id="next" class="material-symbols-rounded" style="float:right"><i
                  class="bi bi-arrow-right-circle h2"></i></span>
              <h2 style="display:inline;float:right">Next month&nbsp;&nbsp;</h2>
            </div>
          <script>
            var f_load = 0;
            var obj_search = new Array();
            var pos_search = new Array();
            var input_obj =
              <?php echo json_encode($first); ?>;
            $.ajax({
              url: "cal_obj_load.php",
              method: "POST",
              data: { input: input_obj, id: usid },
              success: function (data) {
                $("#object").html(data);

              }
            });

            $.ajax({
              url: "cal_shi_load.php",
              method: "POST",
              data: { input: input_obj, id: usid },
              success: function (data) {
                $("#shi_load").html(data);
              }
            });
            var inp = <?php echo json_encode($first); ?>;
            $('#select_obj').change(function () {
              obj_search = [];
              shi_search = [];
              load_check1 = 0;
            load_check2 = 0;
          load_check3 = 0;
           /*   objectall = 0;
              shiftall = 0;
              object_all();
              shift_all();*/

              inp = $(this).val();
              $.ajax({
                url: "cal_obj_load.php",
                method: "POST",
                data: { input: inp, id: usid },
                success: function (data) {
                  $("#object").html(data);

                }
              });

              $.ajax({
                url: "cal_shi_load.php",
                method: "POST",
                data: { input: inp, id: usid },
                success: function (data) {
                  $("#shi_load").html(data);

                }
              });
              //alert(shi_search);
              //alert(obj_search);
              filter();
            });
            /*function rum(inp,usid){
              $.ajax({
                url: "cal_shi_load.php",
                method: "POST",
                data: { input: inp, id: usid },
                success: function (data) {
                  //$("#searchresult").css("display", "inline");
                  $("#shi_load").html(data);
                  /*let lshi = document.getElementsByName("nshi").length;
                  let elements = document.getElementsByName("nshi");
                  if (lshi != 0) {
                    for (var b = 0; b < lshi; b++) {

                      shiftall_arr.push(elements[b].value);
                    }
                  }*/
            /*shift_all();
            //shift_all();

          }
        });
      }*/

            var load_check1 = 0;
            var load_check2 = 0;
            var load_check3 = 0;
            var arridc = new Array();

           $(document).on("ajaxComplete", function () {
              //$( ".log" ).text( "Triggered ajaxComplete handler." );
              //alert("true");
              let lshi = document.getElementsByName("nshi").length;
              let elements = document.getElementsByName("nshi");
              if (lshi != 0 && load_check1 == 0) {
                load_check1 = 1;
                for (var b = 0; b < lshi; b++) {

                  shi_search.push(elements[b].value);
                }
              }
              let lobj = document.getElementsByName("nobj").length;
              let elements2 = document.getElementsByName("nobj");
              if (lobj != 0 && load_check2 == 0) {
                load_check2 = 1;
                for (var b = 0; b < lobj; b++) {

                  obj_search.push(elements2[b].value);
                }
              }
              if(load_check1 ==1 && load_check2==1 && load_check3 ==0 ){
                //alert("went");
                load_check3 = 1;
                f_load = 0;
                filter();
                
                /*load_check3 = 1;
                load_check3 = 1;*/
              }
            });

            var shiftall = 1;
            var objectall = 1;
            let lshi;
            var shiftall_arr = new Array();
            function shift_all() {
              f_load = 0;
              if (shiftall == 0) {
                shiftall = 1;
                shi_search = [];
                lshi = document.getElementsByName("nshi").length;
                let elements = document.getElementsByName("nshi");
                if (lshi != 0) {
                  for (var b = 0; b < lshi; b++) {

                    shi_search.push(elements[b].value);
                  }
                }

              } else {

                shiftall = 0;
                shi_search = [];
                lshi = document.getElementsByName("nshi").length;
                let elements = document.getElementsByName("nshi");
                if (lshi != 0) {
                  for (var b = 0; b < lshi; b++) {
                    if (elements[b].checked) {
                      shi_search.push(elements[b].value);
                    }
                  }
                }

              }
              //alert(shi_search);
              //filter();


            }
            var objectall = 1;
            var objectall_arr = new Array();
            function object_all() {
              f_load = 0;
              if (objectall == 0) {
                objectall = 1;
                obj_search = [];
                lobj = document.getElementsByName("nobj").length;
                let elements = document.getElementsByName("nobj");
                if (lobj != 0) {
                  for (var b = 0; b < lobj; b++) {

                    obj_search.push(elements[b].value);
                  }
                }

              } else {
                objectall = 0;
                obj_search = [];
                lobj = document.getElementsByName("nobj").length;
                let elements = document.getElementsByName("nobj");
                if (lobj != 0) {
                  for (var b = 0; b < lobj; b++) {
                    if (elements[b].checked) {
                      obj_search.push(elements[b].value);
                    }
                  }
                }
              }
              //alert(obj_search);
              //filter();

            }
            var shi_search = new Array();

            function shift_search(clicked_val) {
              f_load = 0;
              if (shi_search.includes(clicked_val) == true && shiftall == 0) {
                for (let i = 0; i < shi_search.length; i++) {
                  if (shi_search[i] === clicked_val) {
                    shi_search.splice(i, 1);
                  }
                }
              } else if(shiftall== 0){
                shi_search.push(clicked_val);
              }
              //alert(shi_search);
              //filter();
            }
              var arrcols = new Array();
              var arrcolor = new Array();
              var arrwdw = new Array(7);
              var arrcolordark = new Array();
              var arrtish = new Array();
              var arrobj = new Array();
              var arrname = new Array();

              /*function filter(){
              var results = new Array();
              $.ajax({
                url: "cal_arr_load.php",
                method: "POST",
                dataType: "json",
                cache: false,
                async: false,
                data: { shall: shiftall,oball: objectall, shift_arr: shi_search, object_arr: obj_search, input: inp,user: usid },
                success: function (data) {
                  results = JSON.stringify(data);
                }

              });
              //alert(results);
               arridc = [];
               arrcols = [];
              arrcolor =[]; //new Array();
              arrwdw =[]; //new Array(7);
             arrcolordark =[]; //new Array();
               arrtish =[]; //new Array();
               arrobj =[]; //new Array();
              //if (shiftall == 1) {
                results = results.substring(1, results.length - 1);
                if(results.length >7){
                alert(results);
                var hhha = new Array();
                var sks = new Array();
                var qpw = [];
                var bnm = lshi;
                hhha = results.split("]");
                var bnm = hhha.length;
                //alert(hhha[i]);
                //alert(hhha[0]);
                for (let i = 0; i < bnm; i++) {
                  var tt = hhha[i].length;
                  if (i == 0) {
                    hhha[i] = hhha[i].substring(1, tt);

                  } else {
                    hhha[i] = hhha[i].substring(2, tt);
                  }
                  //alert(hhha[i]);
                  if (i == 0) {
                    for (let z = 0; z < 7; z++) {
                      arrwdw[z] = [];
                      for (let j = 0; j < hhha.length; j++) {
                        arrwdw[z][j] = 0;
                      }
                    }
                    for (let z = 0; z < 14; z++) {
                      arrtish[z] = [];
                      for (let j = 0; j < hhha.length; j++) {
                        arrtish[z][j] = 0;
                      }
                    }
                  }

                  sks = hhha[i].split(",");
                  //alert(hhha[i]);
                  arridc[i] = sks[0].substring(1, sks[0].length - 1);
                  arrcols[i] = sks[1].substring(1, sks[1].length - 1);
                  arrcolor[i] = sks[2].substring(1, sks[2].length - 1);
                  arrcolordark[i] = sks[3].substring(1, sks[3].length - 1);
                  arrwdw[0][i] = sks[4].substring(1, sks[4].length - 1);
                  arrwdw[1][i] = sks[5].substring(1, sks[5].length - 1);
                  arrwdw[2][i] = sks[6].substring(1, sks[6].length - 1);
                  arrwdw[3][i] = sks[7].substring(1, sks[7].length - 1);
                  arrwdw[4][i] = sks[8].substring(1, sks[8].length - 1);
                  arrwdw[5][i] = sks[9].substring(1, sks[9].length - 1);
                  arrwdw[6][i] = sks[10].substring(1, sks[10].length - 1);
                  arrtish[0][i] = sks[11].substring(1, sks[11].length - 1);
                  arrtish[1][i] = sks[12].substring(1, sks[12].length - 1);
                  arrtish[2][i] = sks[13].substring(1, sks[13].length - 1);
                  arrtish[3][i] = sks[14].substring(1, sks[14].length - 1);
                  arrtish[4][i] = sks[15].substring(1, sks[15].length - 1);
                  arrtish[5][i] = sks[16].substring(1, sks[16].length - 1);
                  arrtish[6][i] = sks[17].substring(1, sks[17].length - 1);
                  arrtish[7][i] = sks[18].substring(1, sks[18].length - 1);
                  arrtish[8][i] = sks[19].substring(1, sks[19].length - 1);
                  arrtish[9][i] = sks[20].substring(1, sks[20].length - 1);
                  arrtish[10][i] = sks[21].substring(1, sks[21].length - 1);
                  arrtish[11][i] = sks[22].substring(1, sks[22].length - 1);
                  arrtish[12][i] = sks[23].substring(1, sks[23].length - 1);
                  arrtish[13][i] = sks[24].substring(1, sks[24].length - 1);
                  arrobj[i] = sks[25].substring(1, sks[25].length - 1);
                  renderCalendar();
                 //alert( arrobj[i]);

                }
              }
                //alert( arrobj[0]);

              //}



            }*/

            var obj_search = new Array();
            function object_search(clicked_val) {
              f_load = 0;
              if (obj_search.includes(clicked_val) == true && objectall == 0) {
                for (let i = 0; i < obj_search.length; i++) {
                  if (obj_search[i] === clicked_val) {
                    obj_search.splice(i, 1);
                  }
                }
              } else if(objectall == 0){
                obj_search.push(clicked_val);
              }
              //alert(obj_search);
              //filter();
            }

          </script>
          <br>
          <br>
          <br>


          <div style="width: 100%;height: 1000px;overflow: auto; border: solid black">
            <div class="calendar">
              <table>
                <tr>
                </tr>
                <table class="days" style="border-collapse:collapse;">
                  <div class="hoverTable">
                    <tr>
                    </tr>
                  </div>
                </table>
              </table>
            </div>
          </div>


          <div class="form-group">

            <input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
          </div>


        </form>






      </div>

    </div>






    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <div class='text-end'>
          <span class="close">&times;</span>
        </div>
        <p>Search for employee..</p>
        <div class="row">
        <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
        <input type="text" id="live_search" style="float: left; font-size: 16px" autocomplete="off" placeholder="Search...">
        
        <input type="button" onclick="Vacant()" style="float: right;font-size: 16px" value="Set shift to vacant">
        <br>
        <br>
        <br>
        <hr>
        <br>
        <h2>Assigned employees:</h2>
        <br>
        <div id="searchresult_assign"></div>

        </div>
      <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
        <h2>All employees:</h2>
        <br>
        <div id="searchresult"></div>
        
      
      <form>
        <!--<input type="text" size="30" onkeyup="showResult(this.value)">-->
        <div id="livesearch"></div>
      </form>

      </div>
      </div>



    </div>



    <br>
    <br>
    <br>



    <script>
      var modal = "";
      var btn = "";
      var idbtn = "xcxcz";
      var qkk = "alsd";
      function Vacant() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
        //let fkf = "bn"

        let chch = document.getElementById(idbtn);
        let mj = idbtn.substring(1, 9);
        let vjvj = document.getElementById("h" + mj);
        //alert(mj);
        vjvj.value = "";
        chch.value = "--vacant--";



      }
      var shfft;
      function Open_name(clicked_id) {
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById(clicked_id);
        idbtn = clicked_id;
        shfft = document.getElementById("i00-"+clicked_id.substring(5)).value;
        //alert(shfft);
        //qkk = "kldsa";
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
        //alert("hjkfashjk");
        var input = document.getElementById("live_search").value;
        //var qkk = "kldsa";
        //var btna = "lasds";
        //alert(input);
        if (input != "") {
          $.ajax({
            url: "livesearch.php",
            method: "POST",
            data: { input: input, btns: idbtn },
            success: function (data) {
              $("#searchresult").css("display", "inline");
              $("#searchresult").html(data);
            }
          });
          $.ajax({
            url: "livesearch_assign.php",
            method: "POST",
            data: { input: input, btns: idbtn, id_sh: shfft },
            success: function (data) {
              $("#searchresult_assign").css("display", "inline");
              $("#searchresult_assign").html(data);
            }
          });
        } else {
          //alert(input);
          $("#searchresult").css("display", "none");
          $("#searchresult_assign").css("display", "none");
        }

      }



      $(document).ready(function () {

        $("#live_search").keyup(function () {

          var input = $(this).val();
          //var qkk = "kldsa";
          //var btna = "lasds";
          //alert(input);
          if (input != "") {
            $.ajax({
              url: "livesearch.php",
              method: "POST",
              data: { input: input, btns: idbtn },
              success: function (data) {
                $("#searchresult").css("display", "inline");
                $("#searchresult").html(data);
              }
            });
            $.ajax({
              url: "livesearch_assign.php",
              method: "POST",
              data: { input: input, btns: idbtn, id_sh: shfft },
              success: function (data) {
                $("#searchresult_assign").css("display", "inline");
                $("#searchresult_assign").html(data);
              }
            });
          } else {
            $("#searchresult").css("display", "none");
            $("#searchresult_assign").css("display", "none");
          }
        });
      });

      function closebtn(clicked_id, vallue) {
        modal.style.display = "none";
        //alert("hjkasd");
        let vva = clicked_id;
        let rr = vva.substring(1, 9);
        let mj = vva.substring(2, 9);
        var mjk = vva.substring(9);
        //alert(rr);
        let chch = document.getElementById(rr);
        let vjvj = document.getElementById("h" + mj);
        //let hhl = document.getElementById("live_search");
        //hhl.value = "";


        var ttxx = document.getElementById(vva).innerText;
        //var ssxx = document.getElementById(vva).innerText;
        //alert(ttxx);
        chch.value = ttxx;
        vjvj.value = mjk;
        document.getElementById("searchresult").innerHTML = "";
        document.getElementById("searchresult_assign").innerHTML = "";
      }


      function Pick_em(cid,cvalue){
        modal.style.display = "none";
        //alert("hjkasd");
        let vva = cid;
        let rr = vva.substring(1, 9);
        let mj = vva.substring(2, 9);
        var mjk = vva.substring(9);
        //alert(rr);
        let chch = document.getElementById(rr);
        let vjvj = document.getElementById("h" + mj);
        //let hhl = document.getElementById("live_search");
        //hhl.value = "";


        var ttxx = document.getElementById(vva).innerText;
        var ttxx = cvalue;
        //var ssxx = document.getElementById(vva).innerText;
        //alert(ttxx);
        chch.value = ttxx;
        vjvj.value = mjk;
        /*alert(rr);
        alert(mj);
        alert(mjk);*/
        document.getElementById("searchresult").innerHTML = "";
        document.getElementById("searchresult_assign").innerHTML = "";

      }
      /*function showResult(str) {
        if (str.length==0) {
          document.getElementById("livesearch").innerHTML="";
          document.getElementById("livesearch").style.border="0px";
          return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
          }
        }
        xmlhttp.open("GET","livesearch.php?q="+str,true);
        xmlhttp.send();
      }*/
    </script>



    <script>
      $(document).ready(function () {
        var id = 1;
        /*Assigning id and class for tr and td tags for separation.*/
        $("#butsend").click(function () {
          var newid = id++;
          $("#table1").append('<tr valign="top" id="' + newid + '">\n\
                                <td width="100px" >' + newid + '</td>\n\
                                <td width="100px" class="name'+ newid + '">' + $("#name").val() + '</td>\n\
                                <td width="100px" class="email'+ newid + '">' + $("#email").val() + '</td>\n\
                                <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');
        });
        $("#table1").on('click', '.remCF', function () {
          $(this).parent().parent().remove();
        });
        /*crating new click event for save button*/
        $("#butsave").click(function () {
          var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
          var from = new Array();
          var to = new Array();
          var date = new Array();
          var nameid = new Array();
          var name = new Array();
          var area = new Array();
          var id_shift = new Array();
          var id_shift_delete = new Array();
          //var id_shift_delete = new Array();
          for (var x = 1; x <= 100; x++) {
            for (var i = 1; i <= 31; i++) {
              /*name.push($("#"+i+" .name"+i).html()); /*pushing all the names listed in the table*/
              //email.push($("#"+i+" .email"+i).html()); /*pushing all the emails listed in the table*/

              if (i < 10) {
                var q = "0" + i;
              } else {
                var q = i;
              }
              /*if (x < 100) {
                var p = "0" + "0" + x;
              } else if (x < 10) {
                var p = "0" + x;
              }else{
                var p = x;
              }*/
              if (x < 10) {
                var p = "0" + "0" + x;
              } else if (x < 100) {
                var p = "0" + x;
              } else {
                var p = x;
              }
              var kla = "tf";
              var kla2 = "-";
              let ml = kla + q + kla2 + p;
              //alert(ml);
              var myElem = document.getElementById(ml);
              if (myElem != null) {

                to.push($("#tt" + q + "-" + p).val());
                from.push($("#tf" + q + "-" + p).val());
                id_shift.push($("#i00-" + p).val());
                nameid.push($("#hn" + q + "-" + p).val());
                name.push($("#bn" + q + "-" + p).val());
                area.push($("#tx" + q + "-" + p).val());
                var ids = $("#i00-" + p).val();
                if (id_shift_delete.includes(ids)) {
                } else {
                  id_shift_delete.push(ids);
                }
                var ym = $("#current_load_date").val();
                let h = ym + "-" + q;
                date.push(h);
                //alert(ym);
              }

            }
          }
          var fromTime = JSON.stringify(from);
          var toTime = JSON.stringify(to);
          var idArr = JSON.stringify(id_shift);
          var dateArr = JSON.stringify(date);
          var deleteArr = JSON.stringify(id_shift_delete);
          var nameidArr = JSON.stringify(nameid);
          var nameArr = JSON.stringify(name);
          var areaArr = JSON.stringify(area);
          //alert(fromTime);
          //alert(toTime);
          var year_month = $("#current_load_date").val();
          $.ajax({
            url: "insert-ajax.php",
            type: "post",
            data: { from: fromTime, to: toTime, dateym: year_month, id_shift: idArr, date: dateArr, id_delete: deleteArr, namesid: nameidArr, name: nameArr, area: areaArr },
            success: function (data) {
              alert(data); /* alerts the response from php.*/
            }
          });
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>




    <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      /*btn.onclick = function() {
        modal.style.display = "block";
      }*/

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = "none";
        document.getElementById("searchresult").innerHTML = "";
        document.getElementById("searchresult_assign").innerHTML = "";

      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";

        }
      }
    </script>





    <script>

    </script>



    <script>
      var passedID = "";
      const daysTag = document.querySelector(".days"),
        currentDate = document.querySelector(".current-date"),
        prevNextIcon = document.querySelectorAll(".icons span");

      let items = [
        [0, 1],
        [4, 8],
        [6, 5],
        [6, 6],
        [8, 28],
        [9, 28],
        [10, 17],
        [11, 24],
        [11, 25],
        [11, 26]
      ];
      // getting new date, current year and month
      let date = new Date(),
        currYear = date.getFullYear(),
        currMonth = date.getMonth();
      <?php

      $currentr = 0;


      ?>
      // storing full name of all months in array
      const months = ["January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"];
      const months2 = [".1", ".2", ".3", ".4", ".5", ".6", ".7",
        ".8", ".9", ".10", ".11", ".12"];
      const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      var first = 0;




      //const renderCalendar = () => {
       function renderCalendar(){
        /*for(var sd = 0; sd < arridc.length; sd++){
          alert(arridc[sd]);

        }*/

        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
          lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
          lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
          lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
        let liTag = "";


        const fr = new Date(currYear, currMonth, 0);
        const f = new Date(currYear, currMonth, 0);
        const kl = new Date(currYear, currMonth, 0);
        const d = new Date();
        const re = new Date();


        let currMonthNull = "";
        if (currMonth < 9) {
          currMonthNull = "0" + (currMonth + 1);
        } else {
          currMonthNull = currMonth + 1;
        }
        let tet = "<input type='hidden' id='current_load_date' name='current_load_date' value='" + currYear + "-" + (currMonthNull) + "'>";
        liTag += `${tet}`;

        var passedSavedata = [];

        var final_arr = [];
        for (let i = 1; i <= lastDateofMonth; i++) {
          if (i == 1) {



            <?php
            $jk = $_POST['current_load_date'];
            $mysqli_cal = require __DIR__ . "/database.php";
            $sql_cal = " SELECT * FROM create_shift ORDER BY id_shift ASC";
            $cols[] = array();
            $color[] = array();
            $colordark[] = array();
            $idc[] = array();
            $wdw[][] = array();
            $tish[][] = array();
            $result_cal = $mysqli_cal->query($sql_cal);
            $r = 0;
            while ($rows_cal = $result_cal->fetch_assoc()) {
              $idc[$r] = $rows_cal['id_shift'];
              $cols[$r] = $rows_cal['shift_name'];
              $color[$r] = $rows_cal['color'];
              $wdw[0][$r] = $rows_cal['monday'];
              $wdw[1][$r] = $rows_cal['tuesday'];
              $wdw[2][$r] = $rows_cal['wednesday'];
              $wdw[3][$r] = $rows_cal['thursday'];
              $wdw[4][$r] = $rows_cal['friday'];
              $wdw[5][$r] = $rows_cal['saturday'];
              $wdw[6][$r] = $rows_cal['sunday'];


              $red = substr($color[$r], 1, 2);
              $green = substr($color[$r], 3, 2);
              $blue = substr($color[$r], 5, 2);
              $red = base_convert($red, 16, 10);
              $green = base_convert($green, 16, 10);
              $blue = base_convert($blue, 16, 10);
              $red = round($red - $red / 100 * 30);
              $green = round($green - $green / 100 * 30);
              $blue = round($blue - $blue / 100 * 30);
              $red = base_convert($red, 10, 16);
              $green = base_convert($green, 10, 16);
              $blue = base_convert($blue, 10, 16);
              if (strlen($red) < 2) {
                $red = "0" . $red;
              }
              if (strlen($green) < 2) {
                $green = "0" . $green;
              }
              if (strlen($blue) < 2) {
                $blue = "0" . $blue;
              }
              $colordark[$r] = "#" . $red . $green . $blue;
              $tish[0][$r] = $rows_cal['mon_from'];
              $tish[1][$r] = $rows_cal['mon_to'];
              $tish[2][$r] = $rows_cal['tue_from'];
              $tish[3][$r] = $rows_cal['tue_to'];
              $tish[4][$r] = $rows_cal['wed_from'];
              $tish[5][$r] = $rows_cal['wed_to'];
              $tish[6][$r] = $rows_cal['thu_from'];
              $tish[7][$r] = $rows_cal['thu_to'];
              $tish[8][$r] = $rows_cal['fri_from'];
              $tish[9][$r] = $rows_cal['fri_to'];
              $tish[10][$r] = $rows_cal['sat_from'];
              $tish[11][$r] = $rows_cal['sat_to'];
              $tish[12][$r] = $rows_cal['sun_from'];
              $tish[13][$r] = $rows_cal['sun_to'];


              $r++;

            }

            $sa[] = array();
            $saved_data[][] = array();

            if ($currentr == 0) {

              $ch = "2024-01";
              //$ch = 
            } else {
              $ch = "2024-02";
            }
            $currentr = 1;
            $y = substr($ch, 0, -3);
            $m = substr($ch, -2);
            $mysqli_sav = require __DIR__ . "/database.php";
            $conout = 0;
            $con = new mysqli($host, $username, $password, $dbname);
            /*if ($conout == 0) {



              for ($x = 0; $x < count($idc); $x++) {
                $sql_check = " SELECT * FROM shift_check WHERE id_shift='$idc[$x]' AND year_shift='$y' AND month_shift ='$m' ";
                $check_existance = mysqli_query($con, $sql_check);

                if (mysqli_num_rows($check_existance) == 0) {

                  $saved_data[$x][0] = "0";
                  $sa[$x] = 0;

                } else {

                  $sa[$x] = "1";
                  $saved_data[$x][0] = "1";
                  for ($i = 1; $i < 32; $i++) {
                    if ($i < 10) {
                      $dt = "0" . $i;
                    } else {
                      $dt = $i;
                    }

                    $d = $ch . "-" . $dt;
                    $sql_get = " SELECT * FROM saved_shift_data WHERE id_of_shift='$idc[$x]' AND saved_date='$d' ";
                    $check_get = mysqli_query($con, $sql_get);
                    if (mysqli_num_rows($check_get) == 0) {
                      $saved_data[$x][$i] = "empty";
                    } else {
                      $result_get = $mysqli_sav->query($sql_get);
                      while ($rows_get = $result_get->fetch_assoc()) {
                        $get_from = $rows_get['saved_from'];
                        $get_to = $rows_get['saved_to'];
                      }
                      $saved_data[$x][$i] = $get_from . "//" . $get_to;
                    }
                  }
                }
              }
              $conout = 1;
            }*/
            global $number;
            $number = count($cols);
            $col_code = "<th id='00-000'>Date</th>";
            for ($i = 0; $i < $number; $i++) {
              $new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);

              $lp = $i + 1;

              if ($lp < 10) {
                $lp = '0' . '0' . $lp;
              } else if ($lp < 100) {
                $lp = '0' . $lp;
              }


              $col_code = $col_code . "<th id='00-" . $lp . "' style='padding:5px;border: solid black' >" . $cols[$i] . "</th><input type='hidden' id='h00-" . $lp . "' value='" . $cols[$i] . "'><input type='hidden' id='i00-" . $lp . "' value='" . $idc[$i] . "'>";

            }

            $final_col_code = "<table><tr style='font-size: 15px;pading:10px;border: solid black'>" . $col_code . "</tr><table>";
            $mysqli_cal->close();
            $ass = "2024-01";
            $rt = 2024;
            ?>


            var count_number =  arrcols.length;
            //alert(count_number+ " Len");
            var col_code = /*"<th id='00-000'>Date</th>"*/"";
            for (var ps = 0; ps < count_number; ps++) {

              let ff = ps + 1;
              if(ff <10){
                ff = "0" + "0" + ff;
              }else if(ff < 100){
                ff = "0" + ff;
              }
              col_code = col_code + "<th id='00-" +ff+ "' style='padding:5px;border: solid black' >" + arrcols[ps] + "</th><input type='hidden' id='h00-" + ff + "' value='" + arrcols[i] +"'><input type='hidden' id='i00-" + ff + "' value='" + arridc[ps] + "'>";

            }
            let final_col_code = "<table><tr style='font-size: 15px;pading:10px;border: solid black'>" + col_code + "</tr><table>";



            //var count_number =  arrcols.length;
            //alert(count_number+ " Len");
            var col_code_obj = "<th id='00-000' rowspan='2'>Date</th>";
            var sea_obj = 0;
            var cou_obj = 0;
            var prea = "";
            //var lst = 0;
            for (var ps = 0; ps < count_number; ps++) {
              if(sea_obj == 0){
                sea_obj = arrobj[ps];
                cou_obj++;
              }else if(arrobj[ps] != sea_obj){
                col_code_obj = col_code_obj + "<th style='padding:5px;border: solid black' colspan='"+cou_obj+"' >" + arrname[ps-1] + "</th>";
                sea_obj = arrobj[ps];
                cou_obj = 1;
                //prea
              }else{
                cou_obj++;
              }
              prea = arrname[ps];
              /*let ff = ps + 1;
              if(ff <10){
                ff = "0" + "0" + ff;
              }else if(ff < 100){
                ff = "0" + ff;
              }*/
              //col_code_obj = col_code_obj + "<th style='padding:5px;border: solid black' >" + arrname[ps] + "</th>";

            }
            col_code_obj = col_code_obj + "<th style='padding:5px;border: solid black' colspan='"+cou_obj+"' >" + prea + "</th>";
             let final_col_code_obj = "<table><tr style='font-size: 15px;pading:10px;border: solid black'>" + col_code_obj + "</tr><table>";
            //alert(col_code);


          /**moe */
          /*var passedID =
              <?php echo json_encode($idc); ?>;*/
              /*var gig =arridc;*/
              //var passedID = new Array();
              var passedID =arridc;
               /*for(var jk = 0; jk < arridc.length; jk++){
                passedID[jk] = arridc[jk];

               }*/
            var passedY =
              <?php echo json_encode($y); ?>;
            var passedM =
              <?php echo json_encode($m); ?>;
            var passedCh =
              <?php echo json_encode($ass); ?>;
              
            //var lena = "<?php //echo "$number" ?>";
            var lena = count_number;
            var tsaas = "1";
            var idp = JSON.stringify(passedID);
            //var idps = JSON.stringify(gig);
            //alert(idps[0]);
            //var idp = gig;
            var Yp = JSON.parse(currYear);
            var Mp = JSON.stringify(currMonth);
            var ChA = JSON.stringify(passedCh);
            var passedSavedata1 = Array();
            var tes;
            //alert(currYear);
            var ssaz = currMonth + 1;
            var MPa = JSON.stringify(ssaz);
            //alert(ssaz);
            var a1sa = new Array;
            var text_return = new Array;
           // alert(idp);
            $.ajax({
              type: "POST",
              url: "cal_get_comment.php",
              dataType: "json",
              cache: false,
              async: false,
              data: {
                id: idp, year: Yp, month: MPa, cha: ChA
              },
              success: function (data) {
                  //alert(JSON.stringify(data));
                  text_return  = JSON.stringify(data);
                  //alert(JSON.stringify(data));
              }

            });
            text_return =text_return.substring(1,text_return.length-1);
            //alert(text_return);
            var middle_arr = new Array();
            var second_arr = new Array();
            //let final_arr = Array();
            middle_arr = text_return.split("]");
            //alert(middle_arr[0]);
            for (let jh = 0; jh < middle_arr.length; jh++) {
              second_arr = [];
              if(jh == 0){
              middle_arr[jh] = middle_arr[jh].substring(1);
              }else{
                middle_arr[jh] = middle_arr[jh].substring(2);
              }
              final_arr[jh] = [];
              //alert(middle_arr[jh]);
            second_arr = middle_arr[jh].split(",");
              for (let j = 0; j < 31; j++) {
                //alert(second_arr[j]);
                var xs = second_arr[j];
                //xs = xs.substring(1);
                //let xk = second_arr[j];
                //let xk = xs.length;
                /*alert(xs);
                alert(xk);*/
                final_arr[jh][j] = xs;
                //final_arr[jh][j] = final_arr[jh][j].substring(1);
                //final_arr[jh][j] = 0;
              }
            }
            //alert(middle_arr[0]);
            //alert(final_arr[4][0]);
            $.ajax({
              type: "POST",
              url: "get-ajax.php",
              dataType: "json",
              cache: false,
              async: false,
              data: {
                id: idp, year: Yp, month: MPa, cha: ChA
              },
              success: function (data321) {
                //alert(data321);
                document.getElementById("help2").value = data321;
                //var tes = JSON.parse(data);
                //tes =  JSON.stringify(data);
                //aja(data);
                //document.getElementById("help").innerHTML = data321;
                //r//eturn data;
                a1sa = JSON.stringify(data321);
                //alert(a1sa);

              }

            });
            //let rrra = document.getElementById("help2").value;
            var hhha = new Array();
            var sks = new Array();
            var qpw = [];
            /*moe*/
            //var bnm = "<?php //echo "$number" ?>";
            var bnm =arridc.length;
            hhha = a1sa.split("]");
            for (let i = 0; i < bnm; i++) {
              hhha[i] = hhha[i].substring(2);
              //alert(hhha[i]);
              passedSavedata[i] = [];
              sks = hhha[i].split(",");
              for (let j = 0; j < 32; j++) {
                passedSavedata[i][j] = sks[j].substring(1, sks[j].length - 1);
                //alert(qpw[j]);
              }
            }
            //alert(qpw);
            //alert(passedSavedata[0][0]);
            /*alert(hhha[0]);
            alert(hhha[1]);

            alert(hhha[2]);

            alert(hhha[3]);
            alert(hhha[4]);
            alert(hhha[5]);
            alert(hhha[6]);
            alert(hhha[7]);
            alert(hhha[8]);*/




            let tet = "<?php echo "$final_col_code"; ?>"

            //liTag += `${tet}`;
            liTag += `${final_col_code_obj}`;
            liTag += `${final_col_code}`;
            col_code = "<th id='00-000'>Date</th>"+col_code; 

          } // creating li of all days of current month
          // adding active class to li if the current day, month, and year matched
          let find = 0;
          let isToday = i === date.getDate() && currMonth === new Date().getMonth()
            && currYear === new Date().getFullYear() ? "active" : "";
          /**source - https://stackoverflow.com/questions/966225/how-can-i-create-a-two-dimensional-array-in-javascript */
          fr.setDate(fr.getDate() + 1);
          f.setDate(f.getDate() + 1)
          let day = weekday[fr.getDay()];
          const m = fr.getMonth();
          var dayy = day;


          for (let e = 0; e < items.length; e++) {

            if (m == items[e][0] && i == items[e][1]) {
              find = 1;
              break;
            }

          }
          /** source https://www.geeksforgeeks.org/how-to-pass-a-php-array-to-a-javascript-function/ */

          /**moe */
          /*var passedArray =
            <?php //echo json_encode($wdw); ?>;
          var passedTime =
            <?php //echo json_encode($tish); ?>;
          var passedColor =
            <?php //echo json_encode($color); ?>;
          var passedColorDark =
            <?php //echo json_encode($colordark); ?>;*/
            //alert("jkhasd");
           var passedArray = arrwdw;
          var passedTime = arrtish;
          var passedColor =arrcolor;
          var passedColorDark = arrcolordark;
          

                                   /* var passedSavedata =
                                      <?php //echo json_encode($saved_data);                ?>;* /
          var passedID =
            <?php //echo json_encode($idc); ?>;
          var tas = 0;
          //alert(passedSavedata[0][2]);


          /** source https://www.geeksforgeeks.org/how-to-pass-variables-and-data-from-php-to-javascript/ */
          /* moe*/
         // var sz = "<?php //echo "$number" ?>";
          //var numas = "<?php //echo "$number" ?>";
          
          if(f_load == 0){
          var sz =arridc.length;
          var numas =arridc.length;
          }else{
            var sz =arridc.length-1;
          var numas =arridc.length-1;   
          }
          //alert("jkhasd2");
          let dts = "";
          let cll = "background-color:#303030; color:white;";
          let ppp = '<div><td>';
          let ddd = '<div><td id="';
          let xxx = "-";
          let jjj = '">';
          let ccc = '" style="min-width:143px;height:180px;border:solid black;background-color: ';
          let zzz = ';">';
          let qqq = "</td></div>";
          let ttt = "<button>+</button>";
          let mmm = '<center><button class="btn btn-light" style="border-radius: 20%;" onClick="reply_click(this.id)" id="b';
          let nnn = '"><i class="bi bi-plus fa-10x"></i></button></center>';
          let bbb = "<br>";
          let ia = '<input type="time" value="';
          let ib = '">';
          let ib1 = '">';
          let xcx = '<button align="right" style="position:absolute;font-size: 10px;pading: 10px" onClick="canceled(this.id)">X</button>';
          //let b1 = '<button align="right" class="btn btn-light" style="position:absolute;top: 3px;right: 3px;font-size: 8px;padding: 10px"" onClick="canceled(this.id)" id="x';
          let b1 = '<button class="btn-close btn-close-white" style="position:relative;border: 1px blackfont-size: 12px;padding-top: 10px;padding-left: 10px" onClick="canceled(this.id)" id="x';
          let bt = '<button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:12px;padding-bottom 10px:" onClick="canceled(this.id)" id="x';
          let b2 = '"></button><br><input type="button" id="bn';
          let b7 = '<br><br><br><input type="button" id="bn';
          let b3 = '" onClick="Open_name(this.id)" style="margin-top:0px" value="';
          let b6 = '"><br><input type="hidden" id="hn';
          let b4 = '" value="';
          let b5 = '"></center><br><div class="mb-3"><textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea></div></div>';
          let t1 = '<div class="form-group"><center><p class="text-light" style="display:inline;font-size:14px;float:left;margin-top:5px;margin-bottom:5px">FROM:</p><input type="time" style="height: 30px;width: 75px;font-size:13px;display:inline;float:right" id="tf';/**class="form-control" */
          let t3 = '<div class="form-group"><center><label for="tf';
          let t4 = '" class="text-light" style="display:inline;font-size:14px;float:left;clear: left;">FROM:</label><input type="time" style="height: 30px;width: 75px;font-size:12px;display:inline;float:right;clear: right;" class="form-control" id="tf';
          let t2 = '<p class="text-light" style="display:inline;font-size:14px;float:left;margin-top:7px;margin-bottom:10px;clear: left;">TO:</p><input type="time" style="height: 30px;width: 75px;font-size:13px;display:inline;float:right;clear: right;margin-bottom:5px" id="tt';/**class="form-control" */
          let t5 = '<label for="tt';
          let t6 = '" class="text-light" style="display:inline;font-size:17px;float:left">TO:</label><input type="time" style="height: 30px;width: 75px;font-size:10px;display:inline;float:right" class="form-control" id="tt';

          let tv = '" value="';
          let open = '--vacant--';
          let s = "background-color:#585858;color:white;";
          let ii = "";
          let cen = "</center>";
          let bt2 = '"><i class="bi bi-trash"></i></button>';
          let txa = '<div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label">Example textarea</label><textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea></div>';


          let td_start = '<td id="'; 
          let td_body = '" style="width: 140px;height: 120px;border:solid black;background-color: ';
          let td_end = '"><div style="margin: 5px"><div class="row"><div class="col-6"><p class="text-light" style="float: left;font-size: 15px">From</p></div>';
          let timepicker_first_start = '<div class="col-6"><input type="time" style="float:right" title="Time selector" id="tf';
          let timepicker_first_body = '" value="';
          let timepicker_first_end = '"></div></div><div class="row"><div class="col-6"><p class="text-light" style="float: left;font-size: 15px">To</p></div>';
          let timepicker_second_start ='<div class="col-6"><input type="time" style="float:right" title="Time selector" id="tt';
          let timepicker_second_body = '" value="';
          let timepicker_second_end = '"></div></div><div class="row"><div class="col-12"><div class="text-center">';
          let employee_selector_start = '<input type="button" id="bn';
          let employee_selector_end = '" onClick="Open_name(this.id)" title="Employee selector" style="width: 130px;height: 32px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size:12px" value="';
          let em_hidden_selector_start = '"><input type="hidden" id="hn';
          let em_hidden_selector_body = '" value="';
          let em_hidden_selector_end = '"></div></div></div><div class="row"><div class="col-12">';
          let textarea_start = '<textarea class="form-control" id="tx';
          let textarea_body = '" style="height: 40px;font-size:12px;margin-top:3px;" title="Comment" rows="1">';
          let textarea_end = '</textarea></div></div><div class="row"><div class="col-4">';
          let delete_start = '<button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" title="Delete" onClick="canceled(this.id)" id="x';
          let delete_end = '"><i class="bi bi-trash"></i></button></div><div class="col-8">';
          let paste_start = '<button type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;margin-left:2px;width: 25px;height: 25px;padding:0px;float:right" title="Paste" onClick="paste_cell(this.id)" id="pa';
          let paste_end = '">P</button>';
          let copy_start = '<button type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:right" title="Copy" onClick="copy_cell(this.id)" id="co';
          let copy_end = '">C</button></div></div></div></td>';
          //dts = dts.concat(td_start, td_body, td_end, timepicker_first_start, timepicker_first_body, timepicker_first_end, timepicker_second_start, timepicker_second_body, timepicker_second_end, employee_selector_start, employee_selector_end, em_hidden_selector_start, em_hidden_selector_body, em_hidden_selector_end, textarea_start, textarea_end, delete_start, paste_start, paste_end, copy_start, copy_end);
          if (day == "Monday") {
            s = "background-color:#303030; color:white;";
            for (let q = 0; q < sz; q++) {
              if (passedSavedata[q][0] == "1" && first == 0) {
                if (passedSavedata[q][i] == "empty") {
                  let p = q + 1;
                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }
                  dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);


                } else {
                  let str1 = passedSavedata[q][i];
                  str1 = str1.substring(0, 5);
                  let str2 = passedSavedata[q][i];
                  str2 = str2.substring(10, 15);
                  let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                  //alert(str3 + "ass"+ str1);
                  
                  let p = q + 1;
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }

                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  var count = 0;
                  var char = 20;
                  var val3 = "";
                  for (; ;) {
                    let result = passedSavedata[q][i].charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = passedSavedata[q][i].substring(char);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p,bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p,bt2, t3,ii, xxx, p,t4, ii, xxx, p, tv, str1, ib, bbb, t5,ii, xxx, p,t6, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                }
              } else if (passedArray[0][q] == 1) {
                let str1 = passedTime[0][q];
                str1 = str1.substring(0, str1.length - 3);
                let str2 = passedTime[1][q];
                str2 = str2.substring(0, str2.length - 3);
                let str3 = final_arr[q][i-1];
                str3 = str3.substring(1, str3.length-1);

                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
              } else {
                let p = q + 1;
                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }
                dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
              }
            }
          } else if (day == "Tuesday") {
            s = "background-color:#585858; color:white;";
            for (let q = 0; q < sz; q++) {

              if (passedSavedata[q][0] == "1" && first == 0) {
                if (passedSavedata[q][i] == "empty") {
                  let p = q + 1;
                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }
                  dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                } else {
                  let str1 = passedSavedata[q][i];
                  str1 = str1.substring(0, 5);
                  let str2 = passedSavedata[q][i];
                  str2 = str2.substring(10, 15);
                  let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                  let p = q + 1;
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }

                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  var count = 0;
                  var char = 20;
                  var val3 = "";
                  for (; ;) {
                    let result = passedSavedata[q][i].charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = passedSavedata[q][i].substring(char);
                  //dts = //dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2,ii, xxx, p,b3,ii, xxx, p,b4, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq)
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

                }
              } else if (passedArray[1][q] == 1) {
                let str1 = passedTime[2][q];
                str1 = str1.substring(0, str1.length - 3);
                let str2 = passedTime[3][q];
                str2 = str2.substring(0, str2.length - 3);
                let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

              } else {
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);
              }
            }
          } else if (day == "Wednesday") {
            s = "background-color:#303030; color:white;";
            for (let q = 0; q < sz; q++) {

              if (passedSavedata[q][0] == "1" && first == 0) {
                if (passedSavedata[q][i] == "empty") {
                  let p = q + 1;
                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }
                  dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                } else {
                  let str1 = passedSavedata[q][i];
                  str1 = str1.substring(0, 5);
                  let str2 = passedSavedata[q][i];
                  str2 = str2.substring(10, 15);
                  let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                  let p = q + 1;
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }

                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  var count = 0;
                  var char = 20;
                  var val3 = "";
                  for (; ;) {
                    let result = passedSavedata[q][i].charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = passedSavedata[q][i].substring(char);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2,ii, xxx, p,b3,ii, xxx, p,b4, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                }
              } else if (passedArray[2][q] == 1) {
                let str1 = passedTime[4][q];
                str1 = str1.substring(0, str1.length - 3);
                let str2 = passedTime[5][q];
                str2 = str2.substring(0, str2.length - 3);
                let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);


              } else {
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
              }
            }
          } else if (day == "Thursday") {
            s = "background-color:#585858; color:white;";
            for (let q = 0; q < sz; q++) {

              if (passedSavedata[q][0] == "1" && first == 0) {
                if (passedSavedata[q][i] == "empty") {
                  let p = q + 1;
                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }
                  dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                } else {
                  let str1 = passedSavedata[q][i];
                  str1 = str1.substring(0, 5);
                  let str2 = passedSavedata[q][i];
                  str2 = str2.substring(10, 15);
                  let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                  let p = q + 1;
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }

                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  var count = 0;
                  var char = 20;
                  var val3 = "";
                  for (; ;) {
                    let result = passedSavedata[q][i].charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = passedSavedata[q][i].substring(char);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2,ii, xxx, p,b3,ii, xxx, p,b4, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                }
              } else if (passedArray[3][q] == 1) {
                let str1 = passedTime[6][q];
                str1 = str1.substring(0, str1.length - 3);
                let str2 = passedTime[7][q];
                str2 = str2.substring(0, str2.length - 3);
                let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

              } else {
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);
              }
            }
          } else if (day == "Friday") {
            s = "background-color:#303030; color:white;";
            for (let q = 0; q < sz; q++) {

              if (passedSavedata[q][0] == "1" && first == 0) {
                if (passedSavedata[q][i] == "empty") {
                  let p = q + 1;
                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }
                  dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                } else {
                  let str1 = passedSavedata[q][i];
                  str1 = str1.substring(0, 5);
                  let str2 = passedSavedata[q][i];
                  str2 = str2.substring(10, 15);
                  let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                  let p = q + 1;
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }

                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  var count = 0;
                  var char = 20;
                  var val3 = "";
                  for (; ;) {
                    let result = passedSavedata[q][i].charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = passedSavedata[q][i].substring(char);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2,ii, xxx, p,b3,ii, xxx, p,b4, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                }
              } else if (passedArray[4][q] == 1) {
                let str1 = passedTime[8][q];
                str1 = str1.substring(0, str1.length - 3);
                let str2 = passedTime[9][q];
                str2 = str2.substring(0, str2.length - 3);
                let str3 = final_arr[q][i];
                  str3 = str3.substring(1, str3.length-1);
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

              } else {
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {

                  ii = i;
                }
                dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
              }
            }
          } else if (day == "Saturday") {
            s = "background-color:#585858; color:white;";
            for (let q = 0; q < sz; q++) {

              if (passedSavedata[q][0] == "1" && first == 0) {
                if (passedSavedata[q][i] == "empty") {
                  let p = q + 1;
                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }
                  dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                } else {
                  let str1 = passedSavedata[q][i];
                  str1 = str1.substring(0, 5);
                  let str2 = passedSavedata[q][i];
                  str2 = str2.substring(10, 15);
                  let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                  let p = q + 1;
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }

                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  var count = 0;
                  var char = 20;
                  var val3 = "";
                  for (; ;) {
                    let result = passedSavedata[q][i].charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = passedSavedata[q][i].substring(char);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2,ii, xxx, p,b3,ii, xxx, p,b4, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);
                }
              } else if (passedArray[5][q] == 1) {
                let str1 = passedTime[10][q];
                str1 = str1.substring(0, str1.length - 3);
                let str2 = passedTime[11][q];
                str2 = str2.substring(0, str2.length - 3);
                let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                dts = dts.concat(td_start, ii, xxx, p, td_body, passedColorDark[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

              } else {
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                dts = dts.concat(ddd, ii, xxx, p, ccc, passedColorDark[q], zzz, mmm, ii, xxx, p, nnn, qqq);
              }
            }
          } else if (day == "Sunday") {
            s = "background-color:#303030; color:white;";
            for (let q = 0; q < sz; q++) {

              if (passedSavedata[q][0] == "1" && first == 0) {
                if (passedSavedata[q][i] == "empty") {
                  let p = q + 1;
                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }
                  dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);

                } else {
                  let str1 = passedSavedata[q][i];
                  str1 = str1.substring(0, 5);
                  let str2 = passedSavedata[q][i];
                  str2 = str2.substring(10, 15);
                  let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                  let p = q + 1;
                  if (p < 10) {
                    p = "0" + "0" + p;
                  } else if (p < 100) {
                    p = "0" + p;
                  }

                  if (i < 10) {
                    ii = "0" + i;
                  } else {
                    ii = i;
                  }
                  var count = 0;
                  var char = 20;
                  var val3 = "";
                  for (; ;) {
                    let result = passedSavedata[q][i].charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = passedSavedata[q][i].substring(char);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2,ii, xxx, p,b3,ii, xxx, p,b4, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, namen, b6, ii, xxx, p, b4, val3, b5, qqq);
                  dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, namen, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, val3, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

                }
              } else if (passedArray[6][q] == 1) {
                let str1 = passedTime[12][q];
                str1 = str1.substring(0, str1.length - 3);
                let str2 = passedTime[13][q];
                str2 = str2.substring(0, str2.length - 3);
                let str3 = final_arr[q][i-1];
                  str3 = str3.substring(1, str3.length-1);
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;
                } else {
                  ii = i;
                }
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b1, ii, xxx, p, b2, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                //dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, bt, ii, xxx, p, bt2, t1, ii, xxx, p, tv, str1, ib, bbb, t2, ii, xxx, p, tv, str2, ib, b7, ii, xxx, p, b3, open, b6, ii, xxx, p, b4, b5, qqq);
                dts = dts.concat(td_start, ii, xxx, p, td_body, passedColor[q], td_end, timepicker_first_start, ii, xxx, p, timepicker_first_body, str1, timepicker_first_end, timepicker_second_start, ii, xxx, p, timepicker_second_body, str2, timepicker_second_end, employee_selector_start, ii, xxx, p, employee_selector_end, open, em_hidden_selector_start, ii, xxx, p, em_hidden_selector_body, em_hidden_selector_end, textarea_start, ii, xxx, p, textarea_body,str3, textarea_end, delete_start, ii, xxx, p, delete_end, paste_start, ii, xxx, p, paste_end, copy_start, ii, xxx, p, copy_end);

              } else {
                let p = q + 1;
                if (p < 10) {
                  p = "0" + "0" + p;
                } else if (p < 100) {
                  p = "0" + p;
                }

                if (i < 10) {
                  ii = "0" + i;

                } else {
                  ii = i;
                }
                dts = dts.concat(ddd, ii, xxx, p, ccc, passedColor[q], zzz, mmm, ii, xxx, p, nnn, qqq);
              }
            }
          }
          let nul = 0;
          if (find == 1) {


            liTag += `<tr><td id="${i}-000" class="${isToday}" style="${s};font-size: 12px;min-height:100px;border: solid black">${i} ${months2[currMonth]} <br> ${day} - Holiday <br> <button id="rc${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;margin-right:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="copy_row(this.id)" title="Copy">C</button><button id="rp${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="paste_row(this.id)" title="Paste">P</button> </td>${dts}<tr>`;
            <?php echo $dsa = ""; ?>
          } else {
            <?php echo $dsa = ""; ?>
            liTag += `<tr style="min-height:100px"><td id="${i}-000" class="${isToday}" style="${s};font-size: 15px;min-height:100px;border: solid black;margin-left:10px">${i} ${months2[currMonth]} <br> ${day} <br> <button id="rc${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;margin-right:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="copy_row(this.id)" title="Copy">C</button><button id="rp${i}" type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:left" onclick="paste_row(this.id)" title="Paste">P</button> </td>${dts}<tr>`;


            <?php echo $dsa = ""; ?>
          }
          <?php echo $dsa = ""; ?>
          if (day == "Sunday" && i != 31) {
            let tet = "<?php echo "$final_col_code"; ?>";
            //liTag += `${tet}`;
            //let blank = "<th><th>" + `${col_code}`;
            liTag += `${col_code}`;
            daysTag.innerHTML = liTag;
          }

        }
        f_load = 1;
        console.log("Hello");
        console.log(passedArray);
        <?php $dsa = ""; ?>
        currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
        daysTag.innerHTML = liTag;

      }



      //renderCalendar();

      <?php $dsa = ""; ?>
      prevNextIcon.forEach(icon => { // getting prev and next icons
        icon.addEventListener("click", () => { // adding click event on both icons
          // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
          currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

          if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
          } else {
            date = new Date(); // pass the current date as date value
          }
          //first = 1;
          renderCalendar(); // calling renderCalendar function


          //add_dat();


        });
      });
    </script>

    <script>
      <?php
      $mysqli_open = require __DIR__ . "/database.php";
      $sql_open = " SELECT * FROM create_shift ORDER BY id_shift ASC";
      $result_open = $mysqli_open->query($sql_open);
      $idb[] = array();
      $b = 0;
      while ($rows_open = $result_open->fetch_assoc()) {
        $idb[$b] = $rows_open['id_shift'];
        $b++;
      }
      $rr = $_GET['kpk'];
      $L = substr($rr, 0, -3);
      $P = substr($rr, -2);

      ?>
      function add_dat() {
        var newww = document.getElementById("current_load_date").value;
        var neww = newww.substring(0, 4);
        var news = newww.substring(5, 7);
        var passedIDB =
          <?php echo json_encode($idb); ?>;
        var passedYY =
          <?php echo json_encode($L); ?>;
        var passedMM =
          <?php echo json_encode($P); ?>;
        var passedChCH =
          <?php echo json_encode($rr); ?>;
        //var lena = "<?php //echo "$number"                ?>";
        var tsaas = "1";
        var idb = JSON.stringify(passedIDB);
        var Ypb = JSON.parse(neww);
        var Mpb = JSON.stringify(news);
        var ChAb = JSON.stringify(passedChCH);
        var Cdsa = JSON.stringify(newww);
        var tess;
        //alert(newww);
        $.ajax({
          type: "POST",
          url: "get-ajax.php",
          dataType: "html",
          data: {
            id: idb, year: Ypb, month: Mpb, cha: ChAb, nn: Cdsa
          },
          success: function (data3211) {
            document.getElementById("help").value = data3211;
            vl();
          }
        });
      }



    </script>
    <script>
                  //renderCalendar();




                  function filter(){
                    from_paste_arr = [];
                    to_paste_arr = [];
                    exist_arr = [];
                    /*alert("1");
                    alert(shi_search);
                    alert("2");
                    alert(obj_search);
                    alert("3");*/
                    f_load = 0;
              var results = new Array();
              $.ajax({
                url: "cal_arr_load.php",
                method: "POST",
                dataType: "json",
                cache: false,
                async: false,
                data: { shall: shiftall,oball: objectall, shift_arr: shi_search, object_arr: obj_search, input: inp,user: usid },
                success: function (data) {
                  results = JSON.stringify(data);
                }

              });
              //alert(results);
               arridc = [];
               arrcols = [];
              arrcolor =[]; //new Array();
              arrwdw =[]; //new Array(7);
             arrcolordark =[]; //new Array();
               arrtish =[]; //new Array();
               arrobj =[]; //new Array();
               arrname =[];
              //if (shiftall == 1) {
                results = results.substring(1, results.length - 1);
                if(results.length >7){
                //alert(results);
                var hhha = new Array();
                var sks = new Array();
                var qpw = [];
                var bnm = lshi;
                hhha = results.split("]");
                var bnm = hhha.length;
                //alert(hhha[i]);
                //alert(hhha[0]);
                for (let i = 0; i < bnm; i++) {
                  var tt = hhha[i].length;
                  if (i == 0) {
                    hhha[i] = hhha[i].substring(1, tt);

                  } else {
                    hhha[i] = hhha[i].substring(2, tt);
                  }
                  //alert(hhha[i]);
                  if (i == 0) {
                    for (let z = 0; z < 7; z++) {
                      arrwdw[z] = [];
                      for (let j = 0; j < hhha.length; j++) {
                        arrwdw[z][j] = 0;
                      }
                    }
                    for (let z = 0; z < 14; z++) {
                      arrtish[z] = [];
                      for (let j = 0; j < hhha.length; j++) {
                        arrtish[z][j] = 0;
                      }
                    }
                  }

                  sks = hhha[i].split(",");
                  //alert(hhha[i]);
                  arridc[i] = sks[0].substring(1, sks[0].length - 1);
                  arrcols[i] = sks[1].substring(1, sks[1].length - 1);
                  arrcolor[i] = sks[2].substring(1, sks[2].length - 1);
                  arrcolordark[i] = sks[3].substring(1, sks[3].length - 1);
                  arrwdw[0][i] = sks[4].substring(1, sks[4].length - 1);
                  arrwdw[1][i] = sks[5].substring(1, sks[5].length - 1);
                  arrwdw[2][i] = sks[6].substring(1, sks[6].length - 1);
                  arrwdw[3][i] = sks[7].substring(1, sks[7].length - 1);
                  arrwdw[4][i] = sks[8].substring(1, sks[8].length - 1);
                  arrwdw[5][i] = sks[9].substring(1, sks[9].length - 1);
                  arrwdw[6][i] = sks[10].substring(1, sks[10].length - 1);
                  arrtish[0][i] = sks[11].substring(1, sks[11].length - 1);
                  arrtish[1][i] = sks[12].substring(1, sks[12].length - 1);
                  arrtish[2][i] = sks[13].substring(1, sks[13].length - 1);
                  arrtish[3][i] = sks[14].substring(1, sks[14].length - 1);
                  arrtish[4][i] = sks[15].substring(1, sks[15].length - 1);
                  arrtish[5][i] = sks[16].substring(1, sks[16].length - 1);
                  arrtish[6][i] = sks[17].substring(1, sks[17].length - 1);
                  arrtish[7][i] = sks[18].substring(1, sks[18].length - 1);
                  arrtish[8][i] = sks[19].substring(1, sks[19].length - 1);
                  arrtish[9][i] = sks[20].substring(1, sks[20].length - 1);
                  arrtish[10][i] = sks[21].substring(1, sks[21].length - 1);
                  arrtish[11][i] = sks[22].substring(1, sks[22].length - 1);
                  arrtish[12][i] = sks[23].substring(1, sks[23].length - 1);
                  arrtish[13][i] = sks[24].substring(1, sks[24].length - 1);
                  arrobj[i] = sks[25].substring(1, sks[25].length - 1);
                  arrname[i] = sks[26].substring(1, sks[26].length - 1);
                  //if (i ==bnm-1) {
                  //renderCalendar();
                  
                  if(i == bnm-2){
                  call_cal();
                  }
                  //}
                  //call_cal();
                 //alert( arrobj[i]);
                

                }
                //call_cal();
                //renderCalendar();
                //renderCalendar();
               

              }else{
                daysTag.innerHTML = "";
                /*let Tac = "<table><tr><th>JAJK</th></tr></table>";
                daysTag.innerHTML = Tac;*/
                Empty();
              }
              
              //renderCalendar();
                //alert( arrobj[0]);

              //}



            }
            function call_cal (){
              renderCalendar();

            }
            function Empty(){
              let head = "<table><tr style='font-size: 15px;pading:10px;border: solid black'><th>"+lastDateofMonth+"</th></tr><table>";
              //let Tac = "<table><tr><th>JAJK</th></tr></table>";
              let Tac = head;
              /*for (let i = 1; i <= lastDateofMonth; i++) {
                Tac = Tac + "<tr><td>" +i +"</td></tr>";
              }*/
                daysTag.innerHTML = head;
            }






























      function vl() {
        tess = document.getElementById("help").textContent;
        var a1 = JSON.parse(document.getElementById("help").value);
        for (let x = 0; x < a1.length + 1; x++) {

          for (let i = 1; i < 32; i++) {
            if (a1[x][0] == "0") {

            } else {
              if (a1[x][i] == "empty") {
                if (x < 10) {
                  var mr = "0" + "0" + (x + 1);
                } else if (x < 100) {
                  var mr = "0" + (x + 1);
                } else {
                  var mr = (x + 1);
                }
                if (i < 10) {
                  var mrs = "0" + i;
                } else {
                  var mrs = i;
                }
                let fa = mrs + "-" + mr;
                let end = "";
                let chq = document.getElementById(fa);
                if (chq !== null) {
                  let can = "";
                  let mmm = '<center><button onClick="reply_click(this.id)" id="b';
                  let nnn = '">V</button></center>';
                  can = mmm + fa + nnn;
                  chq.innerHTML = can;
                }
              } else {
                if (x < 10) {
                  var mr = "0" + "0" + (x + 1);
                } else if (x < 100) {
                  var mr = "0" + (x + 1);
                } else {
                  var mr = (x + 1);
                }
                if (i < 10) {
                  var mrs = "0" + i;
                } else {
                  var mrs = i;
                }
                let fa = mrs + "-" + mr;
                let end = " ";
                let chp = document.getElementById(fa);
                if (chp !== null) {
                  let final = "";
                  let btn1 = '<button align="right" style="position:absolute;top: 0px;right: 0px;font-size: 8px;" onClick="canceled(this.id)" id="x';
                  let btn2 = '">V</button><br><br><br><br><br><input type="button" id="bn';
                  let b2 = '">X</button><br><input type="button" id="bn';
                  let btn3 = '" onClick="Open_name(this.id)" value="'
                  let btn6 = '"><input type="hidden" id="hn';


                  /*let cll = "background-color:#303030; color:white;";
          let ppp = '<div><td>';
          let ddd = '<div><td id="';
          let xxx = "-";
          let jjj = '">';
          let ccc = '" style="min-width:170px;border:solid black;padding: 20px;background-color: ';
          let zzz = ';">';
          let qqq = "</td></div>";
          let ttt = "<button>+</button>";
          let mmm = '<center><button class="btn btn-light" style="border-radius: 20%;" onClick="reply_click(this.id)" id="b';
          let nnn = '"><i class="bi bi-plus fa-10x"></i></button></center>';
          let bbb = "<br>";
          let ia = '<input type="time" value="';
          let ib = '">';
          let ib1 = '">';
          let xcx = '<button align="right" style="position:absolute;font-size: 10px;pading: 10px" onClick="canceled(this.id)">X</button>';
          //let b1 = '<button align="right" class="btn btn-light" style="position:absolute;top: 3px;right: 3px;font-size: 8px;padding: 10px"" onClick="canceled(this.id)" id="x';
          let b1 = '<button class="btn-close btn-close-white" style="position:relative;border: 1px blackfont-size: 12px;padding-top: 10px;padding-left: 10px" onClick="canceled(this.id)" id="x';
          let bt = '<button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:12px;padding-bottom 10px:" onClick="canceled(this.id)" id="x';
          let b2 = '"></button><br><input type="button" id="bn';
          let b7 = '<br><br><br><input type="button" id="bn';
          let b3 = '" onClick="Open_name(this.id)" style="margin-top:10px" value="';
          let b6 = '"><br><input type="hidden" id="hn';
          let b4 = '" value="';
          let b5 = '"></center></div>';
          let t1 = '<div class="form-group"><center><p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:5px;margin-bottom:5px">FROM:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right" class="form-control" id="tf';
          let t3 = '<div class="form-group"><center><label for="tf';
          let t4 = '" class="text-light" style="display:inline;font-size:17px;float:left;clear: left;">FROM:</label><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;" class="form-control" id="tf';
          let t2 = '<p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:7px;margin-bottom:10px;clear: left;">TO:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;margin-bottom:5px" class="form-control" id="tt';
          let t5 = '<label for="tt';
          let t6 = '" class="text-light" style="display:inline;font-size:17px;float:left">TO:</label><input type="time" style="height: 38px;width: 75px;font-size:10px;;display:inline;float:right" class="form-control" id="tt';

          let tv = '" value="';
          let open = 'vacant';
          let s = "background-color:#585858;color:white;";
          let ii = "";
          let cen = "</center>";
          let bt2 = '"><i class="bi bi-trash"></i></button>';*/




                  //let b3 = '" onClick="Open_name(this.id)" value="open"><input type="hidden" id="hn';
                  let btn4 = '" value="';
                  let btn5 = '"></center></div>';
                  let val = a1[x][i];
                  let val1 = val.substring(0, 5);
                  let val2 = val.substring(10, 15);
                  let val3 = "" /*val.substring(20)*/;
                  var count = 0;
                  var char = 20;
                  for (; ;) {
                    let result = val.charAt(char);
                    if (result != "/") {
                      val3 = val3 + result;
                      char++;
                    } else {
                      break;
                    }
                  }
                  char = char + 2;
                  let namen = val.substring(char);
                  let brr = "<br>";
                  let tm1 = '<div class="form-group"><center><p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:5px;margin-bottom:5px">FROM:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;" class="form-control" id="tf';
                  let tm2 = '<p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:7px;margin-bottom:10px;clear: left;">TO:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;margin-bottom:5px" class="form-control" id="tt';
                  let tmv = '" value="';
                  let tmc = '">';
                  let asz = '<input type="time" id="tp01-001" value="00:00">';
                  let bt = '<button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:12px;padding-bottom 10px:" onClick="canceled(this.id)" id="x';
                  let bt2 = '"><i class="bi bi-trash"></i></button>';
                  final = bt + fa + bt2 + tm1 + fa + tmv + val1 + tmc + brr + tm2 + fa + tmv + val2 + tmc + btn1 + fa + btn2 + fa + btn3 + namen + btn6 + fa + btn4 + val3 + btn5;
                  chp.innerHTML = "";
                  chp.innerHTML = final;
                }
              }
            }
          }
        }
      }
    </script>

    <script>
      function FFF() {
        let r = 10;
        let nulls = 0;
        if (r < 10) {
          r = "0" + r;
        }
        labelElement.innerHTML =
          r;
      }


      function prependZero(number) {
        if (number < 9)
          return "0" + number;
        else
          return number;
      }


      function reply_click(clicked_id) {
        let result123 = clicked_id.substring(1, 7);
        let cha = document.getElementById(result123);
        let final = "";
        let btn1 = '<button align="right" style="position:absolute;top: 0px;right: 0px;font-size: 8px;" onClick="canceled(this.id)" id="x';
        let btn2 = '">x</button><br><br><br><br><br><input type="button" id="bn';
        let btn3 = '" onClick="Open_name(this.id)" value="--vacant--"><input type="hidden" id="hn';
        let btn4 = '" value=""></center></div>';
        let val = "00:00";
        let brr = "<br>";
        let tm1 = '<div class="form-group"><center><p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:5px;margin-bottom:5px">FROM:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;" class="form-control" id="tf';
        let tm2 = '<p class="text-light" style="display:inline;font-size:17px;float:left;margin-top:7px;margin-bottom:10px;clear: left;">TO:</p><input type="time" style="height: 38px;width: 75px;font-size:10px;display:inline;float:right;clear: right;margin-bottom:5px" class="form-control" id="tt';
        let tmv = '" value="';
        let tmc = '">';
        let tmc2 = '">';
        let bt = '<button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:12px;" onClick="canceled(this.id)" id="x';
        let bt2 = '"><i class="bi bi-trash"></i></button>';



          let new_start = '<div style="margin: 5px"><div class="row"><div class="col-6"><p class="text-light" style="float: left;font-size: 15px">From</p></div>';
          let timepicker_first_start = '<div class="col-6"><input type="time" style="float:right" title="Time selector" id="tf';
          let timepicker_first_body = '" value="';
          let timepicker_first_end = '"></div></div><div class="row"><div class="col-6"><p class="text-light" style="float: left;font-size: 15px">To</p></div>';
          let timepicker_second_start ='<div class="col-6"><input type="time" style="float:right" title="Time selector" id="tt';
          let timepicker_second_body = '" value="';
          let timepicker_second_end = '"></div></div><div class="row"><div class="col-12"><div class="text-center">';
          let employee_selector_start = '<input type="button" id="bn';
          let employee_selector_end = '" onClick="Open_name(this.id)" title="Employee selector" style="width: 130px;height: 32px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size:12px" value="--vacant--';
          let em_hidden_selector_start = '"><input type="hidden" id="hn';
          let em_hidden_selector_body = '" value="';
          let em_hidden_selector_end = '"></div></div></div><div class="row"><div class="col-12">';
          let textarea_start = '<textarea class="form-control" id="tx';
          let textarea_body = '" style="height: 40px;font-size:12px;margin-top:3px;" title="Comment" rows="1">';
          let textarea_end = '</textarea></div></div><div class="row"><div class="col-4">';
          let delete_start = '<button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" title="Delete" onClick="canceled(this.id)" id="x';
          let delete_end = '"><i class="bi bi-trash"></i></button></div><div class="col-8">';
          let paste_start = '<button type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;margin-left:2px;width: 25px;height: 25px;padding:0px;float:right" title="Paste" onClick="paste_cell(this.id)" id="pa';
          let paste_end = '">P</button>';
          let copy_start = '<button type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:right" title="Copy" onClick="copy_cell(this.id)" id="co';
          let copy_end = '">C</button></div></div></div>';




          final = new_start+timepicker_first_start + result123+timepicker_first_body + val +timepicker_first_end +timepicker_second_start+result123 + timepicker_second_body+ val +timepicker_second_end+employee_selector_start+ result123 +  employee_selector_end + em_hidden_selector_start+ result123+ em_hidden_selector_body+ em_hidden_selector_end + textarea_start + result123 + textarea_body +textarea_end+delete_start+result123+delete_end +paste_start + result123+paste_end +copy_start +result123 +copy_end;

        //final = bt + result123 + bt2 + tm1 + result123 + tmv + val + tmc + brr + tm2 + result123 + tmv + val + tmc2 + btn1 + result123 + btn2 + result123 + btn3 + result123 + btn4;
        cha.innerHTML = final;
      }
      function canceled(clicked_id) {
        let result123 = clicked_id.substring(1, 7);
        let cha = document.getElementById(result123);
        let can = "";
        let mmm = '<center><button class="btn btn-light" style="border-radius: 20%;" onClick="reply_click(this.id)" id="b';
        let nnn = '"><i class="bi bi-plus fa-10x"></i></button></center>';
        can = mmm + result123 + nnn;
        cha.innerHTML = can;
      }
      var from_paste = "";
      var to_paste = "";
      var exist_arr = new Array()
      var from_paste_arr = new Array();
      var to_paste_arr = new Array();
      function paste_cell(paste_id) {
        
        paste_id = paste_id.substring(2);
        //document.getElementById("tf"+paste_id).value;
        //alert(document.getElementById("tf"+paste_id).value);
        //from_paste = document.getElementById("tf"+paste_id).value;
        //to_paste = document.getElementById("tf"+paste_id).value;

        if(from_paste != ""){
        document.getElementById("tf"+paste_id).value = from_paste;
        document.getElementById("tt"+paste_id).value = to_paste
      }
      }
      function copy_cell(copy_id) {
        //alert(copy_id);
        copy_id = copy_id.substring(2);

        from_paste = document.getElementById("tf"+copy_id).value;
        to_paste = document.getElementById("tt"+copy_id).value;


      }
      function copy_row(copy_id) {
        from_paste_arr = [];
        to_paste_arr = [];
        exist_arr = [];
      copy_id = copy_id.substring(2);
      //alert(copy_id);
      if(copy_id < 10){
          copy_id = "0"+copy_id;
        }
      var sz =arridc.length;
      for(var i = 1; i < sz; i++){
        //var col = i+1; 
        

        var col_id = i; 
        if(col_id < 10){
          //var row_ = i+1; 
          col_id = "0" + "0" +col_id;
        }else if(col_id < 100){
          col_id = "0" +col_id;
        }
        //alert("tf"+copy_id+"-"+col_id);
        if (document.getElementById('tf' + copy_id+"-"+col_id) != null) {
            exist_arr[i-1] = 1;
            from_paste_arr[i-1] = document.getElementById("tf"+copy_id+"-"+col_id).value;
          to_paste_arr[i-1] = to_paste = document.getElementById("tt"+copy_id+"-"+col_id).value;
        }else{
          exist_arr[i-1] = 0;
          from_paste_arr[i-1] = "00:00";
          to_paste_arr[i-1] = "00:00";
        }

      }
      alert(exist_arr);
      alert(from_paste_arr);
      alert(to_paste_arr);
      }
      function paste_row(paste_id) {
        paste_id = paste_id.substring(2);
      alert(paste_id);
      if(paste_id < 10){
          paste_id = "0"+paste_id;
        }
        if(from_paste_arr.length != 0){
      var sz =arridc.length;
      
      for(var i = 1; i < sz; i++){
         
            var col_id = i; 
        if(col_id < 10){
          //var row_ = i+1; 
          col_id = "0" + "0" +col_id;
        }else if(col_id < 100){
          col_id = "0" +col_id;
        }
        alert(paste_id+"-"+col_id);
        if(exist_arr[i-1] == 0){
          if(document.getElementById('tf' + paste_id+"-"+col_id) != null){
            var x_id = "x" + paste_id+"-"+col_id;
              canceled(x_id);
          }

        }else{
          if(document.getElementById('tf' + paste_id+"-"+col_id) == null){
            var r_id = "b" + paste_id+"-"+col_id;
              //canceled(x_id);
              reply_click(r_id);
              document.getElementById("tf"+paste_id+"-"+col_id).value = from_paste_arr[i-1];
              document.getElementById("tt"+paste_id+"-"+col_id).value = to_paste_arr[i-1];
          }else{
            document.getElementById("tf"+paste_id+"-"+col_id).value = from_paste_arr[i-1];
              document.getElementById("tt"+paste_id+"-"+col_id).value = to_paste_arr[i-1];
          }
        }
        
      }
    }

      }
    </script>



  <?php else: ?>
  <?php endif; ?>








</body>

</html>