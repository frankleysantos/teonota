<?php
   try {
   	    global $pdo;
    	$pdo = new PDO ("mysql:dbname=sorteio; host=localhost", "root", "");
    } catch (PDOException $e) {
    	echo "ERRO:".$e->getMessage();;
    } 
 ?>
