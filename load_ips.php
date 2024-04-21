<?php
$mysqli = require __DIR__ . "/database.php";

$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM IPS";
$fetch = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($fetch)) {
    echo '<div class="row" >';
    echo '<div style="width: 100%; border: solid black">';
    
    echo '</div>';
    echo '</div>';
}


?>