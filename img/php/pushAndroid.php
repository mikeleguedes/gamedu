<html lang="pt">
 
<head>
<?php
    
      include '../php/VerificarSession.php';
      include '../email/email.php';
    
    
    
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

   <script>
    
    
 var config = {
            apiKey: "AIzaSyAx8IZM_EKoADVng8TExk_Bldx0vL0djyk",
            authDomain: "fir-d187b.firebaseapp.com",
            databaseURL: "https://fir-d187b.firebaseio.com",
            projectId: "fir-d187b",
            storageBucket: "fir-d187b.appspot.com",
            messagingSenderId: "41493591821"
          };
          firebase.initializeApp(config);
          // Get a reference to the database service
         var playersRef = firebase.database().ref("app/");
var data = new Date();
// Guarda cada pedaço em uma variável
var dia     = data.getDate();           // 1-31
var dia_sem = data.getDay();            // 0-6 (zero=domingo)
var mes     = data.getMonth();          // 0-11 (zero=janeiro)
var ano2    = data.getYear();           // 2 dígitos
var ano4    = data.getFullYear();       // 4 dígitos
var hora    = data.getHours();          // 0-23
var min     = data.getMinutes();        // 0-59
var seg     = data.getSeconds();        // 0-59
var mseg    = data.getMilliseconds();   // 0-999
var tz      = data.getTimezoneOffset(); // em minutos


var valor = dia+'/'+mes+'/'+ano4+'/'+hora+'/'+min+'/'+seg;
playersRef.set ({
   notificacao:valor
});

</script>


</head>
 
 <body>
 
    <?php include '../menu.php';?>

<!--CONTEUDO AQUI -->
        
<div class="container">
    <div class="row">
    
    <p></p>
   
    <p> </p><p> </p>
    
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Lista de Alunos </h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    
                  </div>
                </div>
              </div>
 
 <?php
 
  $Disciplina = $_POST['disciplina'];
  $IdUsuario = $_SESSION['idusuario'];
  $codigos = json_decode($_POST['codigo']);
  $codalunonotificacao = $codigos;
  $title = $_POST["title"];
  $message = $_POST["message"]; 
  $imagemUrl = $_POST["imagemurl"];
  $urlPush = $_POST["url"];
 

$fp = fopen("bloco4.txt", "a");
$consultaToken =" ";
//navega pelos elementos do array, imprimindo cada empregado
for($i = 0; $i < count($codigos); $i++) {
        
        if($i == count($codigos)-1){
           $consultaToken.=$codigos[$i]->id;

        } else{
           $consultaToken.=$codigos[$i]->id.",";
        }
    }
  $escreve = fwrite($fp, $consultaToken);  
    
//echo "1";


// Escreve "exemplo de escrita" no bloco1.txt

// Fecha o arquivo
fclose($fp); 


$TipoNotificacao = 2;//$_POST['tiponotificacao'];
include '../php/Conexao.php'; 
$stmt = $conexao->prepare("SELECT aluno.token, aluno.nomealuno, aluno.matricula, aluno.email FROM aluno WHERE aluno.idaluno in ($consultaToken) AND aluno.alunoativo != 0 AND aluno.token is not null");
$DevicesX = "";

$stmt->bindValue(1,$Disciplina);
		


		$stmt->execute();
//echo "2";
		if($stmt->rowCount() >0){

		?><div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden-xs">Matricula</th>
                        
                        
						
                    </tr> 
                  </thead><?php

                $resultado = $stmt->fetchAll();
                $contador = 1;

                foreach($resultado as $linha){
                    //$email = new Email();
                    //$email->enviarEmail($linha["email"],$message,$title);
                    if($contador ==1){
                        $DevicesX = $linha["token"]  ;
                    }else if($contador >1){
                        $DevicesX = $linha["token"] .",". $DevicesX  ;
                    }
?>
					<tbody>
                          <tr>
                            
                            <td class="hidden-xs"><?php echo ($linha["nomealuno"]); ?></td>
                            <td><?php echo $linha["matricula"]; ?></td>
                            
                          </tr>
                        </tbody>
						<?php
                   		
                    $contador++;

		         }
		
		}

//echo "4";
//include 'php/Conexao.php';
 $stmt = $conexao->prepare("insert into notificacao(usuario_idusuario,iddisciplina,tiponotificacao_idtiponotificacao,descricao,urlimagem,linknotificacao,titulonotificacao,data) values (?,?,?,?,?,?,?,NOW()) ");
    
    
    $stmt -> bindParam(1,$IdUsuario);
    $stmt -> bindParam(2,$Disciplina);
    $stmt -> bindParam(3,$TipoNotificacao);
    $stmt -> bindParam(4,$message);
    $stmt -> bindParam(5,$imagemUrl); 
    $stmt -> bindParam(6,$urlPush); 
    $stmt -> bindParam(7,$title);



$stmt->execute(); 
//echo "--".$IdUsuario.$Disciplina."--".$TipoNotificacao.$message.$imagemUrl.$urlPush.$title;
$id_res = $conexao->lastInsertId(); 




for($i = 0; $i < count($codalunonotificacao); $i++) {

    $id = $codalunonotificacao[$i]->id;
    $visualizada = 0;
            $stmt1 = $conexao->prepare("insert into notificacao_aluno(notificacao_idnotificacao,aluno_idaluno,visualizada) values (?,?,?) ");
            $stmt1 -> bindParam(1,$id_res);
            $stmt1 -> bindParam(2,$id);
            $stmt1 -> bindParam(3,$visualizada); 
            $stmt1->execute();
    }


if(isset($_POST) && !empty($_POST)){
	$apiKey = $_POST["apiKey"]; // CHAVE DA API GCM...
    $devicesToken = explode(",",$DevicesX);
    require_once('PushBots.class.php');
$pb = new PushBots();
// Application ID
$appID = '572672d34a9efaa64e8b4569';
// Application Secret
$appSecret = 'b07cf5ed298bc5340d2a53ed11cf1ea8';
$pb->App($appID, $appSecret);
 
// Notification Settings
$pb->Alert($message);
$pb->Platform("1");
$pb->Badge("+2");
// Update Alias 
/**
 * set Alias Data
 * @param   integer $platform 0=> iOS or 1=> Android.
 * @param   String  $token Device Registration ID.
 * @param   String  $alias New Alias.
 */
 
$pb->AliasData(1, $devicesToken, "");
// set Alias on the server
$pb->setAlias();
// Push it !
$pb->Push();
// Push to Single Device
// Notification Settings
//Push to Single Device
//$pb->PushOne();
//Remove device by Alias
//$pb->removeByAlias("myalias");
	
}
?>
</table>
            
              </div>
            
            </div>

</div></div></div>

        

    </div>
</div>
 
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

</body>
</html>
