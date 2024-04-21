<?php

/**html stranka pro adminy a managery urcena pro nacitani statistiky dochazkove evidence - uzivatel muze videt statistky jinych uzivatelu*/
$cons = "";
session_start();
/**na zacatku kazdeho souboru, ktery slozi jako html strana je pripojeni do databaze, ktere kontroluje pres session
 * , zda-li uzivatel v databazi existuje a zda-li ma opravni na nahlednuti do souboru
*/
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

$mysqli1 = require __DIR__ . "/database.php";
$sql1 = " SELECT * FROM user2 ORDER BY id DESC ";
$result1 = $mysqli1->query($sql1);
$mysqli1->close();

?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin home page </title>
    <link rel="stylesheet" href="css/main_page.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body onload="startTime()">
    <?php if (isset($user) && $userp == "admin"): ?>


        <!--zacatek navbar -->
        <!--source -  https://www.codingnepalweb.com/drop-down-navigation-bar-html-css/-->
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

            <!--konec navbar -->

            <br>
            <div class="container">
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
                <button id="unselect" style="display: none;margin-left: 15px" onclick="Unselect()" class="btn btn-danger">Unselect</button>
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
                            document.getElementById("chart").style.display = "";
                            document.getElementById("table_stat").style.display = "";
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
                            document.getElementById("chart").style.display = "";
                            document.getElementById("table_stat").style.display = "";
                            usid = vvv;
                            loader();
                            

                        }
                </script>
                <!-- vybrani mesicee -->
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
                <!-- vybrani roku -->
                <select id="year" style="float:right">
                </select>
                <div id="assi_search" style="width:550px">

                      </div>
                <br>
                <br>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

                <!--graf statistiky -->
                <div id="chart" class="card" style="display:none">
                    <div id="div_can" class="card-body">
                        <canvas id="chLine" style="width:100%;max-height: 600px"></canvas>
                    </div>
                </div>
                <br>
                <!-- zacatek tabulky statistiky -->
                <div id="table_stat" style="display:none">
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
                    <!-- konec tabulky statistiky -->
                </div>

                <script>
                    var colors = ['#007bff', '#28a745', '#333333', '#c3e6cb', '#dc3545', '#6c757d'];
                    /*** source https://codepen.io/anonymous_viewer/pen/NWrprmQ */


                    function daysInMonth(month, year) {
                        return new Date(year, month, 0).getDate();
                    }

                    /**vytvareni promenych pro datum */
                    const d = new Date();
                    let year = d.getFullYear();
                    let month = d.getMonth();
                    month = month + 1;
                    max_day = daysInMonth(month, year);

                    var xValues = new Array();/**-x souradnice pro graf statistiky (dny) */
                    var yValues = new Array();/**-y souradnice pro graf statistiky (pocet od pracovanych hodin) */

                    for (var x = 0; x < max_day; x++) {/** forcyklus pridava dny do grfu na zaklade toho kolik dany mesic ma dni */
                        xValues[x] = x + 1;
                    }
                    function Unselect() {
                        document.getElementById('search_bar_em').readOnly = false;
                            document.getElementById('select_em').disabled = false;
                            document.getElementById('select_em').value = 0;
                            document.getElementById('search_bar_em').value = "";
                            document.getElementById("unselect").style.display = "none";
                            document.getElementById("chart").style.display = "none";
                            document.getElementById("table_stat").style.display = "none";
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
                    /**promene na secteni odpracovanych smen  */
                    var sum_sch = 0;/**-secteni planovanych smen  */
                    var sum_log = 0;/**-secteni zaokrouhlenych planovanych smen  */
                    var sum_sch_r = 0;/**-secteni zaregistrovane dochazky */
                    var sum_log_r = 0;/**-secteni zaokrouhlene zaregistrovane dochazky */




                    /*** source https://www.geeksforgeeks.org/how-to-get-the-number-of-days-in-a-specified-month-using-javascript/ */
                    /**funkce co vybira soucasny mesic */
                    function selectElement(id, valueToSelect) {
                        let element = document.getElementById(id);
                        element.value = valueToSelect;
                    }

                    selectElement('month', month);/**vybrani soucasneho mesice */
                    /**vybrani soucasneho roku a vlozeni do roku do selectu v rozmezi 1900 - 2100 */
                    var select = document.getElementById('year');
                    for (var i = 1900; i <= (2100); i++) {
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
                    var return_var;/**promena na vracena zpetna data z souboru load_my_stats.php pres ajax */
                    var arr_return = new Array(); /** array na vracena zpetna data  */
                    var usid = <?php echo json_encode($userid); ?>;/**promena s id_uzivatele */


                    return_var = [];
                    $.ajax({
                        url: "load_my_stats.php",
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
                        url: "load_my_stats_table.php",
                        method: "POST",
                        data: { year: year, id: usid, month: month },
                        success: function (data) {
                            $("#stat_table").html(data);
                            var counter = 0;
                            for (; ;) {
                                if (document.getElementById("s" + counter) != null) {
                                    /**forcyklus, ktery scita data jednotlivych sloupcu  */
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
                    for (var g = 0; g < max_day; g++) {
                        yValues[g] = return_var[g] / 3600;

                    }
                    load_char();






                    $('#year').change(function () {
                        inp1 = $(this).val();
                        //alert(inp1);
                        xValues = [];
                        yValues = [];
                        return_var = [];
                        max_day = daysInMonth(inp2, inp1);
                        for (var x = 0; x < max_day; x++) {
                            xValues[x] = x + 1;
                        }
                        $.ajax({
                            url: "load_my_stats.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                //$("#object").html(data);
                                //alert(data);
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
                        //input.className = "css-class-name"; // set the CSS class
                        div_can.appendChild(canva);
                        load_char();

                        sum_sch = 0;
                        sum_log = 0;
                        sum_sch_r = 0;
                        sum_log_r = 0;
                        alert("is");
                        $.ajax({
                            url: "load_my_stats_table.php",
                            method: "POST",
                            //dataType: "json",
                            //cache: false,
                            //async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                $("#stat_table").html(data);
                                //alert(data);
                                //return_var = data;
                                var counter = 0;
                                for (; ;) {
                                    if (document.getElementById("s" + counter) != null) {
                                        //alert("jkhfasdsjkh");
                                        sum_sch = sum_sch + Number(document.getElementById("s" + counter).innerHTML);
                                        sum_log = sum_log + Number(document.getElementById("l" + counter).innerHTML);
                                        sum_sch_r = sum_sch_r + Number(document.getElementById("sr" + counter).innerHTML);
                                        sum_log_r = sum_log_r + Number(document.getElementById("lr" + counter).innerHTML);
                                        //alert(sum_sch);
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
                                /*alert(counter);
                                alert(sum_sch);
                                alert(sum_log);
                                alert(sum_sch_r);
                                alert(sum_log_r);*/


                            }
                        });
                    });
                    function loader(){
                        //inp2 = $(this).val();
                        xValues = [];
                        yValues = [];
                        return_var = [];
                        max_day = daysInMonth(inp2, inp1);
                        for (var x = 0; x < max_day; x++) {
                            xValues[x] = x + 1;
                        }
                        $.ajax({
                            url: "load_my_stats.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                //$("#object").html(data);
                                //alert(data);
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
                        //alert("jkdsajh");
                        //var context1 = document.querySelector('#chLine').getContext('2d');
                        //new Chart(context1).Line(data1);
                        //load_char();
                        //alert(inp2);
                        //document.getElementById("chLine").data.datasets[0].data = yValues;
                        //document.getElementById("chLine").chart.data.labels = xValues;
                        //document.getElementById("chLine").update();
                        //document.getElementById("chLine").destroy();
                        var div_can = document.getElementById("div_can");
                        div_can.innerText = "";

                        var canva = document.createElement("canvas");
                        canva.id = "chLine";
                        //input.className = "css-class-name"; // set the CSS class
                        div_can.appendChild(canva);
                        load_char();

                        sum_sch = 0;
                        sum_log = 0;
                        sum_sch_r = 0;
                        sum_log_r = 0;
                        alert("is");
                        $.ajax({
                            url: "load_my_stats_table.php",
                            method: "POST",
                            //dataType: "json",
                            //cache: false,
                            //async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                $("#stat_table").html(data);
                                //alert(data);
                                //return_var = data;
                                var counter = 0;
                                for (; ;) {
                                    if (document.getElementById("s" + counter) != null) {
                                        //alert("jkhfasdsjkh");
                                        sum_sch = sum_sch + Number(document.getElementById("s" + counter).innerHTML);
                                        sum_log = sum_log + Number(document.getElementById("l" + counter).innerHTML);
                                        sum_sch_r = sum_sch_r + Number(document.getElementById("sr" + counter).innerHTML);
                                        sum_log_r = sum_log_r + Number(document.getElementById("lr" + counter).innerHTML);
                                        //alert(sum_sch);
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
                                /*alert(counter);
                                alert(sum_sch);
                                alert(sum_log);
                                alert(sum_sch_r);
                                alert(sum_log_r);*/


                            }
                    
                });
            }



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
                            url: "load_my_stats.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                //$("#object").html(data);
                                //alert(data);
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
                        //alert("jkdsajh");
                        //var context1 = document.querySelector('#chLine').getContext('2d');
                        //new Chart(context1).Line(data1);
                        //load_char();
                        //alert(inp2);
                        //document.getElementById("chLine").data.datasets[0].data = yValues;
                        //document.getElementById("chLine").chart.data.labels = xValues;
                        //document.getElementById("chLine").update();
                        //document.getElementById("chLine").destroy();
                        var div_can = document.getElementById("div_can");
                        div_can.innerText = "";

                        var canva = document.createElement("canvas");
                        canva.id = "chLine";
                        //input.className = "css-class-name"; // set the CSS class
                        div_can.appendChild(canva);
                        load_char();

                        sum_sch = 0;
                        sum_log = 0;
                        sum_sch_r = 0;
                        sum_log_r = 0;
                        alert("is");
                        $.ajax({
                            url: "load_my_stats_table.php",
                            method: "POST",
                            //dataType: "json",
                            //cache: false,
                            //async: false,
                            data: { year: inp1, id: usid, month: inp2 },
                            success: function (data) {
                                $("#stat_table").html(data);
                                //alert(data);
                                //return_var = data;
                                var counter = 0;
                                for (; ;) {
                                    if (document.getElementById("s" + counter) != null) {
                                        //alert("jkhfasdsjkh");
                                        sum_sch = sum_sch + Number(document.getElementById("s" + counter).innerHTML);
                                        sum_log = sum_log + Number(document.getElementById("l" + counter).innerHTML);
                                        sum_sch_r = sum_sch_r + Number(document.getElementById("sr" + counter).innerHTML);
                                        sum_log_r = sum_log_r + Number(document.getElementById("lr" + counter).innerHTML);
                                        //alert(sum_sch);
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
                                /*alert(counter);
                                alert(sum_sch);
                                alert(sum_log);
                                alert(sum_sch_r);
                                alert(sum_log_r);*/


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