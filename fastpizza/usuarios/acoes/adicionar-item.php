<?php

session_start();

header("Location: ../produtos.php");

include_once '../../class/Cliente.php';

$cliente = new Cliente();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

$i = count($_SESSION['pedido']);

$_SESSION['pedido'][$i] = $_GET['idproduto'];

//print_r($_SESSION['pedido']);

exit;
?>