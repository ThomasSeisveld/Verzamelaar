<?php
// connection
$serverName = "localhost";
$UserName = "ftp089560";
$Password = "ftp089560";
$DBName = "MainDBTho";

$con = mysqli_connect($serverName, $UserName, $Password, $DBName);

if (!$con) {
    die("Connection Failed : " . mysqli_connect_error());
}
