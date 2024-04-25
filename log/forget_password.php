<?php
/** main login page */
$is_invalid = false;/** var that checks if email and password is valid */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    /**connection to database */
    //$mysqli = require __DIR__ . "/database.php";
    $mysqli = require("../database.php");
    $conn = new mysqli($host, $username, $password, $dbname);
    /**code that checks if email is in database */
    $sql = sprintf("SELECT * FROM user2
                    WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );


    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();


    if ($user) {

        /**vertification of password with password hash*/
        //if (password_verify($_POST["password"], $user["password_hash"])) {

            //session_start();

            //session_regenerate_id();
            /** start of global sessions*/
            //$_SESSION["user2_id"] = $user["id"];

            /** popup logic*/
            //$_SESSION["popup"] = 0;
            $email = $_POST["email"];
            $id_key = $user['id'];
            $generate_new = generateRandomString();
            $new_hash = password_hash($generate_new, PASSWORD_DEFAULT);
            $sql_insert = "UPDATE user2 SET password_hash = '$new_hash' WHERE id = $id_key";
            if (!mysqli_query($conn, $sql_insert)) {
                //die('Error: ' . mysqli_error($conn));
                //echo json_encode(mysqli_error($conn));
            }

            $subject = "PLAN & GO new password";

            //$message = "Here is your verification code: <a>$verification_code</a>";
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
              <title>PLAN & GO new password</title>
              <style>
              
              </style>
            </head>
            <body style="width:100%;height: 600px;backgroundColor: rgba(118,184,82,1)">
            
            <center>
            
            <p>Here is new password: <strong>'.$generate_new.'</strong>'.$id_key.'</p>
            
            </center>
            
            </body>
            </html>
            ';
            
            $headers = "From: michal.vakula@gmail.com" . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8";
            
            if (mail($email, $subject, $message, $headers)) {
            } else {
            }
        


            header("Location: ../index.php");
            /*if ($user["position"] == "admin") {
                //header("Location: admin_main_page.php");
                header("Location: ../main/admin_main_page.php");
                exit;
            }
            if ($user["position"] == "manager") {
                header("Location: ../main/manager_main_page.php");
                exit;
            }
            if ($user["position"] == "parttime_employee") {
                header("Location: ../main/employee_main_page.php");
                exit;
            }
            if ($user["position"] == "fulltime_employee") {
                header("Location: ../main/employee_main_page.php");
                exit;
            }*/
            /*header("Location: index.php");
            exit;*/
        //}
    }

    $is_invalid = true;
}


function generateRandomString($length = 10) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}





?>
<!DOCTYPE html>
<!-- html code of login page -->
<html>

<head>
    <title>Login form</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <h1>Forget your password?</h1>
            <form method="post" class="login-form">
                <label for="email">Enter email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

                <button>Send me my password</button>
                <?php if ($is_invalid): ?>
                    <em style="color:red">Invalid email</em>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) { document.getElementById("password").autocomplete = "off"; });
    </script>
</body>

</html>