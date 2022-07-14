<?php

session_start();

include_once '../../../class/Cliente.php';

$cliente = new Cliente();

$cliente->verificarSessao($_SESSION['email'],$_SESSION['nome']);

$cliente->UpdateCliente($_POST['id'], $_POST['nome'], $_POST['email'],$_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['telefone']);

header("Location: ../form-clientes.php?msg=0&clienteId=".$_POST['id']);
exit;
?>