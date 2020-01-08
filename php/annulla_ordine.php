<?php
    require_once('funzione.php');
    checkSession(false);

    if (!isset($_GET['idOrdine']) || !isset($_GET['timeannull'])) {
        header('Location: ordini.php?ammin=0&err=13');
        exit();
    }

    $idCliente = $_SESSION['id'];
    $idOrdine = trim($_GET['idOrdine']);
    $timeannull = trim($_GET['timeannull']);

    if (empty($idOrdine) || empty($timeannull)) {
        header('Location: ordini.php?ammin=0&err=13');
        exit();
    }
    
    require_once('db/mysql_credentials.php');

    function delete_order($idCliente, $idOrdine, $timeannull, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection,
						'SELECT *
							FROM ordine
							WHERE idCliente=? AND
                                idOrdine=? AND
                                dataOra + INTERVAL 5 MINUTE > ?')) {
			mysqli_stmt_bind_param($stmt, 'dds', $idCliente, $idOrdine, $timeannull);
			$result = mysqli_stmt_execute($stmt);
			if ($result) {
				mysqli_stmt_store_result($stmt);
                $norows = mysqli_stmt_num_rows($stmt);
                mysqli_stmt_free_result($stmt);
			    mysqli_stmt_close($stmt);
				if ($norows == 1) {
                    $result = mysqli_query($db_connection, '
                                    DELETE FROM veicolo
                                        WHERE idOrdine=\''. $idOrdine. '\'');
                    if ($result) {
                        $result = mysqli_query($db_connection, '
                                    DELETE FROM ordine
                                        WHERE idOrdine=\''. $idOrdine. '\'');
                        if ($result)
                            return true;
                    }
                }
            }
        }
        return false;
    }

    $success = delete_order($idCliente, $idOrdine, $timeannull, $con);

    mysqli_close($con);

    if ($success) {
        //Success message
        header('Location: ordini.php?ammin=0&msg=2');
    }
    else {
        //Error message
        header('Location: ordini.php?ammin=0&err=13');
    }
?>