<html>
<head>
<link rel="stylesheet" type="text/css" href="login.css"> 
<link rel="stylesheet" type="text/css "href="bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
	<body>
	<?php 
		if(count($_GET)>0){
			$err=$_GET['err'];
				if($err=='3')
			{?>
				<div class="alert alert-danger alert-dismissible fade show">
					i campi con * sono obbligatori
				</div><?php
			}else if($err=='4')
					{?>	
		<div class="alert alert-danger alert-dismissible fade show">
			questo utente non esiste
		</div>
					<?php }} ?>
<form action="login.php" method="POST">

				<label for="email">email</label>   
				<input type="email" name="email" placeholder="email">
				<label for="password">password</label>
				<input type="password" name="pass" placeholder="password">
				<input type="submit" value="Submit">
	<div class="field-group">
		<div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
		<label for="remember-me">Remember me</label>
	</div>
	

	
</form>
	
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>		
	</body>
</html>