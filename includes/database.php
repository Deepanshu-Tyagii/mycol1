<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "mycol";


$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if ($conn) {

}else {
    die("Database connection failed!");
}

ini_set('session.gc_maxlifetime', 1800);
?>