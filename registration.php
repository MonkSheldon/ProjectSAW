<?php

//manca connessione al database
//non riesco a connettermi al mio database di prova 
//per testare la registrazione :( 

// Get values from $_POST, but do it IN A SECURE WAY
$idCliente= $_POST["idCliente"];
$email = $_POST["email"]; // replace null with $_POST and sanitization
$first_name = $_POST["nome"]; // replace null with $_POST and sanitization
$last_name = $_POST["cognome"]; // replace null with $_POST and sanitization
$password = sha1($_POST["password"]); // replace null with $_POST and sanitization
$password_confirm = sha1($_POST["rePassword"]); // replace null with $_POST and sanitization

$checkemail=mysql_query("SELECT email FROM cliente WHERE email='".$_POST["email"]."'");
$checkidCliente=mysql_query("SELECT idCliente FROM cliente WHERE idCliente='".$_POST["idCliente"]."'");

function insert_user($email, $first_name, $last_name, $password, $password_confirm, $idCliente) {
	if(mysql_num_rows((($checkemail)==0)&&($checkidCliente)==0){
		
		if($password==$password_confirm){
			$result="INSERT INTO user(idCliente,email,nome,cognome,password,telefono)VALUES 
			('".mysqli_real_escape_string($mysqli,$_POST['idCliente'])."',
			'".mysqli_real_escape_string($mysqli,$_POST['email'])."',
			'".mysqli_real_escape_string($mysqli,$_POST['nome'])."',
			'".mysqli_real_escape_string($mysqli,$_POST['cognome'])."',
			'".mysqli_real_escape_string($mysqli,$_POST['password'])."',
			'".mysqli_real_escape_string($mysqli,$_POST['telefono'])."')";

			if ($mysqli->query($result) === TRUE) {
				echo "persona inserita!";
				return true;
			} else {
				echo "Error: " . $result. "<br>" . $mysqli->error;
				return false;
			}
		}
			else
			{
				echo "hai sbagliato";
				return false;
			}
	}else{
		echo "persona già inserita del database";
	}
}

// Get user from login
$successful = insert_user($email, $first_name, $last_name, $password, $password_confirm, $idCliente);

if ($successful) {
    // Success message
    echo "$email registered successfully!";
} else {
    // Error message
    echo "There was an error in the registration process.";
	
$mysqli->close();
}
