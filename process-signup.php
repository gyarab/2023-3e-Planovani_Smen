<?php
/** old code of signup page */
/**no use */
if (empty($_POST["firstname"])) {
    die("Firstname is required");
}

if (empty($_POST["lastname"])) {
    die("Lastname is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

if (empty($_POST["countryCode"])) {
    die("Selection is empty (code)");
}

if (empty($_POST["position"])) {
    die("Selection is empty (position)");
}


$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$mysqli = require __DIR__ . "/database.php";

/**Creating verification code */
function generateRandomString($length = 6) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

$verification_code = generateRandomString();

/**sending email */
$to = $_POST["email"];

$subject = "Verification Code";

$message = "Here is your verification code: $verification_code";

$headers = "From: michal.vakula@gmail.com" . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}

$sql1 = "INSERT INTO verification (firstname, middlename, lastname, email, password_hash, countryCode, phone, position, verificationCode)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt1 = $mysqli->stmt_init();

if (!$stmt1->prepare($sql1)) {
    die ("SQL error: " . $mysqli->error);
}

$stmt1->bind_param(
    "ssssssssss",
    $_POST["firstname"],
    $_POST["middlename"],
    $_POST["lastname"],
    $_POST["email"],
    $password_hash,
    $_POST["countryCode"],
    $_POST["phone"],
    $_POST["position"],
    $verification_code
);

if ($stmt1->execute()) {
    header("Location: verification.php");
    exit;
} else {
    /** Code that checks if is email unique*/
    /**Needs to be reconstruct  */
    if ($mysqli->errno === 1062) {
        //die("email already taken");
    } else {
        //die($mysqli->error . " " . $mysqli->errno);
    }
}  
?>
