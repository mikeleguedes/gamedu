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
margin-left:25%;

}

</style>
</head>
<body>
 <?php include '../menu.php';?>

<!--CONTEUDO AQUI -->
<form class="form-horizontal" method="POST"  action="../php/CadastrarTurma.php" style="margin-top:20px;">
<fieldset>

<!-- Form Name -->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome </label>  
  <input class="form-control input col-md-5" name="nome" type="text" placeholder="Ex. Técnico em informática para internet" required="">
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="periodo">Período</label>
    <select name="periodo" class="form-control input col-md-2">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="turno">Turno</label>
    <select name="turno" class="form-control input col-md-2">
      <option value="Vespertino">Vespertino</option>
      <option value="Matutino">Matutino</option>
      <option value="Noturno">Noturno</option>
    </select>
</div>

</fieldset>
<button id="singlebutton" name="singlebutton" style="border-radius:5px;margin-left:15% " class="btn btn-success">Cadastrar</button>
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
                    <h3 class="panel-title">Lista de Turmas</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>
			  <?php                      
			  include '../php/Conexao.php';
$stmt = $conexao->prepare("select * from turma");





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
                        <th>Turno</th>
						
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
                              <a class="btn btn-success"  href="../php/alterarTurma.php?idturma=<?php echo $linha['idturma']; ?>"><em class="fa fa-pencil"></em></a>
                              <a class="btn btn-danger" href="../php/DeletarTurma.php?idturma=<?php echo $linha['idturma']; ?>"><em class="fa fa-trash"></em></a>
                            </td>
                            <td class="hidden-xs"><?php echo $linha["idturma"]; ?></td>
                            <td><?php echo ($linha["nometurma"]); ?></td>
                            <td><?php echo ($linha["turnoturma"]); ?></td>
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




    <!-- Links -->
    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/plugins.js"></script>
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/widgets.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
	
</body>
</html>
