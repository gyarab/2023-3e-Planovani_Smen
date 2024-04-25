<?php
//$path = $_SERVER['DOCUMENT_ROOT'] . "/database.php";
//$mysqli = require ($path);
//$mysqli = include( __DIR__ . '/database.php');
//echo "hello";
//$path = $_SERVER['DOCUMENT_ROOT'] . "/database.php";
$cons = "";
session_start();
if (isset($_SESSION["user2_id"])) {
    //echo $_SESSION["user2_id"];

    //$mysqli = require('../database.php');
    //$mysqli = include( __DIR__ . '/database.php');
    /*try {
        require(__DIR__ . '/database.php');
    } catch (\Throwable $e) {
        echo "This was caught: " . $e->getMessage();
    }
    echo " End of script.";*/
    //$mysqli = require($_SERVER['DOCUMENT_ROOT']."/database.php");
    //$mysqli1 = include( __DIR__ . '/database.php');
    $conn = new mysqli($host, $username, $password, $dbname);

    //echo"123";
    echo"123-";
    $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";

    //$result = $mysqli->query($sql);
    $result = mysqli_query($conn, $sql);
    echo"-123";
    //echo $_SESSION["user2_id"];
    $user = mysqli_fetch_assoc($result);

    echo"123";
    $sqlp = "SELECT position, id FROM user2 WHERE id = {$_SESSION["user2_id"]}";
    //$resultp = $mysqli->query($sqlp);
    $fetch = mysqli_query($conn, $sqlp);
    while ($rrr = mysqli_fetch_assoc($fetch)) {
        $userp = $rrr['position'];
        $userid = $rrr['id'];

    }
    echo "---";
    echo $userp ;
    echo "---";
    echo $userid ;
    //$mysqli->close();
}

//$mysqli1 = require( __DIR__ . '/database.php');
//$mysqli1 = include( __DIR__ . '/database.php');
//$sql1 = " SELECT * FROM user2 ORDER BY id DESC ";
//$result1 = $mysqli->query($sql1);
/*$mysqli1->close();*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <p><?php echo $path; ?> --- <?php echo $userid ; ?></p>
    <script>
        var val = 0;
        $.ajax({
            url: "../delete_ips.php",
            method: "POST",
            data: { id: val },
            success: function (data) {
                alert(data);
              
            }
        })

    </script>

</body>

</html>