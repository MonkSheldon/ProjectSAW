<?php
    if (!isset($_POST['email'])) {
        header('Location: forgotPwdHTML.php?err=1');
        exit();
    }
    $email = trim($_POST['email']);
    if (empty($email)) {
        header('Location: forgotPwdHTML.php?err=1');
        exit();
    }
    require_once('db/mysql_credentials.php');

   
    function update_pwd($email, $db_connection) {
        $pwdOriginal = generateRandomString(8);
        $pwd = sha1($pwdOriginal);
        if ($stmt = mysqli_prepare($db_connection, "
                UPDATE cliente
                    SET pword=?
                    WHERE email=?")) {
            mysqli_stmt_bind_param($stmt, "ss", $pwd, $email);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($result)
                return $pwdOriginal;
        }
        return null;
    }
    $success = update_pwd($email, $con);
    mysqli_close($con);
    if ($success) {
        //Success message
        require 'class.phpmailer.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.libero.it';
        $mail->Username = 'pagnonilorenzo@libero.it';
        $mail->Password = 'Pagno1998';
        $mail->setFrom('pagnonilorenzo@libero.it', 'Site');
        $mail->addAddress($email, $email);
        $mail->Subject = 'Site - Reimpostazione password';
        $mail->Body = 'Gentile utente, la sua nuova password è la seguente: '. $success. ' Consigliamo di cambiarla al prossimo accesso per aumentare la sicurezza del suo account';
        if ($mail->send())
            header("Location: forgotPwdHTML.php?msg=1");
        else
            header("Location: forgotPwdHTML.php?err=6");
    } else {
        // Error message
        header("Location: forgotPwdHTML.php?err=5");
    }
?>



