<?php include 'VerificarSession.php'?>
<?php


include 'Conexao.php';
session_start();

try{
$stmt = $conexao->prepare("select * from turma where idturma = ?");


$idturma= $_GET["idturma"]; 

$stmt->bindValue(1,$idturma);

$stmt->execute();
$resultado = $stmt->fetchAll();





	

foreach($resultado as $linha){


?>
<html>
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
<?php include '../menu.php'; ?>

<form class="form-horizontal" method="POST"  action="updateTurma.php?idturma=<?php echo $idturma; ?>" style="margin-top:20px;">
<fieldset>

<!-- Form Name -->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome </label>  

  <input id="nome" name="nome" type="text" placeholder="nome da turma" class="form-control input col-md-5" required="" value="<?php echo $linha['nometurma']?>">
   
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="periodo">Período</label>

    <select id="periodo" name="periodo" class="form-control input col-md-1">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>

</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="turno">Turno</label>
    <select id="turno" name="turno" class="form-control input col-md-2">
      <option value="vespertino" <?php if($linha['turnoturma']=='vespertino'){echo 'selected="selected"';}?> >Vespertino</option>
      <option value="matutino"  <?php if($linha['turnoturma']=='matutino'){echo 'selected="selected"';}?>>Matutino</option>
      <option value="noturno"  <?php if($linha['turnoturma']=='noturno'){echo 'selected="selected"';}?>>Noturno</option>
    </select>
</div>

</fieldset>
<button id="singlebutton" name="singlebutton"  style="margin-left:45%;"    class="btn btn-success">Alterar</button>
</form>
	

		
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
