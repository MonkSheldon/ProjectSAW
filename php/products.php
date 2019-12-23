<?php
	require_once("funzione.php");
  myHeader("prodotti", true);
  require_once('db/mysql_credentials.php');
  $veicolo = $_GET['veicolo'];

 if ($stmt = mysqli_prepare($con,
						"SELECT nome, marca, tipoMotore, tipoModello, noPasseggeri, 
            peso, potenza, prezzo, larghezza, lunghezza,
             altezza FROM modello
              WHERE tipoModello=?")); 
    {
      mysqli_stmt_bind_param($stmt,'s',$veicolo);
      $result = mysqli_stmt_execute($stmt);
      
    if ($result) 
      {
        //mysqli_stmt_get_result
				mysqli_stmt_store_result($stmt);
        $norows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_bind_result($stmt,$name,  $brand, $type_engine, $type_model, $passenger, 
        $weight, $power, $price, $width, $length, $height);
         if ($norows >= 1) {?>
          <h2> I nostri veicoli </h2>
          <link rel="stylesheet" type="text/css" href="../css/pagina.css">
          <div class="card-columns">
              <?php for ($i = 0; $i < $norows; $i++) { 
              mysqli_stmt_fetch($stmt);?> 
              <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <p class="card-text"><?php echo $name;?> </p>
                <a href="" class="btn btn-primary">Aggiungi al carrello</a>
                </div>
              </div> <?php }
               ?>
          </div><?php
          
      mysqli_stmt_free_result($stmt);
      mysqli_stmt_close($stmt);
				}
			}
    }
    mysqli_close($con);
   
?>

<?php
	include("../html/footer.html");
?>