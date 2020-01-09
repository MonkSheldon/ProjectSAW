<?php
	require_once('funzione.php');
	myHeader('INDEX', true);
?>

<!-- fai un file css con : -->
<div class='container-fluid'>
<br><h3>Parcheggi cari? 
	Stufo di dimenticare dove hai posteggiato il tuo aereo? </h3><br>
<h5 id='myh5'>
	VeichLe Resize è una strat-up innovativa genovese, che si occupa di introdurre veicoli di ogni genere ridimensionabili.
	Così da evitare l'inquinamento visivo di veicoli di ogni genere nelle strade.
	Infatti Veichle Resize dispone di una vasta gamma di prodotti, dalle auto agli aerei, dalle biciclette ai treni!
	... tranquillo, non rimarrai schiacciato all'interno dei veicoli, i nostri ingegneri si sono occupati dei miglior controlli su questo.
</h5>

	
		<div class='row'>
		<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
			<ol class='carousel-indicators'>
				<?php
					for ($i = 0; $i < 6; $i++) { ?>
						<li data-target='#carouselExampleIndicators' data-slide-to='<?php echo $i; ?>'
				<?php
						if ($i == 0) { ?>
							class='active'
				<?php
						} ?>
						></li>
				<?php
					} ?>
			</ol>
			<div class='carousel'>
			<?php
				$means = array('moto', 'nave', 'auto', 'aereo', 'treno', 'bici');
				foreach ($means as $half) { ?>
			<?php
					if ($half == 'moto') { ?>
						<div class='carousel-item active show-for-large-up'>
			<?php
					}
					else { ?>
						<div class='carousel-item'>
			<?php
					} ?>
						<img class='d-block' src='../images/<?php echo $half; ?>.jpg' style='width: 100%' alt='<?php echo $half; ?>'>
					</div>
			<?php
				} ?>
		  	</div>
			<a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
				<span class='carousel-control-prev-icon' aria-hidden='true'></span>
				<span class='sr-only'>Previous</span>
			</a>
			<a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
				<span class='carousel-control-next-icon' aria-hidden='true'></span>
				<span class='sr-only'>Next</span>
			</a>
		</div>
		</div>
</div>
<br><h2>Veicoli</h2><br>

<div class='card-columns'>
	<?php
		$veichles = array('aereo', 'auto', 'bici', 'moto', 'nave', 'treno');
		foreach ($veichles as $veichle) { ?>
			<div class='card' style='width: 18rem'>
				<a href='products.php?veichle=<?php echo $veichle; ?>'><img class='card-img-top' src='../images/vechicles/<?php echo $veichle; ?>.jpg' alt='Card image cap'>
					<div class='card-body'>
						<h4 class='card-title'><?php echo ucfirst($veichle); ?></h4>
						<p class='card-text'>Dinanzi a me non fuor cose create se non etterne, e io etterno duro. Lasciate ogni speranza, voi ch'intrate</p>
					</div>
				</a>
			</div>
	<?php
		} ?>
 </div>

 <?php include('../html/footer.html');?>