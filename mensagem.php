<!doctype html>
<html lang="pt">
<head>

 <?php include 'php/VerificarSession.php'?>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IFPE -home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-icon.png">
  <link rel="shortcut icon" href="favicon.ico">

  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/scss/style.css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

  <meta http-equiv="refresh" content=2;url='http://www.professornilson.com/mobile/<?php echo $_GET["url"]?>'>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" >

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <?php include 'menu.php'?>

    <div class="main-panel">
       <?php include 'menusuperiormensagem.php';?>

<!--CONTEUDO AQUI -->
        <div class="container">
  
        <div class="row">
            <br><br>
            <p style="color:blue"><h2>Registro <?php echo $_GET['msg']?> com Sucesso</h2></p>
        </div>

        </div>
        

    </div>
</div>


</body>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/main.js"></script>

  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/widgets.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
	

</html>
