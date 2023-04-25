<?php
$servername = "localhost";
$username = "bobanovi_ch";
$password = "Etoga1234567890";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "bobanovi_ch");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_set_charset ($conn ,"utf8");

?>