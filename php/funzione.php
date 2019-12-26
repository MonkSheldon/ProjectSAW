<?php
	function checkSession() {
		session_start();
		if (!isset($_SESSION['id'])) {
			header('Location: login.php');
			exit();
		}
	//manca la funzione sessione per il carrello
	}

	function checkValuesUtente($form) {
        if (($form == "inserimento" && (!isset($_POST['pass']) ||
            !isset($_POST['confirm']))) || !isset($_POST['email']) ||
            !isset($_POST['firstname']) || !isset($_POST['lastname']) ||
            !isset($_POST['telephone'])) {
			myRedirect($form);
        }

        // Get values from $_POST, but do it IN A SECURE WAY
        if ($form == "inserimento") {
            $password = trim($_POST['pass']); // replace null with $_POST and sanitization
	        $password_confirm = trim($_POST['confirm']); // replace null with $_POST and sanitization
        }
        $email = trim($_POST['email']); // replace null with $_POST and sanitization
        $first_name = trim($_POST['firstname']); // replace null with $_POST and sanitization
        $last_name = trim($_POST['lastname']); // replace null with $_POST and sanitization
        $telephone = trim($_POST['telephone']);

        // Get additional values from $_POST, but do it IN A SECURE WAY
        // If you have additional values, change functions params accordingly
        if (($form == "inserimento" && (empty($password) ||
            empty($password_confirm))) || empty($email) ||
            empty($first_name) || empty($last_name)) {
			myRedirect($form);
		}
		
		$valuesUtente = array(
			'email' => $email,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'telephone' => $telephone);

        if ($form == "inserimento") {
			$valuesUtente['password'] = $password;
			$valuesUtente['password_confirm'] = $password_confirm;
        }
        return $valuesUtente;
    }

	function controlError($err) {
		if ($err == "1" || $err == "2" || $err == "3" || $err == "4" ||
			$err == "5" || $err == "6") { ?>
			<div class="alert alert-danger alert-dismissible fade show">
			<?php
				switch ($err) {
					case "1":
						echo "I campi con * sono obbligatori";
					break;
					case "2":
						echo "L'utente è già inserito con questa mail";
					break;
					case "3":
						echo "Username e/o password sbagliate";
					break;
					case "4":
						echo "La password attuale non risulta corretta e/o la nuova password non è uguale a quella di conferma";
					break;
					case "5":
						echo "L'email inserita non risulta nel sistema";
					break;
					case "6":
						echo "Momentaneamente abbiamo qualche problema con la reimpostazione della password. Riprova più tardi, ci dispiace per il disagio";
					break;
				} ?>
			</div>
	<?php
		}
	}

	function formUtente($action, $msgSuccess) {
		session_start();
		if (count($_GET) > 0) {
			if ($_GET['msg'] == "1") { ?>
				<div class="alert alert-success">
					<?php echo $msgSuccess; ?>
				</div>
		<?php
			}
			else {
				controlError($_GET['err']);
			}
		} ?>
		<form action="<?php echo $action; ?>" method="POST">
			<!--<label for="firstname">First name *</label>-->
			<br><input type="text" name="firstname" placeholder="firstname *" <?php insertValueForUpdate($action, $_SESSION['nome']); ?>required><br>
			
			<!--<label for="lastname">Last name *</label>-->
			<br><input type="text" name="lastname" placeholder="lastname *" <?php insertValueForUpdate($action, $_SESSION['cognome']); ?>required><br>

			<!--abel for="email">E-mail *</label>-->
			<br><input type="email" name="email" placeholder="email *" <?php insertValueForUpdate($action, $_SESSION['email']); ?>required><br>

			<?php
				if (!isset($_SESSION['id'])) { ?>
					<!--<label for="pass">Password *</label>-->
					<br><input type="password" name="pass" placeholder="password *" required><br>

					<!--<label for="confirm">Confirm Password *</label>-->
					<br><input type="password" name="confirm" placeholder="confirm *" required><br>
			<?php } ?>

			<!--<label for="telephone">telefono *</label>-->
			<br><input type="text" name="telephone" placeholder="telephone" <?php insertValueForUpdate($action, $_SESSION['telefono']); ?>><br>		

			<br><input type="submit" value="Submit">
		</form>
<?php
	}

	function insertValueForUpdate($action, $value) {
		if (isset($_SESSION['id'])) {
			echo "value=\"$value\" ";
		}
	}

	function myHeader($title, $op) {
?>
		<!DOCTYPE html>
		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="../css/startSaw.css">
				<link rel="stylesheet" type="text/css "href="../css/bootstrap.min.css">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
				<title><?php echo $title; ?></title>
			</head>
				<body>
					<nav class="navbar navbar-expand-sm sticky-top ">
						<a class="navbar-brand" href="../php/index.php"><img src="../images/logo1.PNG" alt="logo"></a>
						<div class="container" >
							<ul class="navbar-nav ml-auto">
							<?php
								if ($op) { ?>
									<li class="nav-item">
									<?php
										session_start();
										if (isset($_SESSION['id'])) { ?>
											<div class="dropdown">
												<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
													Ciao <?php echo $_SESSION['nome']. " ". $_SESSION['cognome']; ?>
												</button>
												<div class="dropdown-menu">
													<?php
														$dropdown = array(
															"show_profile.php?id=". $_SESSION['id'] => "Modifica account",
															"logout.php" => "Logout"
														);
														foreach ($dropdown as $link => $name) { ?>
															<a class="dropdown-item" href="<?php echo $link; ?>"><?php echo $name; ?></a>
													<?php
														} ?>
												</div>
											</div>
									<?php
										}
										else { ?>
											<a class="nav-link" href="../php/inserimento.php">
												<i class="far fa-user"></i></a>
											<a class="nav-link" href="../php/loginHTML.php">
												<i class="fas fa-sign-in-alt"></i></a>
									<?php
										} ?>
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
		if ($form == "inserimento") {
			header("Location: ". $form. ".php?err=1");
		}
		else {
			header("Location: ". $form. ".php?id=". $_SESSION['id'] ."&err=1");
		}
		exit();
	}

	function sessionUtente($id, $email, $nome, $cognome, $telefono) {
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['email'] = $email;
		$_SESSION['nome'] = $nome;
		$_SESSION['cognome'] = $cognome;
		$_SESSION['telefono'] = $telefono;
	}
?>