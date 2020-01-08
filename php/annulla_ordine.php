<?php
    require_once('funzione.php');
    checkSession(false);

    if (!isset($_GET['idOrder']) || !isset($_GET['timeannull'])) {
        header('Location: ordini.php?ammin=0&err=13');
        exit();
    }

    $idClient = $_SESSION['id'];
    $idOrder = trim($_GET['idOrder']);
    $timeannull = trim($_GET['timeannull']);

    if (empty($idOrder) || empty($timeannull)) {
        header('Location: ordini.php?ammin=0&err=13');
        exit();
    }
    
    require_once('db/mysql_credentials.php');

    function delete_order($idClient, $idOrder, $timeannull, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection,
						'SELECT *
							FROM ordine
							WHERE idCliente=? AND
                                idOrdine=? AND
                                dataOra + INTERVAL 5 MINUTE > ?')) {
			mysqli_stmt_bind_param($stmt, 'dds', $idClient, $idOrder, $timeannull);
			$result = mysqli_stmt_execute($stmt);
			if ($result) {
				mysqli_stmt_store_result($stmt);
                $norows = mysqli_stmt_num_rows($stmt);
                mysqli_stmt_free_result($stmt);
			    mysqli_stmt_close($stmt);
				if ($norows == 1) {
                    $result = mysqli_query($db_connection, '
                                    DELETE FROM veicolo
                                        WHERE idOrdine=\''. $idOrder. '\'');
                    if ($result) {
                        $result = mysqli_query($db_connection, '
                                    DELETE FROM ordine
                                        WHERE idOrdine=\''. $idOrder. '\'');
                        if ($result)
                            return true;
                    }
                }
            }
        }
        return false;
    }

    $successful = delete_order($idClient, $idOrder, $timeannull, $con);

    mysqli_close($con);

    if ($successful)
        header('Location: ordini.php?ammin=0&msg=2');
    else
        header('Location: ordini.php?ammin=0&err=13');
?>