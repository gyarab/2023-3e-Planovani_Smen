<?php

/**tento soubor je hlavni html strana pro admin uzivatele */

/**na zacatku kazdeho souboru, ktery slozi jako html strana je pripojeni do databaze, ktere kontroluje pres session
 * , zda-li uzivatel v databazi existuje a zda-li ma opravni na nahlednuti do souboru
 */
$cons = "";
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
<!-- source:- hodiny https://www.w3schools.com/js/tryit.asp?filename=tryjs_timing_clock -->

<body onload="startTime()">
    <?php if (isset($user) && $userp == "admin"): ?>

        <!--source -  https://www.codingnepalweb.com/drop-down-navigation-bar-html-css/-->
        <!--zacatek navbaru -->
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
            <br>

            <br>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-12 col-md-6">
                    <!-- source: https://www.geeksforgeeks.org/how-to-specify-minimum-maximum-number-of-characters-allowed-in-an-input-field-in-html/ -->
                    <input type="hidden" id="hip">
                    <p style="font-size:20px"><strong>Enter IP: &nbsp;&nbsp;</strong></p>
                    <input id="ip1" class="form-control" maxlength="3" type="text" style="width: 58px;display: inline"
                        onkeyup="checkIP1(this.value)">
                    <p style="font-size:30px; display: inline;height:38px">.</p>
                    <input id="ip2" class="form-control" maxlength="3" type="text" style="width: 58px;display: inline"
                        onkeyup="checkIP2(this.value)">
                    <p style="font-size:30px; display: inline;height:38px">.</p>
                    <input id="ip3" class="form-control" maxlength="3" type="text" style="width: 58px;display: inline"
                        onkeyup="checkIP3(this.value)">
                    <p style="font-size:30px; display: inline;height:38px">.</p>
                    <input id="ip4" class="form-control" maxlength="3" type="text" style="width: 58px;display: inline">
                    <br>
                    <br>

                    <p style="font-size:20px; display: inline"><strong>Description: &nbsp;&nbsp;</strong></p>
                    <br>
                    <br>

                    <input id="mytext" class="form-control" style="display: inline" type="text">
                </div>

                <script>


                    /**--source: http://www.javascriptkit.com/script/script2/autotab.shtml */
                    function checkIP1(val) {
                        if (val.length == 3) {
                            document.getElementById("ip2").focus();

                        }

                    }
                    function checkIP2(val) {
                        if (val.length == 3) {
                            document.getElementById("ip3").focus();

                        }

                    }
                    function checkIP3(val) {
                        if (val.length == 3) {
                            document.getElementById("ip4").focus();

                        }

                    }

                </script>
                <script>
                    /**source: https://www.geeksforgeeks.org/how-to-get-client-ip-address-using-javascript/ */
                    /* Add "https://api.ipify.org?format=json" to 
                    get the IP Address of user*/
                    var ip_return;
                    $(document).ready(() => {
                        $.getJSON("https://api.ipify.org?format=json",
                            function (data) {

                                // Displayin IP address on screen
                                document.getElementById("hip").value = data.ip;
                                //$("#gfg").html(data.ip);
                            })
                        //alert(ip_return);
                    });
                    function get_my_ip() {
                        var ip_arr = new Array();
                        var my_ip = document.getElementById("hip").value;
                        ip_arr = my_ip.split(".");
                        document.getElementById("ip1").value = ip_arr[0];
                        document.getElementById("ip2").value = ip_arr[1];
                        document.getElementById("ip3").value = ip_arr[2];
                        document.getElementById("ip4").value = ip_arr[3];
                    }



                    function add_ip() {
                        var ip1 = document.getElementById("ip1").value;
                        var ip2 = document.getElementById("ip2").value;
                        var ip3 = document.getElementById("ip3").value;
                        var ip4 = document.getElementById("ip4").value;
                        var description = document.getElementById("mytext").value;
                        $.ajax({
                            url: "add_ip.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: { ip1: ip1, ip2: ip2, ip3: ip3, ip4: ip4, description: description },
                            success: function (data) {
                                //results = JSON.stringify(data);
                                alert(data);
                            }

                        });
                    }


                    function load_ips() {
                        $.ajax({
                            url: "load_my_stats_table.php",
                            method: "POST",
                            //dataType: "json",
                            //cache: false,
                            //async: false,
                            data: { year: year, id: usid, month: month },
                            success: function (data) {
                                $("#stat_table").html(data);
                            }
                        })
                    }
                </script>



                <div class="col-12 col-md-6">

                </div>


            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <button type="button" class="btn btn-primary" onclick="add_ip()" style="float:right">ADD IP</button>
                    <button type="button" class="btn btn-warning" onclick="get_my_ip()"
                        style="float:right;margin-right:10px ">GET DEVICE IP</button>
                </div>
            </div>


        </div>
    <?php else: ?>
    <?php endif; ?>
</body>

</html>