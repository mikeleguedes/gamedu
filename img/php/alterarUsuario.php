<?php include 'VerificarSession.php'?>
<?php


include 'Conexao.php';


try{
$stmt = $conexao->prepare("select * from usuario where idusuario = ?");


$idusuario= $_GET["idusuario"]; 

$stmt->bindValue(1,$idusuario);

$stmt->execute();
$resultado = $stmt->fetchAll();





	

foreach($resultado as $linha){


?>
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
<?php include '../menu.php'; ?>

<form class="form-horizontal" method="POST" action="updateUsuario.php?idusuario=<?php echo $idusuario; ?>" style="margin-left:-10%;">

<fieldset style="padding-left: 150px;">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nomeusuario">Nome Completo</label>  
  <input class="form-control input col-md-5" name="nomeusuario" type="text" placeholder="" value="<?php echo $linha['nomeusuario'] ?>">
</div>

<!-- Text input-->  
<div class="form-group">
  <label class="col-md-4 control-label" for="nomereduzido">Nome reduzido</label>  
  <input class="form-control input col-md-5" name="nomereduzido" type="text" placeholder=""  value="<?php echo $linha['nomereduzido'] ?>">
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cpfusuario">CPF</label>  
  <input class="form-control input col-md-3" name="cpfusuario" type="text" value="<?php echo $linha['cpfusuario'] ?>" required="">
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tipousuario_idtipousuario">Tipo de Usuário</label>
  <select name="tipousuario_idtipousuario" class="form-control input col-md-2">
  <option >Escolha... </option>
  <option value="1" <?php if(($linha["tipousuario_idtipousuario"]) == 1){ echo "selected";}?> > Professor</option>
  <option value="2" <?php if(($linha["tipousuario_idtipousuario"]) == 2){ echo "selected";}?>> Técnico</option>
  <option value="3" <?php if(($linha["tipousuario_idtipousuario"]) == 3){ echo "selected";}?>> Administrador</option>
  </select> 
</div>

<div class="form-group">
  <div class="col-md-8">
<!-- Select Basic -->
<?php
  //Seleciona todas disciplinas e lista no form
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

<button id="singlebutton" name="singlebutton"  style="margin-left:45%;"    class="btn btn-success">Alterar</button>
</fieldset>
</form>
	

		

</body>
</html> 
<?php
}
}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();
} 

?>