<?php
session_start();


if($_SESSION['idusuario'] == ""){
header('Location: index.php');
}

 ?>