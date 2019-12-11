<?php
	function createSession($id, $email, $nome, $cognome) {
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['email'] = $email;
		$_SESSION['nome'] = $nome;
		$_SESSION['cognome'] = $cognome;
	}
	
	function checkSession() {
		session_start();
		if (!isset($_SESSION['login'])) {
			header('Location: login.php');
			exit();
		}
	//manca la funzione sessione per il carrello
	}

	function controlError($err) {
		if ($err == "1" || $err == "2" || $err == "3") { ?>
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
				} ?>
			</div>
	<?php
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
													<a class="dropdown-item" href="logout.php">Logout</a>
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
?>