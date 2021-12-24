<?php

session_start();

include_once '../class/Cliente.php';

$cliente = new Cliente();

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
	<link rel="stylesheet" type="text/css" href="../config/style.css">
	<link rel="icon" type="imagem/png" href="../img/logo.png" />

	<style type="text/css">
		.container-fluid{
			min-height: 800px;
		}

		.container{
			background-color: white;
			box-shadow: 0 2px #999; 
			border-radius: 3px;
			padding: 20px;
		}
	</style>

	<script type="text/javascript">
		function ConfirmaSenha() {
			a = document.getElementById('senha_nova').value;
			b = document.getElementById('senha_nova2').value;

			if (a != b){
				alert("A senha confirmada está diferente. Digite e confirme sua senha novamente.");
				document.getElementById('senha_nova').value = '';
				document.getElementById('senha_nova2').value = '';
			}
		}
	</script>

</head>
<body>

	<nav class="navbar">
		<a href="#" onclick="abreMenu();" class="botao-menu">☰</a>
		<div>
			<span> 
				<?php 
				if ($_SESSION['pedido'] != null) {
					echo "<a href='checkout.php'>Itens do pedido atual: ".count($_SESSION['pedido'])."</a>";
				}
				?>
			</span>
			<a href="../usuarios/" class="link-menu">Início</a>
			<a href="produtos.php" class="link-menu">Cardápio</a>
			<a href="pedidos.php" class="link-menu">Pedidos</a>
		</div>
		
	</nav>

	<div class="side-menu" id="side-menu">
		<div class="row" id="side-user-info">
			<div class="col-md-12">
				<h5><?php echo $cliente->getNome(); ?></h5>
				<h6><?php echo $cliente->getEmail(); ?></h6>
				<a href="perfil.php">Alterar Perfil</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a href="#" onclick="fechaMenu();" class="botao-fechar-menu"><img src="../img/icons/fechar.png" class="side-menu-icon">Fechar</a>
			</div>
			<div class="col-md-12">
				<a href="acoes/logout.php"><img src="../img/icons/sair.png" class="side-menu-icon">Sair</a>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="logo-inicial" id="logo-inicial">
			<img src="../img/logo.png">
		</div>
		<div class="container">
			<form action="acoes/alterar-senha.php" id="form_senha" method="POST">
				<fieldset>
					<legend>Alterar Perfil</legend>
					<p>
						<label for="senha_atual">Senha Atual:</label><br>
						<input type="password" name="senha-atual" id="senha_atual" size="30" maxlength="32" required>
					</p>
					<p>
						<label for="senha_nova">Nova Senha:</label><br>
						<input type="password" name="senha-nova" id="senha_nova" size="30" maxlength="32" required>
					</p>
					<p>
						<label for="senha_nova2">Confirme a Nova Senha:</label><br>
						<input type="password" name="senha-nova2" id="senha_nova2" size="30" maxlength="32" required>
					</p>
					<p>
						<button type="submit" class="btn btn-primary" onclick="ConfirmaSenha()">Alterar</button>
					</p>
				</fieldset>
				
			</form>

			<p>
				<a href="perfil.php">Alterar Perfil</a>
			</p>
		</div>
	</div>

	<footer>
		Fast Pizza® | 2019
	</footer>

	<?php
		if (!isset($_GET['msg'])) {
			
		}else if($_GET['msg'] == 0){
			echo "<script>alert('Senha Alterada com Sucesso!');</script>";
		}else if($_GET['msg'] == 1){
			echo "<script>alert('Erro: Não foi possível alterar a senha. A senha atual está incorreta.');</script>";
		}
	?>

</body>
</html>