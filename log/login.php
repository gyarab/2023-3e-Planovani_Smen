<?php
/** main login page */
$is_invalid = false;/** var that checks if email and password is valid */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    /**connection to database */
    $mysqli = require ("../database.php");
    /**code that checks if email is in database */
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );


    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();


    if ($user) {

        /**vertification of password with password hash*/
        if (password_verify($_POST["password"], $user["password_hash"])) {

            session_start();

            session_regenerate_id();
            /** start of global sessions*/
            $_SESSION["user_id"] = $user["id"];

            /** popup logic*/
            $_SESSION["popup"] = 0;

            if ($user["position"] == "admin") {
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
            }

        }
    }

    $is_invalid = true;
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
            <h1>Log-in</h1>
            <form method="post" class="login-form">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

                <label for="password">Password</label>
                <input type="password" value="" name="password" id="password" autocomplete="off">
                <button>Log in</button>
                <?php if ($is_invalid): ?>
                    <em style="color:red">Invalid login</em>
                <?php endif; ?>
                <br>
                <small><a href="../log/forget_password.php">Forget your password ?</a></small>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) { document.getElementById("password").autocomplete = "off"; });
    </script>
</body>

</html>