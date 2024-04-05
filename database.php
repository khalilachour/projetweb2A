<?php

$hostname = "localhost";
$dbUser = "root";
$Password = "";
$dbName = "baseuser";

$conn = mysqli_connect($hostname, $dbUser, $Password, $dbName);
if (!$conn) {
    die("Something went wrong" . mysqli_connect_error());
}

?>