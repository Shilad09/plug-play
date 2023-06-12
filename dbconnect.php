<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videologin";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Failed to connect: " . mysqli_connect_error());
}
?>