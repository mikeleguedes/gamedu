 <?php
 session_start();
  $idaluno = $_GET['idaluno'];
  $idnotificacao = $_GET['idnotificacao'];
  

include 'Conexao.php'; 


$stmt = $conexao->prepare("SELECT * FROM notificacao WHERE idnotificacao=?");
$DevicesX = "";
$titulo = "";
$descricao = "";
$urlimagem = "";
$urllink = "";
$disciplina = "";

$stmt->bindValue(1,$idnotificacao);
		


$stmt->execute();



	
		

$resultado = $stmt->fetchAll();

foreach($resultado as $linha){

	
	$titulo = $linha["titulonotificacao"] ;
	$descricao = $linha["descricao"] ;
	$urlimagem = $linha["urlimagem"] ;
	$urllink = $linha["linknotificacao"] ;
        $tiponotificacao = $linha["tiponotificacao_idtiponotificacao"] ;
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
		
	

class GCMPushMessage {
    var $url = 'https://android.googleapis.com/gcm/send';
    var $serverApiKey = "";
    var $devices = array();
    
    function GCMPushMessage($apiKeyIn){
        $this->serverApiKey = $apiKeyIn;
    }
    function setDevices($deviceIds){
    
        if(is_array($deviceIds)){
            $this->devices = $deviceIds;
        } else {
            $this->devices = array($deviceIds);
        }
    
    }
    function send($message, $data = false){
        
        if(!is_array($this->devices) || count($this->devices) == 0){
            $this->error("No devices set");
        }
        
        if(strlen($this->serverApiKey) < 8){
            $this->error("Server API Key not set");
        }
        
       $fields = array(
            'registration_ids'  => $this->devices,
            'payload'              => array( "message" => $message ),
        );
        
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $fields['data'][$key] = $value;
            }
        }
        $headers = array( 
            'Authorization: key=' . $this->serverApiKey,
            'Content-Type: application/json'
        );

        echo json_encode( $fields );
        $ch = curl_init();
        
        curl_setopt( $ch, CURLOPT_URL, $this->url );
        
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
        
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return $result;
    }
    
    function error($msg){
        echo "Android send notification failed with error:";
        echo "\t" . $msg;
        exit(1);
    }
}




	$apiKey = "AIzaSyDSH5Ca4Qfn9KFNr9xQaSC197gmpy_RNBk"; // CHAVE DA API GCM...
        $devicesToken = explode(",",$DevicesX); // Tokens dos aparelhos que receberão a notificação - separados por ','...
	$gcpm = new GCMPushMessage($apiKey);
	$gcpm->setDevices($devicesToken);
        $imagemUrl = $urlimagem;
        $urlPush = $urllink;
	$title = $titulo;
	$message = $descricao; // Conteúdo da mensagem do PUSH...
	$response = $gcpm->send($message, array('title' => $title,'BigTextStyle' => 'true','bigText' => $message ,
                                                'url'=>$urlPush,'customNotificationTitle'=>$title,'idnotificacao'=>$idnotificacao)); // Título do Push...

  
 
   
	echo $response;
	echo "<br>-------------------------------------";
	


