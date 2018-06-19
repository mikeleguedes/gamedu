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
.form-group{
margin-left:30%;

}

</style>
</head>
<body>
 <?php include '../menu.php';?>


<!--CONTEUDO AQUI -->
<form class="form-horizontal" method="POST"  action="../php/CadastrarDisciplina.php" style="margin-top:20px;">
<fieldset>

<!-- Form Name -->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome </label>  
  <input class="form-control input col-md-5" name="nome" type="text" placeholder="Ex. Engenharia de SoftWare" required="">
</div>





</fieldset>
<button id="singlebutton" name="singlebutton"  style="margin-left:40%;border-radius:5px;"    class="btn btn-success">Cadastrar</button>
</form>


<!-- -->


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<div class="container">
    <div class="row">
    
    <p></p>
   
    <p> </p><p> </p>
    
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Lista de Disciplinas</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>
			  <?php                      
			  include '../php/Conexao.php';
$stmt = $conexao->prepare("select * from disciplina");





$stmt->execute();

if($stmt->rowCount() >0){
			  
			  ?>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th class="hidden-xs">ID</th>
                        <th>Nome</th>
                        
						
                    </tr> 
                  </thead>
				  <?php 
				  	}	

	$resultado = $stmt->fetchAll();

	foreach($resultado as $linha){
				  ?>
                  <tbody>
                          <tr>
                            <td align="center">
                              <a class="btn btn-success"  href="../php/alterarDisciplina.php?iddisciplina=<?php echo $linha['iddisciplina']; ?>"><em class="fa fa-pencil"></em></a>
                              <a class="btn btn-danger" href="../php/DeletarDisciplina.php?iddisciplina=<?php echo $linha['iddisciplina']; ?>"><em class="fa fa-trash"></em></a>
                            </td>
                            <td class="hidden-xs"><?php echo $linha["iddisciplina"]; ?></td>
                            <td><?php echo ($linha["descricaodisciplina"]); ?></td>
                            
                          </tr>
                        </tbody>
						<?php 
						} 
						?>
                </table>
            
              </div>
            
            </div>

</div></div></div>


        

    </div>
</div>


</body>

    <!-- Links -->
    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/plugins.js"></script>
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/widgets.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>

</html>
