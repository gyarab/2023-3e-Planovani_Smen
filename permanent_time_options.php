<?php
/**Currently in development  */
$cons = "";
session_start();

if (isset($_SESSION["user2_id"])) {

  $mysqli = require __DIR__ . "/database.php";

  $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
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
  <title>Document</title>
  <link rel="stylesheet" href="css/main_page.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/tree.css">
  <link rel="stylesheet" href="css/success.css">

  <style>
    .cont {
      margin-bottom: 25px;
      border: 1px solid;
      margin: auto;
      width: 100%;
      padding: 10px;
      box-shadow: 5px 10px #888888;
      margin-left: 10px;
    }

    .head {
      margin: auto;
      width: 100%;
      padding: 10px;
      margin-bottom: 25px;
    }

    .in {
      border-radius: 100%;
      height: 30px;
      width: 30px;
      border: solid #aaa;
    }

    .topright {
      position: absolute;
      top: 8px;
      right: 16px;
      font-size: 18px;
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
  </style>
</head>

<body>
  <script>
    var id_shift;
    var update;

  </script>

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
              <li><a href="#">LIST</a></li>
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
  <br>
  <br>
  <br>






  <?php if (isset($user)): ?>

    <div class="container">

      <br>
      <div class="cont">
        <div class="row">
          <div class='col-12 col-md-12'>
            <script>
              var obj_search = new Array();
              var shi_search = new Array();
              /*const curr_date = new Date();
              let day =curr_date.getDate();
              let month = curr_date.getMonth()+1;
              let year = curr_date.getFullYear();

              let sr = `${day}-${month}-${year}`;*/

              let currentDate = new Date().toJSON().slice(0, 10);
              //alert(currentDate);
            </script>

            <br>
            <h6>Selected time</h6>
            <br>
            <div style="display: inline;">
              <p>Select employee :</p>
              <input id="search_bar_em" type="text" size="20" autocomplete="off" style="display: inline"
                style='margin-bottom: 15px' placeholder="Search for employee">
              <p style="display: inline"> OR </p>
              <Select id="select_em" style="display: inline">
                <option id="opt_man-0" value="0">Pick a employee</option>
                <?php
                /** nacteni vsech uzivatelu do select boxu */
                $mysqli = require __DIR__ . "/database.php";

                $conn = new mysqli($host, $username, $password, $dbname);
                $query7 = "SELECT * FROM user2 ORDER BY lastname, firstname ";
                $result7 = mysqli_query($conn, $query7);
                if (mysqli_num_rows($result7) > 0) {
                  while ($row_em = mysqli_fetch_assoc($result7)) {
                    $id_em = $row_em['id'];
                    $firstname_em = $row_em['firstname'];
                    $middlename_em = $row_em['middlename'];
                    $lastname_em = $row_em['lastname'];

                    ?>
                    <option id="opt_em-<?php echo $id_em; ?>" value="<?php echo $id_em; ?>">
                      <?php echo $lastname_em . " " . $middlename_em . " " . $firstname_em; ?>
                    </option>

                    <?php
                  }
                }

                ?>
              </Select>
              <button id="unselect" style="display: none;margin-left: 15px" onclick="Unselect()"
                class="btn btn-danger">Unselect</button>
            </div>
            <div id="assi_search" style="width:550px">

            </div>
            <br>
            <br>
            <script>
              /** vyhledavani uzivatelu pres searchbar */
              $("#search_bar_em").keyup(function () {

                var input = $(this).val();
                if (input != null) {

                  $.ajax({
                    url: "employee_search.php",
                    method: "POST",
                    data: { input: input },
                    success: function (data) {
                      $("#assi_search").html(data);
                    }
                  });
                }
              });
              /** vybrani uzivatele pres select */
              var usid;
              $('#select_em').change(function () {
                var srch = $(this).val();
                if (srch != 0) {

                  var ph = document.getElementById("opt_em-" + srch).innerText;
                  document.getElementById('search_bar_em').value = ph;
                  document.getElementById('assi_search').innerHTML = "";
                  const selec2 = document.querySelector('#select_em');
                  selec2.value = srch;
                  em_sel = srch;
                  document.getElementById('search_bar_em').readOnly = true;
                  document.getElementById('select_em').disabled = true;
                  document.getElementById("unselect").style.display = "";
                  /*document.getElementById("chart").style.display = "";
                  document.getElementById("table_stat").style.display = "";*/
                  document.getElementById("div_in").style.display = "";
                  usid = srch;
                  loader();
                }
              });
              var global_id;
              /**funkce na vybrani uzivatele pres searchbar */
              function push(vvv) {
                var ph = document.getElementById("op_em" + vvv).innerText;
                document.getElementById('search_bar_em').value = ph;
                document.getElementById('assi_search').innerHTML = "";
                const selec2 = document.querySelector('#select_em');
                selec2.value = vvv;
                em_sel = vvv;
                document.getElementById('search_bar_em').readOnly = true;
                document.getElementById('select_em').disabled = true;
                document.getElementById("unselect").style.display = "";
                /*document.getElementById("chart").style.display = "";
                document.getElementById("table_stat").style.display = "";*/
                document.getElementById("div_in").style.display = "";
                usid = vvv;
                loader();


              }
              function Unselect() {
                document.getElementById('search_bar_em').readOnly = false;
                document.getElementById('select_em').disabled = false;
                document.getElementById('select_em').value = 0;
                document.getElementById('search_bar_em').value = "";
                document.getElementById("unselect").style.display = "none";
                /*document.getElementById("chart").style.display = "none";
                document.getElementById("table_stat").style.display = "none";*/
                document.getElementById("div_in").style.display = "none";
                 document.getElementById('frommonday').value ="";
             document.getElementById('tomonday').value ="";
            document.getElementById('fromtuesday').value ="";
             document.getElementById('totuesday').value ="";
            document.getElementById('fromwednesday').value ="";
            document.getElementById('towednesday').value ="";
             document.getElementById('fromthursday').value ="";
             document.getElementById('tothursday').value ="";
             document.getElementById('fromfriday').value ="";
             document.getElementById('tofriday').value ="";
             document.getElementById('fromsaturday').value ="";
            document.getElementById('tosaturday').value ="";
            document.getElementById('fromsunday').value ="";
          document.getElementById('tosunday').value ="";
          document.getElementById('monday').checked =false;
          document.getElementById('tuesday').checked =false;
          document.getElementById('wednesday').checked =false;
          document.getElementById('thursday').checked =false;
          document.getElementById('friday').checked =false;
          document.getElementById('saturday').checked =false;
          document.getElementById('sunday').checked =false;
              }
            </script>
            <div id="div_in" style="display: none;">
              <div class="row">
                <div class='col-12 col-md-6'>

                  <input type="checkbox" id="everyday" name="radio" style="display:inline">
                  <label for="everyday" style="display:inline"> Everyday</label>
                  <input type="checkbox" id="everyworkday" name="radio" style="display:inline">
                  <label for="everyworkday" style="display:inline"> Every work day</label>
                  <input type="checkbox" id="weekend" name="radio" style="display:inline">
                  <label for="weekend" style="display:inline"> Every weekend</label>
                  <br>
                  <label for="from" style="display:inline">From </label>
                  <input type="time" id="from" name="from" style="display:inline" />
                  <label for="to" style="display:inline">To </label>
                  <input type="time" id="to" name="to" style="display:inline" />

                  <button id="paste" class="btn btn-outline-primary" onclick="myFunction()">Paste</button>
                  <br>
                  <hr>


                  <!--<h3>Specific setting</h3>--->
                <div class="row">
                  <div class='col-12 col-md-12'>
                    <input class="select" type="checkbox" id="monday" name="monday" style="display:inline">
                    <label for="monday" style="display:inline"> Monday </label>
                    <div style="float:right">
                      <label for="frommonday" style="display:inline"> From </label>
                      <input id="frommonday" name="frommonday" type="time" style="display:inline" />
                      <label for="tomonday" style="display:inline;margin-left:15px">To </label>
                      <input type="time" id="tomonday" name="tomonday" style="display:inline" />
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class='col-12 col-md-12'>
                    <input class="select" type="checkbox" id="tuesday" name="tuesday" style="display:inline">
                    <label for="tuesday" style="display:inline"> Tuesday </label>
                    <div style="float:right">
                      <label for="fromtuesday" style="display:inline"> From </label>
                      <input type="time" id="fromtuesday" name="fromtuesday" style="display:inline" />
                      <label for="totuesday" style="display:inline;margin-left:15px">To </label>
                      <input type="time" id="totuesday" name="totuesday" style="display:inline" />
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class='col-12 col-md-12'>
                    <input class="select" type="checkbox" id="wednesday" name="wednesday" style="display:inline">
                    <label for="wednesday" style="display:inline"> Wednesday </label>
                    <div style="float:right">
                      <label for="fromwednesday" style="display:inline"> From </label>
                      <input type="time" id="fromwednesday" name="fromwednesday" style="display:inline" />
                      <label for="towednesday" style="display:inline;margin-left:15px">To </label>
                      <input type="time" id="towednesday" name="towednesday" style="display:inline" />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class='col-12 col-md-12'>
                    <input class="select" type="checkbox" id="thursday" name="thursday" style="display:inline">
                    <label for="thursday" style="display:inline"> Thursday </label>
                    <div style="float:right">
                      <label for="fromthursday" style="display:inline">From </label>
                      <input type="time" id="fromthursday" name="fromthursday" min="00:00" max="00:00"
                        style="display:inline" />
                      <label for="tothursday" style="display:inline;margin-left:15px">To </label>
                      <input type="time" id="tothursday" name="tothursday" min="00:00" max="00:00"
                        style="display:inline" />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class='col-12 col-md-12'>
                    <input class="select" type="checkbox" id="friday" name="friday" style="display:inline">
                    <label for="Friday" style="display:inline"> Friday </label>
                    <div style="float:right">
                      <label for="fromfriday" style="display:inline">From </label>
                      <input type="time" id="fromfriday" name="fromfriday" min="00:00" max="00:00"
                        style="display:inline" />
                      <label for="tofriday" style="display:inline;margin-left:15px">To </label>
                      <input type="time" id="tofriday" name="tofriday" min="00:00" max="00:00" style="display:inline" />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class='col-12 col-md-12'>
                    <input class="select" type="checkbox" id="saturday" name="saturday" style="display:inline">
                    <label for="saturday" style="display:inline"> Saturday </label>
                    <div style="float:right">
                      <label for="fromsaturday" style="display:inline">From </label>
                      <input type="time" id="fromsaturday" name="fromsaturday" min="00:00" max="00:00"
                        style="display:inline" />
                      <label for="tosaturday" style="display:inline;margin-left:15px">To </label>
                      <input type="time" id="tosaturday" name="tosaturday" min="00:00" max="00:00"
                        style="display:inline" />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class='col-12 col-md-12'>
                    <input class="select" type="checkbox" id="sunday" name="sunday" style="display:inline">
                    <label for="sunday" style="display:inline"> Sunday </label>
                    <div style="float:right">
                      <label for="fromsunday" style="display:inline">From </label>
                      <input class="select" type="time" id="fromsunday" name="fromsunday" min="00:00" max="00:00"
                        style="display:inline" />
                      <label style="display:inline;margin-left:15px">To </label>
                      <input type="time" id="tosunday" name="tosunday" min="00:00" max="00:00" style="display:inline" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <br>
                  <div class='col-12 col-md-12'>
                    <br>


                    <button class="btn btn-primary" onclick="Save()" style="float:right">Save time options</button>
                  </div>
                </div>



              </div>
            </div>
          </div>


        </div>
      </div>
      <!--<label>In which object the shift should be:</label>
          <br>-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
          crossorigin="anonymous"></script>










        <?php
        $names = $_GET['day'];
        foreach ($names as $color) {
          echo $color . "<br />";
        }
        ?>








        <!--<div class="tree">
            <div id="res"></div>
          </div>
          <br id="hbr3" style="display:none">
          <label id="label3" style="visibility:hidden;color:red">Object needs to be selected*</label>-->






        <script>



          var input = <?php echo json_encode($pickm); ?>;
          var ChA = JSON.parse(input);
          $.ajax({
            url: "load_object_in_shift.php",
            method: "POST",
            data: { input: ChA },
            success: function (data) {
              $("#res").html(data);
            }
          });


          var ff;


          var previous;



          $("#savemain").click(function () {
            $(".check-icon").hide();
            setTimeout(function () {
              $(".check-icon").show();
            }, 10);
          });


          var cq = 0;
          var Cq = JSON.parse(cq);


          function Edit_shift() {
            let e = document.getElementById("sfield").value;

            if (e != "") {

              var mf = document.getElementById('sfrommonday').value;
              var mt = document.getElementById('stomonday').value;
              var tuf = document.getElementById('sfromtuesday').value;
              var tut = document.getElementById('stotuesday').value;
              var wf = document.getElementById('sfromwednesday').value;
              var wt = document.getElementById('stowednesday').value;
              var thf = document.getElementById('sfromthursday').value;
              var tht = document.getElementById('stothursday').value;
              var ff = document.getElementById('sfromfriday').value;
              var ft = document.getElementById('stofriday').value;
              var saf = document.getElementById('sfromsaturday').value;
              var sat = document.getElementById('stosaturday').value;
              var suf = document.getElementById('sfromsunday').value;
              var sut = document.getElementById('stosunday').value;

              var name = document.getElementById('sfield').value;
              //var start = document.getElementById('sr').value;
              var start = currentDate;

              var mo_d = document.getElementById("smonday");
              var tu_d = document.getElementById("stuesday");
              var we_d = document.getElementById("swednesday");
              var th_d = document.getElementById("sthursday");
              var fr_d = document.getElementById("sfriday");
              var sa_d = document.getElementById("ssaturday");
              var su_d = document.getElementById("ssunday");
              if (previous3 != "0" && previous3 != null) {
                var bb = "spa" + previous3;
                var hh = "shi" + previous3;
                var pj = document.getElementById(bb).value;
                var jj = document.getElementById(hh).value;
              } else {
                var pj = transfer[24];
                var jj = transfer[23]
              }
              var update = 1;
              //alert(previous3);
              if (mo_d.checked == true) {
                mon_day = 1;
              } else {
                mon_day = 0;
              }
              if (tu_d.checked == true) {
                tue_day = 1;
              } else {
                tue_day = 0;
              }
              if (we_d.checked == true) {
                wed_day = 1;
              } else {
                wed_day = 0;
              }
              if (th_d.checked == true) {
                thu_day = 1;
              } else {
                thu_day = 0;
              }
              if (fr_d.checked == true) {
                fri_day = 1;
              } else {
                fri_day = 0;
              }
              if (sa_d.checked == true) {
                sat_day = 1;
              } else {
                sat_day = 0;
              }
              if (su_d.checked == true) {
                sun_day = 1;
              } else {
                sun_day = 0;
              }


              var monf = JSON.stringify(mf);
              var mont = JSON.stringify(mt);
              var tuef = JSON.stringify(tuf);
              var tuet = JSON.stringify(tut);
              var wedf = JSON.stringify(wf);
              var wedt = JSON.stringify(wt);
              var thuf = JSON.stringify(thf);
              var thut = JSON.stringify(tht);
              var frif = JSON.stringify(ff);
              var frit = JSON.stringify(ft);
              var satf = JSON.stringify(saf);
              var satt = JSON.stringify(sat);
              var sunf = JSON.stringify(suf);
              var sunt = JSON.stringify(sut);

              var jobname = JSON.stringify(name);

              var mond = JSON.parse(mon_day);
              var tued = JSON.parse(tue_day);
              var wedd = JSON.parse(wed_day);
              var thud = JSON.parse(thu_day);
              var frid = JSON.parse(fri_day);
              var satd = JSON.parse(sat_day);
              var sund = JSON.parse(sun_day);
              //alert(jj);
              $.ajax({


                url: "load_shift2.php",
                method: "POST",
                data: {
                  mond: mond, monf: monf, mont: mont,
                  tued: tued, tuef: tuef, tuet: tuet,
                  wedd: wedd, wedf: wedf, wedt: wedt,
                  thud: thud, thuf: thuf, thut: thut,
                  frid: frid, frif: frif, frit: frit,
                  satd: satd, satf: satf, satt: satt,
                  sund: sund, sunf: sunf, sunt: sunt,
                  jobname: e, color: shex, start: start,
                  object_name: pj, object_id: jj, update: update,
                  id_shift: id_shift
                },
                success: function (data) {
                  modal.style.display = "none";
                  alert("Shift was successfully edited");
                  //alert("Schift saved succesfully");
                }
              });
              $.ajax({


                url: "load_existing_shift.php",
                method: "POST",
                data: { input: inp0, type: typ_btn, obj: obj_search, shi: shi_search },
                success: function (data) {
                  $("#shift_ex_load").html(data);
                }
              });
              var popup = document.getElementById("label2s");
              popup.style.visibility = "hidden";
              popup.innerText = "";
              var po = document.getElementById("hbrs");
              po.style.display = "none";

              var popu = document.getElementById("label1s");
              popu.style.visibility = "hidden";
              var pop = document.getElementById("hbr1s");
              pop.style.display = "none";

              var popups = document.getElementById("label3s");
              popups.style.visibility = "hidden";
              var p = document.getElementById("hbr3s");
              p.style.display = "none";

            } else {
              var popup = document.getElementById("label2s");
              popup.style.visibility = "visible";
              popup.innerText = "Needs to be filled*";
              var po = document.getElementById("hbrs");
              po.style.display = "";

              var popu = document.getElementById("label1s");
              popu.style.visibility = "visible";
              var pop = document.getElementById("hbr1s");
              pop.style.display = "";

            }
          }

          function loader() {
            var return_data;
            var return_data_arr = new Array();
            $.ajax({


              url: "load_permanent_time_option.php",
              method: "POST",
              dataType: "json",
              cache: false,
              async: false,
              data: {

                input: usid
              },
              success: function (data) {
                return_data = JSON.stringify(data);
                //alert(data);
              }

            });
           

            return_data = return_data.substring(1,return_data.length-1);
          alert(return_data);
          if(return_data != "[]"){
           return_data_arr =  return_data.split(",");
           for(var e = 0; e < return_data_arr.length; e++){
            return_data_arr[e] = return_data_arr[e].substring(1,return_data_arr[e].length-1);
            //alert(return_data_arr[e]);
           }
           if(return_data_arr[0] == 1 ){
            document.getElementById("monday").checked = true;
            document.getElementById("frommonday").value = return_data_arr[1].substring(0,5) ;
            document.getElementById("tomonday").value = return_data_arr[2].substring(0,5) ;
           }
           if(return_data_arr[3] == 1 ){
            document.getElementById("tuesday").checked = true;
            document.getElementById("fromtuesday").value = return_data_arr[4].substring(0,5) ;
            document.getElementById("totuesday").value = return_data_arr[5].substring(0,5) ;
           }
           if(return_data_arr[6] == 1 ){
            document.getElementById("wednesday").checked = true;
            document.getElementById("fromwednesday").value = return_data_arr[7].substring(0,5) ;
            document.getElementById("towednesday").value = return_data_arr[8].substring(0,5) ;
           }
           if(return_data_arr[9] == 1 ){
            document.getElementById("thursday").checked = true;
            document.getElementById("fromthursday").value = return_data_arr[10].substring(0,5) ;
            document.getElementById("tothursday").value = return_data_arr[11].substring(0,5) ;
           }
           if(return_data_arr[12] == 1 ){
            document.getElementById("friday").checked = true;
            document.getElementById("fromfriday").value = return_data_arr[13].substring(0,5) ;
            document.getElementById("tofriday").value = return_data_arr[14].substring(0,5) ;
           }
           if(return_data_arr[15] == 1 ){
            document.getElementById("saturday").checked = true;
            document.getElementById("fromsaturday").value = return_data_arr[16].substring(0,5) ;
            document.getElementById("tosaturday").value = return_data_arr[17].substring(0,5) ;
           }
           if(return_data_arr[18] == 1 ){
            document.getElementById("sunday").checked = true;
            document.getElementById("fromsunday").value = return_data_arr[19].substring(0,5) ;
            document.getElementById("tosunday").value = return_data_arr[20].substring(0,5) ;
           }
           
          }
          }

          





          function Save() {





            var mf = document.getElementById('frommonday').value;
            var mt = document.getElementById('tomonday').value;
            var tuf = document.getElementById('fromtuesday').value;
            var tut = document.getElementById('totuesday').value;
            var wf = document.getElementById('fromwednesday').value;
            var wt = document.getElementById('towednesday').value;
            var thf = document.getElementById('fromthursday').value;
            var tht = document.getElementById('tothursday').value;
            var ff = document.getElementById('fromfriday').value;
            var ft = document.getElementById('tofriday').value;
            var saf = document.getElementById('fromsaturday').value;
            var sat = document.getElementById('tosaturday').value;
            var suf = document.getElementById('fromsunday').value;
            var sut = document.getElementById('tosunday').value;

            //var start = document.getElementById('sr').value;
            var start = currentDate;

            var mo_d = document.getElementById("monday");
            var tu_d = document.getElementById("tuesday");
            var we_d = document.getElementById("wednesday");
            var th_d = document.getElementById("thursday");
            var fr_d = document.getElementById("friday");
            var sa_d = document.getElementById("saturday");
            var su_d = document.getElementById("sunday");
            var update = 0;
            if (mo_d.checked == true) {
              mon_day = 1;
            } else {
              mon_day = 0;
            }
            if (tu_d.checked == true) {
              tue_day = 1;
            } else {
              tue_day = 0;
            }
            if (we_d.checked == true) {
              wed_day = 1;
            } else {
              wed_day = 0;
            }
            if (th_d.checked == true) {
              thu_day = 1;
            } else {
              thu_day = 0;
            }
            if (fr_d.checked == true) {
              fri_day = 1;
            } else {
              fri_day = 0;
            }
            if (sa_d.checked == true) {
              sat_day = 1;
            } else {
              sat_day = 0;
            }
            if (su_d.checked == true) {
              sun_day = 1;
            } else {
              sun_day = 0;
            }

            var monf = JSON.stringify(mf);
            var mont = JSON.stringify(mt);
            var tuef = JSON.stringify(tuf);
            var tuet = JSON.stringify(tut);
            var wedf = JSON.stringify(wf);
            var wedt = JSON.stringify(wt);
            var thuf = JSON.stringify(thf);
            var thut = JSON.stringify(tht);
            var frif = JSON.stringify(ff);
            var frit = JSON.stringify(ft);
            var satf = JSON.stringify(saf);
            var satt = JSON.stringify(sat);
            var sunf = JSON.stringify(suf);
            var sunt = JSON.stringify(sut);



            var mond = JSON.parse(mon_day);
            var tued = JSON.parse(tue_day);
            var wedd = JSON.parse(wed_day);
            var thud = JSON.parse(thu_day);
            var frid = JSON.parse(fri_day);
            var satd = JSON.parse(sat_day);
            var sund = JSON.parse(sun_day);
            $.ajax({


              url: "insert_permanent_time_option.php",
              method: "POST",
              data: {
                mond: mond, monf: monf, mont: mont,
                tued: tued, tuef: tuef, tuet: tuet,
                wedd: wedd, wedf: wedf, wedt: wedt,
                thud: thud, thuf: thuf, thut: thut,
                frid: frid, frif: frif, frit: frit,
                satd: satd, satf: satf, satt: satt,
                sund: sund, sunf: sunf, sunt: sunt,
                id: usid
              },
              success: function (data) {
                alert(data);
              }

            });

            /*$.ajax({


              url: "load_existing_shift.php",
              method: "POST",
              data: { input: inp0, type: typ_btn, obj: obj_search, shi: shi_search },
              success: function (data) {
                $("#shift_ex_load").html(data);
              }
            });*/

          }
        </script>




        <br>
        <!--<label for="colorpicker">Color Picker:</label>
          <br>
          <br>

          <input id="color-1" type="button" class="in" onclick="Color(this.id)" style="background-color: #124072;"
            value="">
          <input id="color-2" type="button" class="in" onclick="Color(this.id)" style="background-color: #067088;"
            value="">
          <input id="color-3" type="button" class="in" onclick="Color(this.id)" style="background-color: #056362;"
            value="">
          <input id="color-4" type="button" class="in" onclick="Color(this.id)" style="background-color: #055d2b;"
            value="">
          <input id="color-5" type="button" class="in" onclick="Color(this.id)" style="background-color: #4b8723;"
            value="">
          <input id="color-6" type="button" class="in" onclick="Color(this.id)" style="background-color: #889d1e;"
            value="">
          <br>
          <input id="color-7" type="button" class="in" onclick="Color(this.id)" style="background-color: #c3b204;"
            value="">
          <input id="color-8" type="button" class="in" onclick="Color(this.id)" style="background-color: #ce8425;"
            value="">
          <input id="color-9" type="button" class="in" onclick="Color(this.id)" style="background-color:  #a53d1a;"
            value="">
          <input id="color-10" type="button" class="in" onclick="Color(this.id)" style="background-color:  #880002;"
            value="">
          <input id="color-11" type="button" class="in" onclick="Color(this.id)" style="background-color:  #6a1161;"
            value="">
          <input id="color-12" type="button" class="in" onclick="Color(this.id)" style="background-color:  #4c1862 ;"
            value="">
          <br>
          <input id="color-13" type="button" class="in" onclick="Color(this.id)" style="background-color: #1965b9;"
            value="">
          <input id="color-14" type="button" class="in" onclick="Color(this.id)" style="background-color:  #039ce0;"
            value="">
          <input id="color-15" type="button" class="in" onclick="Color(this.id)" style="background-color: #01969c;"
            value="">
          <input id="color-16" type="button" class="in" onclick="Color(this.id)" style="background-color: #009242;"
            value="">
          <input id="color-17" type="button" class="in" onclick="Color(this.id)" style="background-color:  #67ad31 ;"
            value="">
          <input id="color-18" type="button" class="in" onclick="Color(this.id)" style="background-color: #bcd637;"
            value="">
          <br>
          <input id="color-19" type="button" class="in" onclick="Color(this.id)" style="background-color: #fff002;"
            value="">
          <input id="color-20" type="button" class="in" onclick="Color(this.id)" style="background-color: #fdaf43;"
            value="">
          <input id="color-21" type="button" class="in" onclick="Color(this.id)" style="background-color: #e87034;"
            value="">
          <input id="color-22" type="button" class="in" onclick="Color(this.id)" style="background-color: #eb1c26;"
            value="">
          <input id="color-23" type="button" class="in" onclick="Color(this.id)" style="background-color: #a2288d;"
            value="">
          <input id="color-24" type="button" class="in" onclick="Color(this.id)" style="background-color: #652d90;"
            value="">
          <br>
          <input id="color-25" type="button" class="in" onclick="Color(this.id)" style="background-color: #81c1e7;"
            value="">
          <input id="color-26" type="button" class="in" onclick="Color(this.id)" style="background-color: #50ddd5;"
            value="">
          <input id="color-27" type="button" class="in" onclick="Color(this.id)" style="background-color: #addc81;"
            value="">
          <input id="color-28" type="button" class="in" onclick="Color(this.id)" style="background-color: #ffffba;"
            value="">
          <input id="color-29" type="button" class="in" onclick="Color(this.id)" style="background-color: #fea698;"
            value="">
          <input id="color-30" type="button" class="in" onclick="Color(this.id)" style="background-color: #b697dd;"
            value="">
          <br>-->

        <script>
          var input_obj =
            <?php echo json_encode($pickm); ?>;
          $.ajax({
            url: "load_list_object.php",
            method: "POST",
            data: { input: input_obj },
            success: function (data) {
              $("#objects").html(data);

            }
          });
          $.ajax({
            url: "load_list_shift.php",
            method: "POST",
            data: { input: input_obj },
            success: function (data) {
              //$("#searchresult").css("display", "inline");
              $("#shi_load").html(data);
            }
          });

          $('#option').change(function () {
            //bj_search = [];
            obj_search = [];
            shi_search = [];
            var inp = $(this).val();
            $.ajax({
              url: "load_list_object.php",
              method: "POST",
              data: { input: inp },
              success: function (data) {
                $("#objects").html(data);

              }
            });



          });

          /*function pos_click(clicked_val) {

              if (pos_search.includes(clicked_val) == true) {
                  for (let i = 0; i < pos_search.length; i++) {
                      if (pos_search[i] === clicked_val) {
                          pos_search.splice(i, 1);
                      }
                  }
              } else {
                  pos_search.push(clicked_val);
              }

          }*/
          function obj_click(clicked_val) {
            //alert(obj_search);

            if (obj_search.includes(clicked_val) == true) {
              for (let i = 0; i < obj_search.length; i++) {
                if (obj_search[i] === clicked_val) {
                  obj_search.splice(i, 1);

                }
              }
            } else {
              obj_search.push(clicked_val);
            }
            $.ajax({


              url: "load_existing_shift.php",
              method: "POST",
              data: { input: inp0, type: typ_btn, obj: obj_search, shi: shi_search },
              success: function (data) {
                $("#shift_ex_load").html(data);
                alert("adsads");
              }
            });
          }
          function shift_search(clicked_val) {
            //alert(shift_search);
            if (shi_search.includes(clicked_val) == true) {
              for (let i = 0; i < shi_search.length; i++) {
                if (shi_search[i] === clicked_val) {
                  shi_search.splice(i, 1);
                }
              }
            } else {
              shi_search.push(clicked_val);
            }
            $.ajax({


              url: "load_existing_shift.php",
              method: "POST",
              data: { input: inp0, type: typ_btn, obj: obj_search, shi: shi_search },
              success: function (data) {
                $("#shift_ex_load").html(data);
              }
            });
          }
        </script>
        <br>
        <br>
        <div id="shift_ex_load">
        </div>
        <br>

        <script>
          var typ_btn = 1;
          var inp0 =
            <?php echo json_encode($first); ?>;
          //var Arrs =new Array();
          $.ajax({


            url: "load_existing_shift.php",
            method: "POST",
            data: { input: inp0, type: typ_btn, obj: obj_search, shi: shi_search },
            success: function (data) {
              $("#shift_ex_load").html(data);
            }
          });


          $('#option').change(function () {
            var inp = $(this).val();
            $.ajax({


              url: "load_existing_shift.php",
              method: "POST",
              data: { input: inp, type: typ_btn, obj: obj_search, shi: shi_search },
              success: function (data) {
                $("#shift_ex_load").html(data);
              }
            });
          })
          var transfer = new Array();
          function Open_edit(clicked_id) {
            id_shift = clicked_id.substring(5);
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            modal.style.display = "block";
            var arr;

            $.ajax({


              url: "edit_shift.php",
              method: "POST",
              dataType: "json",
              cache: false,
              async: false,
              data: { input: id_shift },
              success: function (data) {
                arr = JSON.stringify(data);
              }
            });
            arr = arr.substring(1, arr.length - 1);
            transfer = arr.split(",");
            for (let i = 0; i < transfer.length; i++) {
              var wap = transfer[i];
              wap = wap.substring(1, wap.length - 1);
              transfer[i] = wap;
            }

            var inpp = transfer[23];
            var saas;
            $.ajax({
              url: "look_for_main_object.php",
              method: "POST",
              dataType: "json",
              cache: false,
              async: false,
              data: { input: inpp },
              success: function (data) {

                saas = JSON.stringify(data);
              }
            });
            saas = saas.substring(1, saas.length - 2);
            var mainb = saas.substring(0, 1);
            var sideb = saas.substring(3);
            sColor(map1.get(transfer[22]));
            document.getElementById("select_obj").value = sideb;
            edit_obj(sideb, transfer[23]);


            document.getElementById("smonday").checked = false;
            document.getElementById("stuesday").checked = false;
            document.getElementById("swednesday").checked = false;
            document.getElementById("sthursday").checked = false;
            document.getElementById("sfriday").checked = false;
            document.getElementById("ssaturday").checked = false;
            document.getElementById("ssunday").checked = false;
            document.getElementById("sfrommonday").value = "";
            document.getElementById("stomonday").value = "";
            document.getElementById("sfromtuesday").value = "";
            document.getElementById("stotuesday").value = "";
            document.getElementById("sfromwednesday").value = "";
            document.getElementById("stowednesday").value = "";
            document.getElementById("sfromthursday").value = "";
            document.getElementById("stothursday").value = "";
            document.getElementById("sfromfriday").value = "";
            document.getElementById("stofriday").value = "";
            document.getElementById("sfromsaturday").value = "";
            document.getElementById("stosaturday").value = "";
            document.getElementById("sfromsunday").value = "";
            document.getElementById("stosunday").value = "";

            if (transfer[0] == 1) {
              document.getElementById("smonday").checked = true;
              var mf = transfer[1];
              mf = mf.substring(0, 5);
              document.getElementById("sfrommonday").value = mf;
              var mf = transfer[2];
              mf = mf.substring(0, 5);
              document.getElementById("stomonday").value = mf;
            }
            if (transfer[3] == 1) {
              document.getElementById("stuesday").checked = true;
              var mf = transfer[4];
              mf = mf.substring(0, 5);
              document.getElementById("sfromtuesday").value = mf;
              var mf = transfer[5];
              mf = mf.substring(0, 5);
              document.getElementById("stotuesday").value = mf;
            }
            if (transfer[6] == 1) {
              document.getElementById("swednesday").checked = true;
              var mf = transfer[7];
              mf = mf.substring(0, 5);
              document.getElementById("sfromwednesday").value = mf;
              var mf = transfer[8];
              mf = mf.substring(0, 5);
              document.getElementById("stowednesday").value = mf;
            }
            if (transfer[9] == 1) {
              document.getElementById("sthursday").checked = true;
              var mf = transfer[10];
              mf = mf.substring(0, 5);
              document.getElementById("sfromthursday").value = mf;
              var mf = transfer[11];
              mf = mf.substring(0, 5);
              document.getElementById("stothursday").value = mf;
            }
            if (transfer[12] == 1) {
              document.getElementById("sfriday").checked = true;
              var mf = transfer[13];
              mf = mf.substring(0, 5);
              document.getElementById("sfromfriday").value = mf;
              var mf = transfer[14];
              mf = mf.substring(0, 5);
              document.getElementById("stofriday").value = mf;
            }
            if (transfer[15] == 1) {
              document.getElementById("ssaturday").checked = true;
              var mf = transfer[16];
              mf = mf.substring(0, 5);
              document.getElementById("sfromsaturday").value = mf;
              var mf = transfer[17];
              mf = mf.substring(0, 5);
              document.getElementById("stosaturday").value = mf;
            }
            if (transfer[18] == 1) {
              document.getElementById("ssunday").checked = true;
              var mf = transfer[19];
              mf = mf.substring(0, 5);
              document.getElementById("sfromsunday").value = mf;
              var mf = transfer[20];
              mf = mf.substring(0, 5);
              document.getElementById("stosunday").value = mf;
            }

            document.getElementById("sfield").value = transfer[21];
          }


          var modal = document.getElementById("myModal");

          // Get the button that opens the modal
          var btn = document.getElementById("myBtn");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks the button, open the modal 


          // When the user clicks on <span> (x), close the modal
          span.onclick = function () {
            modal.style.display = "none";

          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function (event) {
            if (event.target == modal) {
              modal.style.display = "none";

            }
          }

        </script>
      </div>



    </div>
    </div>

  <?php else: ?>
  <?php endif; ?>
</body>
<script>
  document.getElementById('sr').valueAsDate = new Date();
  document.cookie = "myval= " + document.getElementById('sr').value;

</script>
<script>



</script>
<script>
</script>


<script>
  document.getElementById('everyday').onclick = function () {
    var mo = document.getElementById('monday');
    var tu = document.getElementById('tuesday');
    var we = document.getElementById('wednesday');
    var th = document.getElementById('thursday');
    var fr = document.getElementById('friday');
    var sa = document.getElementById('saturday');
    var su = document.getElementById('sunday');
    if (mo.checked == true) {
      mo.checked = false;
    } else {
      mo.checked = true;
    }
    if (tu.checked == true) {
      tu.checked = false;
    } else {
      tu.checked = true;
    }
    if (we.checked == true) {
      we.checked = false;
    } else {
      we.checked = true;
    }
    if (th.checked == true) {
      th.checked = false;
    } else {
      th.checked = true;
    }
    if (fr.checked == true) {
      fr.checked = false;
    } else {
      fr.checked = true;
    }
    if (sa.checked == true) {
      sa.checked = false;
    } else {
      sa.checked = true;
    }
    if (su.checked == true) {
      su.checked = false;
    } else {
      su.checked = true;
    }

  }
  document.getElementById('everyworkday').onclick = function () {

    var mo = document.getElementById('monday');
    var tu = document.getElementById('tuesday');
    var we = document.getElementById('wednesday');
    var th = document.getElementById('thursday');
    var fr = document.getElementById('friday');
    if (mo.checked == true) {
      mo.checked = false;
    } else {
      mo.checked = true;
    }
    if (tu.checked == true) {
      tu.checked = false;
    } else {
      tu.checked = true;
    }
    if (we.checked == true) {
      we.checked = false;
    } else {
      we.checked = true;
    }
    if (th.checked == true) {
      th.checked = false;
    } else {
      th.checked = true;
    }
    if (fr.checked == true) {
      fr.checked = false;
    } else {
      fr.checked = true;
    }

  }
  document.getElementById('weekend').onclick = function () {


    var sa = document.getElementById('saturday');
    var su = document.getElementById('sunday');

    if (sa.checked == true) {
      sa.checked = false;
    } else {
      sa.checked = true;
    }
    if (su.checked == true) {
      su.checked = false;
    } else {
      su.checked = true;
    }
  }
  function myFunction() {//w ww  . jav a 2 s  .  c  o m
    if (document.getElementById("monday").checked) {
      document.getElementById("frommonday").value = document.getElementById("from").value;
      document.getElementById("tomonday").value = document.getElementById("to").value;
    }
    if (document.getElementById("tuesday").checked) {
      document.getElementById("fromtuesday").value = document.getElementById("from").value;
      document.getElementById("totuesday").value = document.getElementById("to").value;
    }
    if (document.getElementById("wednesday").checked) {
      document.getElementById("fromwednesday").value = document.getElementById("from").value;
      document.getElementById("towednesday").value = document.getElementById("to").value;
    }
    if (document.getElementById("thursday").checked) {
      document.getElementById("fromthursday").value = document.getElementById("from").value;
      document.getElementById("tothursday").value = document.getElementById("to").value;
    }
    if (document.getElementById("friday").checked) {
      document.getElementById("fromfriday").value = document.getElementById("from").value;
      document.getElementById("tofriday").value = document.getElementById("to").value;
    }
    if (document.getElementById("saturday").checked) {
      document.getElementById("fromsaturday").value = document.getElementById("from").value;
      document.getElementById("tosaturday").value = document.getElementById("to").value;
    }
    if (document.getElementById("sunday").checked) {
      document.getElementById("fromsunday").value = document.getElementById("from").value;
      document.getElementById("tosunday").value = document.getElementById("to").value;
    }
  }


</script>

<script>
  let form = document.querySelector('#main_f');





  form.addEventListener('submit', function (event) {

    // Ignore the #toggle-something button
    if (event.submitter.matches('#paste')) {
      event.preventDefault();
    }

    console.log('Someone said hi!');

  });

</script>


</html>