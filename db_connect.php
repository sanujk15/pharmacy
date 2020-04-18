<?php

$servername = "us-cdbr-iron-east-01.cleardb.net";
$username = "b4540e0f2b47a1";
$password = "dc5d7a30";
$dbname = "heroku_5259b59daae6cf4";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
?>