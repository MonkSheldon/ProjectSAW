<?php
	require_once("funzione.php");
	myHeader("INDEX", true);
?>
	<div class="container-fluid" style="width: 100%; height:35%;">
		<div class="row">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php
					for ($i = 0; $i < 6; $i++) { ?>
						<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"
				<?php
						if ($i == 0) { ?>
							class="active"
				<?php
						} ?>
						></li>
				<?php
					} ?>
			</ol>
			<div class="carousel">
			<?php
				$mezzi = array("moto", "nave", "auto", "aereo", "treno", "bici");
				foreach ($mezzi as $mezzo) { ?>
			<?php
					if ($mezzo == "moto") { ?>
						<div class="carousel-item active show-for-large-up">
			<?php
					}
					else { ?>
						<div class="carousel-item">
			<?php
					} ?>
						<img class="d-block" src="../images/<?php echo $mezzo; ?>.jpg" style="width: 100%" alt="<?php echo $mezzo; ?>">
					</div>
			<?php
				} ?>
		  	</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		</div>
</div>
<br><h2>Veicoli</h2><br>
<div class="card-columns">
	<?php
		$veicoli = array("aereo", "bici", "moto", "macchina", "nave", "treno");
		foreach ($veicoli as $veicolo) { ?>
			<div class="card" style="width: 18rem">
				<img class="card-img-top" src="../images/vechicles/<?php echo $veicolo; ?>.jpg" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title"><?php echo ucfirst($veicolo); ?></h5>
						<p class="card-text">Dinanzi a me non fuor cose create se non etterne, e io etterno duro. Lasciate ogni speranza, voi ch'intrate</p>
					</div>
			</div>
	<?php
		} ?>
 </div>	
 <?php include('../html/footer.html');?>