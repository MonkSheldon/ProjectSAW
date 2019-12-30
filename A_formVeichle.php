<?php

    require_once("funzione.php");
    myHeader("Prodotti", false);
    require_once('db/mysql_credentials.php');

    if (count($_GET) > 0) {
		if (isset($_GET['msg']) && $_GET['msg'] == "1") { ?>
			<div class="alert alert-success">
				<strong>Modello inserito</strong> 
			</div>
	<?php
		}
		else {
			controlError($_GET['err']);
		}
	}
    ?>
    <form action="A_inVeichle.php" method="POST">

       <br> <input type="text" name="nome" placeholder="nome" required><br>
       <br> <input type="text" name="marca" placeholder="marca" required><br>

        <input type="radio" name="tipoModello" value='macchina' required>Macchina<br>
        <input type="radio" name="tipoModello" value='moto' required>Moto<br>
        <input type="radio" name="tipoModello" value='treno' required>Treno<br>
        <input type="radio" name="tipoModello" value='nave' required>Nave<br>
        <input type="radio" name="tipoModello" value='aereo' required>Aereo<br>
        <input type="radio" name="tipoModello" value='biciletta' required>Bicicletta<br>

        <br><input type="number" name="Passeggeri" required><br>

        <input type="radio"   name="tipoMotore" value='benzina' required>benzina<br>
        <input type="radio"   name="tipoMotore" value='gasolio' required>gasolio<br>
        <input type="radio"   name="tipoMotore" value='elettrico' required>elettrico<br>
        <input type="radio"   name="tipoMotore" value='velocipede' required>velocipede<br>
      
        <br> <input type="number"  name="peso" placeholder="peso" required><br>
        <br> <input type="number"  name="potenza" placeholder="potenza" required><br>
        <br> <input type="number"  name="prezzo" placeholder="prezzo" required><br>
        <br> <input type="number"  name="larghezza" placeholder="larghezza" required><br>
        <br> <input type="number"  name="lunghezza" placeholder="lunghezza" required><br>
        <br><input type="number"  name="altezza" placeholder="altezza" required><br>    
        <br><input type ="color" name="colore" required><br>
    <br><input type="submit" value="Submit">
    </form>

<?php
    include('../html/footer.html');
?>
