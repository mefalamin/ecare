<?php
$username = "admin";
$password = "secret";
$hostname = "localhost";
$db_name = "project";

//connection to the database
$mysqli = new mysqli($hostname, $username, $password, $db_name);
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
