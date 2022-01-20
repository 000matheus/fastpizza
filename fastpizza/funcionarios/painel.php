<?php

session_start();

include_once '../class/Funcionario.php';

$cliente = new Funcionario();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>Fast Pizza</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../config/mainScript.js"></script>
    <link rel="stylesheet" type="text/css" href="../config/style-dark.css">
    <link rel="icon" type="imagem/png" href="../img/logo.png" />


</head>

<style>
    .item-modulo {
        background-color: #666;
        text-align: center;
        margin: 50px;
        padding: 10px;
        border-radius: 10px;
    }

    .modulos {
        width: 30%;
        margin: 0 auto;
        display: flex;
        justify-content: center;
    }

    /*.icon-modulo{
        background-color: #ccc;
        padding: 10px;
        border-radius: 10px;
    }*/
</style>

<body>

    <nav class="navbar">
        <div class="logo-nav" id="logo-nav">
            <img src="../img/logo.png">
        </div>
        <div class="navbar-links">
            <a href="#" class="link-menu">Nome de Usuário</a>|
            <a href="#" class="link-menu">Sair</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="modulos">
            <div class="item-modulo">
                <img class="icon-modulo" src="../img/icons/modulos/funcionarios.png">
                <p>1</p>
            </div>
            <div class="item-modulo">
                <img class="icon-modulo" src="../img/icons/modulos/funcionarios.png">
                <p>2</p>
            </div>
            <div class="item-modulo">
                <img class="icon-modulo" src="../img/icons/modulos/funcionarios.png">
                <p>3</p>
            </div>
        </div>
    </div>

    <footer>
        Fast Pizza® | 2019
    </footer>
</body>

</html>