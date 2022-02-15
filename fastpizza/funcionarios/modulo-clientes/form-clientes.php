<?php
require '../acoes/verificar-sessao.php';
require 'acoes/consultar-clientes.php';

if(isset($_GET['msg']) && $_GET['msg'] == 0){
	echo "<script>alert('Cliente alterado com sucesso!');</script>";
}
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
    <link rel="stylesheet" type="text/css" href="../../config/style-dark.css">
    <link rel="icon" type="imagem/png" href="../../img/logo.png" />

    <style>
        .container {
            margin: 30px auto;
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

        a{
            color: #fff;
        }
    </style>

</head>

<body>

    <nav class="navbar">
        <div class="logo-nav" id="logo-nav">
            <img src="../../img/logo.png">
        </div>
        <div class="navbar-links">
            <a href="#" class="link-menu">Nome de Usuário</a>|
            <a href="acoes/logout.php" class="link-menu">Sair</a>
        </div>
    </nav>

    <div class="container">

        <p>
            <a href="../modulo-clientes/">Voltar</a>
        </p>
        
        <h1>Clientes</h1>

        <form method="POST" action="acoes/alterar-cliente.php">
        <fieldset>
					<legend>Alterar Perfil</legend>
                    <p>
						<label for="form_id">Id:</label><br>
						<input type="text" name="id" id="form_id" size="30" readonly value="<?php echo $consultaCliente['id']; ?>" required>
					</p>
					<p>
						<label for="form_nome">Nome:</label><br>
						<input type="text" name="nome" id="form_nome" size="30" maxlength="30" value="<?php echo $consultaCliente['nome']; ?>" required>
					</p>
					<p>
						<label for="form_email">Email:</label><br>
						<input type="email" name="email" id="form_email" size="30" maxlength="50" value="<?php echo $consultaCliente['email']; ?>" required>
					</p>
					<p>
						<label for="form_endereco">Endereço:</label><br>
						<input type="text" name="endereco" id="form_endereco" size="30" maxlength="50" value="<?php echo $consultaCliente['endereco']; ?>" required>
					</p>
					<p>
						<label for="form_bairro">Bairro:</label><br>
						<input type="text" name="bairro" id="form_bairro" size="30" maxlength="30" value="<?php echo $consultaCliente['bairro']; ?>" required>
					</p>
					<p>
						<label for="form_cidade">Cidade:</label><br>
						<input type="text" name="cidade" id="form_cidade" size="30" maxlength="30" value="<?php echo $consultaCliente['cidade']; ?>" required>
					</p>
					<p>
						<label for="form_uf">Estado:</label><br>
						<select name="uf" id="form_uf" required>
							<option id="uf_rj" value="RJ">Rio de Janeiro</option>
							<option id="uf_sp" value="SP">São Paulo</option>
							<option id="uf_mg" value="MG">Minas Gerais</option>
						</select>
					</p>
					<p>
						<label for="form_telefone">Telefone ou celular:</label><br>
						<input type="text" name="telefone" id="form_telefone" size="30" maxlength="11" value="<?php echo $consultaCliente['tel']; ?>" required>
					</p>
					<p>
						<button type="submit" class="btn btn-primary">Alterar</button>
					</p>
				</fieldset>
        </form>

    </div>

    <footer>
        Fast Pizza® | 2019
    </footer>
</body>

</html>