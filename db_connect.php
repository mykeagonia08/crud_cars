<?php

//set connection variables
$host = 'localhost';
$username = 'root';
$password = 'root';
$db_name = 'myCars'; //database name

//connect to mysql
$mysqli = new mysqli($host, $username, $password, $db_name);

// check if any connection error was encountered
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.';
    exit;
}
