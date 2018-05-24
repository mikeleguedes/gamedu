<?php include '../php/VerificarSession.php'; ?>
<?php


include '../php/Conexao.php';




try{
$stmt = $conexao->prepare("select * from usuario where idusuario = ?");


$idusuario= $_POST["idusuario"]; 
$stmt->bindValue(1,$idusuario);

$stmt->execute();

$resultado = $stmt->fetchAll();


foreach($resultado as $linha){


?>
<html>
<head>
		<meta charset="utf-8">
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
<title>Cadastrar Disciplina Professor</title>

 <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-icon.png">
  <link rel="shortcut icon" href="favicon.ico">

  <link rel="stylesheet" href="../assets/css/normalize.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/scss/style.css">


  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
<style>
 form{
  margin-left: 35%;
 } 
</style> 
</head>

<body>

<?php include '../menu.php';?>

<form class="form-horizontal" method="POST" action="updateDisciplinaProfessor.php?idusuario=<?php echo $idusuario; ?>">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label lass="form-control input col-md-3" for="nomereduzido">Nome reduzido</label>  
  <input name="nomereduzido" type="text" value="<?php echo $linha['nomereduzido'] ?>" class="form-control input col-md-4" required="">
    
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="disciplinas"></label>  
  <div class="col-md-8 col-md-offset-3">
<!-- Select Basic -->
<?php
  //Seleciona todas disciplinas e lista no form; traz as disciplinas cadastradas de determinado usuário 
  $stmt = $conexao->prepare("SELECT * FROM disciplina");

		$stmt->execute();

		if($stmt->rowCount()>0){

	
		
$i=0;
		$resultado = $stmt->fetchAll();
		foreach($resultado as $linha){ 
		$stmt2 = $conexao->prepare("SELECT * FROM usuario_disciplina WHERE usuario_idusuario=? and disciplina_iddisciplina=?;");
		$stmt2 -> bindParam(1,$idusuario);
		$stmt2 -> bindParam(2,$linha['iddisciplina']);
		$stmt2->execute();
		if($stmt2->rowCount()>0){
	   echo "<fieldset class='col-sm-6'><label>
      <input type='checkbox' value=".$linha['iddisciplina']." name='disciplinas[]' checked style='background-color=red;' />
      <span style='font-size:18px'>".($linha['descricaodisciplina'])."</span>
   </label></fieldset>";
		}else{
		echo "<fieldset class='col-sm-6'><label>
      <input type='checkbox' value=".$linha['iddisciplina']." name='disciplinas[]'  />
      <span style='font-size:18px'>".($linha['descricaodisciplina'])."</span>
   </label></fieldset>";

		
		}
   
		}
		
		}
  
  

  
?> 

  </div>
</div>

<button id="singlebutton" name="singlebutton"  style="margin-left:25%;border-radius: 5px;"    class="btn btn-success">Cadastrar</button>
</fieldset>
</form>
	

<!-- Links -->
  <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/widgets.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>

</body>
</html> 
<?php
}
}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();
} 

?>