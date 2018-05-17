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
    

      
 $(function () {

            $('body').on('click', '.list-group .list-group-item', function () {
                $(this).toggleClass('active');
            });
            $('.list-arrows button').click(function () {
                var $button = $(this), actives = '';
                if ($button.hasClass('move-left')) {
                    actives = $('.list-right ul li.active');
                    actives.clone().appendTo('.list-left ul');
                    actives.remove();
                } else if ($button.hasClass('move-right')) {
                    actives = $('.list-left ul li.active');
                    actives.clone().appendTo('.list-right ul');
                    actives.remove();
                }
            });
            $('.dual-list .selector').click(function () {
                var $checkBox = $(this);
                if (!$checkBox.hasClass('selected')) {
                    $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
                    $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
                } else {
                    $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
                    $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
                }
            });
            $('[name="SearchDualList"]').keyup(function (e) {
                var code = e.keyCode || e.which;
                if (code == '9') return;
                if (code == '27') $(this).val(null);
                var $rows = $(this).closest('.dual-list').find('.list-group li');
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
                $rows.show().filter(function () {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });

        });

$(document).ready(function() {
    $("#disciplina").change(function() {
        // executa uma ação qualquer
     
          $.ajax({
              url: "http://www.ifpe.esy.es/mobile/PaginaWeb/AlunosDisciplina.php",
              type: "post",
              data: { 
                 id: $('#disciplina').val()
                    },
               success: function (response) {
                   $('#listaAlunos').html(response);
                   $('#listaselecionada').html("");
                 
                 }     
          });
    });


      var retornosubmit = false;

      $("#formpush").submit(function () {
          return retornosubmit;
      });


        
    


      $('button[type="button"]').on('click', function(){
        // e aqui, o this é o botão clicado
          var id = this.id;
          //alert(id);
          if(id == "btnpush"){
              retornosubmit = true;
          }
        event.preventDefault();
        var arrayObj = new Array();
        var checkedItems = {}, counter = 0;
        $("#listaselecionada li").each(function(idx, li) {
            checkedItems[counter] = $(li).val();
            counter++;
            var obj= new Object();

             obj.id = $(li).val();
             arrayObj.push(obj);

    

        });
        $("#codigo").val(JSON.stringify(arrayObj));
        $('#display-json').html(JSON.stringify(arrayObj));
             var classes = this.classList;
   
      });

       $("#btnpush").click(function () {
         $("#btnpush").attr("disabled", false);
         $("#formpush").submit();
      });


});

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
  
    
    <div class="row">
        <div class="col-sm-12">




            <div class="[ panel panel-default ] panel-google-plus .col-md-4">
              
                
                <div class="panel-heading .col-md-10" style="
    padding-left: 30px;
">
                    <img class="[ img-circle ] " src="<?php echo $linha['imagem'];?>"  width="60" height="60" />
                    <h3>Prof: <?php echo $linha['nomereduzido'];?></h3>
                    <h5><span>Enviado em </span> - <span><?php echo $linha['datan'];?></span> </h5>
		   <h3><?php echo $linha['titulo'];?></h3>

                </div>
                <div class="panel-body" style="padding-left: 30px;">
                    <p><?echo $linha['descricao'];?></p>
         

                <a href="../php/pushAndroidunicoFeed.php?id=<?php echo $linha['idfeedback']?>&idaluno=<?php echo $_GET['idaluno']?>" class="btn btn-primary" role="button">Reenviar feedback</a>
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
