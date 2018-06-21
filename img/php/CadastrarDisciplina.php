<?php
try{
	include 'Conexao.php';


	$Nome= $_POST["nome"]; 
	
	$stmt = $conexao->prepare("insert into disciplina(descricaodisciplina) values (?)");
	

	$stmt -> bindParam(1,$Nome);


	$stmt->execute(); 



	echo '<script>alert("Cadastro Realizado com Sucesso!");
	location.href="../view/registrardisciplinas.php"	
		</script>';




}catch(PDOException $e){
	echo 'ERROR: ' . $e->getMessage();



} 



?>
