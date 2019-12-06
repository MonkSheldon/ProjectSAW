<?php
	require_once('db/mysql_credentials.php');

	if (!isset($_POST['email']) || !isset($_POST['firstname']) ||
		!isset($_POST['lastname']) || !isset($_POST['pass']) ||
		!isset($_POST['confirm']) || !isset($_POST['telephone'])) {
		header("Location: inserimento.php?err=1");
		exit();
	}

	// Get values from $_POST, but do it IN A SECURE WAY
	$email = trim($_POST['email']); // replace null with $_POST and sanitization
	$first_name = trim($_POST['firstname']); // replace null with $_POST and sanitization
	$last_name = trim($_POST['lastname']); // replace null with $_POST and sanitization
	$password = trim($_POST['pass']); // replace null with $_POST and sanitization
	$password_confirm = trim($_POST['confirm']); // replace null with $_POST and sanitization
	$telephone = trim($_POST['telephone']);

	// Get additional values from $_POST, but do it IN A SECURE WAY
	// If you have additional values, change functions params accordingly
	if (empty($email) || empty($first_name) || empty($last_name) ||
		empty($password) || empty($password_confirm)) {
		header("Location: inserimento.php?err=1");
		exit();
	}

	function insert_user($email, $first_name, $last_name, $password, $password_confirm, $telephone, $db_connection) {
		if ($password != $password_confirm)
			return false;
		
		$password = sha1($password);

		if ($stmt = mysqli_prepare($db_connection, "INSERT INTO cliente
					(idCliente, email, pword, nome, cognome, telefono)
					VALUES (null, ?, ?, ?, ?, ?)")) {
			mysqli_stmt_bind_param($stmt, "sssss", $email, $password,
									$first_name, $last_name, $telephone);
			$result = mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			if ($result) {				
				return true;
			}
		}
		return false;
	}

	// Get user from login
	$successful = insert_user($email, $first_name, $last_name, $password, $password_confirm, $telephone, $con);

	mysqli_close($con);

	if ($successful) {
		// Success message
		echo "$email registered successfully!";
	} else {
		// Error message
		header('Location: inserimento.php?err=2');//non è stato possibile inserire, perché l'email è gia esistente,
	}
?>