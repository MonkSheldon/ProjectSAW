<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Open DBMS Server connection

// Get search string from $_GET['search']
// but do it IN A SECURE WAY
$search = $_GET['search']; // replace null with $_GET and sanitization
if(!isset($_GET['search'])||empty($_GET['search'] ))
{
	header('Location: searchHTML.html');
	exit();
}		
echo $search;	
function search($search, $db_connection) {
 $search=trim($search);
 $query="SELECT * from cliente WHERE email='".$search."'";
$result=mysqli_query($db_connection,$query);
			
			if (mysqli_affected_rows($db_connection)==1) {				
				 return mysqli_fetch_assoc($result);
			} else {
				return null;
			}
}

// Get user from login
$results = search($search, $con);

if ($results) {
    foreach ($results as $result) {
       // Format as you like and print search results
       echo $result;
    }
} else {
    // No matches found
  header('Location: index.php');
	exit();
}
?>
