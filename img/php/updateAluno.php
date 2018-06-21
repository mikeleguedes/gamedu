<?php include 'VerificarSession.php'?>
<?php


include 'Conexao.php';
  
try{
//Verifica se foi preenchido os campos do formulário de alteração	
if(isset($_POST['disciplinas']) and isset($_POST['nome']) and isset($_POST['matricula']) and isset($_POST['turma'])){
$nome= ($_POST["nome"]); 
$matricula= ($_POST["matricula"]); 
$Disciplinas= $_POST["disciplinas"]; 
$idaluno= $_GET['idaluno'];
if(isset($_POST['ativo'])){
     $ativo = $_POST['ativo'][0];	
}else{
	 $ativo =0;
}

$Turma= $_POST['turma'];
//echo "teste".$idaluno;

//Deleta todos os Registros em aluno_disciplina do aluno
$stmt = $conexao->prepare("DELETE FROM aluno_disciplina WHERE aluno_idaluno =?");
$stmt -> bindParam(1,$idaluno);
$stmt->execute(); 

//Update na tabela aluno
$stmt = $conexao->prepare("UPDATE aluno SET nomealuno=?,matricula=?,alunoativo=? WHERE idaluno= ?");
$stmt -> bindParam(1,$nome);
$stmt -> bindParam(2,$matricula);
$stmt -> bindParam(3,$ativo);
$stmt -> bindParam(4,$idaluno);
$stmt->execute(); 


//Update na tabela aluno_turma
$stmt = $conexao->prepare("UPDATE aluno_turma SET turma_idturma=? WHERE aluno_idaluno= ?");
$stmt -> bindParam(1,$Turma);
$stmt -> bindParam(2,$idaluno);
$stmt->execute();

//Registra todas disciplinas selecionadas
for($i=0;$i<count($Disciplinas);$i++){
	
$stmt = $conexao->prepare("insert into aluno_disciplina(aluno_idaluno,disciplina_iddisciplina) values (?,?)");
$stmt -> bindParam(1,$idaluno);
$stmt -> bindParam(2,$Disciplinas[$i]);

 $stmt->execute();

}

$_SESSION['erromatricula'] = "Aluno ".$nome." alterado com Sucesso!";
 		echo "<script language= 'JavaScript'>
 location.href='../view/mensagem.php?msg=Alterado&url=registraralunos.php'
 </script>"; 	
		
		
	


}else{
		
	 $_SESSION['erromatricula'] = "Você deve preencher todos os campos e selecionar ao menos uma Disciplina!";
		echo "<script language= 'JavaScript'>
location.href='../view/mensagem.php?msg=Alterado&url=alterarAluno.php'
</script>"; 	
		
		
	}
	
	
}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();

}

?>



