<html lang="pt">
 
<head>
<?php include '../php/VerificarSession.php'; ?>

<link href="css/listar.css" rel="stylesheet" />
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
  margin-left: 25%;
 } 
</style>
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
 <script src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-database.js"></script>
 <script type="text/javascript">
    
    
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

    <div class="main-panel">
       <?php include 'menusuperior.php';?>

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
$stmt = $conexao->prepare("SELECT aluno.token, aluno.nomealuno, aluno.matricula FROM aluno WHERE aluno.idaluno in ($consultaToken) AND aluno.alunoativo != 0 AND aluno.token is not null");
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






for($i = 0; $i < count($codalunonotificacao); $i++) {

    $id = $codalunonotificacao[$i]->id;
    $visualizada = 0;
           $stmt1 = $conexao->prepare("insert into feedback(idaluno,iddisciplina,idusuario,titulo,descricao,urlimagem,urllink,visualizada,data) values (?,?,?,?,?,?,?,?,NOW()) ");
    
    $stmt1 -> bindParam(1,$id);
    $stmt1 -> bindParam(2,$Disciplina);
    $stmt1 -> bindParam(3,$IdUsuario);
    $stmt1 -> bindParam(4,$title);
    $stmt1 -> bindParam(5,$message); 
    $stmt1 -> bindParam(6,$imagemUrl);   
    $stmt1 -> bindParam(7,$urlPush);
    $stmt1 -> bindParam(8,$visualizada);
    $stmt1 -> execute();
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
 
 

  <!-- Links -->
  <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/widgets.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>

</body>
</html>