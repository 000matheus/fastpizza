<?php

session_start();

if (is_dir("../class/")) {
    require_once '../class/Funcionario.php';
}
else if (is_dir('../../class/')) {
    require_once '../../class/Funcionario.php';
}

$funcionario = new Funcionario();

$funcionario->verificarSessao($_SESSION['email'], $_SESSION['nome']);

?>