<?php

$servername = "localhost";
$username = "root";
$password = "deepak@1999";
$db = "foodstore";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
