<?php

session_start();

include_once '../class/Cliente.php';

$cliente = new Cliente();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

$form = $cliente->SelectCliente($_SESSION['id']);

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
		function CarregaEstado($estado){
			switch($estado) {
				case "RJ":
					var option = document.getElementById('uf_rj');
					option.setAttribute("selected","selected");
				break;
				case "SP":
					var option = document.getElementById('uf_sp');
					option.setAttribute("selected","selected");
				break;
				case "MG":
					var option = document.getElementById('uf_mg');
					option.setAttribute("selected","selected");
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
			<form action="acoes/alterar-cliente.php" id="form_cadastro" method="POST">
				<fieldset>
					<legend>Alterar Perfil</legend>
					<p>
						<label for="form_nome">Nome:</label><br>
						<input type="text" name="nome" id="form_nome" size="30" maxlength="30" value="<?php echo $form['nome']; ?>" required>
					</p>
					<p>
						<label for="form_email">Email:</label><br>
						<input type="email" name="email" id="form_email" size="30" maxlength="50" value="<?php echo $form['email']; ?>" required>
					</p>
					<p>
						<label for="form_endereco">Endereço:</label><br>
						<input type="text" name="endereco" id="form_endereco" size="30" maxlength="50" value="<?php echo $form['endereco']; ?>" required>
					</p>
					<p>
						<label for="form_bairro">Bairro:</label><br>
						<input type="text" name="bairro" id="form_bairro" size="30" maxlength="30" value="<?php echo $form['bairro']; ?>" required>
					</p>
					<p>
						<label for="form_cidade">Cidade:</label><br>
						<input type="text" name="cidade" id="form_cidade" size="30" maxlength="30" value="<?php echo $form['cidade']; ?>" required>
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
						<input type="text" name="telefone" id="form_telefone" size="30" maxlength="11" value="<?php echo $form['tel']; ?>" required>
					</p>
					<p>
						<button type="submit" class="btn btn-primary">Alterar</button>
					</p>
				</fieldset>
				
			</form>

			<p>
				<a href="senha.php">Alterar Senha</a>
			</p>
		</div>
	</div>

	<footer>
		Fast Pizza® | 2019
	</footer>

	<?php
		if (!isset($_GET['msg'])) {
			
		}else if($_GET['msg'] == 0){
			echo "<script>alert('Perfil Alterado com Sucesso!');</script>";
		}
	?>

	<script type="text/javascript">
		CarregaEstado("<?php echo $form['uf']; ?>");
	</script>

</body>
</html>