<?php
    require_once("funzione.php");
    checkSession();
    myHeader("CAMBIA PASSWORD", true);
    
    if (count($_GET) > 0) {
        if ($_GET['msg'] == "1") { ?>
            <div class="alert alert-success">
                La password è stata cambiata correttamente
            </div>
    <?php
        }
        else {
            controlError($_GET['err']);
        }
    }
?>
    <form action="changePwd.php" method="POST">
        <!--<label for="pass">Password *</label>-->
		<br><input type="password" name="pass" placeholder="password *" required><br>

        <!--<label for="newpass">New Password *</label>-->
		<br><input type="password" name="newpass" placeholder="new password *" required><br>

        <!--<label for="confirm">Confirm Password *</label>-->
        <br><input type="password" name="confirm" placeholder="confirm *" required><br>
    
        <br><input type="submit" value="Submit">
    </form>
<?php
    include('../html/footer.html');
?>