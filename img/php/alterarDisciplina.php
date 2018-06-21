<?php


include '../php/Conexao.php';
session_start();

try{
$stmt = $conexao->prepare("select * from disciplina where iddisciplina = ?");


$iddisciplina= $_GET["iddisciplina"]; 

$stmt->bindValue(1,$iddisciplina);

$stmt->execute();
$resultado = $stmt->fetchAll();





	

foreach($resultado as $linha){

$nomedisciplina = $linha['descricaodisciplina'];
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

</style>
</head>
<body>
 <?php include '../menu.php';?>

<form class="form-horizontal" method="POST"  action="updateDisciplina.php?iddisciplina=<?php echo $iddisciplina; ?>" style="margin-top:20px;">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome </label>  
  <input class="form-control input col-md-5" name="nome" type="text" placeholder="Ex. Técnico em informática para internet" required="" value="<?php echo ($nomedisciplina);?>">
</div>

<!-- Select Basic -->


</fieldset>
<button id="singlebutton" name="singlebutton"  style="margin-left:15%;border-radius:5px;"    class="btn btn-success">Alterar</button>
</form>


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
}
}catch(PDOException $e){
echo 'ERROR: ' . $e->getMessage();
} 

?>
