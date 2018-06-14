<?php
try{
	include 'Conexao.php';


    $Nome= $_POST["nome"]; 
	$Periodo= $_POST["periodo"]; 
	$Turno= $_POST["turno"]; 
	$NomeX= $Nome . " - " . $Periodo;
    







	
$stmt = $conexao->prepare("insert into turma(nometurma,turnoturma,periodo) values (?,?,?)");
	
	

	$stmt -> bindParam(1,$NomeX);
	$stmt -> bindParam(2,$Turno);
	$stmt -> bindParam(3,$Periodo);


	


$stmt->execute(); 



echo "<script language= 'JavaScript'>
location.href='../mensagem.php?msg=Cadastrado&url=registrarturmas.php'
</script>";
	


  
	}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();
 


} 
	


?>