<?php
    require_once('funzione.php');
    checkSession(false);
    if (isset($_COOKIE['id']))
        setcookie('id', '', time() - 3600);
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['admin']);
    unset($_SESSION['nome']);
    unset($_SESSION['cognome']);
    unset($_SESSION['telefono']);
    if (!isset($_SESSION['carrello']))
        session_destroy();
    header('Location: index.php');
?>