<?php

$servername= "localhost";
$username= "root";
$password = "";

$dbname = "acc_db";

$conn = new mysqli($servername, $username, $password, $dbname);



if (!$conn) {
	echo "Connection failed!";
}