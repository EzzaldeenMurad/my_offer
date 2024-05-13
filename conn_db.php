<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_offer";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
