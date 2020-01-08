<?php
    require_once('funzione.php');
    myHeader('CARRELLO', true);
    printMessage();
    
    if (!isset($_SESSION['carrello'])) {
        // fare messaggi di warning con questo echo 
        echo 'Non ci sono prodotti all\'interno del carrello';
    }
    else {
        $idModello_concatena = '';
        $virgola = false;

        foreach ($_SESSION['carrello'] as $key => $value) {
            if ($virgola)
                $idModello_concatena .= ', ';
            $idModello_concatena .= $key;
            $virgola = true;
        }
        
        require_once('db/mysql_credentials.php');
        
        $result = mysqli_query($con, 'SELECT idModello, nome, marca, prezzo
                                        FROM modello 
                                        WHERE idModello IN ('. $idModello_concatena. ')
                                        ORDER BY prezzo ASC');
        
        if ($result && mysqli_affected_rows($con) > 0) {
            $prezzo_totale = 0;

            echo '<b>Nome Marca Quantità Prezzo</b><br>';

            while ($row = mysqli_fetch_assoc($result)) {
                $prezzo_unitario = $row['prezzo'];
                $quantita = $_SESSION['carrello'][$row['idModello']];
                $prezzo_veicolo = $prezzo_unitario * $quantita;
                $prezzo_totale += $prezzo_veicolo;
                
                echo $row['nome']. ' '. $row['marca']. ' '. $quantita. ' '. $prezzo_unitario; ?>
                <a href='update_products.php?action=elimina&idModello=<?php echo $row['idModello']; ?>' class='btn btn-primary'>Rimuovi</a><br>
<?php
            }
            echo '<br><b>Totale:</b> '. $prezzo_totale;
            $_SESSION['totale'] = $prezzo_totale; ?>
            <br><a href='conferma_ordine.php'>Conferma ordine</a>
            <br><a href='update_products.php?action=svuota'>Svuota carrello</a>
<?php
        }
        mysqli_close($con);
    }
    include('../html/footer.html');
?>