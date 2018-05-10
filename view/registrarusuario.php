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
 <?php include '../menu.php';?>

<form class="form-horizontal" method="post" action="../php/CadastrarUsuario.php" >

  <?php 
      //Erros gerados no cadastro/alteração
  if(isset($_SESSION['erromatricula'])){
   echo "<center><h4 style='color:red;'>".$_SESSION['erromatricula']."</h4></center>";

   unset( $_SESSION['erromatricula'] );
    }
  ?>

  <fieldset>
     <div class="form-group text-">
      <label class="col-md-4 control-label" for="nomeusuario">Nome completo</label>  
      <div class="">
        <input class="form-control input col-md-5" name="nomeusuario" type="text">

     
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="nomereduzido">Nome reduzido</label>  
      <div class="">
        <input class="form-control input col-md-5" name="nomereduzido" type="text" required="" >

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="cpfusuario">CPF</label>  
      <div class="">
        <input class="form-control input col-md-5" name="cpfusuario" type="text" placeholder="sem pontos ou traços" maxlength="11">

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="senha">Senha</label>  
      <div class="">
        <input class="form-control input col-md-5" name="senha" type="password" required="" >

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="tipousuario_idtipousuario">Tipo de Usuário</label>
        <select name="tipousuario_idtipousuario" class="form-control input col-md-2" >
         <option >Escolha... </option>
         <option value="1" > Professor</option>
         <option value="2" > Técnico</option>
         <option value="3" > Administrador</option>
       </select>	
   </div>



    <div class="container">
      <div class="row">  
        <div class="form-group">
         <input type="submit" style="border-radius: 5px;" class="btn btn-primary btn-success" value="Cadastrar">     
        </div>  
      </div>
    </div> 

  </fieldset>
</form>
  




        <?php
          //Lista usuario
        if(isset($_GET['disciplinaList'])){
        ?>


 <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Lista de usuarios</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>
			  <?php                      
			  include '../php/Conexao.php';
$stmt = $conexao->prepare("SELECT * FROM `usuario`");

 $DisciplinaList = $_GET['disciplinaList'];
$stmt -> bindParam(1,$DisciplinaList);
$stmt->execute();

if($stmt->rowCount() >0){
			  
			  ?>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list" id="conteudo">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th class="hidden-xs">ID</th>
                        <th></th>
                        
						<th>Nome</th>
						<th>Cpf </th>
						
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
                              <a class="btn btn-success"  href="../php/alterarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>"><em class="fa fa-pencil"></em></a>
                              <a target="_blank" href="../php/deletarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>&nomeusuario=<?php echo $linha['nomeusuario']; ?>"id="Clique<?php echo $linha["idusuario"]; ?>" class="btn btn-danger" ><em class="fa fa-trash"></em></a>
                           <div id="escondido<?php echo $linha["idusuario"]; ?>" style="display:none;">
						   Tem certeza que deseja deletar esse Usuario? <?php echo ($linha["nomeusuario"]); ?> ? <br>
    <a  id="Clique" class="btn btn-success" href="../php/deletarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>&nomeusuario=<?php echo $linha['nomeusuario']; ?>"><em class="fa fa-check"></em></a>
</div>
<script>
$( "#Clique<?php echo $linha["idusuario"]; ?>" ).click(function() {
  $("#escondido<?php echo $linha["idusuario"]; ?>").css("display","block");
});
 </script>
						   
						   </td>
                            <td class="hidden-xs"><?php echo $linha["idusuario"]; ?></td>
                            <td><?php echo ($linha["cpfusuario"]); ?></td>
                           
							  <td><?php echo ($linha["nomeusuario"]); ?></td>
							    <td><?php echo ($linha["cpfusuario"]); ?></td>
							<!-- <td><?php if(($linha["alunoativo"]) == 1){
					echo "Sim";		}else{ echo "Não";}								?></td> -->
                          </tr>
                        </tbody>
						<?php 
						} 
						?>
                </table>
				<table id="paginador" border="1">
			
		</table>
            
              </div>
            
            </div>

</div></div></div>
 
<?php											
 }else{
	 
?>



 <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Lista de Usuarios</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>
			  <?php                      
			  include '../php/Conexao.php';
$stmt = $conexao->prepare("SELECT * FROM usuario");

$stmt->execute();

if($stmt->rowCount() >0){
			  
			  ?>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list" id="conteudo">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th class="hidden-xs">ID</th>
                        <th>CPF</th>
			<th>Nome</th>
			<th>Ativo</th>
      <th>Tipo</th>
						
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
                              <a class="btn btn-success"  href="../php/alterarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>"><em class="fa fa-pencil"></em></a>
                              <a target="_blank" href="../php/deletarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>&nomeusuario=<?php echo $linha['nomeusuario']; ?>" id="Clique<?php echo $linha["idusuario"]; ?>" class="btn btn-danger" ><em class="fa fa-trash"></em></a>
                           <div id="escondido<?php echo $linha["idusuario"]; ?>" style="display:none;">
						   Tem certeza que deseja deletar o Usuário <?php echo ($linha["nomeusuario"]); ?> ? <br>
    <a  id="Clique" class="btn btn-success" href="../php/deletarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>&nomeusuario=<?php echo $linha['nomeusuario']; ?>"><em class="fa fa-check"></em></a>
</div>
<script>
$( "#Clique<?php echo $linha["idusuario"]; ?>" ).click(function() {
  $("#escondido<?php echo $linha["idusuario"]; ?>").css("display","block");
});
 </script>
						   
						   </td>
                            <td class="hidden-xs"><?php echo $linha["idusuario"]; ?></td>
                            <td><?php echo ($linha["cpfusuario"]); ?></td>
			    <td><?php echo ($linha["nomeusuario"]); ?></td>
							    
							<td><?php if(($linha["usuarioativo"]) == 1){
          echo "Sim";   }else{ echo "Não";}               ?></td> 


              <td><?php if(($linha["tipousuario_idtipousuario"]) == 1){
          echo "Professor";   }
                      elseif (($linha["tipousuario_idtipousuario"]) == 2) {
          echo "Técnico";}
                      else{echo "Administrador";}               ?>          
              </td>
                          </tr>
                        </tbody>
						<?php 
						} 
						?>
                </table>
				<table id="paginador" border="1">
			
		</table>
            
              </div>
            
            </div>

</div></div></div>

	 
<?php	 
 }

        
?>
    </fieldset>
            </div>
 
        

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
