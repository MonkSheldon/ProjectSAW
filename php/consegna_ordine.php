<?php
    require_once('funzione.php');
    checkSession(true);

    if (!isset($_GET['idOrdine'])) {
        header('Location: ordini.php?ammin=1&err=14');
        exit();
    }

    $idOrdine = trim($_GET['idOrdine']);

    if (empty($idOrdine)) {
        header('Location: ordini.php?ammin=1&err=14');
        exit();
    }
    
    require_once('db/mysql_credentials.php');

    function delivery_order($idOrdine, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection, 'UPDATE ordine
                                                        SET isConsegna=\'1\'
                                                        WHERE idOrdine=?')) {
            mysqli_stmt_bind_param($stmt, 'd', $idOrdine);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    $success = delivery_order($idOrdine, $con);

    mysqli_close($con);

    if ($success) {
        //Success message
        header('Location: ordini.php?ammin=1');
    }
    else {
        //Error message
        header('Location: ordini.php?ammin=1&err=14');
    }
?>