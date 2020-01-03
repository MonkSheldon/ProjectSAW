<?php
    if(!is_int($_GET['idModello']))
        header('Location: index.php?err=10');
   
    session_start();
    $action=$_GET['action'];
   
    $idModello = $_GET['idModello'];
    //fare il controllo del idModello che sia effettivamente un numero
   
    switch($action) {
        case "aggiungi":
            if(!isset($_SESSION['count']))
                $_SESSION['count']=1;
            else
                $_SESSION['count']++;

            if (!isset($_SESSION['carrello'])) 
                $_SESSION['carrello'] = array( $idModello => 1);
            else
            
                if (array_key_exists( $idModello, $_SESSION['carrello']))
                    $_SESSION['carrello'][$idModello]++;
                else
                    $_SESSION['carrello'][$idModello] = 1;

         header("Location: products.php?veicolo=". $_GET['veicolo']);
        break;

        case "elimina":

            if (array_key_exists($idModello, $_SESSION['carrello'])) {
               $_SESSION['count']-=$_SESSION['carrello'][$idModello];
                unset($_SESSION['carrello'][ $idModello]);
                if ($_SESSION['count']==0) {
                    unset($_SESSION['count']);
                    unset($_SESSION['carrello']);
                }
            }
    
            header('Location: carrello.php');
        break;

        case "svuota":
            unset($_SESSION['carrello']);
        break;

        default:
        echo "sono in default"; 
    }
?>