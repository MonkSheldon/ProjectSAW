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
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    function update_pwd($email, $db_connection) {
        $pwdOriginal = generateRandomString(8);
        $pwd = sha1($pwdOriginal);
        if ($stmt = mysqli_prepare($db_connection, "UPDATE cliente
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
    if ($success)
    {  
        require 'pear/PHPMailer.php';
        $mail= new PHPMailer;
        $mail->setFrom('veronica.salvi.majo@gmail.com', 'veronica');
        $mail->addAddress('pagnonilorenzo@libero.it',' ');
        $mail->Subject  = 'First PHPMailer Message';
        $mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
        if(!$mail->send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
        echo 'Message has been sent.';
        }
      /*
        ini_set('SMTP','stmp.gmail.com');
        ini_set('sendmail_from','pagnonilorenzo@llibero.it');
        ini_set('smtp_port',465);

        $sub = "Site - Reimpostazione password";
        $msg = "Gentile utente,\n
                la sua nuova password è la seguente: ". $success. "\n
                Consigliamo di cambiarla al prossimo accesso per
                aumentare la sicurezza del suo account\n\nStaff";
        $header = "From: Site <pagnonilorenzo@libero.it>\r\n";
        $s = mail($email, $sub, $msg, $header);

        ini_restore('sendmail_from');
        VAR_DUMP($s);
        /*    header("Location: forgotPwdHTML.php?msg=1");
        else
            header("Location: forgotPwdHTML.php?err=6");*/
    } else {
        // Error message
        header("Location: forgotPwdHTML.php?err=5");
    }
?>