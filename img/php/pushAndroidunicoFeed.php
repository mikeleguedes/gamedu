 <?php
 session_start();
  $idaluno = $_GET['idaluno'];
  $idfeedback = $_GET['id'];
  

include '../php/Conexao.php'; 


$stmt = $conexao->prepare("SELECT * FROM feedback WHERE idfeedback=?");
$DevicesX = "";
$titulo = "";
$descricao = "";
$urlimagem = "";
$urllink = "";
$disciplina = "";

$stmt->bindValue(1,$idfeedback);
		


$stmt->execute();



	
		

$resultado = $stmt->fetchAll();

foreach($resultado as $linha){

	
	$titulo = $linha["titulo"] ;
	$descricao = $linha["descricao"] ;
	$urlimagem = $linha["urlimagem"] ;
	$urllink = $linha["urllink"] ;
       // $tiponotificacao = $linha["tiponotificacao_idtiponotificacao"] ;
	$disciplina = $linha["iddisciplina"] ;	
	

	
}



$stmt1 = $conexao->prepare("SELECT aluno.token FROM aluno WHERE aluno.idaluno = ? AND aluno.alunoativo != 0 AND aluno.token is not null");
$DevicesX = "";

$stmt1->bindValue(1,$idaluno);
		


		$stmt1->execute();



	
		

	$resultado1 = $stmt1->fetchAll();

	foreach($resultado1 as $linha){

$DevicesX = $linha["token"];
	

	
		}
		



// Push The notification with parameters
require_once('PushBots.class.php');
$pb = new PushBots();
// Application ID
$appID = '572672d34a9efaa64e8b4569';
// Application Secret
$appSecret = 'b07cf5ed298bc5340d2a53ed11cf1ea8';
$pb->App($appID, $appSecret);
 
// Notification Settings
$pb->Alert($descricao);
$pb->Platform(1);
//$pb->Badge("+2");
// Update Alias 
/**
 * set Alias Data
 * @param   integer $platform 0=> iOS or 1=> Android.
 * @param   String  $token Device Registration ID.
 * @param   String  $alias New Alias.
 */
 
$pb->AliasData(1, $DevicesX, "teste");
// set Alias on the server
$pb->setAlias();
// Push it !
$pb->Push();
// Push to Single Device
// Notification Settings
$pb->AlertOne("Cordova Mesage");
$pb->PlatformOne("0");
$pb->TokenOne($DevicesX);
//Push to Single Device
$pb->PushOne();
//Remove device by Alias
$pb->removeByAlias("myalias");



	


