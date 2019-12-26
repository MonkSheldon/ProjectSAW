<?php
    require_once('funzione.php');
    checkSession();
    $valuesUtente = checkValuesUtente("show_profile");

    // Get value from $_SESSION
    $id = $_SESSION['id']; // replace null with $_SESSION

    require_once('db/mysql_credentials.php');

    function update_user($id, $email, $first_name, $last_name,
                            $telephone, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection, "UPDATE cliente
                    SET email=?, nome=?, cognome=?, telefono=?
                    WHERE idCliente='". $id ."'")) {
            mysqli_stmt_bind_param($stmt, "ssss", $email, $first_name,
                                        $last_name, $telephone);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    // Get user from login
    $successful = update_user($id, $valuesUtente['email'],
                                $valuesUtente['first_name'],
                                $valuesUtente['last_name'],
                                $valuesUtente['telephone'], $con);

    mysqli_close($con);

    if ($successful) {
        // Success message
        sessionUtente($id, $valuesUtente['email'],
                        $valuesUtente['first_name'],
                        $valuesUtente['last_name'],
                        $valuesUtente['telephone']);
        header("Location: show_profile.php?id=". $_SESSION['id'] ."&msg=1");
    } else {
        // Error message
        header("Location: show_profile.php?id=". $_SESSION['id'] ."&err=2");
    }
?>