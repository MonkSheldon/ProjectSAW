<?php
    require_once('funzione.php');
    myHeader('search', true);
    printMessage();
?>
    <form action='search.php' method='GET'>
       <label for='search'>Search</label>
        <br><br><input type='text' name='search' placeholder='cerca per marca *' required><br>
        <input type='submit' value='Submit'>
    </form>
<?php
    include('../html/footer.html');
?>