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

<script>
        var app = angular.module('myApp', []);
        app.controller('alunos', function($scope, $http) {



       // * FUNÇÃO PARA EFETUAR LOGIN * //
        $scope.listarAlunos = function(){
      
    var cod = $('#disciplinaList').val();
         $http.get('http://professornilson.com/mobile/restDAO/aluno/loadAlunoDisciplina/'+cod).success(function (dados) {
                   $scope.myData = dados;
              
            }).error(function (dados) {
                console.log(dados);
            });

       
       }


          // * FUNÇÃO PARA EFETUAR LOGIN * //
        var listarTodosAlunos = function(){
      
         var cod = $('#disciplinaList').val();
         $http.get('http://professornilson.com/mobile/restDAO/aluno/queryAll').success(function (dados) {
                   $scope.myData = dados;
              
            }).error(function (dados) {
                console.log(dados);
            });

       
       }

$scope.excluiraluno = function(idaluno){
      
   $("#escondido"+idaluno).css("display","block");

       
       }

       
listarTodosAlunos();

        });


</script>

<script language="JavaScript" src="js/FormatarDados.js"></script>
<style>
form{
  margin-left: 25%;
}  
</style>
</head>
<body ng-app="myApp" ng-controller="alunos">
<div ng-repeat="x in myData ">
    
</div>


<?php include '../menu.php';?>
<!--CONTEUDO AQUI -->
<form class="form-horizontal" method="GET" action="SelecionarDisciplinas.php" >
<fieldset>
<input type="hidden" name="idDisciplina" id="idDisciplina" value="<?php echo $_GET['disciplinaList'];?>">

<!-- Erros gerados no cadastro/alteração-->
<?php 

if(isset($_SESSION['erromatricula'])){
 echo "<center><h4 style='color:red;'>".$_SESSION['erromatricula']."</h4></center>";

 unset( $_SESSION['erromatricula'] );

}


?>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="nome">Nome</label>  
  <input class="form-control input col-md-5" name="nome" type="text" required="">
</div>


<!-- lista no select as linhas nometurma e turnoturma da tabela turma   -->

<div class="form-group">
  <label class="col-md-2 control-label" for="turma">Turma</label>
    <select id="turma" name="turma" class="form-control input col-md-5">
      <?php
  include '../php/Conexao.php';
  $stmt = $conexao->prepare("SELECT * FROM turma ");
  $stmt->execute();
  
    $resultado = $stmt->fetchAll();
    foreach($resultado as $linha){ 
    ?>
     <option value="<?php echo $linha['idturma']; ?>"><?php echo ($linha['nometurma']); ?> <?php echo ($linha['turnoturma']); ?></option>
   
<?php
}   
?>
    </select>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="matricula">Matricula</label>  
  <input class="form-control input col-md-5" name="matricula" type="text" required="" maxlength="13" >   
</div>


</fieldset>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<div class="container">
    <div class="row">
    

    <div class="form-group">
           
            <div class="col-sm-5">
			
             
<div class="form-group">
<div class="col-sm-5">

 <input type="submit" style="margin-left:250%;margin-top:15%;border-radius:5px;" class="btn btn-primary btn-success" value="cadastrar">     
	  </div>      
	  </div>
	  </div>
          </div>
		  
		  </form>



		  <form class="form-horizontal" action="registraralunos.php">


<!-- Form Name -->

<div classe="row">
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-5 control-label" for="selectbasic">Disciplina</label>
  <div class="col-md-10">
    <select id="disciplinaList" name="disciplinaList" class="form-control">
	<?php
  //Seleciona todas disciplinas e lista no form
  include '../php/Conexao.php';
  $stmt = $conexao->prepare("SELECT * FROM disciplina ");
  $stmt->execute();

		if($stmt->rowCount()>0){

	
		

		$resultado = $stmt->fetchAll();
		foreach($resultado as $linha){ 
		?>
	   <option value="<?php echo $linha['iddisciplina']; ?>"  <?php if($_GET['disciplinaList']==$linha['iddisciplina']){echo "selected";}?>><?php echo ($linha['descricaodisciplina']); ?>
     </option>
   
   <?php
		}
		
		}
  
  

  
?> 
      
      
    </select>

    <input  type="" ng-click="listarAlunos();" style="border-radius: 5px;margin-top:5%;" class="btn btn-primary btn-info" value="Listar">  
  </div>
