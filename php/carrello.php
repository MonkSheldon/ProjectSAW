<?php
    require_once('funzione.php');
    myHeader('CARRELLO', true);
    printMessage();
    
    if (!isset($_SESSION['shoppingCart'])) {
        // fare messaggi di warning con questo echo 
        echo 'Non ci sono prodotti all\'interno del carrello';
    }
    else {
        $idModel_concatena = '';
        $comma = false;

        foreach ($_SESSION['shoppingCart'] as $idModel => $quantity) {
            if ($comma)
                $idModel_concatena .= ', ';
            $idModel_concatena .= $idModel;
            $comma = true;
        }
        
        require_once('db/mysql_credentials.php');
        
        $result = mysqli_query($con, 'SELECT idModello, nome, marca, prezzo
                                        FROM modello 
                                        WHERE idModello IN ('. $idModel_concatena. ')
                                        ORDER BY prezzo ASC');
        
        if ($result && mysqli_affected_rows($con) > 0) {
            $price_total = 0;

            echo '<b>Nome Marca Quantità Prezzo</b><br>';

            while ($row = mysqli_fetch_assoc($result)) {
                $price_unit = $row['prezzo'];
                $quantity = $_SESSION['shoppingCart'][$row['idModello']];
                $price_veichle = $price_unit * $quantity;
                $price_total += $price_veichle;
                
                echo $row['nome']. ' '. $row['marca']. ' '. $quantity. ' '. $price_unit; ?>
                <a href='update_products.php?action=elimina&idModel=<?php echo $row['idModello']; ?>' class='btn btn-primary'>Rimuovi</a><br>
<?php
            }
            echo '<br><b>Totale:</b> '. $price_total;
            $_SESSION['total'] = $price_total; ?>
            <br><a href='conferma_ordine.php'>Conferma ordine</a>
            <br><a href='update_products.php?action=svuota'>Svuota carrello</a>
<?php
        }
        mysqli_close($con);
    }
    include('../html/footer.html');
?>