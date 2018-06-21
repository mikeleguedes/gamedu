<?php include 'VerificarSession.php'; ?>
<?php


include 'Conexao.php';
  
try{
//Verifica se foi preenchido os campos do formulário de alteração	
if(isset($_POST['tipousuario_idtipousuario']) and isset($_POST['nomeusuario']) and isset($_POST["cpfusuario"]) and isset($_POST["nomereduzido"]) )	{
$nomeusuario= ($_POST["nomeusuario"]); 
$cpfusuario= ($_POST["cpfusuario"]); 
$nomereduzido= ($_POST["nomereduzido"]); 
$tipousuario_idtipousuario = $_POST["tipousuario_idtipousuario"];
$Disciplinas= $_POST["disciplinas"]; 
$idusuario= $_GET['idusuario']; 
//echo "teste".$idusuario;

//Deleta todos os Registros em usuario_disciplina do usuario
$stmt = $conexao->prepare("DELETE FROM usuario_disciplina WHERE usuario_idusuario =?");
$stmt -> bindParam(1,$idusuario);
$stmt->execute(); 

//Update na tabela usuario
$stmt1 = $conexao->prepare("UPDATE usuario SET nomeusuario=?,cpfusuario=?, nomereduzido=?, tipousuario_idtipousuario=? WHERE idusuario= ?");
$stmt1 -> bindParam(1,$nomeusuario);
$stmt1 -> bindParam(2,$cpfusuario);
$stmt1 -> bindParam(3,$nomereduzido);
$stmt1 -> bindParam(4,$tipousuario_idtipousuario);
$stmt1 -> bindParam(5,$idusuario);
$stmt1->execute(); 




//Registra todas disciplinas selecionadas
for($i=0;$i<count($Disciplinas);$i++){
	
$stmt2 = $conexao->prepare("insert into usuario_disciplina(usuario_idusuario,disciplina_iddisciplina) values (?,?)");
$stmt2 -> bindParam(1,$idusuario);
$stmt2 -> bindParam(2,$Disciplinas[$i]);

 $stmt2->execute();

}

$_SESSION['erromatricula'] = "Usuario ".$nomeusuario." alterado com Sucesso!";
		echo "<script language= 'JavaScript'>
location.href='../view/mensagem.php?msg=Alterado&url=registrarusuario.php'
</script>"; 	
		
		
	


}else{
		
	 $_SESSION['erromatricula'] = "Você deve preencher todos os campos e selecionar ao menos uma Disciplina!";
		echo "<script language= 'JavaScript'>
location.href='../view/mensagem.php?msg=Alterado&url=alterarUsuario.php'
</script>"; 	
		
		
	}
	
	
}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();

}

?>



