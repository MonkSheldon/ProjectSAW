<?php 
require_once("funzione.php");

//checkSession();
if (!isset($_POST['nome']) || !isset($_POST['marca']) ||
	!isset($_POST['tipoMotore']) || !isset($_POST['tipoModello']) ||
	!isset($_POST['Passeggeri']) || !isset($_POST['peso'])||
	!isset($_POST['potenza']) || !isset($_POST['prezzo']) ||
    !isset($_POST['larghezza']) || !isset($_POST['lunghezza'])||
    !isset($_POST['altezza'])||!isset($_POST['colore']))
{
    header("Location: A_formVeichle.php?err=1");
	exit();
}

$name=trim($_POST['nome']);
$brand=trim($_POST['marca']);
$type_engine=trim($_POST['tipoMotore']);
$type_model=trim($_POST['tipoModello']);
$passenger=trim($_POST['Passeggeri']);
$weight=trim($_POST['peso']);
$power=trim($_POST['potenza']);
$price=trim($_POST['prezzo']);
$width=trim($_POST['larghezza']);
$length=trim($_POST['lunghezza']);
$height=trim($_POST['altezza']);
$colore=trim($_POST['colore']);

if (empty($name) || empty($brand) 
    ||empty($type_engine) || empty($type_model)
    ||empty($passenger) ||empty($weight)
    ||empty($power) || empty($price)
    ||empty($width) || empty($length)
    ||empty($height)||empty($colore))
{
    header("Location: A_formVeichle.php?err=1");
	exit();
}

require_once('db/mysql_credentials.php');
function insert_Veichle($name, $brand, $type_engine, $type_model, $passenger, 
                        $weight, $power, $price, $width, $length, $height, $colore, $db_connection) 
{
    if ($stmt = mysqli_prepare($db_connection, "INSERT INTO modello
                (idModello, nome, marca, tipoMotore, tipoModello,
                    noPasseggeri, peso, potenza, prezzo, larghezza, 
                    lunghezza, altezza, colore) VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        mysqli_stmt_bind_param($stmt, "ssssidddddds", $name,  $brand, $type_engine, $type_model, $passenger, 
                            $weight, $power, $price, $width, $length, $height, $colore);
        
        $result=mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($result) 
        {
            return true;
        }
    }
    return false;
}
$successful = insert_Veichle($name, $brand, $type_engine, $type_model, $passenger, 
                    $weight, $power, $price, $width, $length, $height,$colore, $con);
    mysqli_close($con);

    if ($successful) 
    {
        header('Location: A_formVeichle.php?msg=1');
       // echo "modello inserito";
    } else 
    {
        //echo "Errore con l'inserimento del modello";
		header('Location: A_formVeichle.php?err=9');
	}
include('../html/footer.html');
?>
