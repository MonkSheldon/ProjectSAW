<?php
    require_once('funzione.php');
    checkSession(true);
    myHeader('GESTIONE MODELLI', true);
?>
    <a href='A_formVeichle.php'>Nuovo Modello</a>
    <br><br>
<?php
    require_once('db/mysql_credentials.php');

    $result = mysqli_query($con, 'SELECT *
                                    FROM modello
                                    ORDER BY nome, marca ASC');
    
    if ($result && mysqli_affected_rows($con) > 0) {
        echo '<b>idModello nome marca alimentazione tipoModello noPasseggeri peso potenza 
                prezzo larghezza lunghezza altezza colore</b>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<br>'. $row['idModello']. ' '. $row['nome']. ' '. $row['marca']. ' '.
                $row['alimentazione']. ' '. $row['tipoModello']. ' '.
                $row['noPasseggeri']. ' '. $row['peso']. ' '. $row['potenza']. ' '.
                $row['prezzo']. ' '. $row['larghezza']. ' '. $row['lunghezza']. ' '.
                $row['altezza']. ' '. $row['colore'];
        }
    }
    else
        echo 'Nessun modello inserito nel sistema';

    mysqli_close($con);

    include('../html/footer.html');
?>