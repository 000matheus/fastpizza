<?php
require 'acoes/verificar-sessao.php';
require_once "acoes/consultar-clientes.php";
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
        .container {
            margin: 30px auto;
        }

        .tabela-clientes {
            margin: 30px auto;
            width: 85%;
        }

        .tabela-clientes,
        .tabela-clientes td,
        .tabela-clientes th {
            border: 1px solid #333;
        }

        .tabela-clientes th {
            background-color: #7C7C7C;
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

        footer {
            position: absolute;
        }

        h1 {
            text-align: center;
        }

        form {
            border: 1px solid #333;
            padding: 10px;
        }

        form span {
            padding: 5px;
            margin: 5px;
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
        <h1>Clientes</h1>
        <table class="tabela-clientes">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone/Celular</th>
            </tr>
            <?php
            foreach ($consultaCliente as $linha) {
                echo '<tr>
                    <td><a href="form-clientes.php?id=' . $linha['id'] . '">' . $linha['nome'] . '</a></td>
                    <td>' . $linha['email'] . '</td>
                    <td>' . $linha['tel'] . '</td>
                </tr>';
            }
            ?>


        </table>

    </div>

    <footer>
        Fast Pizza® | 2019
    </footer>
</body>

</html>