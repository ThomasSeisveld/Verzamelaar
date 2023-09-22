<?php
// connection
$serverName = "localhost";
$UserName = "db_089560";
$Password = "db089560!";
$DBName = "db_89560";

$conn = mysqli_connect($serverName, $UserName, $Password, $DBName);

if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}
