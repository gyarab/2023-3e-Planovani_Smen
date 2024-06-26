<?php
/**html stranka pro nastenku vytvareni a editaci zprav pro nastenku */
$cons = "";
session_start();
/** session a kontrola uzivatele */
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
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin home page </title>
    <link rel="stylesheet" href="../css/main_page.css">
    <link rel="stylesheet" href="../css/logout.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/logout.css">
    <style>
        .in {
            border-radius: 100%;
            height: 30px;
            width: 30px;
            border: solid #aaa;
        }

        /**source pro modal : https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_modal */
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

<body id="body" onload="startTime()">
    <?php if (isset($user) && ($userp == "admin" || $userp == "manager")): ?>
        <div id="myModal" class="modal">

            <!-- Modal content pro editovani zprav -->
            <div class="modal-content">
                <input type="hidden" id="hh">
                <div class='text-end'>
                    <span class="close">&times;</span>
                </div>
                <div class="container">
                    <h2>Edit board </h2>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <h5>
                                Caption
                            </h5>
                            <br>
                            <input id="ecaption" type="text">
                            <br>
                            <br>
                            <h5>
                                Select color:
                            </h5>
                            <br>
                            <input id="ecolor-1" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #124072;" value="">
                            <input id="ecolor-2" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #067088;" value="">
                            <input id="ecolor-3" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #056362;" value="">
                            <input id="ecolor-4" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #055d2b;" value="">
                            <input id="ecolor-5" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #4b8723;" value="">
                            <input id="ecolor-6" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #889d1e;" value="">
                            <br>
                            <input id="ecolor-7" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #c3b204;" value="">
                            <input id="ecolor-8" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #ce8425;" value="">
                            <input id="ecolor-9" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color:  #a53d1a;" value="">
                            <input id="ecolor-10" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color:  #880002;" value="">
                            <input id="ecolor-11" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color:  #6a1161;" value="">
                            <input id="ecolor-12" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color:  #4c1862 ;" value="">
                            <br>
                            <input id="ecolor-13" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #1965b9;" value="">
                            <input id="ecolor-14" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color:  #039ce0;" value="">
                            <input id="ecolor-15" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #01969c;" value="">
                            <input id="ecolor-16" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #009242;" value="">
                            <input id="ecolor-17" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color:  #67ad31 ;" value="">
                            <input id="ecolor-18" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #bcd637;" value="">
                            <br>
                            <input id="ecolor-19" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #fff002;" value="">
                            <input id="ecolor-20" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #fdaf43;" value="">
                            <input id="ecolor-21" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #e87034;" value="">
                            <input id="ecolor-22" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #eb1c26;" value="">
                            <input id="ecolor-23" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #a2288d;" value="">
                            <input id="ecolor-24" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #652d90;" value="">
                            <br>
                            <input id="ecolor-25" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #81c1e7;" value="">
                            <input id="ecolor-26" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #50ddd5;" value="">
                            <input id="ecolor-27" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #addc81;" value="">
                            <input id="ecolor-28" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #ffffba;" value="">
                            <input id="ecolor-29" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #fea698;" value="">
                            <input id="ecolor-30" type="button" class="in" onclick="eColor(this.id)"
                                style="background-color: #b697dd;" value="">



                        </div>
                        <div class="col-12 col-md-8">
                            <h5>
                                Text
                            </h5>
                            <br>
                            <div class="mb-3">

                                <textarea id="eareatext" class="form-control" id="eareatext" rows="7"></textarea>
                            </div>
                            <h5>For</h5>
                            <input type="checkbox" id="eadmin_c" name="eadmin_c" disabled="true" checked="true" />
                            <label for="eadmin_c">Administrators</label>
                            <input type="checkbox" id="emanager_c" name="emanager_c" />
                            <label for="emanager_c">Managers</label>
                            <input type="checkbox" id="eem_full_c" name="eem_full_c" />
                            <label for="eem_full_c">Full-time employees</label>
                            <input type="checkbox" id="eem_part_c" name="eem_part_c" />
                            <label for="eem_part_c">Part-time employees</label>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="Update()" style="float:right">Save</button>
                    <button type="button" class="btn btn-danger" onclick="Delete()" style="float:left">Delete</button>


                    <br>
                    <br>
                    <br>
                    <br>

                </div>
            </div>
        </div>
        <script>
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

        <!--start of navbar -->
        <!--source - navbar  https://www.codingnepalweb.com/drop-down-navigation-bar-html-css/-->
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
            <?php } ?>
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
                <h2>Add to the board </h2>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h5>
                            Caption
                        </h5>
                        <br>
                        <input id="caption" type="text">
                        <br>
                        <br>
                        <h5>
                            Select color:
                        </h5>
                        <br>
                        <input id="scolor-1" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #124072;" value="">
                        <input id="scolor-2" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #067088;" value="">
                        <input id="scolor-3" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #056362;" value="">
                        <input id="scolor-4" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #055d2b;" value="">
                        <input id="scolor-5" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #4b8723;" value="">
                        <input id="scolor-6" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #889d1e;" value="">
                        <br>
                        <input id="scolor-7" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #c3b204;" value="">
                        <input id="scolor-8" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #ce8425;" value="">
                        <input id="scolor-9" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color:  #a53d1a;" value="">
                        <input id="scolor-10" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color:  #880002;" value="">
                        <input id="scolor-11" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color:  #6a1161;" value="">
                        <input id="scolor-12" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color:  #4c1862 ;" value="">
                        <br>
                        <input id="scolor-13" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #1965b9;" value="">
                        <input id="scolor-14" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color:  #039ce0;" value="">
                        <input id="scolor-15" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #01969c;" value="">
                        <input id="scolor-16" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #009242;" value="">
                        <input id="scolor-17" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color:  #67ad31 ;" value="">
                        <input id="scolor-18" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #bcd637;" value="">
                        <br>
                        <input id="scolor-19" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #fff002;" value="">
                        <input id="scolor-20" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #fdaf43;" value="">
                        <input id="scolor-21" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #e87034;" value="">
                        <input id="scolor-22" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #eb1c26;" value="">
                        <input id="scolor-23" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #a2288d;" value="">
                        <input id="scolor-24" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #652d90;" value="">
                        <br>
                        <input id="scolor-25" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #81c1e7;" value="">
                        <input id="scolor-26" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #50ddd5;" value="">
                        <input id="scolor-27" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #addc81;" value="">
                        <input id="scolor-28" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #ffffba;" value="">
                        <input id="scolor-29" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #fea698;" value="">
                        <input id="scolor-30" type="button" class="in" onclick="sColor(this.id)"
                            style="background-color: #b697dd;" value="">



                        <script>
                            const map1 = new Map();
                            /**hashmapy pro vyber barev */
                            map1.set('#124072', 'scolor-1');
                            map1.set('#067088', 'scolor-2');
                            map1.set('#056362', 'scolor-3');
                            map1.set('#055d2b', 'scolor-4');
                            map1.set('#4b8723', 'scolor-5');
                            map1.set('#889d1e', 'scolor-6');

                            map1.set('#c3b204', 'scolor-7');
                            map1.set('#ce8425', 'scolor-8');
                            map1.set('#a53d1a', 'scolor-9');
                            map1.set('#880002', 'scolor-10');
                            map1.set('#6a1161', 'scolor-11');
                            map1.set('#4c1862', 'scolor-12');

                            map1.set('#1965b9', 'scolor-13');
                            map1.set('#039ce0', 'scolor-14');
                            map1.set('#01969c', 'scolor-15');
                            map1.set('#009242', 'scolor-16');
                            map1.set('#67ad31', 'scolor-17');
                            map1.set('#bcd637', 'scolor-18');

                            map1.set('#fff002', 'scolor-19');
                            map1.set('#fdaf43', 'scolor-20');
                            map1.set('#e87034', 'scolor-21');
                            map1.set('#eb1c26', 'scolor-22');
                            map1.set('#a2288d', 'scolor-23');
                            map1.set('#652d90', 'scolor-24');

                            map1.set('#81c1e7', 'scolor-25');
                            map1.set('#50ddd5', 'scolor-26');
                            map1.set('#addc81', 'scolor-27');
                            map1.set('#ffffba', 'scolor-28');
                            map1.set('#fea698', 'scolor-29');
                            map1.set('#b697dd', 'scolor-30');

                            const map2 = new Map();

                            map2.set('#124072', 'ecolor-1');
                            map2.set('#067088', 'ecolor-2');
                            map2.set('#056362', 'ecolor-3');
                            map2.set('#055d2b', 'ecolor-4');
                            map2.set('#4b8723', 'ecolor-5');
                            map2.set('#889d1e', 'ecolor-6');

                            map2.set('#c3b204', 'ecolor-7');
                            map2.set('#ce8425', 'ecolor-8');
                            map2.set('#a53d1a', 'ecolor-9');
                            map2.set('#880002', 'ecolor-10');
                            map2.set('#6a1161', 'ecolor-11');
                            map2.set('#4c1862', 'ecolor-12');

                            map2.set('#1965b9', 'ecolor-13');
                            map2.set('#039ce0', 'ecolor-14');
                            map2.set('#01969c', 'ecolor-15');
                            map2.set('#009242', 'ecolor-16');
                            map2.set('#67ad31', 'ecolor-17');
                            map2.set('#bcd637', 'ecolor-18');

                            map2.set('#fff002', 'ecolor-19');
                            map2.set('#fdaf43', 'ecolor-20');
                            map2.set('#e87034', 'ecolor-21');
                            map2.set('#eb1c26', 'ecolor-22');
                            map2.set('#a2288d', 'ecolor-23');
                            map2.set('#652d90', 'ecolor-24');

                            map2.set('#81c1e7', 'ecolor-25');
                            map2.set('#50ddd5', 'ecolor-26');
                            map2.set('#addc81', 'ecolor-27');
                            map2.set('#ffffba', 'ecolor-28');
                            map2.set('#fea698', 'ecolor-29');
                            map2.set('#b697dd', 'ecolor-30');

                            /**promene pro vyber barev  */
                            let sprevious2 = "scolor-1";
                            let scodecolor = "#124072";
                            let shex;
                             /**dosazeni barvy primarni barvy po nacteni stranky  */
                            window.addEventListener("load", (event) => {

                                let sclicked_color = document.getElementById(sprevious2);
                                sclicked_color.style.border = "solid black";
                                shex = "#124072";
                            });
                            /** prepis z rgb modelu na hex model  */
                            function sColor(clicked) {
                                let sclicked_color = document.getElementById(clicked);
                                sclicked_color.style.border = "solid black";
                                scodecolor = sclicked_color.style.backgroundColor;
                                /**hex source : http://www.java2s.com/example/nodejs/css/get-background-color-in-hex.html */
                                var srgb = scodecolor.match(/\d+/g);
                                shex = '#' + ('0' + parseInt(srgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(srgb[1], 10).toString(16)).slice(-2) + ('0' + parseInt(srgb[2], 10).toString(16)).slice(-2);
                                let sclicked_color_prev = document.getElementById(sprevious2);
                                if (clicked != sprevious2) {
                                    sclicked_color_prev.style.border = "";
                                    sprevious2 = clicked;
                                }


                            }
                            /**promene pro vyber barev v editoru */
                            let eprevious2 = "ecolor-1";
                            let ecodecolor = "#124072";
                            let ehex;
                            /** prepis z rgb modelu na hex model v editoru  */
                            function eColor(clicked) {
                                let eclicked_color = document.getElementById(clicked);
                                eclicked_color.style.border = "solid black";
                                ecodecolor = eclicked_color.style.backgroundColor;
                                /**hex source : http://www.java2s.com/example/nodejs/css/get-background-color-in-hex.html */
                                var ergb = ecodecolor.match(/\d+/g);
                                ehex = '#' + ('0' + parseInt(ergb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(ergb[1], 10).toString(16)).slice(-2) + ('0' + parseInt(ergb[2], 10).toString(16)).slice(-2);
                                let eclicked_color_prev = document.getElementById(eprevious2);
                                if (clicked != eprevious2) {
                                    eclicked_color_prev.style.border = "";
                                    eprevious2 = clicked;
                                }


                            }
                        </script>
                    </div>
                    <div class="col-12 col-md-8">
                        <h5>
                            Text
                        </h5>
                        <br>
                        <div class="mb-3">

                            <textarea id="areatext" class="form-control" id="exampleFormControlTextarea1"
                                rows="7"></textarea>
                        </div>
                        <h5>For</h5>
                        <input type="checkbox" id="admin_c" name="admin_c" disabled="true" checked="true" />
                        <label for="admin_c">Administrators</label>
                        <input type="checkbox" id="manager_c" name="manager_c" />
                        <label for="manager_c">Managers</label>
                        <input type="checkbox" id="em_full_c" name="em_full_c" />
                        <label for="em_full_c">Full-time employees</label>
                        <input type="checkbox" id="em_part_c" name="em_part_c" />
                        <label for="em_part_c">Part-time employees</label>
                    </div>



                </div>
                <br>
                <br>
                <button type="button" class="btn btn-primary" onclick="Save_btn()" style="float:right">Save</button>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                <br>
                <br>


                <div id="all_board">

                </div>
            </div>


            <script>
                var position = <?php echo json_encode($userp); ?>;/**pozice zaregistrovaneho uzivatele */
                var type = 1;/** typ nacteni nastenky
                 1 - nasteni s editor tlacitkem
                 0 -  nasteni bez editor tlacitka (pouziva se u nacteni na hlavnich strankach) 
                 */

                load_boards();
                /** nacteni existujicich zprav na nastence */
                function load_boards() {
                    $.ajax({


                        url: "../board/load_board_edit.php",
                        method: "POST",
                        data: {
                            position: position, type: type
                        },
                        success: function (data) {
                            $("#all_board").html(data);
                        }
                    });
                }

                /**funkce na ukladani zpravy do databaze */
                function Save_btn() {
                    var man = 0;
                    var part = 0;
                    var full = 0;
                    let te = document.getElementById("areatext").value;
                    let ca = document.getElementById("caption").value;
                    if (document.getElementById("manager_c").checked == true) {
                        man = 1;
                    }
                    if (document.getElementById("em_full_c").checked == true) {
                        full = 1;
                    }
                    if (document.getElementById("em_part_c").checked == true) {
                        part = 1;
                    }

                    $.ajax({


                        url: "../board/add_board.php",
                        method: "POST",
                        data: {
                            color: shex, man: man, part: part, full: full, text: te, caption: ca
                        },
                        success: function (data) {
                            success_alert("Board was successfully added");
                        }
                    });
                }
                var board_id = 0;
                /**funkce na update database nastenky */
                function Update() {
                    var man = 0;
                    var part = 0;
                    var full = 0;
                    let te = document.getElementById("eareatext").value;
                    let ca = document.getElementById("ecaption").value;
                    if (document.getElementById("emanager_c").checked == true) {
                        man = 1;
                    }
                    if (document.getElementById("eem_full_c").checked == true) {
                        full = 1;
                    }
                    if (document.getElementById("eem_part_c").checked == true) {
                        part = 1;
                    }

                    $.ajax({


                        url: "../board/update_board.php",
                        method: "POST",
                        data: { input: board_id, color: ehex, man: man, part: part, full: full, text: te, caption: ca },
                        success: function (data) {
                            success_alert("Board was successfully updated");
                        }
                    });
                    modal.style.display = "none";
                    load_boards();
                }
                /**funkce na vymazni zprav z nastenky */
                function Delete() {
                    $.ajax({


                        url: "../board/delete_board.php",
                        method: "POST",
                        data: { input: board_id },
                        success: function (data) {
                            success_alert("Board was successfully deleted");
                        }
                    });
                    modal.style.display = "none";
                    load_boards();
                }
                /**funkce na ziskani dat z nastenky pro editaci */
                function Edit(clicked) {
                    clicked = clicked.substring(1);
                    board_id = clicked;
                    var con;
                    var arr;
                    $.ajax({


                        url: "../board/edit_board_content.php",
                        method: "POST",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data: { input: clicked },
                        success: function (data) {
                            con = (data);
                        }
                    });
                    $.ajax({


                        url: "../board/edit_board_rest.php",
                        method: "POST",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data: { input: clicked },
                        success: function (data) {
                            arr = JSON.stringify(data);
                        }
                    });

                    const secondString = new String(con.toString());
                    document.getElementById("eareatext").value = secondString;
                    arr = arr.substring(1, arr.length - 1);
                    var color_get = arr.substring(1, 8);
                    var full_get = arr.substring(11, 12);
                    var part_get = arr.substring(15, 16);
                    var man_get = arr.substring(19, 20);
                    var cap_get = arr.substring(23, arr.length - 1);
                    eColor(map2.get(color_get));
                    if (full_get == 1) {
                        document.getElementById("eem_full_c").checked = true;

                    } else {
                        document.getElementById("eem_full_c").checked = false;

                    }
                    if (part_get == 1) {
                        document.getElementById("eem_part_c").checked = true;

                    } else {
                        document.getElementById("eem_part_c").checked = false;

                    }
                    if (man_get == 1) {
                        document.getElementById("emanager_c").checked = true;

                    } else {
                        document.getElementById("emanager_c").checked = false;

                    }
                    document.getElementById("ecaption").value = cap_get;
                    var modal = document.getElementById("myModal");
                    var span = document.getElementsByClassName("close")[0];
                    modal.style.display = "block";

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
</body>

</html>