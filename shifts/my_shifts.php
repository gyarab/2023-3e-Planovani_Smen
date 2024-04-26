<?php

session_start();

if (isset($_SESSION["user_id"])) {

  $mysqli = require ("../database.php");

  $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
  $sqlp = "SELECT position, id FROM user WHERE id = {$_SESSION["user_id"]}";
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
  <link rel="stylesheet" href="../css/main_page.css">
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
  </style>
</head>

<body>
  <?php if (isset($user)): ?>
    <?php
    $today = date("Y-m-d");

    ?>
    <script>
      var usid = <?php echo json_encode($userid); ?>;
    </script>
    <div class="container">

    <?php if ($userp == "admin") { ?>
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
            <?php } else if ($userp == "manager") { ?>
                    <nav>

                        <div class="navbar container">

                            <i class='bx bx-menu'></i>
                            <div class="logo"><a
                                    style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;display:inline; width: 100px"
                                    href="../main/manager_main_page.php">Home :
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
                                                <li><a href="../search/list_of_employees.php">LIST</a></li>
                                                <li><a href="../rights_assignments/rights.php">RIGTHS & ASSIGNMENT</a></li>
                                            </div>
                                        </ul>

                                    </li>
                                    <li>
                                        <a href="#">CALENDAR</a>
                                        <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                                        <ul class="htmlCss-sub-menu sub-menu" style="padding-left: 0px;">
                                            <li><a href="../calendar/calendar.php">CURRENT SCHEDULE</a></li>
                                            <li><a href="../options/permanent_time_options.php">TIME OPTIONS</a></li>

                                            <li class="more">
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">OTHERS</a>
                                        <i class='bx bxs-chevron-down js-arrow arrow '></i>
                                        <ul class="js-sub-menu sub-menu" style="padding-left: 0px;">
                                            <li><a href="../board/information_board.php">INFO BOARD</a></li>
                                            <li><a href="../shifts/my_shifts.php">MY SHIFTS</a></li>
                                            <li><a href="../log/change_my_password.php">CHANGE PASSWORD</a></li>
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
            <?php } else { ?>
                    <nav>

                        <div class="navbar container">

                            <i class='bx bx-menu'></i>
                            <div class="logo"><a
                                    style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;display:inline; width: 100px"
                                    href="../main/employee_main_page.php">Home :
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

                                                <li><a
                                                        href="../search/list_of_employees.php">LIST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                </li>


                                            </div>
                                        </ul>

                                    </li>
                                    <li>
                                        <a href="#">CALENDAR</a>
                                        <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                                        <ul class="htmlCss-sub-menu sub-menu" style="padding-left: 0px;">
                                            <li><a href="../calendar/calendar_view.php">CURRENT SCHEDULE</a></li>
                                        <?php if ($userp == "parttime_employee") { ?>
                                                <li><a href="../options/time_options.php">TIME OPTIONS</a></li>
                                        <?php } else if ($userp == "fulltime_employee") { ?>
                                                    <li><a href="../options/permanent_time_options_view.php">TIME OPTIONS</a></li>
                                        <?php } ?>
                                            <li class="more">
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">OTHERS</a>
                                        <i class='bx bxs-chevron-down js-arrow arrow '></i>
                                        <ul class="js-sub-menu sub-menu" style="padding-left: 0px;">
                                            <li><a href="../shifts/my_shifts.php">MY SHIFTS</a></li>
                                            <li><a href="../log/change_my_password.php">CHANGE PASSWORD</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="../statistics/my_stats.php">STATISTICS</a></li>
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
                <?php
                }
                ?>
      <script src="../js/main_page.js"></script>
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

            <div class="icons">
              <span id="prev" class="material-symbols-rounded" style="float:left"><i
                  class="bi bi-arrow-left-circle h2"></i></span>
              <h2 style="display:inline;float:left">&nbsp;&nbsp;Previous month</h2>
              <span id="next" class="material-symbols-rounded" style="float:right"><i
                  class="bi bi-arrow-right-circle h2"></i></span>
              <h2 style="display:inline;float:right">Next month&nbsp;&nbsp;</h2>
            </div>
            <script>


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
            <input type="text" id="live_search" style="float: left; font-size: 16px" autocomplete="off"
              placeholder="Search...">

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
              <div id="livesearch"></div>
            </form>

          </div>
        </div>



      </div>



      <br>
      <br>
      <br>



      <script>

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



        renderCalendar();
        function renderCalendar() {


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

          var result_arr = [];
          var total_lenght = 0;
          var is_empty = 0;
          for (let i = 1; i <= lastDateofMonth; i++) {

            if (i == 1) {
              var arr_return = new Array;
              $.ajax({
                type: "POST",
                url: "../shifts/get_my_shifts.php",
                dataType: "json",
                cache: false,
                async: false,
                data: {
                  month: currMonthNull, year: currYear, id: usid
                },
                success: function (data) {
                  text_return = JSON.stringify(data);
                  alert(JSON.stringify(data));
                }

              });
              var middle_arr = new Array();
              var finished_arr = new Array();
              text_return = text_return.substring(1, text_return.length - 1);
              if (text_return.substring(2, text_return.length - 2) == "") {
                is_empty = 1;

              }
              middle_arr = text_return.split("]");

              total_lenght = middle_arr.length;
              for (let jh = 0; jh < middle_arr.length; jh++) {
                finished_arr = [];
                if (jh == 0) {
                  middle_arr[jh] = middle_arr[jh].substring(1);
                } else {
                  middle_arr[jh] = middle_arr[jh].substring(2);
                }
                result_arr[jh] = [];
                finished_arr = middle_arr[jh].split(",");
                for (let j = 0; j < 12; j++) {
                  var xs = finished_arr[j];

                  result_arr[jh][j] = xs;

                }
              }
              let ch = result_arr[0][0];




              var col_code_obj = "<tr><th id='00-000' rowspan='1' style='width: 100px'>Date</th><th style='width: 100%'></th></tr>";

              let final_col_code_obj = col_code_obj;

              tet;


              liTag += `${final_col_code_obj}`;


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
            let save_string;



            /** source https://www.geeksforgeeks.org/how-to-pass-a-php-array-to-a-javascript-function/ */
            let plan = "";
            if (is_empty == 0) {
              for (let e = 0; e < total_lenght; e++) {
                if (i == result_arr[e][0]) {
                  //alert("true" + i);
                  var color = result_arr[e][7];
                  var object = result_arr[e][3];
                  var name = result_arr[e][2];
                  var log_from = result_arr[e][8];
                  var log_to = result_arr[e][9];
                  var pla_from = result_arr[e][5];
                  var pla_to = result_arr[e][6];
                  var com = result_arr[e][4];
                  var com_from = result_arr[e][10];
                  var com_to = result_arr[e][11];
                  color = color.substring(1, color.length - 1);
                  name = name.substring(1, name.length - 1);
                  object = object.substring(1, object.length - 1);
                  log_from = log_from.substring(1, log_from.length - 4);
                  log_to = log_to.substring(1, log_to.length - 4);
                  pla_from = pla_from.substring(1, pla_from.length - 4);
                  pla_to = pla_to.substring(1, pla_to.length - 4);
                  com = com.substring(1, com.length - 1);
                  plan = plan + '<div class="row" style="width:100%;height:100%"><div class="col-12" style="width:100%;height:100%; margin:auto"><div class="p-3 mb-2 text-white" style="background-color:' + color + ';"><div class="row"><div class="col-16"><p style="font-size: 23px">' + object + ' - ' + name + '</p></div></div><div class="row"><div class="col-6"><p style="font-size: 15px">Planned from: ' + pla_from + '</p><p style="font-size: 15px">Planned to:      ' + pla_to + '</p><p style="font-size: 15px">Comment:      ' + com + '</p></div><div class="col-6"><p style="font-size: 15px">Loged from: ' + log_from + '</p><p style="font-size: 15px">Loged to: ' + log_to + '</p><p style="font-size: 15px">Log-in comment: ' + com_from + '</p><p style="font-size: 15px">Log-out comment: ' + com_to + '</p></div></div></div></div></div>';
                }
              }
            }


            let dts = "";


            if (day == "Monday") {
              s = "background-color:#303030; color:white;";
            } else if (day == "Tuesday") {
              s = "background-color:#585858; color:white;";
            } else if (day == "Wednesday") {
              s = "background-color:#303030; color:white;";
            } else if (day == "Thursday") {
              s = "background-color:#585858; color:white;";
            } else if (day == "Friday") {
              s = "background-color:#303030; color:white;";
            } else if (day == "Saturday") {
              s = "background-color:#585858; color:white;";
            } else if (day == "Sunday") {
              s = "background-color:#303030; color:white;";
            }


            if (i == 1) {
              liTag += `<br>`;
            }

            liTag += `<tr><td id="${i}-000" class="${isToday}" style="${s};font-size: 12px;height:100px;border: solid black">${i} ${months2[currMonth]} <br> ${day} </td>${dts}<td style='width: 100%'>${plan}</td><tr>`;



            if (day == "Sunday" && i != 31) {

            }

          }

          currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
          daysTag.innerHTML = liTag;
        }




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
            renderCalendar(); // calling renderCalendar function




          });
        });


        function isNumber(value) {
          return typeof value === 'number';
        }

      </script>





    <?php else: ?>
    <?php endif; ?>








</body>

</html>