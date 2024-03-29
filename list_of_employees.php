<?php

/**Main page of admin account */

/**Opening add picking data from database database */
$cons = "";
$space = "";
session_start();

if (isset($_SESSION["user2_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    /*$sqlp = "SELECT * FROM user2
    WHERE position = {$_SESSION["user2_position"]}";*/
    $sqlp = "SELECT position FROM user2 WHERE id = {$_SESSION["user2_id"]}";
    $resultp = $mysqli->query($sqlp);

    //$userp = $resultp->fetch_assoc();
    while ($rrr = $resultp->fetch_assoc()) {
        $userp = $rrr['position'];

    }

}

$mysqli1 = require __DIR__ . "/database.php";
$sql1 = " SELECT * FROM user2 ORDER BY id DESC ";
$result1 = $mysqli1->query($sql1);
$mysqli1->close();

?>

<!DOCTYPE html>
<html>

<head>
    <title>EMPLOYEES LIST</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main_page.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

<body onload="startTime()">

    <?php if (isset($user) && $userp == "admin"): ?>


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
                                <ul class="em-sub-menu sub-menu">
                                    <li><a href="signup.php">ADD TO SYSTEM</a></li>
                                    <li><a href="list_of_employees.php">LIST</a></li>
                                    <li><a href="#">CHANGE DATA</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">DATABASE</a>
                                <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                                <ul class="htmlCss-sub-menu sub-menu">
                                    <li><a href="create_object.php">CREATE OBJECT</a></li>
                                    <li><a href="create_shift.php">CREATE SHIFT</a></li>
                                    <li><a href="#">CURRENT SCHEDULE</a></li>
                                    <li class="more">
                                        <span><a href="#">More</a>
                                            <i class='bx bxs-chevron-right arrow more-arrow'></i>
                                        </span>
                                        <ul class="more-sub-menu sub-menu">
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
                                <ul class="js-sub-menu sub-menu">
                                    <li><a href="#">Dynamic Clock</a></li>
                                    <li><a href="#">Form Validation</a></li>
                                    <li><a href="#">Card Slider</a></li>
                                    <li><a href="#">Complete Website</a></li>
                                </ul>
                            </li>
                            <li><a href="#">STATISTICS</a></li>
                            <li><a href="logout.php">LOG OUT</a></li>
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

            <br><br>

            <div id="txt"></div>
            <script src="js/main_page.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>




            <?php
            $mysqli2 = require __DIR__ . "/database.php";
            $conn = new mysqli($host, $username, $password, $dbname);
            $sql2 = " SELECT * FROM user2 ORDER BY id ASC ";
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
                        //alert(efdg);
                        var obj_search = new Array();
                        var pos_search = new Array();
                        function pos_click(clicked_val) {
                            /*if (this.checked) {
                                alert(this.value);
                            }*/
                            if (pos_search.includes(clicked_val) == true) {
                                for (let i = 0; i < pos_search.length; i++) {
                                    if (pos_search[i] === clicked_val) {
                                        pos_search.splice(i, 1);
                                        /*console.log("Removed element: " + spliced);
                                        console.log("Remaining elements: " + arr);*/
                                    }
                                }
                            } else {
                                pos_search.push(clicked_val);
                                //alert(pos_search);
                            }
                            //var input = $(this).val();
                            var input = document.getElementById('live_search').value;
                            $.ajax({
                                url: "search_employee.php",
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
                        <!--<option value="0">Pick a object</option>-->
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
                            //alert("is");
                            if (obj_search.includes(clicked_val) == true) {
                                for (let i = 0; i < obj_search.length; i++) {
                                    if (obj_search[i] === clicked_val) {
                                        obj_search.splice(i, 1);
                                        /*console.log("Removed element: " + spliced);
                                        console.log("Remaining elements: " + arr);*/
                                    }
                                }
                            } else {
                                obj_search.push(clicked_val);
                                //alert(pos_search);
                            }
                            var input = document.getElementById('live_search').value;
                            $.ajax({
                                url: "search_employee.php",
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
                            //alert("vgfh");
                            if (shi_search.includes(clicked_val) == true) {
                                for (let i = 0; i < shi_search.length; i++) {
                                    if (shi_search[i] === clicked_val) {
                                        shi_search.splice(i, 1);
                                    }
                                }
                            } else {
                                shi_search.push(clicked_val);
                            }
                            //alert(shi_search);
                            var input = document.getElementById('live_search').value;
                            $.ajax({
                                url: "search_employee.php",
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
                            url: "load_list_object.php",
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
                                url: "load_list_object.php",
                                method: "POST",
                                data: { input: inp },
                                success: function (data) {
                                    $("#object").html(data);

                                }
                            });


                            $.ajax({
                                url: "load_list_shift.php",
                                method: "POST",
                                data: { input: inp },
                                success: function (data) {
                                    //$("#searchresult").css("display", "inline");
                                    $("#shi_load").html(data);
                                }
                            });

                        });
                    </script>
                    <div id="object" style="display:inline;">

                    </div>
                    <?php
                    /**Repeats print of rows */
                    while ($rowsob = $result4->fetch_assoc()) {
                        ?>
                        <!--<div class="form-check form-check-inline">
                            <input class="form-check-input" style="display:inline;" type="checkbox"
                                id="inlineCheckbox<?php //echo $rowsob['id_object'];        ?>" value="option2">
                            <label class="form-check-label" style="display:inline;"
                                for="inlineCheckbox<?php // echo $rowsob['id_object'];        ?>">
                                <?php // echo $rowsob['object_name'];        ?>
                            </label>
                        </div>-->


                        <?php

                    }
                    ?>
                    <br>
                    <br>
                    <h5 style="display:inline;"> &nbsp;&nbsp;Shift : &nbsp;&nbsp;</h5>
                    <div id="shi_load" style="display:inline;">
                        <?php
                        /**Repeats print of rows */
                        /*$arr_sh = array();
                        while ($rowssh = $result5->fetch_assoc()) {
                            if (in_array($rowssh['shift_name'], $arr_sh)) {
                            } else {
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="display:inline;" type="checkbox"
                                        id="sh<?php echo $rowssh['id_shift']; ?>" value="option2">
                                    <label class="form-check-label" style="display:inline;" for="sh<?php echo $rowssh['id_shift']; ?>">
                                        <?php echo $rowssh['shift_name']; ?>
                                    </label>
                                </div>


                                <?php
                                array_push($arr_sh, $rowssh['shift_name']);
                            }

                        }*/
                        ?>

                        <!--<div id="shi_load">-->
                    </div>
                </form>
                <!--<input type="button" onclick="Vacant()" value="Sear" >-->
                <br>
                <hr>
            </div>

            <div id="searchresult">

                <script>
                    //alert(input_obj);
                    $.ajax({
                        url: "load_list_shift.php",
                        method: "POST",
                        data: { input: input_obj },
                        success: function (data) {
                            //$("#searchresult").css("display", "inline");
                            $("#shi_load").html(data);
                        }
                    });


                    $(document).ready(function () {

                        $("#live_search").keyup(function () {
                            //alert(obj_search);

                            var input = $(this).val();

                            $.ajax({
                                url: "search_employee.php",
                                method: "POST",
                                data: { input: input, position: pos_search, object: obj_search, shift: shi_search },
                                success: function (data) {
                                    $("#searchresult").css("display", "inline");
                                    $("#searchresult").html(data);
                                    //alert(data);
                                }
                            });
                        });
                    });

                    var man_arr = new Array();
                    var em_arr = new Array();
                </script>
                <?php
                /**Repeats print of rows */
                while ($rows = $result3->fetch_assoc()) {
                    ?>
                    <div id="<?php echo $rows['id'] ?>div" class="cont">

                        <p>
                            <?php echo $rows['firstname']; ?>
                            <?php echo $rows['middlename']; ?>
                            <?php echo $rows['lastname']; ?> -
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
                                <!--<script>
                                    //man_arr.push(<?php //echo $rows['id']        ?>);
                                                            /*man_load();
                                                            function man_load(){
                                                            $.ajax({
                                                                url: "load_rights_manager.php",
                                                                method: "POST",
                                                                data: { input: <?php //echo $rows['id']        ?> },
                                    success: function (data) {
                                        //$("#searchresult").css("display", "inline");
                                        $("#rlr<?php //echo $rows['id']        ?>").html(data);
                                        //alert(data);
                                    }
                                                            });
                                                            }* /
                                </script>-->
                                <?php

                            }
                            if ($rows['position'] != "manager") { ?>

                                <?php
                            }
                            ?>

                            <!--<font size="+1"><label>Assigned shifts :</label></font>
                                <br>-->
                            <div id="sr<?php echo $rows['id'] ?>"></div>
                            <!--</div>-->
                            <script>em_arr.push(<?php echo $rows['id'] ?>);</script>




                        </div>


                    </div>
                    <br>
                    <?php
                }
                ?>
                <script>
                    /*if (man_arr.length != 0) {
                        //alert(man_arr);
                        for (let i = 0; i < man_arr.length; i++) {
                            var mm = man_arr[i];
                            $.ajax({
                                url: "load_rights_manager.php",
                                method: "POST",
                                data: { input: mm },
                                success: function (data) {
                                    $("#lr" + mm).html(data);
                                }
                            });
                        }
                    }*/
                    /*if (em_arr.length != 0) {
                        //alert(man_arr);
                        for (let i = 0; i < em_arr.length; i++) {
                          //alert(em_arr[i]);
                            var pm = em_arr[i];
                            //alert("hjgasd");
                                $.ajax({
                                    url: "load_assignment_employee.php",
                                    method: "POST",
                                    data: { input: pm },
                                    success: function (data) {
                                        //$("#searchresult").css("display", "inline");
                                        $("#sr"+mm).html(data);
                                        alert(data);
                                    }
                            });
                        }
                    }*/
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
                            url: "load_assignment_employee.php",
                            method: "POST",
                            data: { input: index },
                            success: function (data) {
                                //$("#searchresult").css("display", "inline");
                                $("#sr" + index).html(data);
                                //alert(data);
                            }
                        });
                    }
                    function rig(index) {

                        $.ajax({
                            url: "load_rights_manager.php",
                            method: "POST",
                            data: { input: index },
                            success: function (data) {
                                $("#lr" + index).html(data);
                            }
                        });

                    }
                </script>
            </div>

        </div>
    <?php else: ?>

        <p>You are log out. You can log in <a href="login.php">HERE</a></p>
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