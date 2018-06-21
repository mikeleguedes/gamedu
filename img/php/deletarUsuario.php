<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gamedu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-icon.png">
  <link rel="shortcut icon" href="favicon.ico">

  <link rel="stylesheet" href="../assets/css/normalize.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/scss/style.css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
<?php
	include 'menu.php';
	include 'Conexao.php';

$idusuario= $_GET["idusuario"];
$nomeusuario= $_GET["nomeusuario"];
		try{
		
		
		
		$stmt = $conexao->prepare("delete from usuario where idusuario = ?");

		 	 	   
		
		$stmt -> bindParam(1,$idusuario);    
		$stmt->execute(); 

/*  "pra quando for implementar usuario ligado a tabela usuario_disciplina"


		$stmt = $conexao->prepare("delete from usuario_disciplina where usuario_idusuario = ?");

		 	 	 		
		$stmt -> bindParam(1,$idusuario);    
		$stmt->execute();

		*/
		
	$_SESSION['erromatricula'] = "<b>Aluno ".$nomeusuario." Deletado com sucesso!</b>";
		echo "<script language= 'JavaScript'>
location.href='../view/mensagem.php?msg=Excluído&url=registrarusuario.php'
</script>"; 	
			
		
		}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();

		}
		
?>
