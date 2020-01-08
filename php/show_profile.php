<?php
    require_once('funzione.php');
    checkSession(false);
    if (!isset($_GET['id']) || $_GET['id'] != $_SESSION['id']) {
        header('Location: login.php'); //da vedere
        exit();
    }
    myHeader('MODIFICA PROFILO', true);
?>
	<h3>Modifica del account VeichLe resize</h3>
    <a href='changePwdHTML.php'>Cambia Password</a>
<?php
    formUtente('update_profile.php');
    include('../html/footer.html');
?>