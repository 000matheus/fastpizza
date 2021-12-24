<?php

session_start();

include_once '../class/Cliente.php';
include_once '../class/Produto.php';

$cliente = new Cliente();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

$produto = new Produto();

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
		.container{
			background-color: #fff;
			text-align: center;
			padding: 10px;
			min-height: 220px;
		}

		table{
			text-align: center;
			width: 100%;
		}

		th{
			width: 50%;
		}

		button a, button a:hover{
			text-decoration: none;
			color: #fff;
		}
	</style>
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
	</div>

	<div class="container">
		<h1>Fechar Pedido</h1>
		<table width="">
			<tr>
				<th>Item</th><th>Valor</th><th></th>
			</tr>

			<?php
			$valor = 0;
			$i = 0;

			if (isset($_SESSION['pedido'])) {
				foreach ($_SESSION['pedido'] as $idPedido) {

					$item = $produto->selectProduto("WHERE id = $idPedido");

					foreach ($item as $atributo) {

						$valor = $valor + $atributo['preco_unit'];

						$atributo['preco_unit'] = number_format($atributo['preco_unit'], 2, ',', '.');

						echo "<tr>
						<td>".$atributo['nome']."</td><td>R$".$atributo['preco_unit']."</td><td><a href='acoes/remover-item.php?item=".$i."'>Remover Item</a></td>
						</tr>";

						$i++;
					}

				}	
			}

			

			$valor = number_format($valor, 2, ',', '.');
			?>
		</table>

		<h4>Valor total: R$<?php echo $valor; ?></h4>

		<br /><button type="button" class="btn btn-success" ><a href="acoes/adicionar-pedido.php">Finalizar Pedido</a></button>
	</div>

	<footer>
		Fast Pizza® | 2019
	</footer>

</body>
</html>