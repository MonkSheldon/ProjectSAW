<?php
    //GESTIONE DEI LOCK
    require_once('funzione.php');
    checkSession(false);

    if (!isset($_SESSION['total'])) {
        header('Location: carrello.php?err=12');
        exit();
    }

    $id = $_SESSION['id'];
    $total = $_SESSION['total'];
    
    require_once('db/mysql_credentials.php');
    
    $result = mysqli_query($con, 'INSERT INTO ordine(idOrdine, dataOra,
                                        totale, isConsegna, idCliente)
                        VALUES (null, default, \''. $total. '\', default, \''. $id. '\')');

    if (!$result) {
        header('Location: carrello.php?err=12');
        exit();
    }

    $result = mysqli_query($con, 'SELECT idOrdine
                                    FROM ordine
                                    WHERE idCliente=\''. $id. '\'
                                    ORDER BY dataOra DESC
                                    LIMIT 1');
    
    if (!$result || mysqli_num_rows($result) != 1) {
        header('Location: carrello.php?err=12');
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    $idOrdine = $row['idOrdine'];
    
    function confirm_order($id, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection, '
                        INSERT INTO veicolo (matricola, idOrdine, idModello)
                            VALUES (?, ?, ?)')) {
            foreach ($_SESSION['shoppingCart'] as $idModel => $quantity)
                for ($i = 0; $i < $quantity; $i++) {
                    $newmatricola = generateRandomString(10);
                    mysqli_stmt_bind_param($stmt, 'sdd', $newmatricola, $id, $idModel);
                    $result = mysqli_stmt_execute($stmt);
                    if (!$result)
                        $i--;
                }
            mysqli_stmt_close($stmt);
            unset($_SESSION['shoppingCart']);
            unset($_SESSION['count']);
            unset($_SESSION['total']);
			return true;
		}
		return false;
    }

    $success = confirm_order($idOrdine, $con);

    mysqli_close($con);

    if ($success)
        header('Location: carrello.php?msg=4');
    else
        header('Location: carrello.php?err=12');
?>