<?php

$servername = "localhost";
$username = "root";
$userpassword = "";
$databasename = "Employee";

$connection = mysqli_connect($servername, $username, $userpassword , $databasename );

$dataquery = "CREATE DATABASE IF NOT EXISTS Employee";
$result = mysqli_query($connection ,$dataquery);

$tablequery = "CREATE TABLE IF NOT EXISTS employeesystem(
emp_id INT PRIMARY KEY AUTO_INCREMENT ,
emp_name VARCHAR(50) NOT NULL,
emp_email VARCHAR(50) UNIQUE,
emp_position VARCHAR(50) NOT NULL,
emp_image VARCHAR(100) NOT NULL
)";
$result = mysqli_query($connection, $tablequery);
?>