<?php


include 'Conexao.php';
  
try{


$stmt = $conexao->prepare("UPDATE turma SET nometurma=?,turnoturma=? WHERE idturma= ?");



$nome= $_POST["nome"]; 
$turno= $_POST["turno"]; 
$periodo= $_POST["periodo"]; 
$nomeX= $nome. " - " .  $periodo;

$idturma= $_GET['idturma']; 




$stmt -> bindParam(1,$nomeX);
$stmt -> bindParam(2,$turno);
$stmt -> bindParam(3,$idturma);

$stmt->execute(); 
if($stmt->rowCount() >0){
	echo "<script language= 'JavaScript'>
location.href='../view/mensagem.php?msg=Alterado&url=registrarturmas.php'
</script>";
		
	}else{
	 echo '<script>
			alert("Não foi possivel alterar usuario.");
			location.href="../view/registrarturmas.php"
		</script>';
	}
	
	
}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();

}

?>
