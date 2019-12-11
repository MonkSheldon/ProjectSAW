<?php
	require_once("funzione.php");
	myHeader("REGISTRAZIONE", false);
?>
	<h3>Crea un account VeichLe resize</h3>
<?php
	if (count($_GET) > 0) {
		if ($_GET['msg'] == "1") { ?>
			<div class="alert alert-success">
				<strong>Registrazione andata a buon fine!</strong> 
				Ora puoi accedere al tuo account effetuando il <a href="loginHTML.php">login</a>
			</div>
	<?php
		}
		else {
			controlError($_GET['err']);
		}
	}
?>
	<form action="registration.php" method="POST">
		<!--<label for="firstname">First name *</label>-->
		<br><input type="text" name="firstname" placeholder="firstname *" required ><br>
		
		<!--<label for="lastname">Last name *</label>-->
		<br><input type="text" name="lastname" placeholder="lastname *" required><br>

		<!--abel for="email">E-mail *</label>-->
		<br><input type="email" name="email" placeholder="email *" required><br>

		<!--<label for="pass">Password *</label>-->
		<br><input type="password" name="pass" placeholder="password *" required><br>

		<!--<label for="confirm">Confirm Password *</label>-->
		<br><input type="password" name="confirm" placeholder="confirm *" required><br>
		
		<!--<label for="telephone">telefono *</label>-->
		<br><input type="text" name="telephone" placeholder="telephone " ><br>		
		
		<!-- TODO: Add additional fields here -->

		<br><input type="submit" value="Submit">
	</form>
<?php
	include("../html/footer.html");
?>