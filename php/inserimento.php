<?php
	require_once("funzione.php");
	myHeader("REGISTRAZIONE", false);
?>
	<h3>Crea un account VeichLe resize</h3>
<?php
	formUtente("registration.php",
				"<strong>Registrazione andata a buon fine!</strong> 
				Ora puoi accedere al tuo account effetuando il <a href=\"loginHTML.php\">login</a>");
	include("../html/footer.html");
?>