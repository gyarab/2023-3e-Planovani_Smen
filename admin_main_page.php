<?php

/**main page of admin account */

/**opening add picking data from database database */
$cons = "";
session_start();

if (isset ($_SESSION["user2_id"])) {

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
</head>

<body onload="startTime()">
    <?php if (isset ($user) && $userp == "admin"): ?>


        <!--start of navbar -->
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

            <!--end of navbar -->
            <!-- Printing of  informations  -->
            <!--<div class="container">-->
            <!-- <p>Users first name :
                    </*?= //htmlspecialchars($user["firstname"]) ?>
                </p>
                <p>Users middle name :
                    </*?= //htmlspecialchars($user["middlename"]) ?>
                </p>
                <p>Users last name :
                    </*?= htmlspecialchars($user["lastname"]) ?>
                </p>
                <p>Users email :
                    </*?= htmlspecialchars($user["email"]) ?>
                </p>
                <p>Users phone Code :
                    </*?= htmlspecialchars($user["countryCode"]) ?>
                </p>
                <p>Users phone :
                    </*?= htmlspecialchars($user["phone"]) ?>
                </p>
                <p>Users password_hash :
                    </*?= htmlspecialchars($user["password_hash"]) ?>
                </p>
                <p>Users position :
                    </*?= htmlspecialchars($user["position"]) ?>
                </p>-->
            <!--</div>-->

            <br>
            <?php
            $have = 0;
            $mysqli = require __DIR__ . "/database.php";
            $conn = new mysqli($host, $username, $password, $dbname);
            $y = date('Y-m-d', strtotime("-1 days"));
            $td = date('Y-m-d');
            $tm = date('Y-m-d', strtotime("1 days"));
            $u = $user['id'];
            $sqly = "SELECT * FROM saved_shift_data WHERE saved_date='$y' AND id_user='$u' ORDER BY saved_from";
            $sqltd = "SELECT * FROM saved_shift_data WHERE saved_date='$td' AND id_user='$u' ORDER BY saved_from ";
            $sqltd3 = "SELECT * FROM saved_shift_data WHERE saved_date='$td' AND id_user=$u ORDER BY saved_from ";
            $sqltm = "SELECT * FROM saved_shift_data WHERE saved_date='$tm' AND id_user='$u' ORDER BY saved_from ";
            $fetchy = mysqli_query($conn, $sqly);
            $fetchtd = mysqli_query($conn, $sqltd);
            $fetchtd3 = mysqli_query($conn, $sqltd3);
            $fetchtm = mysqli_query($conn, $sqltm);
            $t1 = array();
            $t2 = array();
            $t2 = array();
            $checkfrom = 0;
            $cs = 0;
            $yb = false;
            $sqlfry = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$u' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance)) OR (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
            $sqlfrtd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance)) OR (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";

            $fetchfryy = mysqli_query($conn, $sqlfry);
            $fetchfrtdtd = mysqli_query($conn, $sqlfrtd);
            if (mysqli_num_rows($fetchfryy) > 0) {
                //$have = 1;
                $sqlfrych = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
                $fetchfryych = mysqli_query($conn, $sqlfrych);
                ?>
                <p>hjfgdhgfdg</p>
                <?php
                while ($row_y = mysqli_fetch_assoc($fetchfryy)) {
                    $st = $row_y['saved_from'];
                    $en = $row_y['saved_to'];
                    //$sqlfrych = "SELECT * FROM attendance WHERE ";

                    if (strtotime($st) >= strtotime($en)) {
                        if (strtotime(date('H:i:s')) < strtotime($en)) {

                            $have = 1;
                        }
                    }
                }
                if (mysqli_num_rows($fetchfryych) > 0) {
                    while ($row_y2 = mysqli_fetch_assoc($fetchfryych)) {
                        $id2 = $row_y['id'];
                        $st2 = $row_y2['saved_from'];
                        $en2 = $row_y2['saved_to'];
                        $att_log = "SELECT * FROM attendance WHERE planned_id=$id2";
                        /*$fetch_log = mysqli_query($conn, $att_log);
                        while ($row_log = mysqli_fetch_assoc($fetch_log)) {
                            $log_from = $row_log['log_from'];
                        }*/

                        if (strtotime($st2) >= strtotime($en2)) {
                            if (strtotime(date('H:i:s')) < strtotime($st2) /*&& strtotime(date('H:i:s'))< strtotime($log)*/) {

                                $have = 1;
                                $checkfrom = 1;
                            }
                        }
                    }
                }

            }
            if ($have != 1) {
                if (mysqli_num_rows($fetchfrtdtd) > 0) {
                    $sqlfrtdch = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
                    $fetchfrtdch = mysqli_query($conn, $sqlfrtdch);
                    ?>
                    <p>lkasdk</p>
                    <?php
                    while ($row_td = mysqli_fetch_assoc($fetchfrtdtd)) {
                        $st3 = $row_td['saved_from'];
                        $en3 = $row_td['saved_to'];
                        //$sqlfrych = "SELECT * FROM attendance WHERE ";

                        if (strtotime($st3) >= strtotime($en3)) {
                            $have = 1;

                        }else if(strtotime($en3) > strtotime(date('H:i:s'))){
                            $have = 1;
                        }
                    }
                    if (mysqli_num_rows($fetchfrtdch) > 0) {
                        $have = 1;
                        $checkfrom = 1;
                    }
                }




                /****if (mysqli_num_rows($fetchtd) > 0) {
                    //$have = 1;
                    $sqlfr = "SELECT * FROM saved_shift_data WHERE saved_date='$td' AND id_user='$u' AND att_from IS NOT NULL AND att_to IS NULL";
                    $fetchfr = mysqli_query($conn, $sqlfr);
                    //$sqlfry = "SELECT * FROM saved_shift_data WHERE saved_date='$y' AND id_user='$u' AND att_from IS NOT NULL AND att_to IS NULL";
                    //$fetchfry = mysqli_query($conn, $sqlfry);
                    //$sqlch = "SELECT * FROM saved_shift_data WHERE saved_date='$td' AND id_user='$u' AND (att_from IS NULL OR att_to IS NULL)";
                    $sqlch = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance)) OR (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
                    //$sqlch = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance)) OR (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance) AND log_from IS NOT NULL AND log_to IS NULL)";

                    $fetchch = mysqli_query($conn, $sqlch);

                    if (mysqli_num_rows($fetchfr) > 0) {
                        //while ($row_fr = mysqli_fetch_assoc($fetchfr)) {
                            $r = 0;
                            /*while ($row_r = mysqli_fetch_assoc($fetchfr)) {
                               
                                $t1[$r] = $row_r['saved_from'];
                                $t2[$r] = $row_r['saved_to'];
                                if (strtotime($t1[$r]) >= strtotime($t2[$r])){

                                }else{
                                    if(strtotime($t2[$r]) > strtotime(date('H:i:s'))){
                                        //$checkfrom = 1;
                                    }
                                }

                            }*/
                /****$checkfrom = 1;
                //}
            }
            if (mysqli_num_rows($fetchfry) > 0) {
                 //$have = 1;
                while ($row_y = mysqli_fetch_assoc($fetchfry)) {
                    $st = $row_y['saved_from'];
                    //$en = $row_y['saved_to'];
                    if( strtotime(date('H:i:s'))<strtotime($st)){
                        $have = 1;
                    }
                }
            }
             if(mysqli_num_rows($fetchfry) > 0){
                //$checkfrom = 1;
                $r = 0;
                /*while ($row_r = mysqli_fetch_assoc($fetchfry)) {
                $t1[$r] = $row_r['saved_from'];
                if (strtotime($t1[$r]) >= strtotime(date('H:i:s'))) {
                    $yb =true;
                    $p = strtotime($t1[$r]);
                    //$status[2] = true;

                }*/
                /***$r++;
 
            /*}*/
                /****if($yb ==true){
                    $checkfrom = 1;
                }
                
            }

                if (mysqli_num_rows($fetchch) > 0) {
                    $r = 0;
                    while ($row_r = mysqli_fetch_assoc($fetchch)) {
                        $t1[$r] = $row_r['saved_from'];
                        $t2[$r] = $row_r['saved_to'];
                        $t3[$r] = $row_r['att_from'];

                        if($row_r['att_from'] == null){
                            if (strtotime($t1[$r]) >= strtotime($t2[$r])){
                                if(strtotime($t2[$r])+86400 > strtotime(date('H:i:s'))){

                                    $have = 1;
                                }else{
                                    $have = 0;
                                }
                            }else{
                                if(strtotime($t2[$r]) > strtotime(date('H:i:s'))){

                                    $have = 1;
                                }else{
                                    $have = 0;

                                }
                            }
                        }else{

                            $have = 1;
                        }
                        $r++;
                    }
                    
                }else{
                    $have = 0;
                }
            }*/
            }
            ?>
            <div class="row">
                <div class='col-12 col-md-4'>
                    <div class="p-3 mb-2" style="background:  #4CAF50;color:#ffffff">Attendance records:</div>
                    <?php if ($have == 1) { ?>
                        <textarea id="txtfield" name="txtfield" rows="3" cols="18"></textarea>
                        <div class="h4" style="float: right;margin-right: 5px;height: 30px;width: 90px">
                            <div id="txt"></div>
                            <br>
                        </div>

                        <br>

                        <br>
                        <button id="pause" type="button" style="float: left;bottom:1%;color:#ffffff;display:none"
                            class="btn btn-info">Start break</button>
                        <button id="confirm" type="button" style="float: right;bottom:1%" class="btn btn-warning"
                            onclick="Comfirm()">Confirm arrival</button>
                        <button id="departure" type="button" style="float: right;bottom:1%;display:none" class="btn btn-danger"
                            onclick="Departure()">Confirm departure</button>
                    <?php } ?>
                    <br>
                    <br>


                    <script>
                        $(window).on("load", function () {
                            document.getElementById("txtfield").value = "";
                            //alert("dsadsa");
                        });
                        var checks = <?php echo json_encode($checkfrom); ?>;
                        let zxz = <?php echo json_encode($p); ?>;
                        //alert(zxz);
                        if (checks == 1) {
                            document.getElementById("pause").style.display = "";
                            document.getElementById("confirm").style.display = "none";
                            document.getElementById("departure").style.display = "";
                        }
                        function Comfirm() {
                            var fetch_id = <?php echo json_encode($userid); ?>;
                            var field = document.getElementById("txtfield").value;
                            //alert(field);
                            var status;
                            var status1;
                            var status2;
                            //$user;
                            //alert(fetch_id);
                            //var fetch_id = 0;
                            //alert(field);
                            $.ajax({
                                url: "confirm_arrival.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { id: fetch_id, text: field },
                                success: function (data, data2) {
                                    //$("#w3review").html(data);
                                    //alert(data);
                                    status = JSON.stringify(data);
                                    status1 = status.substring(1, 2);
                                    status2 = status.substring(3, 4);
                                    alert(status);

                                }

                            });
                            //alert(status);
                            if (status1 == 0) {
                                alert("Your arrival is confirm");
                                document.getElementById("pause").style.display = "";
                                document.getElementById("confirm").style.display = "none";
                                document.getElementById("departure").style.display = "";
                            } else if (status1 == 1) {
                                alert("Please enter comment why are you late");
                            } else {
                                alert("Please enter comment why are you early");
                            }

                        }
                        function Departure() {

                            var fetch_id = <?php echo json_encode($userid); ?>;
                            var field = document.getElementById("txtfield").value;
                            //alert(field);
                            var left;
                            var left1;
                            var left2;
                            //$user;
                            //alert(fetch_id);
                            //var fetch_id = 0;
                            //alert(field);
                            $.ajax({
                                url: "confirm_departure.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { id: fetch_id, text: field },
                                success: function (data) {
                                    //$("#w3review").html(data);
                                    //alert(data);
                                    left = JSON.stringify(data);
                                    left1 = left.substring(1, 2);
                                    left2 = left.substring(3, 4);
                                    alert(left);

                                }
                            });
                            if (left1 == 0) {
                                alert("Your departure is confirm");
                                document.getElementById("pause").style.display = "none";
                                document.getElementById("confirm").style.display = "";
                                document.getElementById("departure").style.display = "none";
                            } else if (left1 == 1) {
                                alert("Please enter comment why are leaving late");
                            } else {
                                alert("Please enter comment why are you leaving early");
                            }
                        }
                    </script>
                </div>
                <div class='col-12 col-md-4'>
                    <div class="p-3 mb-2" style="background:  #4CAF50;color:#ffffff">Closest shifts:</div>
                    <div class="row g-2">

                        <div class='col-12 col-md-4'>
                            <p class="text-center" style="margin-bottom:auto">Yesterday</p>
                            <?php if (mysqli_num_rows($fetchy) > 0) {
                                while ($rows_y = mysqli_fetch_assoc($fetchy)) {
                                    $id_y = $rows_y['id_of_shift'];
                                    $from_y = substr($rows_y['saved_from'], 0, -3);
                                    $to_y = substr($rows_y['saved_to'], 0, -3);

                                    $sqly2 = "SELECT * FROM create_shift WHERE id_shift='$id_y' ";
                                    $fetchy2 = mysqli_query($conn, $sqly2);
                                    while ($rows_y2 = mysqli_fetch_assoc($fetchy2)) {
                                        $color_y = $rows_y2['color'];
                                        $name_y = $rows_y2['shift_name'];
                                        $object_y = $rows_y2['object_name'];
                                    }
                                    ?>
                                    <div class="p-3 mb-2 text-white" style="background-color:<?php echo $color_y ?>">
                                        <p class="text-center" style="margin-bottom:auto">
                                            <?php echo $name_y; ?><br>
                                            <?php echo $object_y; ?><br><small>
                                                <?php echo $from_y . "-" . $to_y ?>
                                            </small>
                                        </p>
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="p-3 mb-2 bg-danger text-white">No planned shift</div>
                            <?php } ?>
                            <!--<label>
                                <?php //echo date('Y-m-d', strtotime("-1 days"));    ?>
                            </label>-->
                        </div>
                        <div class='col-12 col-md-4'>
                            <p class="text-center" style="margin-bottom:auto">Today</p>
                            <?php if (mysqli_num_rows($fetchtd) > 0) {
                                while ($rows_td = mysqli_fetch_assoc($fetchtd)) {
                                    
                                    $id_td = $rows_td['id_of_shift'];
                                    $from_td = substr($rows_td['saved_from'], 0, -3);
                                    $to_td = substr($rows_td['saved_to'], 0, -3);

                                    $sqltd2 = "SELECT * FROM create_shift WHERE id_shift='$id_td' ";
                                    $fetchtd2 = mysqli_query($conn, $sqltd2);
                                    while ($rows_td2 = mysqli_fetch_assoc($fetchtd2)) {
                                        $color_td = $rows_td2['color'];
                                        $name_td = $rows_td2['shift_name'];
                                        $object_td = $rows_td2['object_name'];
                                    }
                                    ?>
                                    <div class="p-3 mb-2 text-white" style="background-color:<?php echo $color_td ?>">
                                        <p class="text-center" style="margin-bottom:auto">
                                            <?php echo $name_td; ?><br>
                                            <?php echo $object_td; ?><br><small>
                                                <?php echo $from_td . "-" . $to_td ?>
                                            </small>
                                        </p>
                                    </div>

                                <?php }
                            } else { ?>
                                <div class="p-3 mb-2 bg-danger text-white">No planned shift</div>
                            <?php } ?>
                            <!--<label>
                                <?php //echo date("Y-m-d")    ?>
                            </label>-->
                        </div>
                        <div class='col-12 col-md-4'>
                            <p class="text-center" style="margin-bottom:auto">Tomorrow</p>
                            <?php if (mysqli_num_rows($fetchtm) > 0) {
                                while ($rows_tm = mysqli_fetch_assoc($fetchtm)) {
                                    $id_tm = $rows_tm['id_of_shift'];
                                    $from_tm = substr($rows_tm['saved_from'], 0, -3);
                                    $to_tm = substr($rows_tm['saved_to'], 0, -3);

                                    $sqltm2 = "SELECT * FROM create_shift WHERE id_shift='$id_tm' ";
                                    $fetchtm2 = mysqli_query($conn, $sqltm2);
                                    while ($rows_tm2 = mysqli_fetch_assoc($fetchtm2)) {
                                        $color_tm = $rows_tm2['color'];
                                        $name_tm = $rows_tm2['shift_name'];
                                        $object_tm = $rows_tm2['object_name'];
                                    }
                                    ?>
                                    <div class="p-3 mb-2 text-white" style="background-color:<?php echo $color_tm ?>">
                                        <p class="text-center" style="margin-bottom:auto">
                                            <?php echo $name_tm; ?><br>
                                            <?php echo $object_tm; ?><br><small>
                                                <?php echo $from_tm . "-" . $to_tm ?>
                                            </small>
                                        </p>
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="p-3 mb-2 bg-danger text-white">No planned shift</div>
                            <?php } ?>
                            <!--<label>
                                <?php //echo date('Y-m-d', strtotime("1 days"));    ?>
                            </label>-->
                        </div>
                    </div>
                </div>
                <div class='col-12 col-md-4'>
                    <div class="p-3 mb-2" style="background:  #4CAF50;color:#ffffff">Comments on the shift:</div>
                    <?php if (mysqli_num_rows($fetchtd3) > 0) {
                                      ?> 
                                      <!--<p>1111</p>-->
                                      <?php  
                                //while ($rows_td4 = mysqli_fetch_assoc($fetchtd2)) {
                                    $result_com = $mysqli->query($sqltd3);
                                    while ($row_com = $result_com->fetch_assoc()) {
                                        $com = $row_com['comments'];
                                        if($com != ""){
                                    ?> 
                                    
                                   
                                   <!--<div style="width: 100%;">No planned shift</div>-->
                                    <p> <?php echo $com; ?></p>
                                    <hr>
                                  


                                <?php }  }?>
                                
<?php
                            } else { ?>
                            <?php } ?>
                
                </div>
            </div>
            <br>
            <div class="row">
                <div class='col-12 col-md-6'>
                    <div class="p-3 mb-2" style="background:  #4CAF50;color:#ffffff">Information board:</div>
                </div>

                <div class='col-12 col-md-6'>
                    <div class="p-3 mb-2" style="background:  #4CAF50;color:#ffffff">Current shifts:
                        <div style="float: right">
                            <select class="form-select form-select-sm" name="option" id="option"
                                style="background-color: #4CAF50;color:#ffffff; margin: auto">
                                <?php
                                $mysqli2 = require __DIR__ . "/database.php";
                                $sql2 = " SELECT * FROM list_of_objects ORDER BY object_name ASC";
                                $result3 = $mysqli2->query($sql2);
                                $mysqli2->close();
                                $counter = 0;
                                while ($rows_dat = mysqli_fetch_assoc($result3)) {
                                    if (null == $rows_dat['superior_object_name']) {
                                        if ($counter == 0) {
                                            $first = $rows_dat['id_object'];
                                        }
                                        $counter++;
                                        ?>
                                        <option value="<?php echo $rows_dat['id_object'] ?>">
                                            <?php echo $rows_dat['object_name']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <script>

                        document.addEventListener("DOMContentLoaded", function () {
                            <?php if ($_SESSION["popup"] == 0) { ?>
                                function popup() {
                                    Swal.fire({
                                        title: "Welcome!",
                                        text: "",
                                        icon: "success"
                                    });
                                    console.log("grgeh");
                                    <?php $_SESSION["popup"] = 1; ?>
                                }
                                popup();
                            <?php } ?>
                        });

                        $('#option').change(function () {
                            var inp = $(this).val();
                            $.ajax({
                                url: "load_current_shifts.php",
                                method: "POST",
                                data: { input: inp },
                                success: function (data) {
                                    $("#current").html(data);
                                    //alert("hjasdsdhjg");
                                }
                            });
                        });



                        var input_obj =
                            <?php echo json_encode($first); ?>;
                        //alert("hjasdhjg");
                        $.ajax({
                            url: "load_current_shifts.php",
                            method: "POST",
                            data: { input: input_obj },
                            success: function (data) {
                                $("#current").html(data);
                                //alert("hjasdsdhjg");
                            }
                        });
                    </script>
                    <div style="height: 800px;overflow:auto;border: solid #aaa;padding: 7px">
                        <div id="current">

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>

        </div>
    <?php else: ?>
    <?php endif; ?>
</body>

</html>