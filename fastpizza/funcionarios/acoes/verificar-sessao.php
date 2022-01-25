<?php

session_start();

include_once '../class/Funcionario.php';

$cliente = new Funcionario();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

?>