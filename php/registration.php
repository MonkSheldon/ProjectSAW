<?php
	require_once('funzione.php');

	$valuesUtente = checkValuesUtente('inserimento');
	
    require_once('db/mysql_credentials.php');
    
	function insert_user($email, $first_name, $last_name, $password, $password_confirm, $telephone, $db_connection) {
		if ($password != $password_confirm)
            return false;
    
        $password = sha1($password);
        
        if ($stmt = mysqli_prepare($db_connection, 'INSERT INTO cliente
					(idCliente, email, pword, cookie, nome, cognome,
					    telefono) VALUES (null, ?, ?, null, ?, ?, ?)')) {
			mysqli_stmt_bind_param($stmt, 'sssss', $email, $password,
									$first_name, $last_name, $telephone);
			$result = mysqli_stmt_execute($stmt);
            
            mysqli_stmt_close($stmt);
            
            if ($result)
				return true;
		}
		return false;
	}

	// Get user from login
	$successful = insert_user($valuesUtente['email'], $valuesUtente['first_name'],
								$valuesUtente['last_name'], $valuesUtente['password'],
								$valuesUtente['password_confirm'],
								$valuesUtente['telephone'], $con);
	
	mysqli_close($con);

	if ($successful) {
		// Success message
		header('Location: inserimento.php?msg=7');
	} else {
		// Error message
		header('Location: inserimento.php?err=2');
	}
?>