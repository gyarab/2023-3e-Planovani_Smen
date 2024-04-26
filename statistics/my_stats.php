<?php

/**main page of admin account */

/**opening add picking data from database database */
$cons = "";
session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require ('../database.php');

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
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin home page </title>
    <link rel="stylesheet" href="../css/main_page.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/logout.css">
</head>

<body id="body" onload="startTime()">
    <?php if (isset($user) && ($userp == "parttime_employee" || $userp == "fulltime_employee")): ?>


        <!--start of navbar -->
        <!--source -  https://www.codingnepalweb.com/drop-down-navigation-bar-html-css/-->
        <div class="container">
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
            <script src="../js/main_page.js"></script>
            <br>
            <br>
            <br>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

            <br>
            <div class="container">


                <select id="month" name="month" style="margin-left:10px;float:right">
                    <option value="1">Jan</option>
                    <option value="2">Feb</option>
                    <option value="3">Mar</option>
                    <option value="4">Apr</option>
                    <option value="5">May</option>
                    <option value="6">Jun</option>
                    <option value="7">Jul</option>
                    <option value="8">Aug</option>
                    <option value="9">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
                <select id="year" style="float:right">
                </select>
                <br>
                <br>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


                <div class="card">
                    <div id="div_can" class="card-body">
                        <canvas id="chLine" style="width:100%;max-height: 600px"></canvas>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class='col-12 col-md-2'>
                        <p>Date</p>
                    </div>
                    <div class='col-12 col-md-3'>
                        <p>Scheduled</p>
                    </div>
                    <div class='col-12 col-md-2'>
                        <p>Scheduled rounded</p>
                    </div>
                    <div class='col-12 col-md-3'>
                        <p>Logged</p>
                    </div>
                    <div class='col-12 col-md-2'>
                        <p>Logged rounded</p>
                    </div>
                    <hr>
                </div>
                <div id="stat_table">
                </div>
                <hr style="height: 3px;">
                <div class="row">
                    <div class='col-12 col-md-2'>
                        <strong>
                            <p>Total: </p>
                        </strong>
                    </div>
                    <div class='col-12 col-md-3'>
                        <div style="display:inline">
                            <p id="st" style="display:inline">0</p>
                        </div>
                        <div style="display:inline">
                            <p id="st_hm" style="display:inline">-</p>
                        </div>
                    </div>
                    <div class='col-12 col-md-2'>
                        <div style="display:inline">
                            <p id="srt" style="display:inline">0</p>
                        </div>
                        <div style="display:inline">
                            <p id="srt_hm" style="display:inline">-</p>
                        </div>
                    </div>
                    <div class='col-12 col-md-3'>
                        <div style="display:inline">
                            <p id="lt" style="display:inline">0</p>
                        </div>
                        <div style="display:inline">
                            <p id="lt_hm" style="display:inline">-</p>
                        </div>
                    </div>
                    <div class='col-12 col-md-2'>
                        <div style="display:inline">
                            <p id="lrt" style="display:inline">0</p>
                        </div>
                        <div style="display:inline">
                            <p id="lrt_hm" style="display:inline">-</p>
                        </div>
                    </div>
                    <hr>
                </div>
                <br>
                <br>
                <div class="row">

                    <div class='col-12 col-md-6'>
                        <h5>Log times</h5>
                        <br>
                        <div class="row">
                            <div class='col-12 col-md-4'>
                                <h6>Date</h6>
                            </div>
                            <div class='col-12 col-md-4'>
                                <h6>From</h6>
                            </div>
                            <div class='col-12 col-md-4'>
                                <h6>To</h6>
                            </div>
                            <hr>
                            <br>
                        </div>
                        <div id="log_table">

                        </div>
                    </div>
                    <div class='col-12 col-md-6'>
                        <h5>Break times</h5>
                        <br>
                        <div class="row">
                            <div class='col-12 col-md-4'>
                                <h6>Date</h6>
                            </div>
                            <div class='col-12 col-md-4'>
                                <h6>From</h6>
                            </div>
                            <div class='col-12 col-md-4'>
                                <h6>To</h6>
                            </div>
                            <hr>
                            <br>
                        </div>
                        <div id="break_table">

                        </div>
                    </div>
                </div>

                <script>
                    var colors = ['#007bff', '#28a745', '#333333', '#c3e6cb', '#dc3545', '#6c757d'];



                    function daysInMonth(month, year) {
                        return new Date(year, month, 0).getDate();
                    }


                    const d = new Date();
                    let year = d.getFullYear();
                    let month = d.getMonth();
                    month = month + 1;
                    max_day = daysInMonth(month, year);
                    var xValues = new Array();
                    var yValues = new Array();
                    for (var x = 0; x < max_day; x++) {
                        xValues[x] = x + 1;
                    }

                    function load_char() {
                        var chLine = document.getElementById("chLine");
                        var chartData = {
                            labels: xValues,
                            datasets: [{
                                data: yValues,
                                backgroundColor: 'transparent',
                                borderColor: colors[0],
                                borderWidth: 4,
                                pointBackgroundColor: colors[0]
                            }
                            ]
                        };
                        if (chLine) {
                            new Chart(chLine, {
                                type: 'line',
                                data: chartData,
                                options: {
                                    scales: {
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: false
                                            }
                                        }],
                                        yAxes: [{ ticks: { min: 0, max: 25 } }],
                                    },
                                    legend: {
                                        display: false
                                    },
                                }
                            });
                        }
                    }


                </script>



                <script>
                    var sum_sch = 0;
                    var sum_log = 0;
                    var sum_sch_r = 0;
                    var sum_log_r = 0;

                    /** source https://stackoverflow.com/questions/8674618/adding-options-to-select-with-javascript */




                    /*** source https://www.geeksforgeeks.org/how-to-get-the-number-of-days-in-a-specified-month-using-javascript/ */

                    function selectElement(id, valueToSelect) {
                        let element = document.getElementById(id);
                        element.value = valueToSelect;
                    }

                    selectElement('month', month);
                    var select = document.getElementById('year');
                    for (var i = 1900; i <= 2100; i++) {
                        var opt = document.createElement('option');
                        if (year == i) {
                            opt.selected = true;
                        }
                        opt.value = i;
                        opt.innerHTML = i;
                        select.appendChild(opt);
                    }

                    var inp1 = year;
                    var inp2 = month;
                    var return_var;
                    var arr_return = new Array();
                    var usid = <?php echo json_encode($userid); ?>;


                    return_var = [];
                    $.ajax({
                        url: "../statistics/load_my_stats.php",
                        method: "POST",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data: { year: year, id: usid, month: month },
                        success: function (data) {
                            return_var = data;


                        }
                    });
                    $.ajax({
                        url: "../statistics/load_my_stats_table.php",
                        method: "POST",
                        data: { year: year, id: usid, month: month },
                        success: function (data) {
                            $("#stat_table").html(data);
                            var counter = 0;
                            for (; ;) {
                                if (document.getElementById("s" + counter) != null) {
                                    sum_sch = sum_sch + Number(document.getElementById("s" + counter).innerHTML);
                                    sum_log = sum_log + Number(document.getElementById("l" + counter).innerHTML);
                                    sum_sch_r = sum_sch_r + Number(document.getElementById("sr" + counter).innerHTML);
                                    sum_log_r = sum_log_r + Number(document.getElementById("lr" + counter).innerHTML);
                                } else {
                                    break;
                                }
                                counter++;
                            }
                            document.getElementById("st").innerHTML = sum_sch;
                            document.getElementById("lt").innerHTML = sum_log;
                            document.getElementById("srt").innerHTML = sum_sch_r;
                            document.getElementById("lrt").innerHTML = sum_log_r;
                            document.getElementById("st_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch) + "h&nbsp;" + Math.trunc(sum_sch * 3600 % 3600 / 60) + "min";
                            document.getElementById("srt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch_r) + "h&nbsp;" + Math.trunc(sum_sch_r * 3600 % 3600 / 60) + "min";
                            document.getElementById("lt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log) + "h&nbsp;" + Math.trunc(sum_log * 3600 % 3600 / 60) + "min";
                            document.getElementById("lrt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log_r) + "h&nbsp;" + Math.trunc(sum_log_r * 3600 % 3600 / 60) + "min";



                        }
                    });
                    $.ajax({
                        url: "../statistics/load_table_log.php",
                        method: "POST",
                        data: { year: year, id: usid, month: month },
                        success: function (data) {
                            $("#log_table").html(data);
                        }
                    });
                    $.ajax({
                        url: "../statistics/load_table_break.php",
                        method: "POST",
                        data: { year: year, id: usid, month: month },
                        success: function (data) {
                            $("#break_table").html(data);
                        }
                    });
                    for (var g = 0; g < max_day; g++) {
                        yValues[g] = return_var[g] / 3600;

                    }
                    load_char();






                    $('#year').change(function () {
                        inp1 = $(this).val();
                        xValues = [];
                        yValues = [];
                        return_var = [];
                        max_day = daysInMonth(inp2, inp1);
                        for (var x = 0; x < max_day; x++) {
                            xValues[x] = x + 1;
                        }
                        $.ajax({
                            url: "../statistics/load_my_stats.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                return_var = data;
                            }
                        });
                        for (var g = 0; g < max_day; g++) {
                            yValues[g] = return_var[g] / 3600;

                        }
                        var div_can = document.getElementById("div_can");
                        div_can.innerText = "";

                        var canva = document.createElement("canvas");
                        canva.id = "chLine";
                        div_can.appendChild(canva);
                        load_char();

                        sum_sch = 0;
                        sum_log = 0;
                        sum_sch_r = 0;
                        sum_log_r = 0;
                        $.ajax({
                            url: "../statistics/load_my_stats_table.php",
                            method: "POST",
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                $("#stat_table").html(data);
                                var counter = 0;
                                for (; ;) {
                                    if (document.getElementById("s" + counter) != null) {
                                        sum_sch = sum_sch + Number(document.getElementById("s" + counter).innerHTML);
                                        sum_log = sum_log + Number(document.getElementById("l" + counter).innerHTML);
                                        sum_sch_r = sum_sch_r + Number(document.getElementById("sr" + counter).innerHTML);
                                        sum_log_r = sum_log_r + Number(document.getElementById("lr" + counter).innerHTML);
                                    } else {
                                        break;
                                    }
                                    counter++;
                                }
                                if (counter != 0) {
                                    document.getElementById("st").innerHTML = sum_sch;
                                    document.getElementById("lt").innerHTML = sum_log;
                                    document.getElementById("srt").innerHTML = sum_sch_r;
                                    document.getElementById("lrt").innerHTML = sum_log_r;
                                    document.getElementById("st_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch) + "h&nbsp;" + Math.trunc(sum_sch * 3600 % 3600 / 60) + "min";
                                    document.getElementById("srt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch_r) + "h&nbsp;" + Math.trunc(sum_sch_r * 3600 % 3600 / 60) + "min";
                                    document.getElementById("lt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log) + "h&nbsp;" + Math.trunc(sum_log * 3600 % 3600 / 60) + "min";
                                    document.getElementById("lrt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log_r) + "h&nbsp;" + Math.trunc(sum_log_r * 3600 % 3600 / 60) + "min";
                                } else {
                                    document.getElementById("st").innerHTML = 0;
                                    document.getElementById("lt").innerHTML = 0;
                                    document.getElementById("srt").innerHTML = 0;
                                    document.getElementById("lrt").innerHTML = 0;
                                    document.getElementById("st_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                    document.getElementById("srt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                    document.getElementById("lt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                    document.getElementById("lrt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                }


                            }
                        });
                    });

                    $('#month').change(function () {
                        inp2 = $(this).val();
                        xValues = [];
                        yValues = [];
                        return_var = [];
                        max_day = daysInMonth(inp2, inp1);
                        for (var x = 0; x < max_day; x++) {
                            xValues[x] = x + 1;
                        }
                        $.ajax({
                            url: "../statistics/load_my_stats.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                return_var = data;


                            }
                        });
                        for (var g = 0; g < max_day; g++) {
                            yValues[g] = return_var[g] / 3600;

                        }
                        var data1 = {
                            labels: xValues,
                            datasets: [{
                                data: yValues,
                                backgroundColor: 'transparent',
                                borderColor: colors[0],
                                borderWidth: 4,
                                pointBackgroundColor: colors[0]
                            }]
                        };

                        var div_can = document.getElementById("div_can");
                        div_can.innerText = "";

                        var canva = document.createElement("canvas");
                        canva.id = "chLine";
                        div_can.appendChild(canva);
                        load_char();

                        sum_sch = 0;
                        sum_log = 0;
                        sum_sch_r = 0;
                        sum_log_r = 0;
                        $.ajax({
                            url: "../statistics/load_my_stats_table.php",
                            method: "POST",
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                $("#stat_table").html(data);
                                var counter = 0;
                                for (; ;) {
                                    if (document.getElementById("s" + counter) != null) {
                                        sum_sch = sum_sch + Number(document.getElementById("s" + counter).innerHTML);
                                        sum_log = sum_log + Number(document.getElementById("l" + counter).innerHTML);
                                        sum_sch_r = sum_sch_r + Number(document.getElementById("sr" + counter).innerHTML);
                                        sum_log_r = sum_log_r + Number(document.getElementById("lr" + counter).innerHTML);
                                    } else {
                                        break;
                                    }
                                    counter++;
                                }
                                if (counter != 0) {
                                    document.getElementById("st").innerHTML = sum_sch;
                                    document.getElementById("lt").innerHTML = sum_log;
                                    document.getElementById("srt").innerHTML = sum_sch_r;
                                    document.getElementById("lrt").innerHTML = sum_log_r;
                                    document.getElementById("st_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch) + "h&nbsp;" + Math.trunc(sum_sch * 3600 % 3600 / 60) + "min";
                                    document.getElementById("srt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_sch_r) + "h&nbsp;" + Math.trunc(sum_sch_r * 3600 % 3600 / 60) + "min";
                                    document.getElementById("lt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log) + "h&nbsp;" + Math.trunc(sum_log * 3600 % 3600 / 60) + "min";
                                    document.getElementById("lrt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + Math.trunc(sum_log_r) + "h&nbsp;" + Math.trunc(sum_log_r * 3600 % 3600 / 60) + "min";
                                } else {
                                    document.getElementById("st").innerHTML = 0;
                                    document.getElementById("lt").innerHTML = 0;
                                    document.getElementById("srt").innerHTML = 0;
                                    document.getElementById("lrt").innerHTML = 0;
                                    document.getElementById("st_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                    document.getElementById("srt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                    document.getElementById("lt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                    document.getElementById("lrt_hm").innerHTML = "&nbsp;-&nbsp;&nbsp;" + 0 + "h&nbsp;" + 0 + "min";
                                }


                            }
                        });

                    });
                    /** source https://www.w3schools.com/jsref/prop_option_selected.asp*/


                </script>

            </div>
        <?php else: ?>
        <?php endif; ?>
</body>

</html>