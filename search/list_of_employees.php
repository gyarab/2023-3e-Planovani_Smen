<?php

/**Main page of admin account */

/**Opening add picking data from database database */
$cons = "";
$space = "";
session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require ("../database.php");


    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
    $sqlp = "SELECT position FROM user WHERE id = {$_SESSION["user_id"]}";
    $resultp = $mysqli->query($sqlp);

    while ($rrr = $resultp->fetch_assoc()) {
        $userp = $rrr['position'];

    }

}


?>

<!DOCTYPE html>
<html>

<head>
    <title>EMPLOYEES LIST</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main_page.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/logout.css">
    <style>
        /**CSS for popup*/
        /**Source - https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_popup */
        .cont {
            margin-bottom: 10px;
            border: 1px solid;
            margin-top: 1px;
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

        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* The actual popup */
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

        .popup .disapear {
            visibility: visible;
            -webkit-animation: fadeOut 1s;
            animation: fadeOut 1s;
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

        @-webkit-keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
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

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
</head>

<body id="body" onload="startTime()">

    <?php if (isset($user) && $userp == "admin" || $userp == "manager" || $userp == "parttime_employee" || $userp == "fulltime_employee"): ?>


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
            <br><br>

            <div id="txt"></div>
            <script src="../js/main_page.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>




            <?php
            $mysqli2 = require ("../database.php");

            $conn = new mysqli($host, $username, $password, $dbname);
            $sql2 = " SELECT * FROM user ORDER BY id ASC ";
            $sql3 = " SELECT * FROM list_of_objects ORDER BY id_object ASC ";
            $sql4 = " SELECT * FROM create_shift ORDER BY id_shift ASC ";
            $query2 = "SELECT * FROM list_of_objects WHERE superior_object_name='' ";
            $result2 = $mysqli2->query($sql2);
            $result3 = $mysqli2->query($sql2);
            $result4 = $mysqli2->query($sql3);
            $result5 = $mysqli2->query($sql4);
            $result6 = mysqli_query($conn, $query2);
            $mysqli2->close();
            ?>
            <div>
                <h1>Colleagues</h1>
                <br>
                <h3>Search for employee</h3>
                <br>
                <form>

                    <input type="text" id="live_search" style="display:inline;" autocomplete="off" placeholder="Search...">

                    <h5 style="display:inline;"> &nbsp;&nbsp;Status : &nbsp;&nbsp;</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" style="display:inline;" onclick="pos_click(this.value)" name="pos"
                            type="checkbox" id="inlineCheckbox1" value="admin">
                        <label class="form-check-label" style="display:inline;" for="inlineCheckbox1">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" style="display:inline;" onclick="pos_click(this.value)" name="pos"
                            type="checkbox" id="inlineCheckbox2" value="manager">
                        <label class="form-check-label" style="display:inline;" for="inlineCheckbox2">Manager</label>

                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" style="display:inline;" onclick="pos_click(this.value)" name="pos"
                            type="checkbox" id="inlineCheckbox3" value="fulltime_employee">
                        <label class="form-check-label" style="display:inline;" for="inlineCheckbox3">Full-time
                            employee</label>

                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" style="display:inline;" onclick="pos_click(this.value)" name="pos"
                            type="checkbox" id="inlineCheckbox4" value="parttime_employee">
                        <label class="form-check-label" style="display:inline;" for="inlineCheckbox4">Part-time
                            employee</label>
                    </div>
                    <script>
                        var efdg = <?php echo json_encode($userp); ?>;
                        var obj_search = new Array();
                        var pos_search = new Array();
                        function pos_click(clicked_val) {
                            if (pos_search.includes(clicked_val) == true) {
                                for (let i = 0; i < pos_search.length; i++) {
                                    if (pos_search[i] === clicked_val) {
                                        pos_search.splice(i, 1);
                                    }
                                }
                            } else {
                                pos_search.push(clicked_val);
                            }
                            var input = document.getElementById('live_search').value;
                            $.ajax({
                                url: "../search/search_employee.php",
                                method: "POST",
                                data: { input: input, position: pos_search, object: obj_search, shift: shi_search },
                                success: function (data) {
                                    $("#searchresult").css("display", "inline");
                                    $("#searchresult").html(data);
                                }
                            });

                        }
                    </script>
                    <br>
                    <br>
                    <h5 style="display:inline;"> &nbsp;&nbsp;Objects : &nbsp;&nbsp;</h5>

                    <Select id="select_obj" style="display: inline">
                        <?php
                        $counter = 0;
                        if (mysqli_num_rows($result6) > 0) {
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                $id_obj = $row6['id_object'];
                                $name_obj = $row6['object_name'];
                                if ($counter == 0) {
                                    $pick = $id_obj;
                                }
                                $counter++;
                                ?>
                                <option value="<?php echo $id_obj; ?>" seleted="selected">
                                    <?php echo $name_obj; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>
                    </Select>

                    <script>
                        var obj_search = new Array();
                        function obj_click(clicked_val) {
                            if (obj_search.includes(clicked_val) == true) {
                                for (let i = 0; i < obj_search.length; i++) {
                                    if (obj_search[i] === clicked_val) {
                                        obj_search.splice(i, 1);
                                    }
                                }
                            } else {
                                obj_search.push(clicked_val);
                            }
                            var input = document.getElementById('live_search').value;
                            $.ajax({
                                url: "../search/search_employee.php",
                                method: "POST",
                                data: { input: input, position: pos_search, object: obj_search, shift: shi_search },
                                success: function (data) {
                                    $("#searchresult").css("display", "inline");
                                    $("#searchresult").html(data);
                                }
                            });
                        }
                        var shi_search = new Array();
                        function shift_search(clicked_val) {
                            if (shi_search.includes(clicked_val) == true) {
                                for (let i = 0; i < shi_search.length; i++) {
                                    if (shi_search[i] === clicked_val) {
                                        shi_search.splice(i, 1);
                                    }
                                }
                            } else {
                                shi_search.push(clicked_val);
                            }
                            var input = document.getElementById('live_search').value;
                            $.ajax({
                                url: "../search/search_employee.php",
                                method: "POST",
                                data: { input: input, position: pos_search, object: obj_search, shift: shi_search },
                                success: function (data) {
                                    $("#searchresult").css("display", "inline");
                                    $("#searchresult").html(data);
                                }
                            });
                        }





                    </script>

                    <script>
                        var input_obj =
                            <?php echo json_encode($pick); ?>;
                        $.ajax({
                            url: "../objects/load_list_object.php",
                            method: "POST",
                            data: { input: input_obj },
                            success: function (data) {
                                $("#object").html(data);

                            }
                        });

                        $('#select_obj').change(function () {
                            bj_search = [];
                            obj_search = [];
                            shi_search = [];
                            var inp = $(this).val();
                            $.ajax({
                                url: "../objects/load_list_object.php",
                                method: "POST",
                                data: { input: inp },
                                success: function (data) {
                                    $("#object").html(data);

                                }
                            });


                            $.ajax({
                                url: "../shifts/load_list_shift.php",
                                method: "POST",
                                data: { input: inp },
                                success: function (data) {
                                    $("#shi_load").html(data);
                                }
                            });

                        });
                    </script>
                    <div id="object" style="display:inline;">

                    </div>
                    <br>
                    <br>
                    <h5 style="display:inline;"> &nbsp;&nbsp;Shift : &nbsp;&nbsp;</h5>
                    <div id="shi_load" style="display:inline;">

                    </div>
                </form>
                <br>
                <hr>
            </div>

            <div id="searchresult">

                <script>
                    $.ajax({
                        url: "../shifts/load_list_shift.php",
                        method: "POST",
                        data: { input: input_obj },
                        success: function (data) {
                            $("#shi_load").html(data);
                        }
                    });


                    $(document).ready(function () {

                        $("#live_search").keyup(function () {

                            var input = $(this).val();

                            $.ajax({
                                url: "../search/search_employee.php",
                                method: "POST",
                                data: { input: input, position: pos_search, object: obj_search, shift: shi_search },
                                success: function (data) {
                                    $("#searchresult").css("display", "inline");
                                    $("#searchresult").html(data);
                                }
                            });
                        });
                    });

                    var man_arr = new Array();
                    var em_arr = new Array();
                </script>
                <?php
                while ($rows = $result3->fetch_assoc()) {
                    ?>
                    <div id="<?php echo $rows['id'] ?>div" class="cont">

                        <p>
                            <?php echo $rows['lastname']; ?>
                            <?php echo $rows['middlename']; ?>
                            <?php echo $rows['firstname']; ?> -
                            <?php
                            if ($rows['position'] == "admin") {
                                echo "Admin";
                            } else if ($rows['position'] == "fulltime_employee") {
                                echo "HPP";
                            } else if ($rows['position'] == "manager") {
                                echo "Manager";
                            } else {
                                echo "DPP";
                            }
                            ?>

                        </p>
                        <div class="popup">
                            <button id="<?php echo $rows['id'] ?>" class="btn btn-light btn-outline-success"
                                style="display:inline;height:20px;width:20px;" onclick="copyfunction1(this.id)"></button>
                            <p style="display:inline">&nbsp;&nbsp;</p>
                            <p id="<?php echo $rows['id'] ?> p1" style="display:inline;height:20px;width:20px">
                                <?php echo $rows['email']; ?>
                            </p>
                            <span class="popuptext" id="<?php echo $rows['id'] ?> pop1">Email copied</span>
                        </div>
                        <br>
                        <div class="popup">
                            <button id="<?php echo $rows['id'] ?>" class="btn btn-light btn-outline-success"
                                style="display:inline;height:20px;width:20px" onclick="copyfunction2(this.id)"></button>
                            <p style="display:inline">&nbsp;&nbsp;</p>
                            <p id="<?php echo $rows['id'] ?> p2+" style="display:inline;height:20px;width:20px">+
                                <?php echo $rows['countryCode']; ?>
                            </p>
                            <p style="display:inline">&nbsp;</p>
                            <p id="<?php echo $rows['id'] ?> p2" style="display:inline">
                                <?php echo $rows['phone']; ?>
                            </p>
                            <span class="popuptext" id="<?php echo $rows['id'] ?> pop2">Phone copied</span>
                            <!--<div class="row">-->
                            <?php
                            if ($rows['position'] == "manager") {
                                ?>
                                <br>
                                <br>
                                <font size="+1"><label>Editing rights for :</label></font>
                                <br>
                                <div id="lr<?php echo $rows['id'] ?>"></div>

                                <script>man_arr.push(<?php echo $rows['id'] ?>);</script>

                                <?php

                            }
                            if ($rows['position'] != "manager") { ?>

                                <?php
                            }
                            ?>


                            <div id="sr<?php echo $rows['id'] ?>"></div>
                            <script>em_arr.push(<?php echo $rows['id'] ?>);</script>




                        </div>


                    </div>
                    <br>
                    <?php
                }
                ?>
                <script>

                    var pm;
                    if (em_arr.length != 0) {
                        for (var i = 0; i < em_arr.length; i++) {
                            shi(em_arr[i]);
                        }
                    }
                    if (man_arr.length != 0) {
                        for (var i = 0; i < man_arr.length; i++) {
                            rig(man_arr[i]);
                        }
                    }
                    function shi(index) {
                        $.ajax({
                            url: "../rights_assignments/load_assignment_employee.php",
                            method: "POST",
                            data: { input: index },
                            success: function (data) {
                                $("#sr" + index).html(data);
                            }
                        });
                    }
                    function rig(index) {

                        $.ajax({
                            url: "../rights_assignments/load_rights_manager.php",
                            method: "POST",
                            data: { input: index },
                            success: function (data) {
                                $("#lr" + index).html(data);
                            }
                        });

                    }

                    function success_alert(message) {
                        Swal.fire({
                            title: message,
                            text: "",
                            icon: "success"
                        });

                    }
                    function error_alert(message) {
                        Swal.fire({
                            title: message,
                            text: "",
                            icon: "error"
                        });

                    }
                </script>
            </div>

        </div>
    <?php else: ?>
        <script>
            document.getElementById("body").style.backgroundColor = " rgba(118,184,82,1)";
        </script>
        <div class="login-page">
            <div class="form">
                <h2>
                    You are current log out
                </h2>
                <br>
                <br>
                <p style="float:left">Log-in <a href="../log/login.php">here:</a></p>
                <br>
                <br>
                <p style="float:left">Go to home page <a href="../index.php">here:</a></p>
                <br>
                <br>
                <br>

            </div>
        </div>
    <?php endif; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--Code for copy buttons -->
    <!-- Source - https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_copy_clipboard-->
    <script>
        function copyfunction1(clicked_id) {
            var s = clicked_id;
            var t = s + " p1";
            var copyText = document.getElementById(t).innerText;
            var h = s + " pop1";
            var popup = document.getElementById(h);
            popup.classList.toggle("show");
            var l = "#" + h;
            const q = document.getElementById(h);

            setTimeout(() => {
                q.style.opacity = 0;
            }, 2000);
            navigator.clipboard.writeText(copyText);
        }

        function copyfunction2(clicked_id) {
            var s = clicked_id;
            var t = s + " p2";
            var z = t + "+"
            var copyText1 = document.getElementById(t).innerText;
            var copyText2 = document.getElementById(z).innerText;
            var ct = copyText2 + copyText1;
            var x = s + " pop2";
            var popup = document.getElementById(x);
            popup.classList.toggle("show");
            const i = document.getElementById(x);
            setTimeout(() => {
                i.style.opacity = 0;
            }, 2000);

            navigator.clipboard.writeText(ct);

        }
    </script>
</body>

</html>