<!doctype html>
<html lang="pt">
<head>
<?php include '../php/VerificarSession.php';?>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="assets/img/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
  margin-left: 25%;
 } 
</style>
</head>
<body>
 <?php include '../menu.php';?>


<!--CONTEUDO AQUI -->
<br>
<form class="form-horizontal" method="POST" action="../php/CadastrarDisciplinaProfessor.php" style="margin-left: 30%;">
    <div class="col-md-4 col-md-offset-3">
        <select name="idusuario" class="form-control">
        <option> Selecione o professor...</option>
      <?php
      //Seleciona todos os professores e lista no form
      include '../php/Conexao.php';
      $stmt = $conexao->prepare("SELECT * FROM usuario ");
      $stmt->execute();

        if($stmt->rowCount()>0){

      
        

        $resultado = $stmt->fetchAll();
        foreach($resultado as $linha){ 
        ?>
         <option value="<?php echo $linha['idusuario']; ?>"><?php echo ($linha['nomeusuario']); ?></option>
       
       <?php
        }   
        }
        
     ?> 
       </select>

      <p></p>
  
    <button type="submit" name="singlebutton"  style="margin-left:35%;border-radius: 5px;"  class="btn btn-success">Buscar</button>  

    </div>
</div>
</fieldset>


</form> 
</body>

 <!-- Links -->
  <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/widgets.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>   
  

</html>
