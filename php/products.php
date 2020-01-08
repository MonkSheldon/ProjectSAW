<?php
	require_once('funzione.php');
  myHeader('PRODOTTI', true);
  require_once('db/mysql_credentials.php');

  $veicolo = $_GET['veicolo'];

  if ($stmt = mysqli_prepare($con,
						'SELECT idModello, nome, marca
              FROM modello
              WHERE tipoModello=?')) {
      mysqli_stmt_bind_param($stmt,'s', $veicolo);
      $result = mysqli_stmt_execute($stmt);
    if ($result) {
      mysqli_stmt_store_result($stmt);
      $norows = mysqli_stmt_num_rows($stmt);
      mysqli_stmt_bind_result($stmt, $idModello, $name, $marca);
      if ($norows >= 1) {?>
        <h2>I nostri veicoli</h2>
        <link rel='stylesheet' type='text/css' href='../css/pagina.css'>
        <div class='card-columns'>
        <?php 
          for ($i = 0; $i < $norows; $i++) { 
            mysqli_stmt_fetch($stmt); ?> 
            <div class='card' style='width: 18rem;'>
              <div class='card-body'>
                <p class='card-text'><?php echo 'Nome: '.$name. '<br>Marca: '. $marca;?></p>
                <a href='update_products.php?action=aggiungi&idModello=<?php echo $idModello;?>' class='btn btn-primary'>Aggiungi al carrello</a>
              </div>
            </div>
    <?php } ?>
        </div>
<?php
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
			}
		}
  }
  mysqli_close($con);
  
	include('../html/footer.html');
?>