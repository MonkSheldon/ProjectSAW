<?php
    require_once('funzione.php');
    myHeader('REIMPOSTA PASSWORD', false);
    printMessage();
?>
    <h3>Reimposta la password</h3>
    <p>Per reimpostarla occorre inserire la mail data al momento della registrazione</h3>
    <form action='forgotPwd.php' method='POST'>
        <!--abel for='email'>E-mail *</label>-->
		<br><input type='email' name='email' placeholder='email *' required><br>
    
        <br><input type='submit' value='Submit'>
    </form>
<?php
    include('../html/footer.html');
?>