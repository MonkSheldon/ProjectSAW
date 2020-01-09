<?php
	$mysql_host = 'localhost';
	$mysql_user = 'root';//'S4329394';
	$mysql_pass = 'toor1920';//'FLV1920';
	$mysql_db = 'S4477837';//'S4329394';
	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
	if (mysqli_connect_errno($con)) {
		echo 'Database error';
		exit();
	}
?>