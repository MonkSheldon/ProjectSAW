<?php
    require_once('funzione.php');
    checkSession(false);
    if (isset($_COOKIE['id']))
        setcookie('id', '', time() - 3600);
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['admin']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['phone']);
    if (!isset($_SESSION['shoppingCart']))
        session_destroy();
    header('Location: index.php');
?>