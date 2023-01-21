<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "benkyoushio";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {

    die("failed to connect!");
}
