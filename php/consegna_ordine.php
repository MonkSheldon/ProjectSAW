<?php
    require_once('funzione.php');
    checkSession(true);

    if (!isset($_GET['idOrder'])) {
        header('Location: ordini.php?ammin=1&err=14');
        exit();
    }

    $idOrder = trim($_GET['idOrder']);

    if (empty($idOrder)) {
        header('Location: ordini.php?ammin=1&err=14');
        exit();
    }
    
    require_once('db/mysql_credentials.php');

    function delivery_order($idOrder, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection, 'UPDATE ordine
                                                        SET isConsegna=\'1\'
                                                        WHERE idOrdine=?')) {
            mysqli_stmt_bind_param($stmt, 'd', $idOrder);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    $successful = delivery_order($idOrder, $con);

    mysqli_close($con);

    if ($successful)
        header('Location: ordini.php?ammin=1');
    else
        header('Location: ordini.php?ammin=1&err=14');
?>