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
  margin-left: 50%;
  margin-right: 50%;
 } 
</style> 
</head>

<body>  
  <?php
  include '../menu.php';
  include '../php/Conexao.php';
  ?>

  <form class="form-horizontal" method="GET" action="SelecionarDisciplinas.php" >
  
    <fieldset>

      <!-- Erros gerados no cadastro/alteração-->
      <?php 
      session_start();
      if(isset($_SESSION['erromatricula'])){
       echo "<center><h4 style='color:red;'>".$_SESSION['erromatricula']."</h4></center>";										
       unset( $_SESSION['erromatricula'] );		
      }
      ?>
    </fieldset>
  </form>

 <div class="container">
  <div class="row">


    <div class="form-group">

      <form class="form-horizontal" action="">



        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-7 " for="selectbasic">Turma</label>
            <select name="turmaList" class="form-control"> 
             <?php
  //Seleciona todas disciplinas e lista no form
             include '../php/Conexao.php';
             $stmt = $conexao->prepare("SELECT * FROM turma ");
             $stmt->execute();

             if($stmt->rowCount()>0){




              $resultado = $stmt->fetchAll();
              foreach($resultado as $linha){ 
                ?>
                <option value="<?php echo $linha['idturma']; ?>"  <?php if($_GET['turmaList']==$linha['idturma']){echo "selected";}?>><?php echo ($linha['nometurma'].' - '.$linha['turnoturma']); ?></option>

                <?php
              }

            }




            ?> 

          </select>
      </div>


      <div class="form-group">
        <label class="col-md-7 control-label" for="selectbasic">Disciplina</label>
          <select id="disciplinaList" name="disciplinaList" class="form-control">
            <?php
  //Seleciona todas disciplinas e lista no form
            include 'php/Conexao.php';
            $stmt = $conexao->prepare("SELECT disciplina.* FROM disciplina,usuario_disciplina where usuario_disciplina.disciplina_iddisciplina = disciplina.iddisciplina 
              and usuario_disciplina.usuario_idusuario=? ");
            $stmt -> bindParam(1,$_SESSION['idusuario']);
            $stmt->execute();

            if($stmt->rowCount()>0){




              $resultado = $stmt->fetchAll();
              foreach($resultado as $linha){ 
                ?>
                <option value="<?php echo $linha['iddisciplina']; ?>"  <?php if($_GET['disciplinaList']==$linha['iddisciplina']){echo "selected";}?>><?php echo ($linha['descricaodisciplina']); ?></option>

                <?php
              }

            }




            ?> 
            <input type="submit" style="margin-left:15%;margin-top:5%;" class="btn btn-primary btn-info" value="Listar">  
          </select>
      </div>


    </fieldset>
  </form>

</div></div><?php
//Verifica a Listagem de alunos, se não mudou, lista os alunos da disciplina 1.
if(isset($_GET['disciplinaList'])){
  ?>


  <div class="col-md-12 col-md-offset-1">

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
      <div class="panel-body">
        <table class="table table-striped table-bordered table-list" id="conteudo">
          <thead>
            <tr>
              <th>Classificação</th>
              <th>Pontos</th>

              <th>Nome</th>


            </tr> 
            <?php                      
            include 'php/Conexao.php';
            $stmt = $conexao->prepare("select selecao.* from (select sum(nota)pontos,aluno.nomealuno,aluno.idaluno, (select turma_idturma from aluno_turma where aluno_turma.aluno_idaluno = aluno.idaluno)codturma,atividade.semestre_idsemestre, 
              (select t.turnoturma from aluno_turma at,turma t where at.turma_idturma = t.idturma and at.aluno_idaluno= aluno.idaluno )turma from atividade_nota, atividade, 
              aluno,(SELECT @row_number:=0)as t where atividade.id = atividade_nota.atividade_idatividade and atividade_nota.iddisciplina = ? and aluno.idaluno = atividade_nota.aluno_idaluno 
              and atividade.semestre_idsemestre = (select semestre.id from semestre where ativo=1 ) group by aluno.nomealuno ORDER BY `pontos` desc) 
              selecao where selecao.codturma=? group by selecao.nomealuno ORDER BY selecao.pontos desc, selecao.nomealuno");

            $turmaList = $_GET['turmaList'];
            $disciplinaList = $_GET['disciplinaList'];

            $stmt -> bindParam(1,$disciplinaList);
            $stmt -> bindParam(2,$turmaList);
            $stmt->execute();

            $resultado = $stmt->fetchAll();




            foreach($resultado as $linha){ 

              ?>




              <tbody>
                <td class="hidden-xs"><?php echo $qtd ?></td>
                <td class="hidden-xs"><?php echo number_format($linha["pontos"] * 1000 , 0,'.','');?></td>
                <td><?php echo ($linha["nomealuno"]); ?></td>


              </tbody>
              <?php 
              $qtd++;
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



    <div class="col-md-12 col-md-offset-1">

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

        <div class="panel-body">
          <table class="table table-striped table-bordered table-list" id="conteudo">
            <thead>
              <tr>
                <th>Classificação</th>
                <th>Pontos</th>

                <th>Nome</th>


              </tr> 
            </thead>
            <?php                      
            include 'php/Conexao.php';
            $stmt = $conexao->prepare("select selecao.* from (select sum(nota)pontos,aluno.nomealuno,aluno.idaluno, (select turma_idturma from aluno_turma where aluno_turma.aluno_idaluno = aluno.idaluno)codturma,atividade.semestre_idsemestre, 
              (select t.turnoturma from aluno_turma at,turma t where at.turma_idturma = t.idturma and at.aluno_idaluno= aluno.idaluno )turma from atividade_nota, atividade, 
              aluno,(SELECT @row_number:=0)as t where atividade.id = atividade_nota.atividade_idatividade and atividade_nota.iddisciplina = ? and aluno.idaluno = atividade_nota.aluno_idaluno 
              and atividade.semestre_idsemestre = (select semestre.id from semestre where ativo=1 ) group by aluno.nomealuno ORDER BY `pontos` desc) 
              selecao where selecao.codturma=? group by selecao.nomealuno ORDER BY selecao.pontos desc, selecao.nomealuno");

            $turmaList = $_GET['turmaList'];
            $disciplinaList = $_GET['disciplinaList'];

            $stmt -> bindParam(1,$disciplinaList);
            $stmt -> bindParam(2,$turmaList);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $qtd=1;
            foreach($resultado as $linha){ 

             ?>




             <tbody>
              <td class="hidden-xs"><?php echo $qtd ?></td>
              <td class="hidden-xs"><?php echo number_format($linha["pontos"] * 1000 , 0,'.','');?></td>
              <td><?php echo ($linha["nomealuno"]); ?></td>


            </tbody>
            <?php 
            $qtd++;
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