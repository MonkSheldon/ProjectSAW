<?php

// TODO: change credentials in the db/mysql_credentials.php file
//BISOGNA METTERE LE SESSIONI

require_once('db/mysql_credentials.php');

// Add session control, header, ...
// Open DBMS Server connection

// Get credentials from $_POST['email'] and $_POST['pass']
// but do it IN A SECURE WAY
$email = $_POST['email']; // replace null with $_POST and sanitization
$pass = $_POST['pass']; // replace null with $_POST and sanitization

if(	!isset($_POST['email'])||empty($_POST['email'])||
	!isset($_POST['pass'])||empty($_POST['pass']))
	{
		header('Location: loginHTML.php?err=3');
			exit();
	}
function login($email, $pass, $db_connection) {
	$email=trim($email);
	$pass=sha1(trim($pass));
	
	$query="SELECT * FROM cliente WHERE email='".$email."' AND pword='".$pass."'" ;
	
	$result=mysqli_query($db_connection,$query);
			
	if (mysqli_affected_rows($db_connection)==1) {				
		return true;
	} else {
		return false;
	}
}

// Get user from login
$user = login($email, $pass, $con);

if ($user) {
    // Welcome message
    echo "Welcome!";
} else {
    // Error message
    header('Location: loginHTML.php?err=4');
}
?>