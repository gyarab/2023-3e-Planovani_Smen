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
            <?php
            $have = 0;/** - promena, ktera udava zdali existuje smena do ktere se da pripojit (hodnota je 1) nebo ne (hodnota je 0) */
            $mysqli = require __DIR__ . "/database.php";
            $conn = new mysqli($host, $username, $password, $dbname);
            $y = date('Y-m-d', strtotime("-1 days"));/**-zjisteni vcerejsiho dne */
            $td = date('Y-m-d');/**-zjisteni dnesniho dne */
            $tm = date('Y-m-d', strtotime("1 days"));/**-zjisteni zitrejsiho dne */
            $u = $user['id'];
            $sqly = "SELECT * FROM saved_shift_data WHERE saved_date='$y' AND id_user='$u' ORDER BY saved_from";/**-SQl dotaz - vybere vcerejsi smeny */
            $sqltd = "SELECT * FROM saved_shift_data WHERE saved_date='$td' AND id_user='$u' ORDER BY saved_from ";/**-SQl dotaz - vybere dnesni smeny */
            $sqltm = "SELECT * FROM saved_shift_data WHERE saved_date='$tm' AND id_user='$u' ORDER BY saved_from "; /**-SQl dotaz - vybere zitrejsi smeny  */
            $sqlcl = "SELECT * FROM saved_shift_data, create_shift WHERE id_user='$u' AND saved_date >= DATE('$td') AND create_shift.id_shift = saved_shift_data.id_of_shift ORDER BY saved_from DESC "; /**-SQL dotaz - co vyhledava nejblizsi nasledujici smenu */
            /**-prikazy, ktere ziskavaji predchozi vysledky z SQL dotazu  */
            $fetchy = mysqli_query($conn, $sqly); 
            $fetchtd = mysqli_query($conn, $sqltd);
            $fetchtm = mysqli_query($conn, $sqltm);
            $fetchcl = mysqli_query($conn, $sqlcl);
            $checkfrom = 0;/**promena, podle ktere se nacita tlacitko budto na prihlaseni do smeny (promena je 0) nebo na odhlaseni ze smeny (promena je 1) */
            /** - SQL dotaz, ktery vyhledava vcerejsi smeny u kterych se uzivatel nezaregistroval a nebo se jeste neodlasil */
            $sqlfry = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$u' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance)) OR (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
            /** - SQL dotaz, ktery vyhledava dnesni smeny u kterych se uzivatel nezaregistroval a nebo se jeste neodlasil */
            $sqlfrtd = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id NOT IN (SELECT planned_id FROM attendance)) OR (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";

            /**-prikazy, ktere ziskavaji predchozi vysledky z SQL dotazu  */
            $fetchfryy = mysqli_query($conn, $sqlfry);
            $fetchfrtdtd = mysqli_query($conn, $sqlfrtd);

            /** tato cast zjistuje zda-li existuji nejake vysledky z dotatzu pro vcerejsi den */
            if (mysqli_num_rows($fetchfryy) > 0) {
                $sqlfrych = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$y' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
                $fetchfryych = mysqli_query($conn, $sqlfrych);
                while ($row_y = mysqli_fetch_assoc($fetchfryy)) {
                    $st = $row_y['saved_from'];
                    $en = $row_y['saved_to'];     
                    /**podminka zkontroluje zda-li je jeste moznost se prihlasit do smeny - soucasny cas v timestapu je mensi nez timestamp kdy smena konci */   
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
                        /**podminka zkontroluje zda-li je jeste moznost se z smeny ohlasit - jeste neuplynulo 24 hodin od zacatku naplanovane smeny */ 
                        $att_log = "SELECT * FROM attendance WHERE planned_id=$id2";
                        if (strtotime($st2) >= strtotime($en2)) {
                            if (strtotime(date('H:i:s')) < strtotime($st2) ) {

                                $have = 1;
                                $checkfrom = 1;
                            }
                        }
                    }
                }

            }
               /** tato cast zjistuje zda-li existuji nejake vysledky z dotatzu pro vcerejsi den */
            if ($have != 1) {
                if (mysqli_num_rows($fetchfrtdtd) > 0) {
                    $sqlfrtdch = "SELECT * FROM saved_shift_data WHERE (saved_shift_data.saved_date='$td' AND saved_shift_data.id_user='$u' AND saved_shift_data.id IN (SELECT planned_id FROM attendance WHERE log_from IS NOT NULL AND log_to IS NULL))";
                    $fetchfrtdch = mysqli_query($conn, $sqlfrtdch);
                    while ($row_td = mysqli_fetch_assoc($fetchfrtdtd)) {
                        $st3 = $row_td['saved_from'];
                        $en3 = $row_td['saved_to'];
                        /**podminka kontroluje jestli smena neprechazi pres dva dny- kontroluje to tim, ze porovna timestampy
                         * 
                         */
                        if (strtotime($st3) >= strtotime($en3)) {
                            $have = 1;
                         /**podminka zkontroluje zda-li je jeste moznost se prihlasit do smeny - soucasny cas v timestapu je mensi nez timestamp kdy  smena konci */
                        } else if (strtotime($en3) > strtotime(date('H:i:s'))) {
                            $have = 1;
                        }
                    }
                    /**podminka kontroluje kontroluji zda-li se uzivatel uz na smenu prihlasil */
                    if (mysqli_num_rows($fetchfrtdch) > 0) {
                        $have = 1;
                        $checkfrom = 1;
                    }
                }
            }
            ?>
            
            <div class="row">
                <!-- zacatek prihlaseni na smenu -->
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

                        var position = <?php echo json_encode($userp); ?>;/**-ziskani pozice prihlaseneho uzivatele */
                        var type = 0; /** promena, ktera slouzi k nacteni pro nacteni informacni tabule */

                        /**nacitani informacni tabule */
                        $.ajax({
                            url: "load_board_edit.php",
                            method: "POST",
                            data: {
                                position: position, type: type
                            },
                            success: function (data) {
                                $("#all_board").html(data);
                            }
                        });





                        $(window).on("load", function () {
                            document.getElementById("txtfield").value = "";
                        });
                        var checks = <?php echo json_encode($checkfrom); ?>;
                        if (checks == 1) {
                            document.getElementById("pause").style.display = "";
                            document.getElementById("confirm").style.display = "none";
                            document.getElementById("departure").style.display = "";
                        }
                        /**Funkce na prihlaseni */
                        function Comfirm() {
                            var fetch_id = <?php echo json_encode($userid); ?>;/**promena s id uzivatele */
                            var field = document.getElementById("txtfield").value;/**promena co ziskava text z textarea na komentare */
                            var status;/**promena pro zpetna data */
                            var status1;/**promena pro potvrzeni, ze data se ulozily do databaze uspesne */
                            var status2;/**promena pro potvrzeni, ze komentar se do databaze ulozil upesne */

                            /**ukladani do databaze */
                            $.ajax({
                                url: "confirm_arrival.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { id: fetch_id, text: field },
                                success: function (data) {
                                    status = JSON.stringify(data);
                                    status1 = status.substring(1, 2);
                                    status2 = status.substring(3, 4);
                                    alert(status);/**--dodelat */

                                }

                            });
                            /**vraceni potvrzujici zpravy*/
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
                        /**funkce na odhlaseni */
                        function Departure() {

                            var fetch_id = <?php echo json_encode($userid); ?>;/**promena s id uzivatele */
                            var field = document.getElementById("txtfield").value;/**promena co ziskava text z textarea na komentare */
                            var left;/**promena pro zpetna data */
                            var left1;/**promena pro potvrzeni, ze data se ulozily do databaze uspesne */
                            var left2;/**promena pro potvrzeni, ze komentar se do databaze ulozil upesne */
                            $.ajax({
                                url: "confirm_departure.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { id: fetch_id, text: field },
                                success: function (data) {
                                    left = JSON.stringify(data);
                                    left1 = left.substring(1, 2);
                                    left2 = left.substring(3, 4);
                                    alert(left);/**--dodelat */

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
                 <!-- konec prihlaseni na smenu -->
                  <!-- zacatek zobrazeni smen uzivatele na dnesek, zitrek a vcerejsek -->
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

                        </div>
                        <div class='col-12'>
                            <!-- zobrazeni nejblizsi smeny -->
                            <p><strong>Closest shift:<a href="my_shifts.php" style="text-decoration:none"></strong>
                                <?php if (mysqli_num_rows($fetchcl) > 0) {
                                    $result_cl = $mysqli->query($sqlcl);
                                    while ($row_cl = $result_cl->fetch_assoc()) {
                                        $sdate = $row_cl['saved_date'];
                                        $shi_name2 = $row_cl['shift_name'];
                                        $obj_name2 = $row_cl['object_name'];
                                        $pl_from = substr($row_cl['saved_from'],0,-3);
                                        $pl_to = substr($row_cl['saved_to'],0,-3);
                                        $month = substr($sdate, 5, -3);
                                        $day = substr($sdate, 8);
                                        break;
                                    }
                                    ?>

                                    <?php echo ($day.".".$month. " | ". $pl_from ."-" . $pl_to . " | " . $obj_name2 . " - " . $shi_name2); ?></a>
                                </p>
                            <?php
                                } else {
                                    ?>
                                //</a></p>
                                <?php
                                } ?>
                        </div>
                    </div>
                </div>
                <!-- konec zobrazeni smen uzivatele na dnesek, zitrek a vcerejsek -->
                <!-- zobrazeni komentare ke smene -->
                <div class='col-12 col-md-4'>
                    <div class="p-3 mb-2" style="background:  #4CAF50;color:#ffffff">Comments on the shift:</div>
                    <?php if (mysqli_num_rows($fetchtd) > 0) {
                        $result_com = $mysqli->query($sqltd);
                        while ($row_com = $result_com->fetch_assoc()) {
                            $com = $row_com['comments'];
                            if ($com != "") {
                                $inside  = str_replace("\n","<br>",$com);
                                $inside  = str_replace(" ","&nbsp;",$inside);
                                ?>
                                <p>
                                    <?php echo $inside; ?>
                                </p>
                                <hr>



                            <?php }
                        } ?>

                        <?php
                    } else { ?>
                    <?php } ?>

                </div>
            </div>
            <br>
            <!-- informacni tabule-->
            <div class="row">
                <div class='col-12 col-md-6'>
                    <div class="p-3 mb-2" style="background:  #4CAF50;color:#ffffff">Information board:</div>
                    <div id="all_board">
                        
                    </div>
                </div>
                <!-- soucasne naplanovane smeny v systemu -->
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
                                }
                            });
                        });



                        var input_obj =
                            <?php echo json_encode($first); ?>;/** id hlavniho objektu */
                            /** nacitani soucasnych smen */
                        $.ajax({
                            url: "load_current_shifts.php",
                            method: "POST",
                            data: { input: input_obj },
                            success: function (data) {
                                $("#current").html(data);
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