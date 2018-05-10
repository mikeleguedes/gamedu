<?php

	include 'Conexao.php';

		try{
		$stmt = $conexao->prepare("delete from turma where idturma = ?");

		$idturma= $_GET["idturma"]; 	 	   
		
		$stmt -> bindParam(1,$idturma);    
		$stmt->execute(); 

		
			 echo "<script language= 'JavaScript'>
location.href='../view/mensagem.php?msg=Excluído&url=registrarturmas.php'
</script>";
			

		}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();

		}

		
?>