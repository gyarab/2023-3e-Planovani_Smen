<?php
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["verification_code"])) {
        $verification_code = $_POST["verification_code"];

        $sql = "SELECT * FROM verification WHERE verificationCode = ? LIMIT 1";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $verification_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();


            $firstname = $row["firstname"];
            $middlename = $row["middlename"];
            $lastname = $row["lastname"];
            $email = $row["email"];
            $password_hash = $row["password_hash"];
            $countryCode = $row["countryCode"];
            $phone = $row["phone"];
            $position = $row["position"];

            $sql_insert = "INSERT INTO user2 (firstname, middlename, lastname, email, password_hash, countryCode, phone, position)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt_insert = $mysqli->prepare($sql_insert);
            $stmt_insert->bind_param("sssssiis", $firstname, $middlename, $lastname, $email, $password_hash, $countryCode, $phone, $position);

            if ($stmt_insert->execute()) {
                $sql2 = "DELETE FROM verification";
                $mysqli->query($sql2);

                header("Location: signup-success.html");
                exit;
            } else {
                die("Failed to insert data into user2: " . $mysqli->error);
            }
        } else {
            die("Verification code not found or expired.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Verification</title>
</head>
<body style="background-color:#8dc26f ;">
    <div class = "form">
        <h2>Email Verification</h2>
        <p>Check email for your verification code</p>
        <form action="verification.php" method="post"  class="login-form">
            <input type="text" name="verification_code" placeholder="Enter verification code" required>
            <br>
            <input type="submit" value="Verify">
        </form>
    </div>
</body>
</html>