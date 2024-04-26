<?php
/** This files creates objects in which admin can create object */


/** code for session */
/**tree source https://codepen.io/philippkuehn/pen/QbrOaN */
session_start();

if (isset($_SESSION["user2_id"])) {

  $mysqli = require ("../database.php");


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
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/main_page.css">
  <link rel="stylesheet" href="../css/tree.css">
  <link rel="stylesheet" href="../css/success.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
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
          <div class="logo"><a
              style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;display:inline; width: 100px"
              href="../main/admin_main_page.php">Home :
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
                    <li><a href="../log/signup.php">ADD TO SYSTEM</a></li>
                    <li><a href="../search/list_of_employees.php">LIST</a></li>
                    <li><a href="../log/change_user_data.php">CHANGE DATA</a></li>
                    <li><a href="../rights_assignments/rights.php">RIGTHS & ASSIGNMENT</a></li>
                  </div>
                </ul>

              </li>
              <li>
                <a href="#">DATABASE</a>
                <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                <ul class="htmlCss-sub-menu sub-menu" style="padding-left: 0px;">
                  <li><a href="../objects/create_object.php">CREATE OBJECT</a></li>
                  <li><a href="../shifts/create_shift.php">CREATE SHIFT</a></li>
                  <li><a href="../calendar/calendar.php">CURRENT SCHEDULE</a></li>
                  <li class="more">
                    <span><a href="#">More</a>
                      <i class='bx bxs-chevron-right arrow more-arrow'></i>
                    </span>
                    <ul class="more-sub-menu sub-menu" style="padding-left: 0px;">
                      <li><a href="#"></a></li>
                      <li><a href="../board/information_board.php">INFO BOARD</a></li>
                      <li><a href="../ip/adding_device.php">ADD DEVICE</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#">OTHERS</a>
                <i class='bx bxs-chevron-down js-arrow arrow '></i>
                <ul class="js-sub-menu sub-menu" style="padding-left: 0px;">
                  <li><a href="../shifts/my_shifts.php">MY SHIFTS</a></li>
                  <li><a href="../log/change_my_password.php">CHANGE PASSWORD</a></li>
                  <li><a href="../options/permanent_time_options.php">TIME OPTIONS</a></li>
                </ul>
              </li>
              <li><a href="../statistics/all_stats.php">STATISTICS</a></li>
              <li><a href="../log/logout.php" style="color :#b2d2f2;">LOG OUT</a></li>
            </ul>
          </div>

          <div class="search-box">
            <i class='bx bx-search'></i>
            <div class="input-box">
              <input type="text" placeholder="Search...">
              <br>
              <br>
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <p>123456789</p>

                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </nav>
      <script src="../js/main_page.js"></script>

      <!--end of the navbar -->
      <br>
      <br>
      <br>

      
        <h1>List of objects</h1>
      
      <div class="cont">
        <div class="row">
          <div class='col-12 col-md-6'>
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
                  $mysqli = require ("../database.php");



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


              <div class="popup">
                <input id="savemain" type="button" onclick="submit_table()" class="btn btn-primary" style="display:inline"
                  value="Create object">


              </div>
              <br>
              <label id="label1" style="visibility:hidden;color:red">Needs to be filled *</label>
              <br>

              <br>

              <?php

              $mysqli2 = require ("../database.php");

              $sql2 = " SELECT * FROM list_of_objects ORDER BY id_object ASC";
              $result2 = $mysqli2->query($sql2);
              $result3 = $mysqli2->query($sql2);
              ?>

              <!-- source display z datatbaze: https://www.geeksforgeeks.org/how-to-fetch-data-from-localserver-database-and-display-on-html-table-using-php/ -->

              <br>
          </div>
          <div class='col-12 col-md-6'>
            <h2>Create new sub object: </h2>
            <input id="new_sub_object" name="new_sub_object" style="display:inline" type="text">

            <input id="savesub" type="button" onclick="submit_subtable()" class="btn btn-primary" style="display:inline"
              value="Create sub-object">
            <br>
            <label id="label2" style="visibility:hidden;color:red"></label>

            <br>



          </div>
        </div>
        <button id="butsave"></button>

        <div class="tree">
          <div id="res">

            <script>

              var input = 0;
              var ChA = JSON.parse(input);
              $.ajax({
                url: "../objects/load_object3.php",
                method: "POST",
                data: { input: ChA },
                success: function (data) {
                  $("#res").html(data);
                }
              });




            </script>


          </div>


        </div>
      </div>


      <script>
        var ff;
        var previous;
        function Helal(clicked) {
          let vjvj = document.getElementById(clicked);
          ff = clicked.substring(3);
          if (previous != ff) {
            vjvj.style.backgroundColor = '#4CAF50';
            vjvj.style.color = '#fff';
            vjvj.style.border = "solid #4CAF50";

            if (previous != "0" && previous != null) {

              var kka = "box" + previous;
              let ffa = document.getElementById(kka);
              ffa.style.color = '';
              ffa.style.backgroundColor = '';
              ffa.style.border = "";
            }
            previous = ff;

          } else {
            vjvj.style.color = '';
            vjvj.style.backgroundColor = '';
            vjvj.style.border = "";

            previous = 0;
          }
        }

        $("#savemain").click(function () {
          $(".check-icon").hide();
          setTimeout(function () {
            $(".check-icon").show();
          }, 10);
        });



        $("#savemain").click(function () {

          let g = document.getElementById("new_object").value;
          if (g == "") {
            var popup = document.getElementById("label1");
            popup.style.visibility = "visible";
          } else {
            $.ajax({
              url: "../objects/insert-object.php",
              method: "POST",
              data: { input: g },
              success: function (data) {

              }
            });


            var newa = document.getElementById("res");
            newa.value = "";
            var input4 = 0;
            document.getElementById("new_object").value = "";
            var ChA = JSON.parse(input4);
            $.ajax({
              url: "../objects/load_object3.php",
              method: "POST",
              data: { input: ChA },
              success: function (data) {
                $("#res").html(data);
                alert("New object is saved");
              }
            });
            var popup = document.getElementById("label1");
            popup.style.visibility = "hidden";
          }


        });

        function submit_subtable() {
          let q = document.getElementById("new_sub_object").value;
          if (q == "") {
            var popup = document.getElementById("label2");
            popup.style.visibility = "visible";
            popup.innerText = "Needs to be filled *";
          } else {
            if (previous != "0" && previous != null) {
              var popup = document.getElementById("label2");
              popup.style.visibility = "hidden";
              var bb = "box" + previous;
              var hh = "hid" + previous;
              var pj = document.getElementById(bb).value;
              var jj = document.getElementById(hh).value;
              $.ajax({
                url: "../objects/insert-sub_object.php",
                method: "POST",
                data: { name: q, sup: pj, id: jj },
                success: function (data) {

                }
              });
              document.getElementById("new_sub_object").value = "";

              var newa = document.getElementById("res");
              newa.value = "";
              var input4 = 0;
              document.getElementById("new_object").value = "";
              var ChA = JSON.parse(input4);
              $.ajax({
                url: "../objects/load_object3.php",
                method: "POST",
                data: { input: ChA },
                success: function (data) {
                  $("#res").html(data);
                  alert("New sub-object is saved");
                }
              });
            } else {
              var popup = document.getElementById("label2");
              popup.style.visibility = "visible";
              popup.innerText = "Sub object needs to be selected*";
            }

          }
        }



      </script>





      <br>
      <br>
      <div class="tree">

      </div>
    </div>


    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

  <?php else: ?>
    <br> USER IS NOT SET <BR>
  <?php endif; ?>

</body>


</html>