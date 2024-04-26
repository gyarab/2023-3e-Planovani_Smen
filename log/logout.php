<?php

/**log out code */
/**closes all connection to database */
session_start();

session_destroy();

header("Location: ../index.php");
exit;
