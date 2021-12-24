<?php
include_once '../class/Cliente.php';

header("Location: cadastroconcluido.html");

$cliente = new Cliente();

$cliente->InsertCliente($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['uf'], $_POST['ddd'].$_POST['telefone']);

exit;
?>

