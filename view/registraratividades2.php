<?php
include '../php/VerificarSession.php';
$nota = array();
$nota = $_POST['nota'];
$codigo = explode('|',$_POST['codigo']);


if(isset($_GET['submitatividade'])){
$_SESSION['nomeatividade'] = $_GET['nome'];
$_SESSION['semestre'] = $_GET['semestreList'];
$_SESSION['tipoatividade']= $_GET['tipoatividadeList'];
}

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
<style>
form{
margin-left:25%;

}
.table table-striped{
margin-left:10%;
}
</style>
</head>
<body>
 <?php include '../menu.php'; ?>

<!--CONTEUDO AQUI -->
<form>
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Disciplina</label>
    <select class="form-control input col-md-5" name="disciplinaList">
  <?php
  //Seleciona todas disciplinas e lista no form
  include '../php/Conexao.php';

  $stmt = $conexao->prepare("SELECT * FROM disciplina ");
  $stmt->execute();

    if($stmt->rowCount()>0){

  
    

    $resultado = $stmt->fetchAll();
    foreach($resultado as $linha){ 
    ?>
     <option value="<?php echo $linha['iddisciplina']; ?>"><?php echo ($linha['descricaodisciplina']); ?></option>
   
   <?php
    }
    
    }
  
  

  
?> 
      <input type="submit" style="margin-left:10%;margin-top:5%;border-radius:5px;" class="btn btn-primary btn-info" value="Selecionar Disciplina">  
    </select>
      
</form>
<form class="form-horizontal" action="../php/CadastrarAtividade.php" method="post">

<input id="semestreList" name="semestreList" type="hidden"  value="<?php echo $_SESSION['semestre']; ?>">
<input id="tipoatividadeList" name="tipoatividadeList" type="hidden"  value="<?php echo $_SESSION['tipoatividade']; ?>">
<input id="nome" name="nome" type="hidden"  value="<?php echo $_SESSION['nomeatividade']; ?>">
<div = class="form-group">

<?php
//Verifica a Listagem de alunos, se não mudou, lista os alunos da disciplina 1.
 if(isset($_GET['disciplinaList'])){
?>


 <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              
        <?php                      
        include '../php/Conexao.php';
$stmt = $conexao->prepare("SELECT * FROM `aluno` INNER JOIN aluno_disciplina on aluno.idaluno = aluno_disciplina.aluno_idaluno 
where aluno_disciplina.disciplina_iddisciplina = ? and alunoativo=1 order by nomealuno ");

 $DisciplinaList = $_GET['disciplinaList'];
$stmt -> bindParam(1,$DisciplinaList);
$stmt->execute();

if($stmt->rowCount() >0){
        
        ?>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list" id="conteudo">
                  <thead>
                    <tr>
                       
                       
                        <th>Matricula</th>
                        
            <th>Nome</th>
            <th>Nota</th>
            
            
                    </tr> 
                  </thead>
          <?php 
            } 

  $resultado = $stmt->fetchAll();
  $cont = 0;
  $arrayAlunos = array();
  foreach($resultado as $linha){

    
    $arrayAlunos[$cont] = $linha["idaluno"];
    $arrayAlunos[$cont];
    $cont++;
          ?>
                  <tbody>
                          <tr>
                            
                         
                            <td><?php echo ($linha["matricula"]); ?></td>
                           
                <td><?php echo ($linha["nomealuno"]); ?></td>
                  <td>
                 <input id="disciplina" name="disciplina" type="hidden" value="<?php echo $DisciplinaList;?>" >
                 <input id="nota" name="nota[]" type="text" placeholder="" class="form-control input-md"  maxlength="13" ></td>
              
                          </tr>
                        </tbody>
            <?php 
            } 
            $_SESSION["codigoarray"] = $arrayAlunos;
            ?>
           
                </table>
        <table id="paginador" border="1">
      <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                   <input type="submit"  class="btn btn-primary " style="border-radius: 5px;" value="cadastrar">   
                  </div>
                  
              </div>
    </table>
            
              </div>
            
            </div>

</div></div></div>
 
<?php                     
 }
   
?>

</div>

</fieldset>


   </div>
</div>

</fieldset>

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























