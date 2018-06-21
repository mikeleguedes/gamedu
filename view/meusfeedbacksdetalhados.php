<!doctype html>
<html>
<head>
<?php include '../php/VerificarSession.php';?>
<?php  
   
include '../php/Conexao.php'; 
	$stmt = $conexao->prepare("SELECT f.*,u.urlimage imagem,f.urlimagem furlimagem, f.urllink link,f.idfeedback,u.nomereduzido,DATE_FORMAT(f.data,'%m/%d/%Y %h:%i') datan from feedback f,usuario u, aluno a WHERE f.idaluno = a.idaluno and  f.idusuario = u.idusuario and a.idaluno=1 order by data desc;");
	$stmt->bindValue(1, $_SESSION['idaluno']);
	$stmt->execute();

	

	$resultado = $stmt->fetchAll();

			
?>


  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.cyan-light_blue.min.css">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/normalize.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/scss/style.css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


<!-- Latest compiled and minified JavaScript -->
<script href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <!--   Core JS Files   -->
  <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
  <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

  <!--  Checkbox, Radio & Switch Plugins -->
  <script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>
  <!--Firebase -->
   <script src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>
   <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-database.js"></script>
    <script type="text/javascript">
    


// troca a imagem quebrada

 $(function(){
  $('img').error(function(){
   $(this).attr('src', 'img/error.png');
  });
 });

</script>
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
 .row{
  margin-left: 1%;
 }            
    </style>
</head>

<body>
<?php include '../menu.php';?>


   <?php 

foreach($resultado as $linha){?> 

<!--CONTEUDO AQUI -->
<div class="row" style="">
  
    

        <div class="col-md-12">




            <div class="panel  panel-google-plus " style="margin-right: 20px;">
              
                
                <div class="panel-heading .col-md-10" style="
    padding-left: 20px; ">                
                    <img class="[ img-circle ] " src="<?php echo $linha['imagem'];?>"  width="60" height="60" />
                  
                    <h3>Prof: <?php echo $linha['nomereduzido'];?></h3>
                    <h5><span>Enviado em </span> - <span><?php echo $linha['datan'];?></span> </h5>
		   <h3><?php echo $linha['titulo'];?></h3>

                </div>
                <div class="panel-body" style="padding-left: 30px;">
                    <p><?echo $linha['descricao'];?></p>
              
              
                 
            </div>
              <a href="../php/pushAndroidunicoFeed.php?id=<?php echo $linha['idfeedback']?>&idaluno=<?php echo $_GET['idaluno']?>" class="btn btn-primary" role="button">Reenviar feedback</a>

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

    
   
 <!--  Charts Plugin -->
  <script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="../assets/js/light-bootstrap-dashboard.js"></script>

 
  <!-- Links -->
<script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/widgets.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>

	

</html>
