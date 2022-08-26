<?php
$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "assisment_db";
$mysqli = new mysqli($host, $user, $pass, $databaseName);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
?>