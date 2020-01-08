<?php
	function checkSession($isAdmin) {
		session_start();
		if (!isset($_SESSION['id'])) {
			header('Location: login.php');
			exit();
		}
		if ($isAdmin && $_SESSION['admin'] == 0) {
			controlError('7');
			exit();
		}
	}

	function checkValuesUtente($form) {
        if (($form == 'inserimento' && (!isset($_POST['pass']) ||
            !isset($_POST['confirm']))) || !isset($_POST['email']) ||
            !isset($_POST['firstname']) || !isset($_POST['lastname']) ||
            !isset($_POST['phone'])) {
			myRedirect($form);
		}
		
        // Get values from $_POST, but do it IN A SECURE WAY
        if ($form == 'inserimento') {
            $password = trim($_POST['pass']); // replace null with $_POST and sanitization
	        $password_confirm = trim($_POST['confirm']); // replace null with $_POST and sanitization
        }
        $email = trim($_POST['email']); // replace null with $_POST and sanitization
        $first_name = trim($_POST['firstname']); // replace null with $_POST and sanitization
        $last_name = trim($_POST['lastname']); // replace null with $_POST and sanitization
		$phone = trim($_POST['phone']);
		
        // Get additional values from $_POST, but do it IN A SECURE WAY
        // If you have additional values, change functions params accordingly
        if (($form == 'inserimento' && (empty($password) ||
            empty($password_confirm))) || empty($email) ||
            empty($first_name) || empty($last_name)) {
			myRedirect($form);
		}
		
		$valuesUtente = array(
			'email' => $email,
			'firstname' => $first_name,
			'lastname' => $last_name,
			'phone' => $phone);
        if ($form == 'inserimento') {
			$valuesUtente['password'] = $password;
			$valuesUtente['password_confirm'] = $password_confirm;
		}
		
        return $valuesUtente;
	}

	function formUtente($action) {
		session_start();
		printMessage();
?>
		<form action='<?php echo $action; ?>' method='POST'>
			<!--<label for='firstname'>First name *</label>-->
			<br><input type='text' name='firstname' placeholder='firstname *' <?php if (isset($_SESSION['firstname'])) {echo 'value=\''. $_SESSION['firstname']. '\'';} ?> required><br>
			
			<!--<label for='lastname'>Last name *</label>-->
			<br><input type='text' name='lastname' placeholder='lastname *' <?php if (isset($_SESSION['lastname'])) {echo 'value=\''. $_SESSION['lastname']. '\'';} ?> required><br>

			<!--abel for='email'>E-mail *</label>-->
			<br><input type='email' name='email' placeholder='email *' <?php if (isset($_SESSION['email'])) {echo 'value=\''. $_SESSION['email']. '\'';} ?>  required><br>

			<?php
				if (!isset($_SESSION['id'])) { ?>
					<!--<label for='pass'>Password *</label>-->
					<br><input type='password' name='pass' placeholder='password *' required><br>

					<!--<label for='confirm'>Confirm Password *</label>-->
					<br><input type='password' name='confirm' placeholder='confirm *' required><br>
			<?php } ?>

			<!--<label for='telephone'>telefono *</label>-->
			<br><input type='text' name='phone' placeholder='phone' <?php if (isset($_SESSION['phone'])) {echo 'value=\''. $_SESSION['phone']. '\'';} ?> ><br>		

			<br><input type='submit' value='Submit'>
		</form>
<?php
	}

	function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            if ($length == 10) {
                if ($i == 0 || $i == 6)
                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                elseif ($i == 1 || $i == 8)
                    $characters = '0123456789';
            }
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

	function myHeader($title, $op) {
?>
		<!DOCTYPE html>
		<html>
			<head>
				<link rel='stylesheet' type='text/css' href='../css/startSaw.css'>
				<link rel='stylesheet' type='text/css' href='../css/bootstrap.min.css'>
				<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
				<title><?php echo $title; ?></title>
			</head>
				<body>
					<nav class='navbar fixed'>

					<a class='navbar-brand' href='index.php'><img src='../images/logo1.PNG' alt='logo'></a>
						
					<div class='container'>
						<ul class='navbar-nav ml-auto'>
							<?php
								if ($op) { ?>
									<li class='nav-item'>
									<?php
										if (session_status() == PHP_SESSION_NONE)
											session_start();
										if (isset($_SESSION['id'])) { ?>
											<div class='dropdown'>
												<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
													Ciao <?php echo $_SESSION['firstname']. ' '. $_SESSION['lastname']; ?>
												</button>
												<div class='dropdown-menu'>
													<?php
														$dropdown = array(
															'ordini.php?ammin=0' => 'I miei ordini',
															'show_profile.php?id='. $_SESSION['id'] => 'Modifica account',
															'logout.php' => 'Logout');
															
															if ($_SESSION['admin'] == 1) {?>
																<a class='dropdown-item' href='gestione_modelli.php'>Gestione modelli</a>
																<a class='dropdown-item' href='ordini.php?ammin=1'>Gestione ordini</a>
															<?php  
																}
															?>
															
															<?php foreach ($dropdown as $link => $name) { ?>
															<a class='dropdown-item' href='<?php echo $link; ?>'><?php echo $name; ?></a>
													<?php
														} ?>
												</div> 
											</div>
									<?php
										}
										else { ?>

												<a class='nav-link' href='inserimento.php'>
												<i class='far fa-user'></i></a>
												<a class='nav-link' href='loginHTML.php'>
												<i class='fas fa-sign-in-alt'></i></a>											 
									<?php
										} ?>
											<a class='nav-link' href='../php/searchHTML.php'>
											<i class='fas fa-search'></i></a>
											<a class='nav-link' href='../php/carrello.php'>	
											<i class='fas fa-shopping-cart'></i></a>
											<span><?php 
										
											if(!isset($_SESSION['count']))		
												echo '0';
  											else
  	  											echo $_SESSION['count'];
												?>
									</li>
							<?php
								} ?>
							</ul>
						</div>
					</nav>
					<br>
<?php
	}

	function myRedirect($form) {
		if ($form == 'inserimento')
			header('Location: '. $form. '.php?err=1');
		else
			header('Location: '. $form. '.php?id='. $_SESSION['id'] .'&err=1');
		exit();
	}

	function printMessage() {
		if (isset($_GET['msg']) && $_GET['msg'] >= 1 && $$_GET['msg'] <= 8) { ?>
			<div class='alert alert-success'>
			<?php
				switch ($_GET['msg']) {
					case 1:
						echo 'Modello inserito';
					break;
					case 2:
						echo 'Ordine cancellato con successo';
					break;
					case 3:
						echo 'La password è stata cambiata correttamente';
					break;
					case 4:
						echo 'Ordine completato';
					break;
					case 5:
						echo 'La password è stata inviata alla tua posta elettronica';
					break;
					case 6:
						echo 'Ordine cancellato con successo';
					break;
					case 7:
						echo '<strong>Registrazione andata a buon fine!</strong> Ora puoi accedere al tuo account effetuando il <a href=\'loginHTML.php\'>login</a>';
					break;
					case 8:
						echo '<strong>Modifica andata a buon fine!</strong>';
					break;
				}
			?>
			</div>
<?php
		}
		else if (isset($_GET['err']) && $_GET['err'] >= 1 && $_GET['err'] <= 12) { ?>
			<div class='alert alert-danger alert-dismissible fade show'>
			<?php
				switch ($_GET['err']) {
					case 1:
						echo 'I campi con * sono obbligatori';
					break;
					case 2:
						echo 'L\'utente è già inserito con questa mail';
					break;
					case 3:
						echo 'Username e/o password sbagliate';
					break;
					case 4:
						echo 'La password attuale non risulta corretta e/o la nuova password non è uguale a quella di conferma';
					break;
					case 5:
						echo 'L\'email inserita non risulta nel sistema';
					break;
					case 6:
						echo 'Momentaneamente abbiamo qualche problema con la reimpostazione della password. Riprova più tardi, ci dispiace per il disagio';
					break;
					case 7:
						echo 'Non hai i premessi per visualizzare questa pagina';
					break;
					case 8:
						echo 'Modello non trovato';
					break;
					case 9:
						echo 'Non è stato possibile inserire il modello nel sistema';
					break;
					case 10:
						echo 'Azione non valida per aggiornare il carrello';
					break;
					case 11:
						echo 'Il modello in analisi non risulta nel sistema';
					break;
					case 12:
						echo 'Ordine non confermato';
					break;
				} ?>
			</div>
	<?php
		}
	}

	function sessionUtente($id, $email, $admin, $first_name, $last_name, $phone) {
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['email'] = $email;
		$_SESSION['admin'] = $admin;
		$_SESSION['firstname'] = $first_name;
		$_SESSION['lastname'] = $last_name;
		$_SESSION['phone'] = $phone;
	}

?>