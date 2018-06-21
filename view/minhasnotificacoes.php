<!doctype html>
<html >
<head>
<?php include '../php/VerificarSession.php';?>
<?php  
   
include '../php/Conexao.php'; 
	$stmt = $conexao->prepare("SELECT n.*,n.urlimagem,u.urlimage imagem,u.nomereduzido,DATE_FORMAT(n.data,'%m/%d/%Y %h:%i') datan from notificacao n,usuario u WHERE u.idusuario = n.usuario_idusuario and n.usuario_idusuario=? order by data desc");
	$stmt->bindValue(1, $_SESSION['idusuario']);
	$stmt->execute();

	

	
		

	$resultado = $stmt->fetchAll();

			
?>

	 <meta charset="utf-8">
    <head><?php include '../php/VerificarSession.php';?>

	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Notificações</title>
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
  #view-source {
    position: fixed;
    display: block;
    right: 0;
    bottom: 0;
    margin-right: 40px;
    margin-bottom: 40px;
    z-index: 900;
  }


  .dual-list .list-group {
    margin-top: 8px;
  }

  .list-left li, .list-right li {
    cursor: pointer;
  }

  .list-arrows {
    padding-top: 100px;
  }

  .list-arrows button {
    margin-bottom: 20px;
  }


  body {
    
    background-color: #f9f9f9;
  }

  /*REQUIRED*/
  .carousel-row {
    margin-bottom: 10px;
    margin-left: 20px;  
  }

  .slide-row {
    padding: 0;
    background-color: #ffffff;
    min-height: 150px;
    border: 1px solid #e7e7e7;
    overflow: hidden;
    height: auto;
    position: relative;
  }


  .slide-footer {
    position: absolute;
    bottom: 0;
    left: 20%;
    width: 78%;
    height: 20%;
    margin: 1%;
  }
</style>

</head>
    
<body>

    	 <?php include '../menu.php';?>

    <div class="main-panel">
        <?php



?>
 

<div class="container">
  <!-- implementar filtro de pesquisa 
          <div class="row pull-right">
           <div id="custom-search-input">
              <div class="input-group col-md-12">
                <input type="text" class="  search-query form-control" placeholder="Pesquise por notificações" />
                  <span class="input-group-btn">
                    <button class="btn btn-success" type="button">
                      <span class="ti-search"></span>
                    </button>
                  </span>
              </div>
            </div>
          </div>
  !-->        
        </div>

  
   <?php 

foreach($resultado as $linha){?> 

<!--CONTEUDO AQUI -->
<div class="row" style="">
  
    
        <div class="col-md-12 " >
          <div class="row carousel-row" style="padding-right: 30px;">
            <div class="col-md-12 slide-row">    
                <div class="panel-heading" style="padding-left: 30px;  background-color:#f5f5f5;
">
                    <img class="pull-right" src="<?php echo $linha['imagem'];?>" alt="Image" width="80px" height="80px" />
                    <h3>Prof: <?php echo $linha['nomereduzido'];?></h3>
                    <h5><span>Enviado em </span> - <span><?php echo $linha['datan'];?></span> </h5>

                </div>
                <div class="panel-body" style="padding-left: 30px;">
                    <h3><?php echo $linha['titulonotificacao'];?></h3>
                    <p><?php echo $linha['descricao'];?></p>
                  
                  <div class="panel-footer">
                    <span class="pull-right buttons">
                    <a href="<?php echo $linha['linknotificacao'];?>" class="btn btn-primary" role="button" target="blank">URL</a>
<a href="minhasnotificacoesdetalhadas.php?id=<?php echo $linha['idnotificacao']?>" class="btn btn-primary" role="button">Verificar Notificações Enviadas</a>
                    </span>
                  </div>
            <img  src="<?php echo $linha['urlimage'];?>"  width="80" height="80" />
            </div>

           </div>
          </div>     
        </div>
            
      
   
 
  </div>

<?php };?>
</div>



<!-- /.col-lg-12 -->
</div>
   
<!-- -->
    </div>
</div>


</body>

    
<script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/plugins.js"></script>
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/widgets.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>


	

</html>
