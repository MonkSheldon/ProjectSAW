<?php
	// TODO: change credentials in the db/mysql_credentials.php file
	//BISOGNA METTERE LE SESSIONI

	// Add session control, header, ...
	// Open DBMS Server connection
	if (!isset($_POST['email']) || !isset($_POST['pass'])) {
		header('Location: loginHTML.php?err=1');
		exit();
	}

	// Get credentials from $_POST['email'] and $_POST['pass']
	// but do it IN A SECURE WAY
	$email = trim($_POST['email']); // replace null with $_POST and sanitization
	$pass = trim($_POST['pass']); // replace null with $_POST and sanitization
	$cookie = $_POST['remember-me'];

	if (empty($email) || empty($pass)) {
		header('Location: loginHTML.php?err=1');
		exit();
	}

	require_once('db/mysql_credentials.php');

	function login($email, $pass, $cookie, $db_connection) {
		$pass = sha1($pass);

		if ($stmt = mysqli_prepare($db_connection,
						"SELECT idCliente, email, nome, cognome
							FROM cliente
							WHERE email=? AND
								pword=?")) {
			mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
			$result = mysqli_stmt_execute($stmt);
			if ($result) {
				mysqli_stmt_store_result($stmt);
				$norows = mysqli_stmt_num_rows($stmt);
				if ($norows == 1) {
					mysqli_stmt_bind_result($stmt, $id, $em, $nome, $cognome);
					mysqli_stmt_fetch($stmt);
					mysqli_stmt_free_result($stmt);
					mysqli_stmt_close($stmt);
					if ($cookie == "remember-me") {
						$time = time() + 3600;
						$result = mysqli_query($db_connection, "
							UPDATE cliente
								SET cookie='". $time ."'
								WHERE idCliente='". $id ."'");
						if (!$result)
							return null;
						setcookie("id", $id, $time);
					}
					return array($id, $em, $nome, $cognome);
				}
			}
		}
		return null;
	}

	// Get user from login
	$user = login($email, $pass, $cookie, $con);

	mysqli_close($con);

	if ($user) {
		// Welcome
		require_once('funzione.php');
		createSession($user[0], $user[1], $user[2], $user[3]);
		header('Location: index.php');
	} else {
		// Error message
		header('Location: loginHTML.php?err=3');
	}
?>