</div>
</div>
</fieldset>
</form>

        </div></div><?php
//Verifica a Listagem de alunos, se não mudou, lista os alunos da disciplina 1.
 if(isset($_GET['disciplinaList'])){
?>


 <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Lista de Alunos</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>
			  <?php                      
			  include '../php/Conexao.php';
$stmt = $conexao->prepare("SELECT * FROM `aluno` INNER JOIN aluno_disciplina on aluno.idaluno = aluno_disciplina.aluno_idaluno where aluno_disciplina.disciplina_iddisciplina = ? order by nomealuno");

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
                        <th>Matricula</th>
                        
						<th>Nome</th>
						<th>Email</th>
						<th>Ativo</th>
						
                    </tr> 
                  </thead>
				  <?php 
				  	}	

	$resultado = $stmt->fetchAll();

	foreach($resultado as $linha){
				  ?>
                  <tbody>
                          <tr >
                            <td align="center" class="col col-xs-4">
                              <a class="btn btn-success"  href="../php/alterarAluno.php?idaluno=<?php echo $linha['idaluno']; ?>"><em class="fa fa-pencil"></em></a>
                              <a target="_blank" id="Clique<?php echo $linha["idaluno"]; ?>" class="btn btn-danger" ><em class="fa fa-trash"></em></a>
                           <div id="escondido<?php echo $linha["idaluno"]; ?>" style="display:none;">
						   Tem certeza que dejesa deletar o Aluno <?php echo ($linha["nomealuno"]); ?> ? <br>
    <a  id="Clique" class="btn btn-success" href="../php/deletarAluno.php?idaluno=<?php echo $linha['idaluno']; ?>&nomealuno=<?php echo $linha['nomealuno']; ?>"><em class="fa fa-check"></em></a>
</div>
<script>
$( "#Clique<?php echo $linha["idaluno"]; ?>" ).click(function() {
  $("#escondido<?php echo $linha["idaluno"]; ?>").css("display","block");
});
 </script>
						   
						   </td>
                            <td class="hidden-xs"><?php echo $linha["idaluno"]; ?></td>
                            <td><?php echo ($linha["matricula"]); ?></td>
                           
							  <td><?php echo ($linha["nomealuno"]); ?></td>
							    <td><?php echo ($linha["email"]); ?></td>
							<td><?php if(($linha["alunoativo"]) == 1){
					echo "Sim";		}else{ echo "Não";}								?></td>
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
                  <div class="col col-xs-12">
                    <h3 class="panel-title">Pesquisa de Aluno</h3>
                     <input  ng-model="pesquisar" type="text" placeholder="" class="form-control input-md"   >
                     <br><br>
                       <h3 class="panel-title">Lista de Alunos</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>


              <div class="panel-body">
                <table class="table table-striped table-bordered table-list" id="conteudo">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th class="hidden-xs">ID</th>
                        <th>Matricula</th>
                        
						<th>Nome</th>
						<th>Email</th>
						<th>Ativo</th>
						
                    </tr> 
                  </thead>
				  
                  <tbody ng-repeat="x in myData | filter:{nomealuno:pesquisar}">
                    
                          <tr >
                            <td align="center">
                              <a class="btn btn-success"  href="../php/alterarAluno.php?idaluno={{x.idaluno}}"><em class="fa fa-pencil"></em></a>
                              <a target="_blank" ng-click="excluiraluno(x.idaluno);" id="Clique{{x.idaluno}}" class="btn btn-danger" ><em class="fa fa-trash"></em></a>
                           <div id="escondido{{x.idaluno}}" style="display:none;">
						   Tem certeza que dejesa deletar o Aluno {{x.nomealuno}}? <br>
    <a  id="Clique" class="btn btn-success" href="../php/deletarAluno.php?idaluno={{x.idaluno}}&nomealuno={{x.nomealuno}}"><em class="fa fa-check"></em></a>
</div>

						   
						   </td>
                            <td class="hidden-xs">{{x.idaluno}}</td>
                            <td>{{x.matricula}}</td>
                           
							  <td>{{x.nomealuno}}</td>
							    <td>{{x.email}}</td>
							<td><span ng-show="{{x.alunoativo == 1}}">Ativo</span></td>
                          </tr>
                        </tbody>
						<?php 
						//} 
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


</body>

 <!-- Links -->
    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/plugins.js"></script>
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/widgets.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
	

</html>
