<?php
    require_once('funzione.php');
    checkSession(true);
    myHeader('NUOVO MODELLO', true);
    printMessage();
?>
    <form action='A_inVeichle.php' method='POST'>
        <br><input type='text' name='nome' placeholder='Nome *' required>
        <br><br><input type='text' name='marca' placeholder='Marca *' required><br>
        
        <?php
            $campi = array('benzina', 'elettrico', 'gasolio', 'velocipede',
                            'aereo', 'auto', 'bicicletta', 'moto', 'nave', 'treno');
            $name = 'alimentazione';
            foreach ($campi as $campo) {
                if ($campo == 'aereo') {
                    $name = 'tipoModello';
                    echo '<br>';
                }
            ?>
                <br><input type='radio' name='<?php echo $name; ?>'
                        value='<?php echo $campo; ?> *'
                        required><?php echo ucfirst($campo);
            } ?>

        <br><br><input type='number' name='passeggeri' placeholder='Passeggeri'
                    required>
        <br><br><input type='number' name='peso' placeholder='Peso *' required>
        <br><br><input type='number' name='potenza' placeholder='Potenza *' required>
        <br><br><input type='number' name='prezzo' placeholder='Prezzo *' required>
        <br><br><input type='number' name='larghezza' placeholder='Larghezza *' required>
        <br><br><input type='number' name='lunghezza' placeholder='Lunghezza *' required>
        <br><br><input type='number' name='altezza' placeholder='Altezza *' required>
        <br><br><input type='color' name='colore *' required>
        <br><br><input type='submit' value='Submit'>
    </form>

<?php include('../html/footer.html'); ?>