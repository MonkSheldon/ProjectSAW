<?php
    require_once('funzione.php');
    checkSession(false);
    myHeader('CAMBIA PASSWORD', true);
    printMessage();
?>
    <form action='changePwd.php' method='POST'>
        <!--<label for='pass'>Password *</label>-->
		<br><input type='password' name='pass' placeholder='password *' required><br>

        <!--<label for='newpass'>New Password *</label>-->
		<br><input type='password' name='newpass' placeholder='new password *' required><br>

        <!--<label for='confirm'>Confirm Password *</label>-->
        <br><input type='password' name='confirm' placeholder='confirm *' required><br>
    
        <br><input type='submit' value='Submit'>
    </form>
<?php
    include('../html/footer.html');
?>