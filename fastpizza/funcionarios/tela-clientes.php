<?php
require 'acoes/verificar-sessao.php';
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

    <style>

        .container{
            margin: 30px auto;
        }

        .tabela-clientes {
            margin: 30px auto;
            width: 85%;
        }

        .tabela-clientes,
        .tabela-clientes td {
            border: 1px solid #333;
        }

        .tabela-clientes td,
        .tabela-clientes th {
            padding: 10px;
        }

        a,
        a:hover {
            text-decoration: none;
            color: inherit;
        }

        footer{
            position: absolute;
        }
    </style>

</head>

<body>

    <nav class="navbar">
        <div class="logo-nav" id="logo-nav">
            <img src="../img/logo.png">
        </div>
        <div class="navbar-links">
            <a href="#" class="link-menu">Nome de Usuário</a>|
            <a href="acoes/logout.php" class="link-menu">Sair</a>
        </div>
    </nav>

    <div class="container">
        <table class="tabela-clientes">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone/Celular</th>
            </tr>
            <?php require_once "acoes/consultar-clientes.php" ?>
        </table>
    </div>


    <footer>
        Fast Pizza® | 2019
    </footer>
</body>

</html>