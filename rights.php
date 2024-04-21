<?php
$cons = "";
session_start();

if (isset($_SESSION["user2_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/tree.css">
    <link rel="stylesheet" href="css/success.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .cont {
            margin-bottom: 25px;
            border: 1px solid;
            margin: auto;
            width: 100%;
            padding: 10px;
            box-shadow: 5px 10px #888888;
            /*margin-left: 10px;*/
        }

        .head {
            margin: auto;
            width: 100%;
            padding: 10px;
            margin-bottom: 25px;
        }

        .in {
            border-radius: 100%;
            height: 30px;
            width: 30px;
            border: solid #aaa;
        }

        .topright {
            position: absolute;
            top: 8px;
            right: 16px;
            font-size: 18px;
        }

        .foo {
            position: fixed;
            bottom: 0;
            right: 0;
        }

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

        /* The Close Button */
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

<body onload="startTime()">
    <?php if (isset($user)): ?>


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

            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class='text-end'>
                        <span class="close">&times;</span>
                    </div>
                    <div class="container">
                        <div style="overflow:auto">
                        <div id="mdiv"></div>
    </div>
                    </div>
                </div>
            </div>


            <div class="container">
                <h3>
                    Rigths & ASSIGNMENT
                </h3>
                <div class="cont">
                    <div class='row'>
                        <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
                            <h3>Manager rights :</h3>
                            <p>Select manager :</p>
                            <input id="search_bar" type="text" size="20" autocomplete="off" style="display: inline"
                                style='margin-bottom: 15px' placeholder="Search for manager">
                            <p style="display: inline"> OR </p>
                            <Select id="select_man" class="size='1'" style="display: inline">
                                <option id="opt_man-0" value="0">Pick a manager</option>
                                <?php
                                $mysqli = require __DIR__ . "/database.php";

                                $conn = new mysqli($host, $username, $password, $dbname);
                                $query = "SELECT * FROM user2 WHERE position='manager' ORDER BY lastname, firstname ";
                                $query2 = "SELECT * FROM list_of_objects WHERE superior_object_name='' ";
                                $result = mysqli_query($conn, $query);
                                $result2 = mysqli_query($conn, $query2);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $firstname = $row['firstname'];
                                        $middlename = $row['middlename'];
                                        $lastname = $row['lastname'];

                                        ?>
                                        <option id="opt_man-<?php echo $id; ?>" value="<?php echo $id; ?>">
                                            <?php echo $lastname . " " . $middlename . " " . $firstname; ?>
                                        </option>

                                        <?php
                                    }
                                }

                                ?>
                            </Select>

                            <div id="manager_search">

                            </div>
                            <br>
                            <br>
                            <p id="text_inf" style="display: inline; visibility:hidden">Selected manager: </p>
                            <strong>
                                <font size="+1">
                                    <p id="sel_text" style="display: inline; visibility:hidden"></p>
                                </font>
                            </strong>
                            <br>
                            <br>
                            <p id="p_right" style="visibility: hidden">
                                <font size="+1">Users rights:</font>
                            </p>
                            <div id="right">

                            </div>
                            <br>

                            <div class="sticky-bottom">
                                <input id="Right" type="button" onclick="Add_right()" class="btn btn-primary"
                                    style="display: inline;float:right; visibility:hidden" value="ADD RIGHTS">
                                <input id="Unselect" type="button" style="display: inline; float: left; visibility:hidden"
                                    onclick="Unselect()" class="btn btn-danger" value="UNSELECT MANAGER">
                                <label id="add_l"
                                    style="display: inline;float: left; visibility:hidden">&nbsp;&nbsp;</label>
                                <input id="Edit" type="button" style="display: inline; float: left; visibility:hidden"
                                    onclick="Edit()" class="btn btn-warning" value="REMOVE RIGHTS">
                            </div>



                        </div>
                        <div class='col-12 col-md-6 p-2' style='margin-bottom: 15px'>
                            <br>
                            <br>
                            <p id="sel_obj" style="display:none">Select OBJECT :</p>
                            <Select id="select_obj" style="display: inline;visibility:hidden">
                                <!--<option value="0">Pick a object</option>-->
                                <?php
                                $counter = 0;
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $id_obj = $row2['id_object'];
                                        $name_obj = $row2['object_name'];
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
                            <div id="tree" class="tree" style="display:none">
                                <div id="object">

                                </div>
                            </div>

                            <input id="r1" type="radio" name="r" onclick="rad(this.value)" style="display:none" value="1"
                                checked>
                            <label id="lr1" for="r1" style="visibility:hidden">With sub-objects</label>
                            <input id="r2" type="radio" name="r" onclick="rad(this.value)" style="display:none" value="2">
                            <label id="lr2" for="r2" style="visibility:hidden">Without sub-objects</label>
                            <script>
                                var click = 1;
                                function rad(clicked) {
                                    //alert(clicked);
                                    if (click != clicked) {
                                        click = clicked;
                                        if (clicked == 1) {
                                            var t = 1;
                                            for (; ;) {
                                                if (document.getElementById("spa" + t) == null) {
                                                    break;
                                                }
                                                if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa" + t).style.backgroundColor != 'rgb(5, 99, 98)') {
                                                    document.getElementById("spa" + t).style.backgroundColor = '';
                                                    document.getElementById("spa" + t).style.color = '';
                                                    document.getElementById("spa" + t).style.border = "";
                                                }
                                                t++;
                                            }
                                            if (document.getElementById("spa1m").style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa1m").style.backgroundColor != 'rgb(5, 99, 98)') {
                                                document.getElementById("spa1m").style.backgroundColor = '';
                                                document.getElementById("spa1m").style.color = '';
                                                document.getElementById("spa1m").style.border = "";
                                            }
                                            var kka = "spa" + previous;
                                            //alert(kka);
                                            let ffa = document.getElementById(kka);
                                            if (ffa.style.backgroundColor != 'rgb(5, 99, 98)') {
                                                ffa.style.backgroundColor = 'rgb(76, 175, 80)';
                                                ffa.style.color = '#fff';
                                                ffa.style.border = "solid #4CAF50";
                                            }
                                            ffa.style.border = "solid #202020";



                                        } else {
                                            //alert(document.getElementById("spa" + previous).name);
                                            var h = document.getElementById("spa" + previous).name;
                                            h = h.substring(1);
                                            var m;
                                            $.ajax({
                                                type: "POST",
                                                url: "look_for_sub_object.php",
                                                dataType: "json",
                                                cache: false,
                                                async: false,
                                                data: {
                                                    input: h
                                                },
                                                success: function (data) {
                                                    //alert(data);
                                                    /*document.getElementById("help2").value = data321;
 
                                                    a1sa = JSON.stringify(data321);*/
                                                    m = JSON.stringify(data);
                                                }
                                            });
                                            //alert(m);
                                            let sarr = new Array();
                                            m = m.substring(1, m.length - 1);
                                            //alert(m);
                                            if (m.length != 0) {
                                                //alert("true");

                                                sarr = m.split(",");
                                                for (let u = 0; u < sarr.length; u++) {
                                                    var c = sarr[u].length;
                                                    var f = sarr[u];
                                                    sarr[u] = f.substring(1, c - 1);
                                                }
                                                for (let u = 0; u < sarr.length; u++) {
                                                    var j = document.getElementsByName("s" + sarr[u]);
                                                    if (j[0] != null) {
                                                        if (j[0].style.backgroundColor != 'rgb(5, 99, 98)') {
                                                            j[0].style.backgroundColor = 'rgb(76, 175, 80)';
                                                            j[0].style.color = '#fff';
                                                            j[0].style.border = "solid #4CAF50";
                                                            j[0].style.border = "solid #202020";
                                                            /*document.getElementById("spa" + t).style.border = "";
                                                            if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(5, 99, 98)') {
                                                                document.getElementById("spa" + t).style.border = "solid rgb(5, 99, 98)";
                                                            }*/
                                                        }
                                                        j[0].style.border = "solid #202020";

                                                        //j[0].style.border = "solid #202020";
                                                    }
                                                }
                                            }


                                            /*var t = 1;
                                            for (; ;) {
                                                if (document.getElementById("spa" + t) == null) {
                                                    break;
                                                }
                                                if (document.getElementById("spa" + t).matches('.tree li input::before')) {
                                                    document.getElementById("spa" + t).style.backgroundColor = 'rgb(76, 175, 80)';
                                                    document.getElementById("spa" + t).style.color = '#fff';
                                                    document.getElementById("spa" + t).style.border = "solid #4CAF50";
                                                }
                                                t++;
                                            }
                                            if (document.getElementById("spa1m").matches('.tree li input:hover+ul li input ')) {
                                                document.getElementById("spa1m").style.backgroundColor = 'rgb(76, 175, 80)';
                                                document.getElementById("spa1m").style.color = '#fff';
                                                document.getElementById("spa1m").style.border = "solid #4CAF50";
                                            }*/


                                        }
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <h3>Shift assignment :</h3>
                        <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
                            <p>Select employee :</p>
                            <input id="search_bar_em" type="text" size="20" autocomplete="off" style="display: inline"
                                style='margin-bottom: 15px' placeholder="Search for employee">
                            <p style="display: inline"> OR </p>
                            <Select id="select_em" style="display: inline">
                                <option id="opt_man-0" value="0">Pick a employee</option>
                                <?php
                                $mysqli = require __DIR__ . "/database.php";

                                $conn = new mysqli($host, $username, $password, $dbname);
                                $query7 = "SELECT * FROM user2 ORDER BY lastname, firstname ";
                                //$query8 = "SELECT * FROM list_of_objects WHERE superior_object_name='' ";
                                $result7 = mysqli_query($conn, $query7);
                                //$result8 = mysqli_query($conn, $query8);
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
                            <div id="assi_search">

                            </div>
                            <br>

                            <p id="text_inf_em" style="display: inline; visibility:hidden">Selected employee: </p>
                            <strong>
                                <font size="+1">
                                    <p id="sel_text_em" style="display: inline; visibility:hidden"></p>
                                </font>
                            </strong>
                            <br>
                            <!--<br>-->
                            <p id="p_assi" style="display: none">
                                <font size="+1">Assigned shifts:</font>
                            </p>
                            <!--<br>-->
                            <div id="assignment" style="display: none">

                            </div>
                            <div class="sticky-bottom">
                                <br>
                                <input id="Right_em" type="button" onclick="Add_right_em()" class="btn btn-primary"
                                    style="display: inline;float:right; visibility:hidden" value="ADD ASSIGNMENT">
                                <input id="Unselect_em" type="button"
                                    style="display: inline; float: left; visibility:hidden" onclick="Unselect_em()"
                                    class="btn btn-danger" value="UNSELECT EMPLOYEE">
                                <label id="add_l"
                                    style="display: inline;float: left; visibility:hidden">&nbsp;&nbsp;</label>
                                <input id="Edit_em" type="button" style="display: inline; float: left; visibility:hidden"
                                    onclick="Edit_assi()" class="btn btn-warning" value="REMOVE ASSIGNMENT">
                            </div>
                        </div>
                        <div class='col-12 col-md-6 p-2' style=' margin-bottom: 15px'>
                            <p id="text_shi" style="visibility:hidden">Selected shifts :</p>
                            <!--<select id='se_shi' style="visibility:hidden" class='form-select' size='12'
                                aria-label='size 3 select example'>
                                <option value=""></option><button>jb</button>
                            </select>-->
                            <!--<br>
                            <br>-->
                            <div id='se_shi' style="height: 300px; overflow: auto;border: solid #aaaaaf;display:none">
                                <ul id="ul_shi" class="list-group">
                                </ul>
                            </div>

                            <input id="clear_btn" type="button" class="btn btn-danger" onclick="Clear_btn()"
                                style="float: right; margin-top:5px; display: none;" value="ClEAR TABLE">
                        </div>
                    </div>

                    <select name="option_sh" id="option_sh">
                        <?php
                        $mysqli2 = require __DIR__ . "/database.php";
                        $sqlsh = " SELECT * FROM list_of_objects ORDER BY object_name";
                        $resultsh = $mysqli2->query($sqlsh);
                        $mysqli2->close();
                        $countersh = 0;
                        while ($rows_sh = mysqli_fetch_assoc($resultsh)) {
                            if (null == $rows_sh['superior_object_name']) {
                                if ($countersh == 0) {
                                    $firstsh = $rows_sh['id_object'];
                                }
                                $countersh++;
                                ?>
                                <option value="<?php echo $rows_sh['id_object'] ?>">
                                    <?php echo $rows_sh['object_name']; ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                    <div id="shift_ex_load">
                    </div>


                    <script>
                        let type_btn = 2;
                        //let sa = JSON.stringify(typsa);
                    </script>
                    <script>

                        var inp0 =
                            <?php echo json_encode($firstsh); ?>;
                        $.ajax({


                            url: "load_existing_shift.php",
                            method: "POST",
                            data: { input: inp0, type: type_btn },
                            success: function (data) {
                                $("#shift_ex_load").html(data);
                            }
                        });

                        $('#option_sh').change(function () {
                            var inp = $(this).val();
                            //alert(sa);
                            $.ajax({


                                url: "load_existing_shift.php",
                                method: "POST",
                                data: { input: inp, type: type_btn },
                                success: function (data) {
                                    $("#shift_ex_load").html(data);
                                }
                            });
                        });
                        /*$('#se_em').change(function () {
                            var inp = $(this).val();
                            alert(inp);
                        });*/
                        function push(vvv) {
                            var ph = document.getElementById("op_em" + vvv).innerText;
                            document.getElementById('search_bar_em').value = ph;
                            document.getElementById('assi_search').innerHTML = "";
                            const selec2 = document.querySelector('#select_em');
                            selec2.value = vvv;
                            em_sel = vvv;
                            document.getElementById('sel_text_em').innerText = ph;
                            document.getElementById('search_bar_em').readOnly = true;
                            document.getElementById('select_em').disabled = true;
                            document.getElementById('Right_em').style.visibility = "visible";
                            document.getElementById('Edit_em').style.visibility = "visible";
                            document.getElementById('Unselect_em').style.visibility = "visible";
                            document.getElementById('text_inf_em').style.visibility = "visible";
                            document.getElementById('sel_text_em').style.visibility = "visible";
                            document.getElementById('se_shi').style.display = "";
                            document.getElementById('text_shi').style.visibility = "visible";
                            //document.getElementById('p_assi').style.display = "";
                            document.getElementById('assignment').style.display = "";
                            document.getElementById('clear_btn').style.display = "";

                            //alert(vvv);
                            $.ajax({
                                url: "load_assignment_employee.php",
                                method: "POST",
                                data: { input: em_sel },
                                success: function (data) {
                                    //$("#searchresult").css("display", "inline");
                                    $("#assignment").html(data);
                                    //alert(data);
                                }
                            });

                        }
                        function Unselect_em() {
                            document.getElementById('search_bar_em').readOnly = false;
                            document.getElementById('select_em').disabled = false;
                            document.getElementById('Right_em').style.visibility = "hidden";
                            document.getElementById('Edit_em').style.visibility = "hidden";
                            document.getElementById('Unselect_em').style.visibility = "hidden";
                            document.getElementById('select_em').value = 0;
                            document.getElementById('search_bar_em').value = "";
                            document.getElementById('text_inf_em').style.visibility = "hidden";
                            document.getElementById('sel_text_em').style.visibility = "hidden";
                            document.getElementById('se_shi').style.display = "none";
                            document.getElementById('text_shi').style.visibility = "hidden";
                            //document.getElementById('p_assi').style.display = "none";
                            document.getElementById('assignment').style.display = "none";
                            document.getElementById('clear_btn').style.display = "none";
                            em_sel = 0;


                        }
                        function Add_right_em() {
                            $.ajax({
                                url: "add_em_right.php",
                                method: "POST",
                                data: { id: shiarr, name: shiname, id_user: em_sel },
                                success: function (data) {
                                    //$("#manager_search").css("display", "inline");
                                    //$("#assi_search").html(data);
                                    alert("Shifts were assigned successfully");
                                }
                            });
                            $.ajax({
                                url: "load_assignment_employee.php",
                                method: "POST",
                                data: { input: em_sel },
                                success: function (data) {
                                    //$("#searchresult").css("display", "inline");
                                    $("#assignment").html(data);
                                    //alert(data);
                                }
                            });
                        }
                        $("#search_bar_em").keyup(function () {

                            var input = $(this).val();
                            if (input != null) {

                                $.ajax({
                                    url: "employee_search.php",
                                    method: "POST",
                                    data: { input: input },
                                    success: function (data) {
                                        //$("#manager_search").css("display", "inline");
                                        $("#assi_search").html(data);
                                    }
                                });
                            }
                        });
                        var shiarr = new Array();
                        var shiname = new Array();
                        function Select_sh(click) {
                            if (em_sel != 0) {
                                //alert(click);
                                var z = click.substring(5);
                                //var x = document.getElementById("se_shi");
                                if (document.getElementById("li_shi-" + z) == null) {
                                    var xx = document.getElementById("ul_shi");
                                    //var option = document.createElement("option");
                                    var optionx = document.createElement("li");
                                    //var  = document.createElement("option");
                                    var g = document.getElementById("h_shi-" + z).innerHTML;
                                    var w = document.getElementById("h_obj-" + z).innerHTML;
                                    //alert(g);
                                    //option.innerHTML = "<div id='div_shi-"+click+"'><p>"+g+"<input class='btn btn-danger' type='button' value='X' style='paddling:0px;font: 1px Arial,width: 24px;height: 24px; float: right'>*/</p></div>";
                                    //option.innerHTML = "<div id='div_shi-"+click+"'><p>"+g+"<button class='btn btn-danger' onclick='arra()' style='float: right'><i class='bi bi-trash'></i></button></p></div>";
                                    // option.value = z;
                                    shiarr.push(z);
                                    shiname.push(g);
                                    optionx.innerHTML = "<div id='div_shi-" + z + "'><p>" + w + "" + g + "<button id='de_shi-" + z + "' class='btn btn-danger' onclick='Delete_shi(this.id)' style='float: right'><i class='bi bi-trash'></i></button></p></div>";
                                    //option.disabled = true;
                                    optionx.setAttribute("id", "li_shi-" + z);
                                    optionx.classList.add("list-group-item");
                                    //x.add(option);
                                    //xx.add(optionx);
                                    xx.appendChild(optionx);
                                    //alert(shiname);
                                }
                                //document.getElementById("div_shi-"+z).innerHTML = "<input type='button' value='Remove' style='float: right'>";
                            }

                        }
                        function Delete_shi(click_d) {
                            var z = click_d.substring(7);
                            document.getElementById("li_shi-" + z).remove();
                            for (let i = 0; i < shiarr.length; i++) {
                                if (shiarr[i] === z) {
                                    shiarr.splice(i, 1);
                                    shiname.splice(i, 1);
                                    //console.log("Removed element: " + spliced);
                                    //console.log("Remaining elements: " + arr);
                                }
                            }
                            //alert(shiname);
                            //alert(z);
                        }
                        function Edit_assi() {
                            //id_shift = clicked_id.substring(5);
                            var modal = document.getElementById("myModal");
                            var span = document.getElementsByClassName("close")[0];
                            modal.style.display = "block";
                            $.ajax({
                                    url: "edit_assignment.php",
                                    method: "POST",
                                    data: { input: em_sel },
                                    success: function (data) {
                                        //$("#manager_search").css("display", "inline");
                                        $("#mdiv").html(data);
                                    }
                                });
                        }
                        function Delete_assi(click) {
                            var id_btn =click.substring(2);
                            $.ajax({
                                    url: "delete_assignment.php",
                                    method: "POST",
                                    data: { input: em_sel, id : id_btn },
                                    success: function (data) {
                                        //$("#manager_search").css("display", "inline");
                                        //$("#mdiv").html(data);
                                        //alert(data);
                                    }
                                });
                            $.ajax({
                                    url: "edit_assignment.php",
                                    method: "POST",
                                    data: { input: em_sel },
                                    success: function (data) {
                                        //$("#manager_search").css("display", "inline");
                                        $("#mdiv").html(data);
                                    }
                                });
                                $.ajax({
                                url: "load_assignment_employee.php",
                                method: "POST",
                                data: { input: em_sel },
                                success: function (data) {
                                    //$("#searchresult").css("display", "inline");
                                    $("#assignment").html(data);
                                    //alert(data);
                                }
                            });
                            //alert(id_btn);
                        }
                        function Clear_btn() {
                            if (shiarr.length > 0) {
                                for (let i = 0; i < shiarr.length; i++) {
                                    document.getElementById("li_shi-" + shiarr[i]).remove();
                                }
                                shiarr = [];
                                shiname = [];
                                //alert(shiarr);
                            }

                        }
                        //document.getElementById("div_shi-"+z).innerHTML = "<input type='button' value='Remove' style='float: right'>";

                    </script>

                    <br>
                </div>
            </div>

            <script>
                function Open_edit(dkas) {

                }
                //$(document).ready(function(){
                //var input_obj = getElementById('select_obj').value;
                //var input_obj = getElementById('select_obj').value;
                //alert("ff");
                //var ChA = JSON.parse(input);
                var input_obj =
                    <?php echo json_encode($pick); ?>;
                //alert(input_obj);
                $.ajax({
                    url: "load_object_in_rights.php",
                    method: "POST",
                    data: { input: input_obj },
                    success: function (data) {
                        //$("#searchresult").css("display", "inline");
                        $("#object").html(data);
                        //alert(data);
                    }
                });





                $("#search_bar").keyup(function () {

                    var input = $(this).val();
                    //var qkk = "kldsa";
                    //var btna = "lasds";
                    //alert(input);
                    //alert("hello");
                    //if(input != ""){
                    //alert(input);
                    if (input != null) {

                        $.ajax({
                            url: "manager_search.php",
                            method: "POST",
                            data: { input: input },
                            success: function (data) {
                                $("#manager_search").css("display", "inline");
                                $("#manager_search").html(data);
                            }
                        });
                        /*}else{
                          $("#searchresult").css("display", "none");
                        }*/
                    }
                });
                //});
                var man_sel;
                function Unselect() {
                    document.getElementById('sel_text').style.visibility = "hidden";
                    document.getElementById('add_l').style.visibility = "hidden";
                    document.getElementById('Right').style.visibility = "hidden";
                    document.getElementById('Edit').style.visibility = "hidden";
                    document.getElementById('Unselect').style.visibility = "hidden";
                    document.getElementById('p_right').style.visibility = "hidden";
                    document.getElementById('text_inf').style.visibility = "hidden";
                    document.getElementById('select_obj').style.visibility = "hidden";
                    document.getElementById('search_bar').readOnly = false;
                    document.getElementById('select_man').disabled = false;
                    document.getElementById('right').innerHTML = "";
                    document.getElementById('select_man').value = 0;
                    document.getElementById('search_bar').value = "";
                    document.getElementById('tree').style.display = "none";
                    document.getElementById('r1').style.display = "none";
                    document.getElementById('r2').style.display = "none";
                    document.getElementById('lr1').style.visibility = "hidden";
                    document.getElementById('lr2').style.visibility = "hidden";
                    document.getElementById('sel_obj').style.display = "none";

                    man_sel = 0;
                    previous = 0;
                    var t = 1;
                    barr = [];
                    document.getElementById("spa1m").style.backgroundColor = '';
                    document.getElementById("spa1m").style.color = '';
                    document.getElementById("spa1m").style.border = "";
                    for (; ;) {
                        if (document.getElementById("spa" + t) == null) {
                            break;
                        }

                        document.getElementById("spa" + t).style.backgroundColor = '';
                        document.getElementById("spa" + t).style.color = '';
                        document.getElementById("spa" + t).style.border = "";

                        t++;
                    }
                }

                let barr = new Array();
                function Pick_manger(clicked_id) {
                    let mm = /*clicked_id.substring(8)*/ clicked_id;
                    var ph = document.getElementById("op_man" + clicked_id).innerText;
                    document.getElementById('search_bar').value = ph;
                    document.getElementById('manager_search').innerHTML = "";
                    const selec = document.querySelector('#select_man');
                    selec.value = mm;
                    man_sel = mm;
                    document.getElementById('sel_text').innerText = ph;
                    document.getElementById('search_bar').readOnly = true;
                    document.getElementById('select_man').disabled = true;
                    document.getElementById('text_inf').style.visibility = "visible";
                    document.getElementById('sel_text').style.visibility = "visible";
                    document.getElementById('add_l').style.visibility = "visible";
                    document.getElementById('Right').style.visibility = "visible";
                    document.getElementById('Edit').style.visibility = "visible";
                    document.getElementById('Unselect').style.visibility = "visible";
                    document.getElementById('p_right').style.visibility = "visible";
                    document.getElementById('select_obj').style.visibility = "visible";
                    document.getElementById('tree').style.display = "";
                    document.getElementById('r1').style.display = "";
                    document.getElementById('r2').style.display = "";
                    document.getElementById('lr1').style.visibility = "";
                    document.getElementById('lr2').style.visibility = "";
                    document.getElementById('sel_obj').style.display = "";

                    previous = 0;
                    var t = 1;
                    for (; ;) {
                        if (document.getElementById("spa" + t) == null) {
                            break;
                        }
                        if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa" + t).style.backgroundColor != 'rgb(5, 99, 98)') {
                            document.getElementById("spa" + t).style.backgroundColor = '';
                            document.getElementById("spa" + t).style.color = '';
                            document.getElementById("spa" + t).style.border = "";
                        }

                        t++;
                    }
                    if (document.getElementById("spa1m").style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa1m").style.backgroundColor != 'rgb(5, 99, 98)') {
                        document.getElementById("spa1m").style.backgroundColor = '';
                        document.getElementById("spa1m").style.color = '';
                        document.getElementById("spa1m").style.border = "";
                    }



                    //alert("kjsajk");

                    var b;
                    barr = [];
                    $.ajax({
                        url: "load_rights_man_obj.php",
                        method: "POST",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data: { input: mm },
                        success: function (data) {
                            //$("#searchresult").css("display", "inline");
                            //$("#right").html(data);
                            //alert(data);
                            b = JSON.stringify(data);
                        }
                    });
                    b = b.substring(1, b.length - 1);
                    if (b.length != 0) {

                        barr = b.split(",");
                        for (let u = 0; u < barr.length; u++) {
                            var c = barr[u].length;
                            var f = barr[u];
                            barr[u] = f.substring(1, c - 1);
                        }

                        for (let u = 0; u < barr.length; u++) {
                            //if(document.getElementsByName("s" + barr[u]) == null){
                            //alert("true");
                            var y = document.getElementsByName("s" + barr[u]);
                            if (y[0] != null) {
                                //alert("true");

                                y[0].style.backgroundColor = '#056362';
                                y[0].style.color = '#fff';
                                y[0].style.border = "solid #056362";
                            }
                            //y[0].style.border = "solid #202020";
                            //}
                        }
                    }


                    $.ajax({
                        url: "load_rights_manager.php",
                        method: "POST",
                        data: { input: mm },
                        success: function (data) {
                            //$("#searchresult").css("display", "inline");
                            $("#right").html(data);
                            //alert(data);
                        }
                    });
                    //alert(ph);
                }
                function Mark() {
                    //alert(barr.length);
                    /*for (let u = 0; u < barr.length; u++) {
                        alert(barr[u]);
                    }*/
                    //sleep(2000).then(() => {
                    //if (barr.length != 0) {
                    for (let u = 0; u < barr.length; u++) {
                        //alert(barr[u]);
                    }
                    for (let u = 0; u < barr.length; u++) {
                        //if(document.getElementsByName("s" + barr[u]) == null){
                        //alert("true");
                        var y = document.getElementsByName("s" + barr[u]);
                        if (y[0] != null) {
                            //alert(y[0]);

                            y[0].style.backgroundColor = '#056362';
                            y[0].style.color = '#fff';
                            y[0].style.border = "solid #056362";
                        }
                        //y[0].style.border = "solid #202020";
                        //}
                    }
                    //}

                }

                $('#select_obj').change(function () {
                    var inp = $(this).val();
                    $.ajax({
                        url: "load_object_in_rights.php",
                        method: "POST",
                        data: { input: inp },
                        success: function (data) {
                            //$("#searchresult").css("display", "inline");
                            $("#object").html(data);
                            //alert(data);
                            Mark();
                        }
                    });

                    /*if (barr.length != 0) {
                        for (let u = 0; u < barr.length; u++) {
                            //if(document.getElementsByName("s" + barr[u]) == null){
                            //alert("true");
                            var y = document.getElementsByName("s" + barr[u]);
                            if (y[0] != null) {
                                alert("find");

                                y[0].style.backgroundColor = '#056362';
                                y[0].style.color = '#fff';
                                y[0].style.border = "solid #056362";
                            }
                            //}
                        }
                    }*/
                    //Mark();
                    previous = 0;
                });
                $('#select_man').change(function () {
                    var srch = $(this).val();
                    if (srch != 0) {
                        var ph = document.getElementById("opt_man-" + srch).innerText;
                        document.getElementById('search_bar').value = ph;
                        document.getElementById('manager_search').innerHTML = "";
                        document.getElementById('sel_text').innerText = ph;
                        document.getElementById('sel_text').style.visibility = "visible";
                        man_sel = srch;
                        document.getElementById('search_bar').readOnly = true;
                        document.getElementById('select_man').disabled = true;
                        document.getElementById('text_inf').style.visibility = "visible";
                        //document.getElementById('sel_text').style.visibility = "visible";
                        document.getElementById('add_l').style.visibility = "visible";
                        document.getElementById('Right').style.visibility = "visible";
                        document.getElementById('Edit').style.visibility = "visible";
                        document.getElementById('Unselect').style.visibility = "visible";
                        document.getElementById('p_right').style.visibility = "visible";
                        previous = 0;
                        var t = 1;
                        for (; ;) {
                            if (document.getElementById("spa" + t) == null) {
                                break;
                            }
                            if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa" + t).style.backgroundColor != 'rgb(5, 99, 98)') {
                                document.getElementById("spa" + t).style.backgroundColor = '';
                                document.getElementById("spa" + t).style.color = '';
                                document.getElementById("spa" + t).style.border = "";
                            }
                            //document.getElementById("spa" + t).style.border = "";
                            t++;
                        }
                        if (document.getElementById("spa1m").style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa1m").style.backgroundColor != 'rgb(5, 99, 98)') {
                            document.getElementById("spa1m").style.backgroundColor = '';
                            document.getElementById("spa1m").style.color = '';
                            document.getElementById("spa1m").style.border = "";
                        }
                        var b;
                        barr = [];
                        $.ajax({
                            url: "load_rights_man_obj.php",
                            method: "POST",
                            dataType: "json",
                            cache: false,
                            async: false,
                            data: { input: man_sel },
                            success: function (data) {
                                //$("#searchresult").css("display", "inline");
                                //$("#right").html(data);
                                //alert(data);
                                b = JSON.stringify(data);
                            }
                        });
                        b = b.substring(1, b.length - 1);
                        if (b.length != 0) {

                            barr = b.split(",");
                            for (let u = 0; u < barr.length; u++) {
                                var c = barr[u].length;
                                var f = barr[u];
                                barr[u] = f.substring(1, c - 1);
                            }

                            for (let u = 0; u < barr.length; u++) {
                                //if(document.getElementsByName("s" + barr[u]) == null){
                                //alert("true");
                                var y = document.getElementsByName("s" + barr[u]);
                                if (y[0] != null) {
                                    //alert("true");

                                    y[0].style.backgroundColor = '#056362';
                                    y[0].style.color = '#fff';
                                    y[0].style.border = "solid #056362";
                                }
                                //y[0].style.border = "solid #202020";
                                //}
                            }
                        }


                        $.ajax({
                            url: "load_rights_manager.php",
                            method: "POST",
                            data: { input: man_sel },
                            success: function (data) {
                                //$("#searchresult").css("display", "inline");
                                $("#right").html(data);
                                //alert(data);
                            }
                        });

                    } else {
                        /*document.getElementById('search_bar').value = "";
                        document.getElementById('sel_text').style.visibility = "hidden";*/
                    }
                    //alert(ph);
                });

                var previous;
                function Sel(clicked) {
                    var t = 1;
                    if (click == 2) {
                        for (; ;) {
                            if (document.getElementById("spa" + t) == null) {
                                break;
                            }
                            if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa" + t).style.backgroundColor != 'rgb(5, 99, 98)') {
                                document.getElementById("spa" + t).style.backgroundColor = '';
                                document.getElementById("spa" + t).style.color = '';
                                document.getElementById("spa" + t).style.border = "";
                            }
                            document.getElementById("spa" + t).style.border = "";
                            if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(5, 99, 98)') {
                                document.getElementById("spa" + t).style.border = "solid rgb(5, 99, 98)";
                            }
                            t++;
                        }
                        if (document.getElementById("spa1m").style.backgroundColor == 'rgb(76, 175, 80)' && document.getElementById("spa1m").style.backgroundColor != 'rgb(5, 99, 98)') {
                            document.getElementById("spa1m").style.backgroundColor = '';
                            document.getElementById("spa1m").style.color = '';
                            document.getElementById("spa1m").style.border = "";
                        }
                        document.getElementById("spa1m").style.border = "";
                        if (document.getElementById("spa1m").style.backgroundColor == 'rgb(5, 99, 98)') {
                            document.getElementById("spa1m").style.border = "solid rgb(5, 99, 98)";
                        }
                    }
                    let vjvj = document.getElementById(clicked);
                    ff = clicked.substring(3);

                    if (previous != ff) {
                        if (vjvj.style.backgroundColor != 'rgb(5, 99, 98)') {
                            vjvj.style.backgroundColor = 'rgb(76, 175, 80)';
                            vjvj.style.color = '#fff';
                            vjvj.style.border = "solid #4CAF50";
                        }
                        vjvj.style.border = "solid #202020";
                        var t = 1;
                        if (click == 2) {
                            for (; ;) {
                                if (document.getElementById("spa" + t) == null) {
                                    break;
                                }
                                if (document.getElementById("spa" + t).matches('.tree li input:hover+ul li input ') && document.getElementById("spa" + t).style.backgroundColor != 'rgb(5, 99, 98)') {
                                    document.getElementById("spa" + t).style.backgroundColor = 'rgb(76, 175, 80)';
                                    document.getElementById("spa" + t).style.color = '#fff';
                                    document.getElementById("spa" + t).style.border = "solid #4CAF50";
                                }
                                if (document.getElementById("spa" + t).matches('.tree li input:hover+ul li input ')) {
                                    document.getElementById("spa" + t).style.border = "solid #202020";
                                }
                                t++;
                            }
                            if (document.getElementById("spa1m").matches('.tree li input:hover+ul li input ') && document.getElementById("spa1m").style.backgroundColor != 'rgb(5, 99, 98)') {
                                document.getElementById("spa1m").style.backgroundColor = 'rgb(76, 175, 80)';
                                document.getElementById("spa1m").style.color = '#fff';
                                document.getElementById("spa1m").style.border = "solid #4CAF50";
                            }
                            if (document.getElementById("spa1m").matches('.tree li input:hover+ul li input ')) {
                                document.getElementById("spa1m").style.border = "solid #202020";
                            }
                            //ffa.style.border = "solid #202020";

                        }
                        if (previous != "0" && previous != null) {
                            /*var t = 1;
                            for(;;){
                                if(document.getElementById("spa"+t) == null){
                                    break;
                                }
                                t++;
                                //alert(t);
                            }*/
                            if (click == 1) {
                                var kka = "spa" + previous;
                                //alert(kka);
                                let ffa = document.getElementById(kka);
                                if (ffa.style.backgroundColor != 'rgb(5, 99, 98)') {
                                    ffa.style.color = '';
                                    ffa.style.backgroundColor = '';
                                    ffa.style.border = "";
                                }
                                ffa.style.border = "";
                                if (ffa.style.backgroundColor == 'rgb(5, 99, 98)') {
                                    ffa.style.border = "solid rgb(5, 99, 98)";
                                }
                            }
                        }
                        previous = ff;

                    } else {
                        if (vjvj.style.backgroundColor != 'rgb(5, 99, 98)') {
                            vjvj.style.color = '';
                            vjvj.style.backgroundColor = '';
                            vjvj.style.border = "";
                        }
                        vjvj.style.border = "";
                        if (vjvj.style.backgroundColor == 'rgb(5, 99, 98)') {
                            vjvj.style.border = "solid rgb(5, 99, 98)";
                        }
                        var t = 1;
                        if (click == 2) {
                            for (; ;) {
                                if (document.getElementById("spa" + t) == null) {
                                    break;
                                }
                                if (document.getElementById("spa" + t).matches('.tree li input:hover+ul li input ') && document.getElementById("spa" + t).style.backgroundColor != 'rgb(5, 99, 98)') {
                                    document.getElementById("spa" + t).style.backgroundColor = '';
                                    document.getElementById("spa" + t).style.color = '';
                                    document.getElementById("spa" + t).style.border = "";
                                }
                                document.getElementById("spa" + t).style.border = "";
                                if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(5, 99, 98)') {
                                    document.getElementById("spa" + t).style.border = "solid rgb(5, 99, 98)";
                                }
                                t++;
                            }
                        }
                        previous = 0;
                    }
                }
                function Edit() {
                    var type = 1;
                    var rr = 0;
                    if (previous != "0" && previous != null) {
                        if (man_sel != "0" && man_sel != null) {
                            var id_ob = document.getElementById("shi" + previous).value;
                            var name_ob = document.getElementById("spa" + previous).value;
                            let sarr = new Array();
                            if (click == 2) {
                                var h = document.getElementById("spa" + previous).name;
                                h = h.substring(1);
                                var m;
                                $.ajax({
                                    type: "POST",
                                    url: "look_for_sub_object.php",
                                    dataType: "json",
                                    cache: false,
                                    async: false,
                                    data: {
                                        input: h
                                    },
                                    success: function (data) {
                                        m = JSON.stringify(data);
                                    }
                                });
                                m = m.substring(1, m.length - 1);
                                if (m.length != 0) {
                                    sarr = m.split(",");
                                    for (let u = 0; u < sarr.length; u++) {
                                        var c = sarr[u].length;
                                        var f = sarr[u];
                                        sarr[u] = f.substring(1, c - 1);
                                    }
                                }
                            }


                            $.ajax({
                                url: "add_man_right.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { id_user: man_sel, id_object: id_ob, name_object: name_ob, branch: click, arr: sarr, type: type },
                                success: function (data) {
                                    alert("Rights removed successfully");
                                }
                            });
                            var t = 1;
                            for (; ;) {
                                if (document.getElementById("spa" + t) == null) {
                                    break;
                                }
                                document.getElementById("spa" + t).style.backgroundColor = '';
                                document.getElementById("spa" + t).style.color = '';
                                document.getElementById("spa" + t).style.border = "";

                                /*document.getElementById("spa" + t).style.border = "";
                                if (document.getElementById("spa" + t).style.backgroundColor == 'rgb(5, 99, 98)') {
                                    document.getElementById("spa" + t).style.border = "solid rgb(5, 99, 98)";
                                }*/
                                t++;
                            }
                            document.getElementById("spa1m").style.backgroundColor = '';
                            document.getElementById("spa1m").style.color = '';
                            document.getElementById("spa1m").style.border = "";
                            var b;
                            barr = [];
                            $.ajax({
                                url: "load_rights_man_obj.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { input: man_sel },
                                success: function (data) {
                                    b = JSON.stringify(data);
                                }
                            });
                            b = b.substring(1, b.length - 1);
                            if (b.length != 0) {

                                barr = b.split(",");
                                for (let u = 0; u < barr.length; u++) {
                                    var c = barr[u].length;
                                    var f = barr[u];
                                    barr[u] = f.substring(1, c - 1);
                                }

                                for (let u = 0; u < barr.length; u++) {

                                    var y = document.getElementsByName("s" + barr[u]);
                                    if (y[0] != null) {


                                        y[0].style.backgroundColor = '#056362';
                                        y[0].style.color = '#fff';
                                        y[0].style.border = "solid #056362";
                                    }

                                }
                            }
                            $.ajax({
                                url: "load_rights_manager.php",
                                method: "POST",
                                data: { input: man_sel },
                                success: function (data) {
                                    $("#right").html(data);
                                }
                            });
                        }

                    }
                }


                function Add_right() {
                    var type = 0;
                    var rr = 0;
                    if (previous != "0" && previous != null) {
                        if (man_sel != "0" && man_sel != null) {
                            var id_ob = document.getElementById("shi" + previous).value;
                            var name_ob = document.getElementById("spa" + previous).value;
                            let sarr = new Array();
                            if (click == 2) {
                                var h = document.getElementById("spa" + previous).name;
                                h = h.substring(1);
                                var m;
                                $.ajax({
                                    type: "POST",
                                    url: "look_for_sub_object.php",
                                    dataType: "json",
                                    cache: false,
                                    async: false,
                                    data: {
                                        input: h
                                    },
                                    success: function (data) {
                                        m = JSON.stringify(data);
                                    }
                                });
                                m = m.substring(1, m.length - 1);
                                if (m.length != 0) {
                                    sarr = m.split(",");
                                    for (let u = 0; u < sarr.length; u++) {
                                        var c = sarr[u].length;
                                        var f = sarr[u];
                                        sarr[u] = f.substring(1, c - 1);
                                    }
                                }
                            }



                            //alert("went");
                            $.ajax({
                                url: "add_man_right.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { id_user: man_sel, id_object: id_ob, name_object: name_ob, branch: click, arr: sarr, type: type },
                                success: function (data) {
                                    //$("#searchresult").css("display", "inline");
                                    //$("#object").html(data);
                                    //alert(data);
                                    alert("Saved successfully");
                                    //alert();
                                }
                            });
                            //alert("Saved successfully");
                            var b;
                            barr = [];
                            $.ajax({
                                url: "load_rights_man_obj.php",
                                method: "POST",
                                dataType: "json",
                                cache: false,
                                async: false,
                                data: { input: man_sel },
                                success: function (data) {
                                    b = JSON.stringify(data);
                                }
                            });
                            b = b.substring(1, b.length - 1);
                            if (b.length != 0) {

                                barr = b.split(",");
                                for (let u = 0; u < barr.length; u++) {
                                    var c = barr[u].length;
                                    var f = barr[u];
                                    barr[u] = f.substring(1, c - 1);
                                }

                                for (let u = 0; u < barr.length; u++) {

                                    var y = document.getElementsByName("s" + barr[u]);
                                    if (y[0] != null) {


                                        y[0].style.backgroundColor = '#056362';
                                        y[0].style.color = '#fff';
                                        y[0].style.border = "solid #056362";
                                    }

                                }
                            }
                            $.ajax({
                                url: "load_rights_manager.php",
                                method: "POST",
                                data: { input: man_sel },
                                success: function (data) {
                                    //$("#searchresult").css("display", "inline");
                                    $("#right").html(data);
                                    //alert(data);
                                }
                            });
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
            <br>
            <br>
            <br>
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

        <?php else: ?>
        <?php endif; ?>
</body>

</html>