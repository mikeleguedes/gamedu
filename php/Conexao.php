<?php


	try{
	$conexao = new PDO('mysql:host=localhost;dbname=gamedu','root','@luno1fpe',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}catch(PDOException $e){
	echo 'ERROR: ' . $e->getMessage();
 

} 


?>
