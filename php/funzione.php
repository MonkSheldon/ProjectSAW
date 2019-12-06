<?php
	function checkSession() {
		session_start();
		if (!isset($_SESSION['login'])) {
			header('Location: login.php');
			exit();
		}
	//manca la funzione sessione per il carrello
	}

	function myHeader($title, $op) { ?>
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
											<a class="nav-link" href="../php/inserimento.php">
												<i class="far fa-user"></i></a>
											<a class="nav-link" href="../php/loginHTML.php">
												<i class="fas fa-sign-in-alt"></i></a>
										</li>
								<?php
									} ?>
									<a href="../html/searchHTML.html">Pagina Web</a>
								</ul>
							</div>
					</nav>
					<br>
<?php
	}
?>