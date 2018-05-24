<!doctype html>
<html>
<head>
<?php include '../php/VerificarSession.php';?>
<?php  
;  
$id = $_GET['id']; 
include '../php/Conexao.php'; 
  $stmt = $conexao->prepare("SELECT idaluno,nomealuno, matricula, urlimagem FROM aluno
  WHERE EXISTS (SELECT * from feedback WHERE feedback.idaluno= aluno.idaluno and feedback.idusuario=?) order by aluno.nomealuno");
  $stmt->bindValue(1, $_SESSION['idusuario']);
  $stmt->execute();

	

	
		

	$resultado = $stmt->fetchAll();

			
?>

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

   <?php 

foreach($resultado as $linha){?> 

<!--CONTEUDO AQUI -->
<div class="row">
   <div class="col-md-12">
    <!-- Begin of rows -->
    <div class="row carousel-row">
        <div class="col-md-12 slide-row">
            
              <!-- Indicators -->
              
            
              <!-- Wrapper for slides -->
              <div class="col-md-2">
                <div class="item active">
                    <img src="<?php echo $linha['urlimagem'];?>" alt="Image" width="80px" height="80px">
                </div>

                
             <input type="hidden" name="idaluno" value="<?php echo $linha['idaluno'];?>"></input>
            </div>
            <div class="col-md-6">
                <h4><?php echo $linha['nomealuno'];?></h4>
 
                
            </div>
            <div class="col-md-4">
               
                 <h6><?php echo $linha['matricula']; ?> </h6>
                
            </div>
           
            <div class="slide-footer">
                <span class="pull-right buttons">
           
                    <a  href="meusfeedbacksdetalhados.php?idaluno=<?php echo $linha['idaluno']?>" 
                       class="btn btn-sm btn-primary" type="submit"> Feedbacks do aluno</a>
                </span>
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

</html>
