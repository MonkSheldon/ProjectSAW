<?php
    require_once('funzione.php');
    checkSession(false);
    myHeader('MODIFICA PROFILO', true);
?>
	<h3>Modifica del account VeichLe resize</h3>
    <a href='changePwdHTML.php'>Cambia Password</a>
<?php
    formUtente('update_profile.php');
    include('../html/footer.html');
?>