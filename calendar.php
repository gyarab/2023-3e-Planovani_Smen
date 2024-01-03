<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<!-- source  https://www.codingnepalweb.com/dynamic-calendar-html-css-javascript/ -->
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Dynamic Calendar JavaScript | CodingNepal</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google Font Link for Icons -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <!--<link rel="stylesheet" href="css/calendar.css">-->
  <!--<script src="js/calendar.js" defer></script>-->
  <style>
    table,
    th,
    td {
      border: 1px solid black;
    }

    /* td:nth-child(even) {
  background-color: #D6EEEE;
}*/

    .hoverTable {
      width: 100%;
      border-collapse: collapse;
    }

    .hoverTable td {
      padding: 7px;
      border: #4e95f4 1px solid;
    }

    /* Define the default color for all the table rows */
    .hoverTable tr {
      background: #b8d1f3;
    }

    /* Define the hover highlight color for the table row */
    tr:hover {
      background-color: #e8e8e8;
    }
  </style>



</head>

<body>
  <div class="wrapper">
    <header>
      <p class="current-date"></p>
      <div class="icons">
        <span id="prev" class="material-symbols-rounded">chevron_left</span>
        <span id="next" class="material-symbols-rounded">chevron_right</span>
      </div>
    </header>
    <div class="calendar">
      <table>
        <tr>




        </tr>

        <table class="days" style="border-collapse:collapse;">
          <div class="hoverTable">
            <tr>




            </tr>
            <!--<ul class="weeks">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>-->

          </div>
        </table>

      </table>

      <table class="hoverTable">
        <tr>
          <th>hjkads</th>
          <th>hjkdasa</th>
        </tr>
        <tr>
          <td>
            das
          </td>
          <td>
            jkhacfshjkfasjkh
          </td>
        </tr>
        <tr>
          <th>hjkads</th>
          <th>hjkdasa</th>
        </tr>
      </table>
      <table id="TVTVT">
        <tr>
          <th id="x0-0">0-0</th>
          <th id="x0-1">0-1</th>
          <th id="x0-2">0-2</th>
        </tr>
        <tr>
          <td id="x1-0">1-0</td>
          <td id="x1-1">1-1</td>
          <td id="x1-2">1-2</td>
        </tr>
        <tr>
          <td id="x2-0">2-0</td>
          <td id="x2-1">2-1</td>
          <td id="x2-2">2-2</td>
        </tr>
      </table>
      <br>

      <button onclick="FFF()">Try it</button>
      <br>
      <label id="labelWithHTML">Initial Text</label>
      <?php echo ($_POST['1-0']) ?>
      <ul class="days"></ul>
    </div>
  </div>
  <script>

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
    // storing full name of all months in array
    const months = ["January", "February", "March", "April", "May", "June", "July",
      "August", "September", "October", "November", "December"];
    const months2 = [".1", ".2", ".3", ".4", ".5", ".6", ".7",
      ".8", ".9", ".10", ".11", ".12"];
    const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const renderCalendar = () => {
      let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
      let liTag = "";
      //const f = new Date(currYear, currMonth, 1);
      /*for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
          liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
      }*/

      const fr = new Date(currYear, currMonth, 0);
      const f = new Date(currYear, currMonth, 0);
      const d = new Date();
      // liTag += `<tr><Day<tr>`;

      //    daysTag.innerHTML = liTag;
      // liTag += `<tr>New<tr>`;

      //daysTag.innerHTML = liTag;
      //let day = weekday[f.getDay()];

      for (let i = 1; i <= lastDateofMonth; i++) {
        if (i == 1) {
          <?php
          $mysqli_cal = require __DIR__ . "/database.php";
          $sql_cal = " SELECT * FROM create_shift ORDER BY id_shift ASC";
          $cols[] = array();
          $idc[] = array();
          $wdw[][] = array();
          $tish[][] = array();
          $result_cal = $mysqli_cal->query($sql_cal);
          $r = 0;
          while ($rows_cal = $result_cal->fetch_assoc()) {
            $idc[$r] = $rows_cal['id_shift'];
            $cols[$r] = $rows_cal['shift_name'];
            $wdw[0][$r] = $rows_cal['monday'];
            $wdw[1][$r] = $rows_cal['tuesday'];
            $wdw[2][$r] = $rows_cal['wednesday'];
            $wdw[3][$r] = $rows_cal['thursday'];
            $wdw[4][$r] = $rows_cal['friday'];
            $wdw[5][$r] = $rows_cal['saturday'];
            $wdw[6][$r] = $rows_cal['sunday'];



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


          $number = count($cols);
          $col_code = "<th id='00-000'>Date</th>";
          for ($i = 0; $i < $number; $i++) {
            $new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
            //$amsda = '" ';
            //prependZero(
            $lp = $i + 1;

            if ($l < 10) {
              $l = "0" + "0" + $l;
            } else if ($l < 100) {
              $l = "0" + $l;
            }


            $col_code = $col_code . "<th id='00-" . $lp . "'>" . $cols[$i] . "</th>";
            /*echo $students[$i];
            echo "<br>";*/
          }

          $final_col_code = "<table><tr>" . $col_code . "</tr><table>";
          //$final_col_code = ""
          $mysqli_cal->close();
          ?>
          let tet = "<?php echo "$final_col_code"; ?>"
          //let tet = "<tr><th>Day</th><th>Day</th></tr>";
          liTag += `${tet}`;
          //liTag += `<tr><th>Day</th><th>Day</th><tr>`;
          //liTag += `<tr>New<tr>`;
        } // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let find = 0;
        let isToday = i === date.getDate() && currMonth === new Date().getMonth()
          && currYear === new Date().getFullYear() ? "active" : "";
        //fr.setDate(date.getDate() + 1);
        /**source - https://stackoverflow.com/questions/966225/how-can-i-create-a-two-dimensional-array-in-javascript */
        fr.setDate(fr.getDate() + 1);
        f.setDate(f.getDate() + 1)
        let day = weekday[fr.getDay()];
        const m = fr.getMonth();
        //const d = fr.getDay();
        //alert(i);

        for (let e = 0; e < items.length; e++) {

          if (m == items[e][0] && i == items[e][1]) {
            find = 1;
            break;
          }
          //alert (passedArray);

        }
        /** source https://www.geeksforgeeks.org/how-to-pass-a-php-array-to-a-javascript-function/ */
        var passedArray =
          <?php echo json_encode($wdw); ?>;
        var passedTime =
          <?php echo json_encode($tish); ?>;

        /** source https://www.geeksforgeeks.org/how-to-pass-variables-and-data-from-php-to-javascript/ */
        var sz = "<?php echo "$number" ?>";
        let dts = "";
        //let ppp = "<td></td>";
        let ppp = '<div><td>';
        let ddd = '<div><td id="';
        let xxx = "-"
        let jjj = '">';
        let qqq = "</td></div>";
        let ttt = "<button>+</button>";
        let mmm = '<button onClick="reply_click(this.id)" id="b';
        let nnn = '">+</button>';
        let bbb = "<br>";
        let ia = '<input type="time" value="';
        let ib = '">';
        let t1 = '<input type="time" id="tf'
        let t2 = '<input type="time" id="tt'
        let tv = '" value="';
        let s = "background-color:#585858;color:white;";
        let ii = "";
        //let qqqas = prependZero(r);
        if (day == "Monday") {
          s = "background-color:#303030; color:white;";
          for (let q = 0; q < sz; q++) {
            if (passedArray[0][q] == 1) {
              let str1 = passedTime[0][q];
              str1 = str1.substring(0, str1.length - 3);
              let str2 = passedTime[1][q];
              str2 = str2.substring(0, str2.length - 3);
              //dts = dts.concat(ppp,ia,str1,ib, bbb,ia, str2,ib, qqq);
              let p = q + 1;
              if (p < 10) {
                p = "0" +"0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //let pp = prependZero(p);
              //ii = prependZero(i);
              dts = dts.concat(ddd, ii, xxx, p, jjj, t1,ii,xxx,p, tv, str1, ib, bbb, t2,ii,xxx,p, tv, str2, ib, qqq);
            } else {
              let p = q + 1;
              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              if (p < 10) {
                p ="0" + "0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }
              dts = dts.concat(ddd, ii, xxx, p, jjj, mmm, ii, xxx, p, nnn, qqq);
            }
          }
        } else if (day == "Tuesday") {
          s = "background-color:#585858; color:white;";
          for (let q = 0; q < sz; q++) {
            if (passedArray[1][q] == 1) {
              let str1 = passedTime[2][q];
              str1 = str1.substring(0, str1.length - 3);
              let str2 = passedTime[3][q];
              str2 = str2.substring(0, str2.length - 3);
              //  dts = dts.concat(ppp, str1, bbb, str2, qqq);
              //  dts = dts.concat(ppp,ia,str1,ib, bbb,ia, str2,ib, qqq);  
              let p = q + 1;
              if (p < 10) {
                p ="0" + "0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //dts = dts.concat(ddd, ii, xxx, p, jjj, ia, str1, ib, bbb, ia, str2, ib, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, t1,ii,xxx,p, tv, str1, ib, bbb, t2,ii,xxx,p, tv, str2, ib, qqq);
            } else {
              let p = q + 1;
              if (p < 10) {
                p ="0" + "0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii =  "0" + i;
              } else {
                ii = i;
              }
              //  dts = dts.concat(ddd,i,xxx,p,jjj, ttt, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, mmm, ii, xxx, p, nnn, qqq);
            }
          }
        } else if (day == "Wednesday") {
          s = "background-color:#303030; color:white;";
          for (let q = 0; q < sz; q++) {
            if (passedArray[2][q] == 1) {
              let str1 = passedTime[4][q];
              str1 = str1.substring(0, str1.length - 3);
              let str2 = passedTime[5][q];
              str2 = str2.substring(0, str2.length - 3);
              //  dts = dts.concat(ppp, str1, bbb, str2, qqq);
              // dts = dts.concat(ppp,ia,str1,ib, bbb,ia, str2,ib, qqq); 
              let p = q + 1;
              if (p < 10) {
                p ="0" + "0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //dts = dts.concat(ddd, ii, xxx, p, jjj, ia, str1, ib, bbb, ia, str2, ib, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, t1,ii,xxx,p, tv, str1, ib, bbb, t2,ii,xxx,p, tv, str2, ib, qqq);
            } else {
              let p = q + 1;
              if (p < 10) {
                p ="0" + "0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //  dts = dts.concat(ddd,i,xxx,p,jjj, ttt, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, mmm, ii, xxx, p, nnn, qqq);
            }
          }
        } else if (day == "Thursday") {
          s = "background-color:#585858; color:white;";
          for (let q = 0; q < sz; q++) {
            if (passedArray[3][q] == 1) {
              let str1 = passedTime[6][q];
              str1 = str1.substring(0, str1.length - 3);
              let str2 = passedTime[7][q];
              str2 = str2.substring(0, str2.length - 3);
              //  dts = dts.concat(ppp, str1, bbb, str2, qqq);
              //  dts = dts.concat(ppp,ia,str1,ib, bbb,ia, str2,ib, qqq);
              let p = q + 1;
              if (p < 10) {
                p ="0" + "0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //dts = dts.concat(ddd, ii, xxx, p, jjj, ia, str1, ib, bbb, ia, str2, ib, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, t1,ii,xxx,p, tv, str1, ib, bbb, t2,ii,xxx,p, tv, str2, ib, qqq);
            } else {
              let p = q + 1;
              if (p < 10) {
                p = "0" +"0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //  dts = dts.concat(ddd,i,xxx,p,jjj, ttt, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, mmm, ii, xxx, p, nnn, qqq);
            }
          }
        } else if (day == "Friday") {
          s = "background-color:#303030; color:white;";
          for (let q = 0; q < sz; q++) {
            if (passedArray[4][q] == 1) {
              let str1 = passedTime[8][q];
              str1 = str1.substring(0, str1.length - 3);
              let str2 = passedTime[9][q];
              str2 = str2.substring(0, str2.length - 3);
              // dts = dts.concat(ppp, str1, bbb, str2, qqq);
              // dts = dts.concat(ppp,ia,str1,ib, bbb,ia, str2,ib, qqq);
              let p = q + 1;
              if (p < 10) {
                p ="0" + "0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //dts = dts.concat(ddd, ii, xxx, p, jjj, ia, str1, ib, bbb, ia, str2, ib, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, t1,ii,xxx,p, tv, str1, ib, bbb, t2,ii,xxx,p, tv, str2, ib, qqq);
            } else {
              let p = q + 1;
              if (p < 10) {
                p = "0" +"0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {

                ii = i;
              }
              //  dts = dts.concat(ddd,i,xxx,p,jjj, ttt, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, mmm, ii, xxx, p, nnn, qqq);
            }
          }
        } else if (day == "Saturday") {
          s = "background-color:#585858; color:white;";
          for (let q = 0; q < sz; q++) {
            if (passedArray[5][q] == 1) {
              let str1 = passedTime[10][q];
              str1 = str1.substring(0, str1.length - 3);
              let str2 = passedTime[11][q];
              str2 = str2.substring(0, str2.length - 3);
              //dts = dts.concat(ppp, str1, bbb, str2, qqq);
              //dts = dts.concat(ppp,ia,str1,ib, bbb,ia, str2,ib, qqq);
              let p = q + 1;
              if (p < 10) {
                p = "0" +"0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //dts = dts.concat(ddd, ii, xxx, p, jjj, ia, str1, ib, bbb, ia, str2, ib, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, t1,ii,xxx,p, tv, str1, ib, bbb, t2,ii,xxx,p, tv, str2, ib, qqq);
            } else {
              let p = q + 1;
              if (p < 10) {
                p = "0" +"0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //   dts = dts.concat(ddd,i,xxx,p,jjj, ttt, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, mmm, ii, xxx, p, nnn, qqq);
            }
          }
        } else if (day == "Sunday") {
          s = "background-color:#303030; color:white;";
          for (let q = 0; q < sz; q++) {
            if (passedArray[6][q] == 1) {
              let str1 = passedTime[12][q];
              str1 = str1.substring(0, str1.length - 3);
              let str2 = passedTime[13][q];
              str2 = str2.substring(0, str2.length - 3);
              //    dts = dts.concat(ppp, str1, bbb, str2, qqq);
              //dts = dts.concat(ppp,ia,str1,ib, bbb,ia, str2,ib, qqq);    
              let p = q + 1;
              if (p < 10) {
                p = "0" +"0" + p;
              } else if (p < 100) {
                p = "0" + p;
              }

              if (i < 10) {
                ii = "0" + i;
              } else {
                ii = i;
              }
              //dts = dts.concat(ddd, ii, xxx, p, jjj, ia, str1, ib, bbb, ia, str2, ib, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, t1,ii,xxx,p, tv, str1, ib, bbb, t2,ii,xxx,p, tv, str2, ib, qqq);
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
              // dts = dts.concat(ddd,i,xxx,p,jjj, ttt, qqq);
              dts = dts.concat(ddd, ii, xxx, p, jjj, mmm, ii, xxx, p, nnn, qqq);
            }
          }
        }
        /*if(day == "Monday"){
          let s = "background-color:#585858; color:white;";
        }else{
        let s = "background-color:#585858; color:white;";
        }*/
        //let s = "background-color:#585858;color:white;";
        let nul = 0;
        if (find == 1) {

          //var dy = "<tr><td class="${isToday}">${i} ${months2[currMonth]} ${day} - Holiday </td><tr>";
          /*let s = "background-color:#303030; color:white;";
          if(day =="Monday"){

          }*/
          // let s = "background-color:#303030; color:white;";

          liTag += `<tr><td id="${i}-000" class="${isToday}" style="${s}">${i} ${months2[currMonth]} <br> ${day} - Holiday </td>${dts}<tr>`;
          <?php echo $dsa = ""; ?>
        } else {
          <?php echo $dsa = ""; ?>
          liTag += `<tr><td id="${i}-000" class="${isToday}" style="${s}">${i} ${months2[currMonth]} <br> ${day}</td>${dts}<tr>`;


          <?php echo $dsa = ""; ?>
        }
        <?php echo $dsa = ""; ?>
        if (day == "Sunday" && day != 31) {
          let tet = "<?php echo "$final_col_code"; ?>";
          liTag += `${tet}`;
          daysTag.innerHTML = liTag;
        }

      }
      /*for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
          liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
      }*/
      console.log("Hello");
      console.log(passedArray);
      <?php $dsa = ""; ?>
      currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
      daysTag.innerHTML = liTag;

    }
    //alert (passedArray);
    renderCalendar();
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
    alert(passedArray);
  </script>
  <script>
    function FFF() {
      //let ch = document.getElementById("TVTVT").rows[1].cells[0].innerHTML;
      // let qqqas = "";
      let r = 10;
      let nulls = 0;
      /*if(r <10){
        qqqas = qqqas.concat(nulls.r);
      }*/
      //let qqqas = prependZero(r);
      if (r < 10) {
        r = "0" + r;
      }
      let labelElement = document
        .getElementById("labelWithHTML");

      /* labelElement.innerHTML =
           "<em>New Text</em> using <strong>innerHTML</strong>";*/
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
      let val = "00:00";
      let brr = "<br>";
      let tm1 = '<input type="time" id="tf';
      let tmv = '" value="';
      let tmc = '">';
     // cha.innerHTML = "<input type='time' value=''><br><input type='time' value=''>";
      final =tm1 +result123+tmv+val+tmc+brr+tm1 +result123+tmv+val+tmc;
      cha.innerHTML = final;
    }
  </script>

</body>

</html>
<?php
function try1($number)
{
  $tt = "";
  for ($i = 0; $i < $number; $i++) {
    $tt = $tt . "<td>X</td>";
  }
  return $tt;
}
function try2($number)
{
  $tt = "";
  for ($i = 0; $i < $number; $i++) {
    $tt = $tt . "<td>X</td>";
  }
  return $tt;
}
?>