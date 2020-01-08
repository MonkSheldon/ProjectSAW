<?php
    if (!isset($_GET['action']))
        header('Location: carrello.php?err=10');
    
    $action = trim($_GET['action']);

    if (empty($action))
        header('Location: carrello.php?err=10');

    if ($action != 'svuota' && !isset($_GET['idModello']))
        header('Location: carrello.php?err=11');
    
    $idModel = trim($_GET['idModel']);

    if ($action != 'svuota' && empty($idModel))
        header('Location: carrello.php?err=11');
    
    session_start();
    
    switch ($action) {
        case 'aggiungi':
            require_once('db/mysql_credentials.php');

            function control_model($id, $db_connection) {
                if ($stmt = mysqli_prepare($db_connection,
						'SELECT tipoModello
							FROM modello
							WHERE idModello=?')) {
			        mysqli_stmt_bind_param($stmt, 'd', $id);
			        $result = mysqli_stmt_execute($stmt);
			        if ($result) {
                        mysqli_stmt_store_result($stmt);
                        $norows = mysqli_stmt_num_rows($stmt);
                        if ($norows == 1) {
                            mysqli_stmt_bind_result($stmt, $tipoModello);
                            mysqli_stmt_fetch($stmt);
                            mysqli_stmt_free_result($stmt);
                            mysqli_stmt_close($stmt);
                            return $tipoModello;
                        }
                    }
                }
                return null;
            }

            $successful = control_model($idModel, $con);

            mysqli_close($con);

            if (!$successful) {
                header('Location: index.php?err=11');
                exit();
            }

            if (!isset($_SESSION['count']))
                $_SESSION['count'] = 1;
            else
                $_SESSION['count']++;
            
            if (!isset($_SESSION['shoppingCart'])) 
                $_SESSION['shoppingCart'] = array( $idModel => 1);
            else
                if (array_key_exists($idModel, $_SESSION['shoppingCart']))
                    $_SESSION['shoppingCart'][$idModel]++;
                else
                    $_SESSION['shoppingCart'][$idModel] = 1;
            
            header('Location: products.php?veichle='. $successful);
        break;
        case 'elimina':
            if (!array_key_exists($idModel, $_SESSION['shoppingCart'])) {
                header('Location: carrello.php?err=11');
                exit();
            }
            $_SESSION['count'] -= $_SESSION['shoppingCart'][$idModel];
            unset($_SESSION['shoppingCart'][$idModel]);
            if ($_SESSION['count'] == 0) {
                unset($_SESSION['count']);
                unset($_SESSION['shoppingCart']);
            }
            header('Location: carrello.php');
        break;
        case 'svuota':
            unset($_SESSION['count']);
            unset($_SESSION['shoppingCart']);
            header('Location: carrello.php');
        break;
        default:
            header('Location: carrello.php?err=10');
    }
?>