<?php

session_start();

include_once '../../class/Cliente.php';

$cliente = new Cliente();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

$i = $_GET['item'];
unset($_SESSION['pedido'][$i]);
$_SESSION['pedido'] = array_values($_SESSION['pedido']);

// print_r($_SESSION['pedido']);

header("Location: ../checkout.php");
exit;
?>