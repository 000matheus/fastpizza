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
    .col-sm-4 {
        background-color: #666;
        text-align: center;
        margin: 20px auto;
        padding: 10px;
        border-radius: 10px;
    }

    .row {
        width: 90%;
        margin: auto;
    }

    .row p {
        padding: 10px;
    }

    footer {
        position: absolute;
    }

    a{
        color: inherit;
    }

    a:hover{
        color: #fff;
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

    <div class="row">
        <div class="col-sm-4">
            <img class="icon-modulo" src="../img/icons/modulos/clientes.png">
            <p><a href="modulo-clientes/">Clientes</a></p>
        </div>
        <?php
            if($_SESSION['cargo'] == 1){
                echo '
            <div class="col-sm-4">
                <img class="icon-modulo" src="../img/icons/modulos/funcionarios.png">
                <p><a href="tela-funcionarios.php">Funcionários</a></p>
            </div>
                ';
            }
        ?>   
    </div>
    <div class="row">
        <div class="col-sm-4">
            <img class="icon-modulo" src="../img/icons/modulos/produtos.png">
            <p><a href="tela-produtos.php">Produtos</a></p>
        </div>
        <div class="col-sm-4">
            <img class="icon-modulo" src="../img/icons/modulos/vendas.png">
            <p><a href="tela-vendas.php">Vendas</a></p>
        </div>
    </div>

    <footer>
        Fast Pizza® | 2019
    </footer>
</body>

</html>