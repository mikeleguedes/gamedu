<!doctype html>
<html >
<head>
<?php include '../php/VerificarSession.php';?>
<?php    
$id = $_GET['id']; 
include '../php/Conexao.php'; 
  $stmt = $conexao->prepare("SELECT n.*,a.nomealuno,n.titulonotificacao,a.urlimagem imagem,a.idaluno, na.visualizada,na.opiniao FROM notificacao n, notificacao_aluno na, aluno a where n.idnotificacao = na.notificacao_idnotificacao AND na.aluno_idaluno = a.idaluno AND na.notificacao_idnotificacao = ? and n.usuario_idusuario=?");
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $_SESSION['idusuario']);
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

/* FONT AWESOME & not necessary for functions */
@import url('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');

body {
    
    background-color: #f9f9f9;
}

/*REQUIRED*/
.carousel-row {
    margin-bottom: 10px;
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


.slide-carousel {
    width: 20%;
    float: left;
    display: inline-block;
}

.slide-carousel .carousel-indicators {
    margin-bottom: 0;
    bottom: 0;
    background: rgba(0, 0, 0, .5);
}

.slide-carousel .carousel-indicators li {
    border-radius: 0;
    width: 20px;
    height: 6px;
}

.slide-carousel .carousel-indicators .active {
    margin: 1px;
}

.slide-content {
    position: absolute;
    top: 0;
    left: 20%;
    display: block;
    float: left;
    width: 80%;
    max-height: 76%;
    padding: 1.5% 2% 2% 2%;
    overflow-y: auto;
}

.slide-content h4 {
    margin-bottom: 3px;
    margin-top: 0;
}

.slide-footer {
    position: absolute;
    bottom: 0;
    left: 20%;
    width: 78%;
    height: 20%;
    margin: 1%;
}

/* Scrollbars */
.slide-content::-webkit-scrollbar {
  width: 5px;
}
 
.slide-content::-webkit-scrollbar-thumb:vertical {
  margin: 5px;
  background-color: #999;
  -webkit-border-radius: 5px;
}
 
.slide-content::-webkit-scrollbar-button:start:decrement,
.slide-content::-webkit-scrollbar-button:end:increment {
  height: 5px;
  display: block;
}
    </style>
</head>

<body>

       <?php include '../menu.php';?>

  
   <?php 

include '../php/Conexao.php'; 

foreach($resultado as $linha){?> 

<!--CONTEUDO AQUI -->
<div class="row">
   <div class="col-md-12"><?php echo $linha['titulonotificacao'];?></div>
    <!-- Begin of rows -->
    <div class="row carousel-row">
        <div class="col-md-12 slide-row">
            
              <!-- Indicators -->
              
            
              <!-- Wrapper for slides -->
              <div class="col-md-2">
                <div class="item active">
                    <img src="<?php echo $linha['imagem'];?>" alt="Image" width="80px" height="80px">
                </div>

                
             <input type="hidden" id="idaluno" name="idaluno" value="<?php echo $linha['idaluno']?>"></input>
            </div>
            <div class="col-md-6">
                <h4><?php echo $linha['nomealuno'];?></h4>
 
                
            </div>
            <div class="col-md-4">
               
                 <p> <?php if($linha['visualizada']>0){echo 'Visualizou : '.$linha['visualizada'];}else{echo 'Não Visualizou';}?>
                 <?php if($linha['visualizada'] > 1){echo 'vezes';}else  if($linha['visualizada']==1){echo 'vez';}?> </p>
                <?php   if($linha['opiniao']==2){  ?>
                <p>
                  <a href="#" class="btn btn-primary btn-sm">
                  <span class="glyphicon glyphicon-thumbs-up"></span> 
                  </a>
               </p> 
               <?php }  ?>
               <?php   if($linha['opiniao']==1){  ?>
                <p>
                  <a href="#" class="btn btn-danger btn-sm">
                  <span class="glyphicon glyphicon-thumbs-down"></span> 
                  </a>
               </p> 
               <?php }  ?>
            </div>
           
            <div class="slide-footer">
                <span class="pull-right buttons">
           
                    <a  href="../php/pushAndroidunico.php?idaluno=<?php echo $linha['idaluno']?>&idnotificacao=<?php echo $linha['idnotificacao']?>" style="border-left-width: 5px;padding-right: 50px;padding-bottom: 20px;" 
                       class="btn btn-sm btn-primary" type="submit"> Reenviar Notificação</a>
                </span>
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

    

 <!-- Links -->
  <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/widgets.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
 <!--  Charts Plugin -->
  <script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="../assets/js/light-bootstrap-dashboard.js"></script>


  

</html>
