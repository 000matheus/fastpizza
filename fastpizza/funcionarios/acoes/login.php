<?php

require_once "../../class/Funcionario.php";

$funcionario = new Funcionario();
$funcionario->setEmail($_POST['email']);
$funcionario->setSenha($_POST['senha']);

$funcionario->Login("../painel.php");

?>