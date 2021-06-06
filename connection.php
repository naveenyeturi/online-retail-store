<?php

function Connect()
{
	// $dbhost = "localhost";
	// $dbuser = "root";
	// $dbpass = "";
	// $dbname = "online_mall";

	// $dbhost = "sql206.epizy.com";
	// $dbuser = "epiz_28246422";
	// $dbpass = "ym6F3vWaxbrhxkV";
	// $dbname = "epiz_28246422_online_mall";

	//Create Connection
	// $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);



	$dbuser = 'postgres';
    $dbpass = '9665';
    $dbhost = 'localhost';
    $dbname='onlinemall';

    // $con = pg_connect("host='$dbhost' dbname='$dbname' port=5432 user='$dbuser' password='$dbpass'")
    // or die ("Could not connect to server\n"); 


    $conn = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass) or die ("Could not connect to server\n"); 




	return $conn;
}
?>