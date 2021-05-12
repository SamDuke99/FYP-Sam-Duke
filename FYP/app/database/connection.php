<?php

//the various different variables specific for my database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'FYP';
//this handles the actual connection using the MySQLi driver
$connect = new MySQLi($dbHost, $dbUsername, $dbPassword, $dbName);
//short error handling in the off chance something goes wrong
if ($connect->connect_error) {
    die('DB connection error: ' . $connect->connect_error);
}

