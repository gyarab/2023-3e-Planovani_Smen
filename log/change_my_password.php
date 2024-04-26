<?php

/**tento soubor je hlavni html strana pro admin uzivatele */

/**na zacatku kazdeho souboru, ktery slozi jako html strana je pripojeni do databaze, ktere kontroluje pres session
 * , zda-li uzivatel v databazi existuje a zda-li ma opravni na nahlednuti do souboru
 */
$cons = "";
session_start();

if (isset($_SESSION["user2_id"])) {

    //$mysqli = require __DIR__ . "/database.php";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    </style>
</head>
<!-- source:- hodiny https://www.w3schools.com/js/tryit.asp?filename=tryjs_timing_clock -->

<body onload="startTime()">
    <?php if (isset($user)): ?>

        <!--source -  https://www.codingnepalweb.com/drop-down-navigation-bar-html-css/-->
        <!--zacatek navbaru -->
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
            <div class="shadow p-3 mb-5 bg-white rounded" style="width: 100%;height: 100%">
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
                    <div class="col-12 col-md-4">


                    </div>
                    <div class="col-12 col-md-4">
                        <h5>Enter old password</h5>
                        <input id="old_p" class="form-control" type="password">
                        <small id="old_h" class="form-text" style="color: red;visibility:hidden">Password does not
                            match</small>
                        <br>
                        <br>
                        <h5>Enter new password</h5>
                        <input id="new_p" class="form-control" type="password">
                        <small id="new_h" class="form-text" style="color: red;visibility:hidden">*</small>

                        <h5>Enter new password again</h5>
                        <input id="again_p" class="form-control" type="password">
                        <small id="again_h" class="form-text" style="color: red;visibility:hidden">*</small>

                        <br>
                        <br>
                        <button type="button" class="btn btn-primary" onclick="change_password()" style="float:right">Change
                            password</button>
                    </div>
                    <div class="col-12 col-md-4">


                    </div>

                </div>
                <script>
                    var usid = <?php echo json_encode($userid); ?>;
                    function change_password() {
                        let old_p = document.getElementById("old_p").value;
                        let new_p = document.getElementById("new_p").value;
                        let again_p = document.getElementById("again_p").value;
                        alert("123456");
                        var status;
                        $.ajax({
                            url: "../log/change_pas_check.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: {
                                id: usid, old_p: old_p, new_p: new_p, again_p: again_p
                            },
                            success: function (data) {

                                status = data;
                                status = status.split(",");
                            }
                        });
                        var stringArray = new Array();
                        for (var i = 0; i < status.length; i++) {
                            stringArray.push(status[i]);
                            if (i != status.length - 1) {
                            }
                        }

                        alert(stringArray);
                        if (stringArray.length == 0) {

                            document.getElementById("old_h").style.visibility = "hidden";
                            document.getElementById("new_h").style.visibility = "hiiden";
                            document.getElementById("again_h").style.visibility = "hidden";
                        } else {

                            document.getElementById("old_h").style.visibility = "hidden";
                            document.getElementById("new_h").style.visibility = "hiiden";
                            document.getElementById("again_h").style.visibility = "hidden";
                            for (var i = 0; i < stringArray.length; i++) {
                                if (stringArray[i] == 1) {
                                    document.getElementById("old_h").style.visibility = "visible";
                                } else if (stringArray[i] == 2) {
                                    document.getElementById("new_h").style.visibility = "visible";
                                    document.getElementById("new_h").innerText = "*Password needs to be at least 8 charaters long";
                                } else if (stringArray[i] == 3 || stringArray[i] == 4 || stringArray[i] == 5) {
                                    document.getElementById("new_h").style.visibility = "visible";
                                    document.getElementById("new_h").innerText = "*Password needs to contain one uppercase and lowercase letter and one number ";
                                } else if (stringArray[i] == 6) {
                                    document.getElementById("again_h").style.visibility = "visible";
                                    document.getElementById("again_h").innerText = "*Passwords do not match";
                                }



                            }
                        }
                    }

                </script>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>



        </div>
    <?php else: ?>
    <?php endif; ?>
</body>

</html>