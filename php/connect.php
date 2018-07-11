<?php

define("DB_SERVER", "localhost"); //host you want to connect
define("DB_USER", "root"); //database user
define("DB_PASS", "password"); //db password
define("DB_NAME", "cs_classsched"); //database name

$connect = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME)
			or die('Error: '.mysqli_connect_error());

$conn = new mysqli('localhost','root','password','cs_classsched');
if($conn->connect_errno){
    echo $conn->connect_error;
    die('404 Database not found.');
}

?>