<?php
	require_once("funzione.php");
	myHeader("pagina", true);
?>
<h2> Titolo della pagina </h2>
<link rel="stylesheet" type="text/css" href="../css/pagina.css">
<div class="card-columns">
<?php for ($i = 0; $i < 3; $i++) { ?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <p class="card-text">Vuolsi così colà dove si puote ciò che si vuole, e più non dimandare</p>
    <a href="https://www.google.it/" class="btn btn-primary">cliccami</a>
  </div>
</div> <?php } ?>
</div>
<!--<div class="card-columns">
	<div class="card" style="width: 18rem;">
	  <div class="card-body">
		<p class="card-text">Vuolsi così colà dove si puote ciò che si vuole, e più non dimandare1</p>
		<a href="https://www.google.it/" class="btn btn-primary">cliccami</a>
	  </div>
	</div>
	<div class="card" style="width: 18rem;">
	  <div class="card-body">
		<p class="card-text">Vuolsi così colà dove si puote ciò che si vuole, e più non dimandare2</p>
		<a href="https://www.google.it/" class="btn btn-primary">cliccami</a>
	  </div>
	</div>
	<div class="card" style="width: 18rem;">
	  <div class="card-body">
		<p class="card-text">Vuolsi così colà dove si puote ciò che si vuole, e più non dimandare3</p>
		<a href="https://www.google.it/" class="btn btn-primary">cliccami</a>
	  </div>
	</div>
</div>-->
 <?php include('../html/footer.html');?>