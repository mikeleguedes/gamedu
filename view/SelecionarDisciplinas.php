<?php include '../php/VerificarSession.php'?>
<?php
try{
	include '../php/Conexao.php';

	
	$Nome= $_GET["nome"]; 
	$Matricula= $_GET["matricula"];
	//echo "  1<br>";
	
	
//Verifica Se a matricula já está cadastrada...
$stmt = $conexao->prepare("SELECT nomealuno,matricula,idaluno FROM aluno WHERE matricula = ?");

	$stmt -> bindParam(1,$Matricula);
		


		$stmt->execute();

		if($stmt->rowCount()>0){
		

		$resultado = $stmt->fetchAll();
		foreach($resultado as $linha){ 
		
		$_SESSION['erromatricula'] = "Já possui um Cadastro com a matrícula ".$linha['matricula']." !";
		echo "<script language= 'JavaScript'>
location.href='registraralunos.php'
</script>";
		}
		
		}else{
	
	
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
<?php include '../menu.php';?>
<!--CONTEUDO AQUI -->


<?php 

if(isset($_SESSION['erromatricula'])){
	echo "<center><h4 style='color:red;'>".$_SESSION['erromatricula']."</h4></center>";

	unset( $_SESSION['erromatricula'] );

}


?>


  <div class="row" style="margin-left:10%;">
  <p></p><br>
  <label style='font-size:20px'>Selecione As Disciplinas que o Aluno Está Cursando</label>
  <form class="form-horizontal" method="POST" action="../php/CadastrarAluno.php" >
  <br>
  <?php
  //Seleciona todas disciplinas e lista no form
  $stmt = $conexao->prepare("SELECT * FROM disciplina ");

		$stmt->execute();

		if($stmt->rowCount()>0){

	
		
$i=0;
		$resultado = $stmt->fetchAll();
		foreach($resultado as $linha){ 
		
	   echo "<fieldset class='col-sm-6'><label>
      <input type='checkbox' value=".$linha['iddisciplina']." name='disciplinas[]' />
      <span style='font-size:18px'>".($linha['descricaodisciplina'])."</span>
   </label></fieldset>";
   
   
		}
		
		}
  
  

  
?>  
  <input type="hidden" readonly="readonly"  name="nome" value="<?php echo $Nome;?>"> 
 <input type="hidden" readonly="readonly" name="matricula" value="<?php echo $Matricula;?>"> 
<input id="singlebutton" name="singlebutton" type="submit" style="margin-left:30%;margin-top:5%"  value="Cadastrar"   class="btn btn-success form-horizontal">
  </form>
  
  

    </div>




























        </div></div>
</div></div>


        

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
	
	<?php
	//Cadastrar Alunos na tabela 'alunos' e Disciplinas na tabela 'aluno_disciplina'
	//Inserir aluno	
$stmt = $conexao->prepare("insert into aluno(nomealuno,matricula) values (?,?)");
	
	

	$stmt -> bindParam(1,$Nome);
	$stmt -> bindParam(2,$Matricula);
	


	


$stmt->execute(); 
	
	
	
	
		}
	
	
  
	}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();
 


} 
	



?>
