<?php
/** Test version main login page */
/**It haso use in program */
session_start();

if (isset($_SESSION["user2_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user2
            WHERE id = {$_SESSION["user2_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class = "form">
        <h1>Planovani Smen</h1>
        <hr>
        <h1>Welcome</h1>
        <button onclick="navigateToPage1()">Log in</button>
        <button onclick="navigateToPage2()">Sign up</button>        
    </div>

    <script>
        function navigateToPage1() {
            window.location.href = "login.php";
        }
        function navigateToPage2() {
            window.location.href = "signup.html";
        }
    </script>
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    
