<?php
	$host        = "host=localhost";
   $port        = "port=5432";
   $dbname      = "dbname=alpha_url";
   $credentials = "user=postgres password=balu";
	$conn = pg_connect("$host $port $dbname $credentials");
   if(!$conn)
    {
      echo "Error : Unable to open database\n";
   } 
?>