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

  <?php
//Lista usuario
  if(isset($_GET['disciplinaList'])){
    ?>

    <div class="container">   

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
                              <a class="btn btn-success"  href="php/alterarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>"><em class="fa fa-pencil"></em></a>
                              <a target="_blank" id="Clique<?php echo $linha["idusuario"]; ?>" class="btn btn-danger" ><em class="fa fa-trash"></em></a>
                           <div id="escondido<?php echo $linha["idusuario"]; ?>" style="display:none;">
               Tem certeza que deseja deletar esse Usuario? <?php echo ($linha["nomeusuario"]); ?> ? <br>
    <a  id="Clique" class="btn btn-success" href="php/deletarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>&nomeusuario=<?php echo $linha['nomeusuario']; ?>"><em class="fa fa-check"></em></a>
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
          echo "Sim";   }else{ echo "Não";}               ?></td> -->
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
                              <a class="btn btn-success"  href="php/alterarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>"><em class="fa fa-pencil"></em></a>
                              <a target="_blank" id="Clique<?php echo $linha["idusuario"]; ?>" class="btn btn-danger" ><em class="fa fa-trash"></em></a>
                           <div id="escondido<?php echo $linha["idusuario"]; ?>" style="display:none;">
               Tem certeza que deseja deletar o Usuário <?php echo ($linha["nomeusuario"]); ?> ? <br>
    <a  id="Clique" class="btn btn-success" href="php/deletarUsuario.php?idusuario=<?php echo $linha['idusuario']; ?>&nomeusuario=<?php echo $linha['nomeusuario']; ?>"><em class="fa fa-check"></em></a>
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

</div>