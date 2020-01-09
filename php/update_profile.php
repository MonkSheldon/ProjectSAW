<?php
    require_once('funzione.php');
    checkSession(false);
    $valuesUtente = checkValuesUtente('show_profile');

    // Get value from $_SESSION
    $id = $_SESSION['id']; // replace null with $_SESSION

    require_once('db/mysql_credentials.php');

    function update_user($id, /*$email,*/ $first_name, $last_name,
                            $phone, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection, 'UPDATE cliente
                    SET /*email=?, */nome=?, cognome=?, telefono=?
                    WHERE idCliente=\''. $id. '\'')) {
            mysqli_stmt_bind_param($stmt, /*'s*/'sss', /*$email, */$first_name, $last_name, $phone);

            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($result)
                return true;
        }
        return false;
    }

    // Get user from login
    $successful = update_user($id, /*valuesUtente['email'],*/ $valuesUtente['firstname'],
                                $valuesUtente['lastname'], $valuesUtente['phone'], $con);

    mysqli_close($con);

    if ($successful) {
        sessionUtente($id, $_SESSION/*$valuesUtente*/['email'], $_SESSION['admin'],
                        $valuesUtente['firstname'], $valuesUtente['lastname'],
                        $valuesUtente['phone']);
        header('Location: show_profile.php?id='. $_SESSION['id'] .'&msg=8');
    } else
        header('Location: show_profile.php?id='. $_SESSION['id'] .'&err=2');
?>