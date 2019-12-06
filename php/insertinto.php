<!DOCTYPE html>
<html>
<body>
<?php
$mysqli = new mysqli("localhost", "root","FLV1920", "utenti");
if ($mysqli->connect_errno) {
    echo "Connessione fallita: ". $mysqli->connect_error . ".";
    exit();
}
//AGGIUNTI Password
$result="INSERT INTO user(idCliente,email,nome,cognome,password,telefono)VALUES 
('".mysqli_real_escape_string($mysqli,$_POST['idCliente'])."',
'".mysqli_real_escape_string($mysqli,$_POST['email'])."',
'".mysqli_real_escape_string($mysqli,$_POST['nome'])."',
'".mysqli_real_escape_string($mysqli,$_POST['cognome'])."',
'".mysqli_real_escape_string($mysqli,$_POST['password'])."',
'".mysqli_real_escape_string($mysqli,$_POST['telefono'])."')";


if ($mysqli->query($result) === TRUE) {
    echo "persona inserita!";
} else {
    echo "Error: " . $result. "<br>" . $mysqli->error;
}
?>
</html>


