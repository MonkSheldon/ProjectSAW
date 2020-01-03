<?php 
require_once("funzione.php");
require_once('db/mysql_credentials.php');



/*$query="INSERT INTO veicolo 
            (idOrdine, dataOra, idCliente ) VALUES (null, null, ?)";

if ($stmt = mysqli_prepare($db_connection, $query) {
mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
$result = mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

if ($result) {
    return true;
}

echo " sono nel return false della funzione insert user";
return false;
}




header('Location: index.php?msg=1');
include('../html/footer.html');?>