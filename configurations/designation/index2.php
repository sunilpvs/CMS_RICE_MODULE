<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "Rollout@123#";
$dbname = "pvscoqq5_devsc_cms";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>