<?php
    require_once('funzione.php');
    checkSession();
    myHeader("ORDINI", true);

    require_once('db/mysql_credentials.php');

    if ($stmt = mysqli_prepare($db_connection,
						"")) {}

    mysqli_close($con);

    include('../html/footer.html');
?>