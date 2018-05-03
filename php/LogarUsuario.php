<?php
session_start();
include 'Conexao.php';
	
$username = $_POST['cpf'];  
$senha = md5($_POST['senha']); 

//$stmt = $conexao->query("select nomeusuario,idusuario from usuario where cpfusuario='$username' and senha='$senha'");
$sql = 'select nomeusuario,idusuario,tipousuario_idtipousuario from usuario where cpfusuario=:username and senha=:senha';

$stmt = $conexao->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
$stmt->execute();
$contagem = $stmt->rowCount();

if ( $contagem == 1  ) {


	$resultado = $stmt->fetchAll();

	foreach($resultado as $linha){

	$_SESSION['nomeusuario'] =$linha["nomeusuario"];
    $_SESSION['idusuario'] = $linha["idusuario"];
    $_SESSION['tipousuario'] = $linha["tipousuario_idtipousuario"];
	}

session_destroy($_SESSION['errologin']);


header('Location: ../dashboard.php');

  
}else{
$_SESSION['errologin'] = "Usuário ou senha inválido";
echo '<script>
			
			location.href="../index.php"	
		</script>';

}






?>