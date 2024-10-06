<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "elkhater";
$con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
