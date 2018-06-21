<?php include 'VerificarSession.php'?>
<?php
try{
	include 'Conexao.php';
	$Matricula = $_POST['matricula'];
	$Nome = $_POST['nome'];
	$Turma = $_POST['turma'];

if(isset($_POST['disciplinas'])){
	
	$Disciplinas = $_POST['disciplinas'];
	
//Cadastrar Alunos na tabela 'alunos', Disciplinas na tabela 'aluno_disciplina' e turma na tabela 'aluno_turma'
	//Inserir aluno	
$stmt = $conexao->prepare("insert into aluno(nomealuno,matricula,alunoativo) values (?,?,0)");
	
	

$stmt -> bindParam(1,$Nome);
$stmt -> bindParam(2,$Matricula);
	
$stmt->execute();




//Busca o ID do aluno inserido
		$stmt = $conexao->prepare("SELECT nomealuno,idaluno FROM aluno WHERE matricula = ?");
		$stmt -> bindParam(1,$Matricula);
		
		$stmt->execute();
		if($stmt->rowCount()>0){
	
		
		$resultado = $stmt->fetchAll();
		foreach($resultado as $linha){ 
		 $Idaluno = $linha['idaluno'];
				}
		}
 
	
	


//Insere aluno em 'aluno_turma'

$stmt = $conexao->prepare("insert into aluno_turma(aluno_idaluno,turma_idturma) values (?,?)");
	
	

$stmt -> bindParam(1,$Idaluno);
$stmt -> bindParam(2,$Turma);
	
$stmt->execute();  
//Busca o ID do aluno inserido
$stmt = $conexao->prepare("SELECT nomealuno,idaluno FROM aluno WHERE matricula = ?");

	$stmt -> bindParam(1,$Matricula);
		


		$stmt->execute();

		if($stmt->rowCount()>0){


		$resultado = $stmt->fetchAll();
		foreach($resultado as $linha){ 
		 $Idaluno = $linha['idaluno'];
		
		
		
		}

	}
 
	
	
 
for($i=0;$i<count($Disciplinas);$i++){
	
$stmt = $conexao->prepare("insert into aluno_disciplina(aluno_idaluno,disciplina_iddisciplina,disciplinaativo) values (?,?,1)");
$stmt -> bindParam(1,$Idaluno);
$stmt -> bindParam(2,$Disciplinas[$i]);

 $stmt->execute();
	
}






$_SESSION['erromatricula'] = "Aluno ".$Nome." cadastrado com sucesso!";
		echo "<script language= 'JavaScript'>
location.href='../view/mensagem.php?msg=Cadastrado&url=registraralunos.php'
</script>"; 
 
 
 
 

 
}
else{

 $_SESSION['erromatricula'] = "Você deve selecionar ao menos uma Disciplina!";
		echo "<script language= 'JavaScript'>
location.href='../SelecionarDisciplinas.php?nome=".$Nome."&matricula=".$Matricula."'
</script>";   


} 
	

}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();
}
?>
