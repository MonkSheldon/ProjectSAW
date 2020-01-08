<?php 
    require_once('funzione.php');
    checkSession(true);

    if (!isset($_POST['name']) || !isset($_POST['brand']) ||
        !isset($_POST['supply']) || !isset($_POST['type_model']) ||
        !isset($_POST['passenger']) || !isset($_POST['weight']) ||
        !isset($_POST['power']) || !isset($_POST['price']) ||
        !isset($_POST['width']) || !isset($_POST['length']) ||
        !isset($_POST['height']) || !isset($_POST['color'])) {
        header('Location: A_formVeichle.php?err=1');
        exit();
    }
    
    $name = trim($_POST['name']);
    $brand = trim($_POST['brand']);
    $supply = trim($_POST['supply']);
    $type_model = trim($_POST['type_model']);
    $passenger = trim($_POST['passenger']);
    $weight = trim($_POST['weight']);
    $power = trim($_POST['power']);
    $price = trim($_POST['price']);
    $width = trim($_POST['width']);
    $length = trim($_POST['length']);
    $height = trim($_POST['height']);
    $color = trim($_POST['color']);

    if (empty($name) || empty($brand) ||
        empty($supply) || empty($type_model) ||
        empty($passenger) || empty($weight) ||
        empty($power) || empty($price) ||
        empty($width) || empty($length) ||
        empty($height) || empty($color)) {
        header('Location: A_formVeichle.php?err=1');
        exit();
    }

    require_once('db/mysql_credentials.php');

    function insert_Veichle($name, $brand, $supply, $type_model, $passenger, $weight,
                    $power, $price, $width, $length, $height, $color, $db_connection) {
        if ($stmt = mysqli_prepare($db_connection, '
                INSERT INTO modello(idModello, nome, marca, alimentazione, tipoModello,
                                    noPasseggeri, peso, potenza, prezzo, larghezza, 
                                    lunghezza, altezza, colore)
                                    VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
            mysqli_stmt_bind_param($stmt, 'ssssidddddds', $name,  $brand, $supply,
                                    $type_model, $passenger, $weight, $power, $price,
                                    $width, $length, $height, $color);
            
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($result)
                return true;
        }
        return false;
    }

    $successful = insert_Veichle($name, $brand, $supply, $type_model, $passenger, 
                        $weight, $power, $price, $width, $length, $height, $color, $con);
                        
    mysqli_close($con);

    if ($successful)
        header('Location: A_formVeichle.php?msg=1');
    else
		header('Location: A_formVeichle.php?err=9');
?>
