<?php

//parameters to connect to a database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "brokerage";

//Connection to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Database connection failed!");
} else {
    //echo "connection worked";
}

?>