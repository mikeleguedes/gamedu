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
<style>
form{
margin-left:35%;

}

</style>
</head>
<body>
 <?php include '../menu.php';
      include '../php/VerificarSession.php';
      include '../php/Conexao.php';
 ?>

<!--CONTEUDO AQUI -->
<form class="form-horizontal" id="formatividade" method="get" action="registraratividades2.php" >
<fieldset>

<!-- Erros gerados no cadastro/alteração-->
<?php 

if(isset($_SESSION['erromatricula'])){
 echo "<center><h4 style='color:red;'>".$_SESSION['erromatricula']."</h4></center>";

 unset( $_SESSION['erromatricula'] );

}

?>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome da Atividade</label>  
  <input class="form-control input col-md-4" name="nome" type="text" placeholder="Ex: Teste de Software" required="">
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="matricula">Tipo Atividade</label>  
   <select class="form-control input col-md-4" name="tipoatividadeList" >
  <?php
  //Seleciona todas disciplinas e lista no form
  
  $stmt = $conexao->prepare("SELECT * FROM atividade_tipo ");
  $stmt->execute();

    if($stmt->rowCount()>0){

  
    

    $resultado = $stmt->fetchAll();
    foreach($resultado as $linha){ 
    ?>
     <option value="<?php echo $linha['id']; ?>"><?php echo ($linha['descricao']); ?></option>
   
   <?php
    }
    
    }
  
  

  
?> 
     
  </select>

</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="matricula">Semestre</label>  
      <select class="form-control input col-md-4" name="semestreList" >
  <?php
  //Seleciona todas disciplinas e lista no form
  
  $stmt = $conexao->prepare("SELECT * FROM semestre where ativo =1");
  $stmt->execute();

    if($stmt->rowCount()>0){

  
    

    $resultado = $stmt->fetchAll();
    foreach($resultado as $linha){ 
    ?>
     <option value="<?php echo $linha['id']; ?>"><?php echo ($linha['semestre']); ?></option>
   
   <?php
    }
    
    }
  
  

  
?> 
      
    </select>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="matricula"></label>  
  <div class="col-md-4">
  <input type="submit" name="submitatividade" style="margin-left:15%;margin-top:5%;border-radius:5px;" class="btn btn-primary btn-info" value="Selecionar Disciplina">  
 </div>
</div>

</fieldset>




<!-- -->


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>


		  
	</form>
		 


<!-- Form Name -->


<!-- Select Basic -->



  <!-- Links -->
<script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/widgets.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
	
</body>
</html>
