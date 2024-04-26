<?php

session_start();

if (isset($_SESSION["user2_id"])) {

  $mysqli = require("../database.php");


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

      <nav>

        <div class="navbar container">

          <i class='bx bx-menu'></i>
          <div class="logo"><a href="../main/admin_main_page.php" style="padding-left: 0px;">Home :
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
                    <li><a href="#">CHANGE DATA</a></li>
                    <li><a href="../rigths_assignments/rights.php">RIGTHS & ASSIGNMENT</a></li>
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
              <li><a href="../log/logout.php" style="color :#b2d2f2;">LOG OUT</a></li>
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
        <form id="form1" name="form1" method="post" >

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

          var result_arr = new Array();
          var from_result_arr = new Array();
          var to_result_arr = new Array();
          var total_lenght = 0;
          var is_empty = 0;
          var text_return;
          for (let i = 1; i <= lastDateofMonth; i++) {

            if (i == 1) {
              $.ajax({
                type: "POST",
                url: "../options/load_time_options.php",
                dataType: "json",
                cache: false,
                async: false,
                data: {
                  month: currMonthNull, year: currYear, id: usid
                },
                success: function (data) {
                  text_return = JSON.stringify(data);
                  alert(text_return);
                }

              });
              text_return = text_return.substring(1, text_return.length - 1);
              result_arr = text_return.split(",");
              alert(result_arr.length);
              for (var ff = 0; ff < result_arr.length; ff++) {
                //alert(result_arr[ff] + "---"+ ff);
                result_arr[ff] = result_arr[ff].substring(1, result_arr[ff].length - 1);
                if (result_arr[ff] == "empty") {
                  from_result_arr[ff] = "";
                  to_result_arr[ff] = "";
                } else {
                  from_result_arr[ff] = result_arr[ff].substring(0, 5);
                  to_result_arr[ff] = result_arr[ff].substring(10, 15);
                }

              }
              


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

            }
            if (i < 10) {
              var ii = "0" + i;
            } else {
              var ii = i;
            }
            plan = '<div class="form-group"><input id="fr' + ii + '" class="form-control" style="text-align: center;margin-top:10px;margin-left:10px;height:50px;width:100px;font-size:15px" type="time" value="' + from_result_arr[i - 1] + '"><div class="form-group"><input id="to' + ii + '" class="form-control" style="text-align: center;margin-left:10px;height:50px;width:100px;font-size:15px" type="time" value="' + to_result_arr[i - 1] + '"></div></div><button type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-bottom:10px;margin-left:10px;width: 25px;height: 25px;padding:0px;float:left" title="Copy" onClick="copy_cell(this.id)" id="co' + ii + '">c<button><button type="button" class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-bottom:10px;margin-left:50px;width: 25px;height: 25px;padding:0px;float:left" title="Paste" onClick="paste_cell(this.id)" id="pa' + ii + '">P<button>';

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
        var from_paste = "";
        var to_paste = "";
        function copy_cell(copy_id) {
          copy_id = copy_id.substring(2);

          from_paste = document.getElementById("fr" + copy_id).value;
          to_paste = document.getElementById("to" + copy_id).value;


        }
        function paste_cell(paste_id) {

          paste_id = paste_id.substring(2);

          if (from_paste != "") {
            document.getElementById("fr" + paste_id).value = from_paste;
            document.getElementById("to" + paste_id).value = to_paste
          }
        }



        $("#butsave").click(function () {

          var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
          var from = new Array();
          var to = new Array();
          var date = new Array();
          for (var i = 1; i <= 31; i++) {


            if (i < 10) {
              var q = "0" + i;
            } else {
              var q = i;
            }

            var kla = "fr";
            let ml = kla + q;
            var myElem = document.getElementById(ml);
            if (myElem != null) {

              to.push($("#to" + q).val());
              from.push($("#fr" + q).val());
              var ym = $("#current_load_date").val();
              let h = ym + "-" + q;
              date.push(h);
            }


          }
          var fromTime = JSON.stringify(from);
          var toTime = JSON.stringify(to);

          var dateArr = JSON.stringify(date);

          var year_month = $("#current_load_date").val();
          $.ajax({
            url: "../options/insert_time_options.php",
            type: "post",
            data: { from: fromTime, to: toTime, dateym: year_month, date: dateArr, id: usid },
            success: function (data) {
              alert(data); /* alerts the response from php.*/
            }
          });
        });




      </script>





    <?php else: ?>
    <?php endif; ?>








</body>

</html>