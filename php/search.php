<?php
	// TODO: change credentials in the db/mysql_credentials.php file
	require_once('funzione.php');
	//BISOGNA AGGIUNGERE LE SESSIONI E CONTROLLARE CHE UN UTENTE POSSA SOLO CERCARE I MODELLI
		//MENTRE L'ADMIN PUO CERCARE MODELLI E CLIENTI. 

	// Get search string from $_GET['search']
	// but do it IN A SECURE WAY
	
	if (!isset($_GET['search'])) {
		header('Location: searchHTML.php?err=1');
		exit();
	}

	$search = trim($_GET['search']); // replace null with $_GET and sanitization
	
	if (empty($search)) {
		header('Location: searchHTML.php?err=1');
		exit();
	}

	require_once('db/mysql_credentials.php');

	$query = 'SELECT *
				FROM modello
				WHERE marca=?
				ORDER BY prezzo ASC';	
	if ($stmt = mysqli_prepare($con, $query)) {
		mysqli_stmt_bind_param($stmt, 's', $search);
		$result = mysqli_stmt_execute($stmt);
		if ($result) {
			mysqli_stmt_store_result($stmt);
			$norows = mysqli_stmt_num_rows($stmt);
			if ($norows > 0) {
				mysqli_stmt_bind_result($stmt, $idModello, $nome, $marca, 
											$tipoMotore, $tipoModello, $noPasseggeri, $peso, 
											$potenza, $prezzo, $larghezza, $lunghezza, $altezza);
				while (mysqli_stmt_fetch($stmt)) {
					echo $idModello, $nome, $marca, 
					$tipoMotore, $tipoModello, $noPasseggeri, $peso, 
					$potenza, $prezzo, $larghezza, $lunghezza, $altezza;
				}
				mysqli_stmt_free_result($stmt);
				mysqli_stmt_close($stmt);
			}
			else
				header('Location: searchHTML.php?err=8');
		}
	}
	
	mysqli_close($con);
?>
