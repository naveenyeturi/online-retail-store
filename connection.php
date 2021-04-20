<?php

function Connect()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "online_mall";

	// $dbhost = "sql206.epizy.com";
	// $dbuser = "epiz_28246422";
	// $dbpass = "ym6F3vWaxbrhxkV";
	// $dbname = "epiz_28246422_online_mall";

	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

	return $conn;
}
?>