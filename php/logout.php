<?php
    if (isset($_COOKIE['id']))
        setcookie("id", "", time() - 3600);
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
?>