<?php
    require_once('funzione.php');
    checkSession(true);
    myHeader('NUOVO MODELLO', true);
    printMessage();
?>
    <form action='A_inVeichle.php' method='POST'>
        <br><input type='text' name='name' placeholder='Name *' required>
        <br><br><input type='text' name='brand' placeholder='Brand *' required><br>
        
        <?php
            $fields = array('benzina', 'elettrico', 'gasolio', 'velocipede',
                            'aereo', 'auto', 'bicicletta', 'moto', 'nave', 'treno');
            $name = 'supply';
            foreach ($fields as $field) {
                if ($field == 'aereo') {
                    $name = 'type_model';
                    echo '<br>';
                }
            ?>
                <br><input type='radio' name='<?php echo $name; ?>'
                        value='<?php echo $field; ?>'
                        required><?php echo ucfirst($field);
            } ?>

        <br><br><input type='number' name='passenger' placeholder='Passenger *'required>
        <br><br><input type='number' name='weight' placeholder='Weight *' required>
        <br><br><input type='number' name='power' placeholder='Power *' required>
        <br><br><input type='number' name='price' placeholder='Price *' required>
        <br><br><input type='number' name='width' placeholder='Width *' required>
        <br><br><input type='number' name='length' placeholder='Length *' required>
        <br><br><input type='number' name='height' placeholder='Height *' required>
        <br><br><input type='color' name='color' required>
        <br><br><input type='submit' value='Submit'>
    </form>

<?php include('../html/footer.html'); ?>