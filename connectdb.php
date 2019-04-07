<?php
 //lifted directly from the php tutorial, modified to connect to the correct database
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'ewong347';
	$dbname = 'ewong347assign2db';
	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
	  die("database connection failed :". mysqli_connect_error().
	  "(".mysqli_connect_errno().")"
	     );
	}
?>
