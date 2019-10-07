<?php
session_start();
$databaseName = 'mis';
$databaseUsername = 'root';
$databasePassword = '';
$hostName = 'localhost';

$con = mysqli_connect($hostName, $databaseUsername, $databasePassword, $databaseName);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>