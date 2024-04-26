<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require("../database.php");
    $conn = new mysqli($host, $username, $password, $dbname);
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );


    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();


    if ($user) {

            $email = $_POST["email"];
            $id_key = $user['id'];
            $generate_new = generateRandomString();
            $new_hash = password_hash($generate_new, PASSWORD_DEFAULT);
            $sql_insert = "UPDATE user SET password_hash = '$new_hash' WHERE id = $id_key";
            if (!mysqli_query($conn, $sql_insert)) {

            }

            $subject = "PLAN & GO new password";

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
<!-- html stranka -->
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