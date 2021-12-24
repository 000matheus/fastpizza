<?php

session_start();

include_once '../../class/Cliente.php';

$cliente = new Cliente();

$cliente->verificarSessao($_SESSION['email'],$_SESSION['nome']);

$cliente->UpdateCliente($_SESSION['id'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['telefone']);

$_SESSION['nome'] = $_POST['nome'];
$_SESSION['email'] = $_POST['email'];

header("Location: ../perfil.php?msg=0");
exit;
?>