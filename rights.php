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
                            <Select id="select_man" style="display: inline">
                                <option id="opt_man-0" value="0">Pick a manager</option>
                                <?php
                                $mysqli = require __DIR__ . "/database.php";

                                $conn = new mysqli($host, $username, $password, $dbname);
                                $query = "SELECT * FROM user2 WHERE position='manager' ";
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
                                            <?php echo $firstname . " " . $middlename . " " . $lastname; ?>
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
                            <br>
                            <br>
                            <p id="sel_text" style="visibility:hidden"></p>
                            <br>
                            <br>
                                <p>Users rights:</p>
                                <div id="right">

                                </div>
                            <div class="sticky-bottom">
                                <input type="button" onclick="Add_right()" class="btn btn-primary" style="float:right;"  value="ADD RIGHTS">
                                </div>

                        </div>
                        <div class='col-12 col-md-6 p-2' style='margin-bottom: 15px'>
                            <br>
                            <br>
                            <p>Select OBJECT :</p>
                            <Select id="select_obj" style="display: inline">
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
                            <div class="tree">
                                <div id="object">

                                </div>
                            </div>
                            <input type="radio" name="r" id="r1" checked>
                            <label for="r1">With sub-objects</label>
                            <input type="radio" name="r" id="r2">
                            <label for="r2">Without sub-objects</label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>

            <script>
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
                function Pick_manger(clicked_id) {
                    let mm = clicked_id.substring(8);
                    var ph = document.getElementById(clicked_id).value;
                    document.getElementById('search_bar').value = ph;
                    document.getElementById('manager_search').innerHTML = "";
                    const selec = document.querySelector('#select_man');
                    selec.value = mm;
                    man_sel = mm;
                    document.getElementById('sel_text').innerText = "Selected manager - " + ph + "";
                    document.getElementById('sel_text').style.visibility = "visible";
                    alert("kjsajk");
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
                        }
                    });
                });
                $('#select_man').change(function () {
                    var srch = $(this).val();
                    if (srch != 0) {
                        var ph = document.getElementById("opt_man-" + srch).innerText;
                        document.getElementById('search_bar').value = ph;
                        document.getElementById('manager_search').innerHTML = "";
                        document.getElementById('sel_text').innerText = "Selected manager - " + ph + "";
                        document.getElementById('sel_text').style.visibility = "visible";
                        man_sel =srch;
                    } else {
                        document.getElementById('search_bar').value = "";
                        document.getElementById('sel_text').style.visibility = "hidden";
                    }
                    //alert(ph);
                });

                var previous;
               function Sel(clicked) {
                    let vjvj = document.getElementById(clicked);
                    ff = clicked.substring(3);
                    if (previous != ff) {
                        vjvj.style.backgroundColor = '#4CAF50';
                        vjvj.style.color = '#fff';
                        vjvj.style.border = "solid #4CAF50";
                        //alert(ff);]

                        if (previous != "0" && previous != null) {

                            var kka = "spa" + previous;
                            //alert(kka);
                            let ffa = document.getElementById(kka);
                            ffa.style.color = '';
                            ffa.style.backgroundColor = '';
                            ffa.style.border = "";
                        }
                        previous = ff;

                    } else {
                        //alert("succes");
                        vjvj.style.color = '';
                        vjvj.style.backgroundColor = '';
                        vjvj.style.border = "";

                        previous = 0;
                    }
                }


                function Add_right(){
                    var rr = 0;
                    if(previous != "0" && previous != null ){
                        if(man_sel != "0" && man_sel != null){
                          var id_ob =  document.getElementById("shi" + previous).value;
                          var name_ob =  document.getElementById("spa" + previous).value;
                    $.ajax({
                    url: "add_man_right.php",
                    method: "POST",
                    data: { id_user: man_sel, id_object : id_ob, name_object : name_ob },
                    success: function (data) {
                        //$("#searchresult").css("display", "inline");
                        //$("#object").html(data);
                        //alert(data);
                        alert("Saved successfully");
                    }
                });
            }
            
            }
                }
            </script>
        <?php else: ?>
        <?php endif; ?>
</body>

</html>