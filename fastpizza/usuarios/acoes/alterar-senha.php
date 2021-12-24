<?php 
session_start();

include '../../class/Cliente.php';

$cliente = new Cliente();
$cliente->verificarSessao($_SESSION['email'],$_SESSION['nome']);

$cliente->VerificarSenha($_SESSION['id'], $_POST['senha-atual'], "../senha.php?msg=1");

$cliente->UpdateSenha($_SESSION['id'], $_POST['senha-nova']);

header("Location: ../senha.php?msg=0");
exit;
?>