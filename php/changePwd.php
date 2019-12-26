<?php
    require_once('funzione.php');
    checkSession();

    if (!isset($_POST['pass']) || !isset($_POST['newpass']) ||
        !isset($_POST['confirm'])) {
        header('Location: changePwdHTML.php?err=1');
        exit();
    }

    $id = $_SESSION['id'];
    $pass = trim($_POST['pass']);
    $newpass = trim($_POST['newpass']);
    $confirm = trim($_POST['confirm']);

    if (empty($pass) || empty($newpass) || empty($confirm)) {
        header('Location: changePwdHTML.php?err=1');
        exit();
    }

    require_once('db/mysql_credentials.php');

    function update_pwd($id, $pass, $newpass, $confirm, $db_connection) {
        if ($newpass != $confirm)
            return false;
        
        $pass = sha1($pass);
        $newpass = sha1($newpass);
        
        if ($stmt = mysqli_prepare($db_connection, "UPDATE cliente
                       SET pword=?
                       WHERE idCliente='". $id ."'
                            AND pword=?")) {
            mysqli_stmt_bind_param($stmt, "ss", $newpass, $pass);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($result)
                return true;
        }
        return false;
    }

    $success = update_pwd($id, $pass, $newpass, $confirm, $con);

    mysqli_close($con);

    if ($success) {
        // Success message
        header("Location: changePwdHTML.php?msg=1");
    } else {
        // Error message
        header("Location: changePwdHTML.php?err=4");
    }
?>