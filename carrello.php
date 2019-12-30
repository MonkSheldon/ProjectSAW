<?php
    require_once("funzione.php");
    myHeader("carrello", true);
    
    if(!isset($_SESSION['carrello']))
    {
        // fare messaggi di warning con questo echo 
        echo "non ci sono prodotti all'interno del carrello";
       exit(); 
    }
    require_once('db/mysql_credentials.php');
    $idModello_concatena='';
    $virgola=false;

    foreach($_SESSION['carrello'] as $key => $value)
    {
        if($virgola)
            $idModello_concatena.=', ';
           
        $idModello_concatena.=$key;
        $virgola=true;
    }
    
    $query="SELECT idModello, nome, marca, prezzo
                FROM modello 
                    WHERE idModello IN ($idModello_concatena) ORDER BY prezzo ASC";
    
    $result=mysqli_query($con,$query);
    if($result)
    {
        if(mysqli_affected_rows($con)>0)
        {
            $prezzo_totale=0;

            echo "<b> Nome </b>";
            echo "<b> Marca </b>";
            echo "<b> Quantità </b>";
            echo "<b> Prezzo </b> <br>";

            while($row = mysqli_fetch_assoc($result))
            {
                $prezzo_veicolo=$row['prezzo']*$_SESSION['carrello'][$row['idModello']];
                $prezzo_totale+=$prezzo_veicolo;
                
                echo " ".$row['nome'];
                echo " ".$row['marca'];
                echo " ".$_SESSION['carrello'][$row['idModello']];
                echo " ".$row['prezzo'];?>
                <a href="update_products.php?action=elimina&idModello=<?php echo $row['idModello'];?>" class="btn btn-primary">Rimuovi</a>
                <?php echo "<br>";
            }
                echo "<br><b>Totale:</b>" .$prezzo_totale;?>
                <a href="conferma_ordine.php">AConferma ordine</a><?php
        }
    }


    mysqli_close($con);
    include("../html/footer.html");
?>