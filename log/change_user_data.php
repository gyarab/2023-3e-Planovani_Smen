<?php

$cons = "";
session_start();

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

<!--source : https://www.youtube.com/watch?v=5L9UhOnuos0  -->
<html>

<head>
    <title>Change user data</title>
    <meta charset="UTF-8">
    <script src="/js/validation.js" defer></script>
    <link rel="stylesheet" href="../css/main_page.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/logout.css">
    <style>
        .forms {
            border-color: black;
        }
    </style>
</head>

<body id="body">
<?php if (isset($user) && $userp == "admin"): ?>

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
    <script src="js/main_page.js"></script>

    <br>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <div class="container">

        <div class="forms">
            <br>
            <h1>Change user data</h1>
            <br>
            <p>Select employee :</p>
            <input id="search_bar_em" type="text" size="20" autocomplete="off" style="display: inline"
                style='margin-bottom: 15px' placeholder="Search for employee">
            <p style="display: inline"> OR </p>
            <Select id="select_em" style="display: inline">
                <option id="opt_man-0" value="0">Pick a employee</option>
                <?php
                /** nacteni vsech uzivatelu do select boxu */
                $mysqli = require ("../database.php");

                $conn = new mysqli($host, $username, $password, $dbname);
                $query7 = "SELECT * FROM user ORDER BY lastname, firstname ";
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
            <button id="unselect" style="display: none;margin-left: 15px" onclick="Unselect()"
                class="btn btn-danger">Unselect</button>
            <script>
                /** vyhledavani uzivatelu pres searchbar */
                $("#search_bar_em").keyup(function () {

                    var input = $(this).val();
                    if (input != null) {

                        $.ajax({
                            url: "../search/employee_search.php",
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
                        document.getElementById("invis_div").style.display = "";

                        usid = srch;
                        get_info();

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
                    document.getElementById("invis_div").style.display = "";

                    usid = vvv;
                    get_info();



                }
                function Unselect() {
                    document.getElementById('search_bar_em').readOnly = false;
                    document.getElementById('select_em').disabled = false;
                    document.getElementById('select_em').value = 0;
                    document.getElementById('search_bar_em').value = "";
                    document.getElementById("unselect").style.display = "none";
                    document.getElementById("invis_div").style.display = "none";

                }
                return_var = new Array();
                function get_info() {
                    document.getElementById('firstname').value = "";
                    document.getElementById('middlename').value = "";
                    document.getElementById('lastname').value = "";
                    document.getElementById('email').value = "";
                    document.getElementById('phone').value = "";

                    document.getElementById("admin").checked = false;


                    document.getElementById("manager").checked = false;

                    document.getElementById("full-time_employee").checked = false;

                    document.getElementById("part-time_employee").checked = false;

                    return_var = [];
                    $.ajax({
                        url: "../log/get_user_info.php",
                        method: "POST",
                        dataType: "json",
                        cache: false,
                        async: false,
                        data: { id: usid },
                        success: function (data) {
                            return_var = data;


                        }
                    });
                    usid = return_var[0];
                    document.getElementById('firstname').value = return_var[1];
                    document.getElementById('middlename').value = return_var[2];
                    document.getElementById('lastname').value = return_var[3];
                    document.getElementById('email').value = return_var[4];
                    document.getElementById('phone').value = return_var[6];
                    document.getElementById('countryCode').value = return_var[5];
                    if (return_var[7] == "admin") {
                        document.getElementById("admin").checked = true;

                    } else if (return_var[7] == "manager") {
                        document.getElementById("manager").checked = true;
                    } else if (return_var[7] == "fulltime_employee") {
                        document.getElementById("full-time_employee").checked = true;
                    } else {
                        document.getElementById("part-time_employee").checked = true;
                    }



                }
                function update_data() {
                    let firstname = document.getElementById("firstname").value;
                    let lastname = document.getElementById("lastname").value;
                    let middlename = document.getElementById("middlename").value;
                    let email = document.getElementById("email").value;
                    let password = document.getElementById("password").value;
                    let password_confirmation = document.getElementById("password_confirmation").value;
                    let countryCode = document.getElementById("countryCode").value;
                    let phone = document.getElementById("phone").value;
                    var position;
                    var ele = document.getElementsByName('pos');

                    for (i = 0; i < ele.length; i++) {
                        if (ele[i].checked) {
                            position = ele[i].value;
                        }
                    }
                    var status;
                    $.ajax({
                        url: "../log/add_user.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            firstname: firstname, lastname: lastname, middlename: middlename, email: email,
                            password: password, password_confirmation: password_confirmation, countryCode: countryCode, phone: phone, position: position
                        },
                        cache: false,
                        async: false,
                        success: function (data) {

                            status = data;
                            status = status.split(",");
                        }


                    });
                }
            </script>
            <div id="assi_search" style="width:550px">

            </div>
            <br>
            <br>
            <br>

            <div id="invis_div" style="display:none">
                <div class="row">
                    <div class='col-12 col-md-6'>
                        <div class="form-group">
                            <h6 for="firstname">First name</h6>

                            <input type="text" id="firstname" name="firstname" class="form-control"
                                placeholder="Enter your fisrt name" value="">
                            <small id="firstnameh" class="form-text" style="color: red;visibility:hidden">*First name is
                                required</small>

                        </div>
                    </div>
                    <div class='col-12 col-md-6'>

                        <div class="form-group">
                            <h6 for="lastname">Last name</h6>

                            <input type="text" id="lastname" name="lastname" class="form-control"
                                placeholder="Enter your last name" value="">
                            <small id="lastnameh" class="form-text" style="color: red;visibility:hidden">*Last name is
                                required</small>

                        </div>
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class='col-12 col-md-6'>
                        <div class="form-group">
                            <h6 for="middlename">Middle name</h6>

                            <input type="text" id="middlename" name="middlename" class="form-control"
                                placeholder="Enter your middle name" value="">
                        </div>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class='col-12 col-md-6'>
                        <div class="form-group">
                            <h6 for="email">Email</h6>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email" value="" readOnly="true">
                            <small id="emailh" class="form-text" style="color: red;visibility:hidden">*</small>

                        </div>

                        <h6 for="countryCode">Phone</h6>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <select name="countryCode" id="countryCode" class="form-select" value="">
                                    <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
                                    <option data-countryCode="SK" value="421">Slovakia (+421)</option>
                                    <optgroup label="Other countries">
                                        <option style="background-image:url(france.png);" data-countryCode="DZ"
                                            value="213">
                                            Algeria
                                            (+213)</option>
                                        <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                        <option data-countryCode="AO" value="244">Angola (+244)</option>
                                        <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                        <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)
                                        </option>
                                        <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                        <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                        <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                        <option data-countryCode="AU" value="61">Australia (+61)</option>
                                        <option data-countryCode="AT" value="43">Austria (+43)</option>
                                        <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                        <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                        <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                        <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                        <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                        <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                        <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                        <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                        <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                        <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                        <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                        <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                        <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                        <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                        <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                        <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                        <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                        <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                        <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                        <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                        <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                        <option data-countryCode="CA" value="1">Canada (+1)</option>
                                        <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                        <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                        <option data-countryCode="CF" value="236">Central African Republic (+236)
                                        </option>
                                        <option data-countryCode="CL" value="56">Chile (+56)</option>
                                        <option data-countryCode="CN" value="86">China (+86)</option>
                                        <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                        <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                        <option data-countryCode="CG" value="242">Congo (+242)</option>
                                        <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                        <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                        <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                        <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                        <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                        <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                        <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
                                        <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                        <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                        <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                        <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                        <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                        <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                        <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                        <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                        <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                        <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                        <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                        <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                        <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                        <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                        <option data-countryCode="FI" value="358">Finland (+358)</option>
                                        <option data-countryCode="FR" value="33">France (+33)</option>
                                        <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                        <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                        <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                        <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                        <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                        <option data-countryCode="DE" value="49">Germany (+49)</option>
                                        <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                        <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                        <option data-countryCode="GR" value="30">Greece (+30)</option>
                                        <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                        <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                        <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                        <option data-countryCode="GU" value="671">Guam (+671)</option>
                                        <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                        <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                        <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                        <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                        <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                        <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                        <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                        <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                        <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                        <option data-countryCode="IN" value="91">India (+91)</option>
                                        <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                        <option data-countryCode="IR" value="98">Iran (+98)</option>
                                        <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                        <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                        <option data-countryCode="IL" value="972">Israel (+972)</option>
                                        <option data-countryCode="IT" value="39">Italy (+39)</option>
                                        <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                        <option data-countryCode="JP" value="81">Japan (+81)</option>
                                        <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                        <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                        <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                        <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                        <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                        <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                        <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                        <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                        <option data-countryCode="LA" value="856">Laos (+856)</option>
                                        <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                        <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                        <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                        <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                        <option data-countryCode="LY" value="218">Libya (+218)</option>
                                        <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                        <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                        <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                        <option data-countryCode="MO" value="853">Macao (+853)</option>
                                        <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                        <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                        <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                        <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                        <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                        <option data-countryCode="ML" value="223">Mali (+223)</option>
                                        <option data-countryCode="MT" value="356">Malta (+356)</option>
                                        <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                        <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                        <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                        <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                        <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                        <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                        <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                        <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                        <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                        <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                        <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                        <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                        <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                        <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                        <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                        <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                        <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                        <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                        <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                        <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                        <option data-countryCode="NE" value="227">Niger (+227)</option>
                                        <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                        <option data-countryCode="NU" value="683">Niue (+683)</option>
                                        <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                        <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                        <option data-countryCode="NO" value="47">Norway (+47)</option>
                                        <option data-countryCode="OM" value="968">Oman (+968)</option>
                                        <option data-countryCode="PW" value="680">Palau (+680)</option>
                                        <option data-countryCode="PA" value="507">Panama (+507)</option>
                                        <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                        <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                        <option data-countryCode="PE" value="51">Peru (+51)</option>
                                        <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                        <option data-countryCode="PL" value="48">Poland (+48)</option>
                                        <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                        <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                        <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                        <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                        <option data-countryCode="RO" value="40">Romania (+40)</option>
                                        <option data-countryCode="RU" value="7">Russia (+7)</option>
                                        <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                        <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                        <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)
                                        </option>
                                        <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                        <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                        <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                        <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                        <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                        <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                        <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                        <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                        <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                        <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                        <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                        <option data-countryCode="ES" value="34">Spain (+34)</option>
                                        <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                        <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                        <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                        <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                        <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                        <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                        <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                        <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                        <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                        <option data-countryCode="SI" value="963">Syria (+963)</option>
                                        <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                        <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                        <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                        <option data-countryCode="TG" value="228">Togo (+228)</option>
                                        <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                        <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)
                                        </option>
                                        <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                        <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                        <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                        <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                        <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)
                                        </option>
                                        <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                        <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                        <option data-countryCode="GB" value="44">UK (+44)</option>
                                        <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                        <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                        <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                        <option data-countryCode="US" value="1">USA (+1)</option>
                                        <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                        <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                        <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                        <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                        <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                        <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)
                                        </option>
                                        <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                        <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                        <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                        <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                        <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                        <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                        <option ng- data-countryCode="aa" value="45654">Zimbabwe (+263)</option>
                                    </optgroup>
                                    <script type="text/javascript">

                                    </script>
                                </select>


                                <input id="phone" type="text" name="phone" class="form-control"
                                    placeholder="Enter your phone number">

                            </div>
                            <div class="form-group">
                                <small id="phoneh" class="form-text" style="color: red;visibility:hidden">*</small>
                            </div>
                        </div>


                    </div>
                    <div class='col-12 col-md-6'>
                        <div class="form-group">
                            <h6 for="password">New password</h6>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter your password">
                            <small id="passwordh" class="form-text" style="color: red;visibility:hidden">*</small>
                        </div>

                        <div class="form-group">
                            <h6 for="password_confirmation">Repeat password</h6>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Enter your password again" class="form-control" value="">
                            <small id="password_confirmationh" class="form-text"
                                style="color: red;visibility:hidden">*</small>
                        </div>
                    </div>
                </div>

                <h6 for="position">Position</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pos" id="full-time_employee"
                        value="fulltime_employee" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Full-time employee
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pos" id="part-time_employee"
                        value="parttime_employee">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Part-time employee
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pos" id="manager" value="manager">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Manager
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pos" id="admin" value="admin">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Admin
                    </label>
                </div>
                <div>
                    <br>
                    <br>
                    <button class="btn btn-primary" name="btnSubmit" style="float:right" onclick="change_data() ">Change
                        user data
                        up</button>



                </div>
            </div>
        </div>
        <script>
            function change_data() {
                let firstname = document.getElementById("firstname").value;
                let lastname = document.getElementById("lastname").value;
                let middlename = document.getElementById("middlename").value;
                let email = document.getElementById("email").value;
                let password = document.getElementById("password").value;
                let password_confirmation = document.getElementById("password_confirmation").value;
                let countryCode = document.getElementById("countryCode").value;
                let phone = document.getElementById("phone").value;
                var position;
                var ele = document.getElementsByName('pos');

                for (i = 0; i < ele.length; i++) {
                    if (ele[i].checked) {
                        position = ele[i].value;
                    }
                }


                var status;

                $.ajax({
                    url: "../log/update_user.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: usid, firstname: firstname, lastname: lastname, middlename: middlename, email: email,
                        password: password, password_confirmation: password_confirmation, countryCode: countryCode, phone: phone, position: position
                    },
                    cache: false,
                    async: false,
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


                if (stringArray.length == 0) {

                    success_alert("Account was successfully edited ");
                    document.getElementById("firstnameh").style.visibility = "hidden";
                    document.getElementById("lastnameh").style.visibility = "hiiden";
                    document.getElementById("emailh").style.visibility = "hidden";
                    document.getElementById("passwordh").style.visibility = "hidden";
                    document.getElementById("password_confirmationh").style.visibility = "hidden";
                    document.getElementById("phoneh").style.visibility = "hidden";
                } else {

                    document.getElementById("firstnameh").style.visibility = "hidden";
                    document.getElementById("lastnameh").style.visibility = "hiiden";
                    document.getElementById("emailh").style.visibility = "hidden";
                    document.getElementById("passwordh").style.visibility = "hidden";
                    document.getElementById("password_confirmationh").style.visibility = "hidden";
                    document.getElementById("phoneh").style.visibility = "hidden";
                    for (var i = 0; i < stringArray.length; i++) {
                        if (stringArray[i] == 1) {
                            document.getElementById("firstnameh").style.visibility = "visible";

                        } else if (stringArray[i] == 2) {
                            document.getElementById("lastnameh").style.visibility = "visible";
                        } else if (stringArray[i] == 3) {
                            document.getElementById("emailh").style.visibility = "visible";
                            document.getElementById("emailh").innerText = "*Invalid email format";
                        } else if (stringArray[i] == 10) {
                            document.getElementById("emailh").style.visibility = "visible";
                            document.getElementById("emailh").innerText = "*Email already registered";
                        } else if (stringArray[i] == 4) {
                            document.getElementById("passwordh").style.visibility = "visible";
                            document.getElementById("passwordh").innerText = "*Password needs to be at least 8 charaters long";
                        } else if (stringArray[i] == 5 || stringArray[i] == 6 || stringArray[i] == 7) {
                            document.getElementById("passwordh").style.visibility = "visible";
                            document.getElementById("passwordh").innerText = "*Password needs to contain one uppercase and lowercase letter and one number ";
                        } else if (stringArray[i] == 8) {
                            document.getElementById("password_confirmationh").style.visibility = "visible";
                            document.getElementById("password_confirmationh").innerText = "*Passwords do not match";
                        } else if (stringArray[i] == 9) {
                            document.getElementById("phoneh").style.visibility = "visible";
                            document.getElementById("phoneh").innerText = "*Phone number cannot contain letters";
                        }


                    }
                }

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