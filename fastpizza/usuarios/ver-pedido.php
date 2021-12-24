<?php

session_start();

include_once '../class/Cliente.php';
include_once '../class/ItemVenda.php';

$cliente = new Cliente();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

$itemPedido = new ItemVenda();

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
		/*
		.container-fluid{
			 min-height: 960px;
		}
		*/

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

		<h1>Pedido nº <?php echo $_GET['numpedido'] ?></h1>
		
		<table>
			<tr>
				<th>Produto</th>
				<th>Valor</th>
			</tr>

			<?php

			if (isset($_GET['numpedido'])) {
				$resultado = $itemPedido->listarItens($_GET['numpedido']);

				foreach ($resultado as $item) {

					$produto = new Produto();
					$consulta = $produto->selectProduto('WHERE id = "'.$item['id_produto'].'"');
					$nomeItem = $consulta->fetch(PDO::FETCH_ASSOC);

					$item['valor'] = number_format($item['valor'], 2, ',', '.');
					echo '<tr>
					<td>'.$nomeItem['nome'].'</td>
					<td>R$'.$item['valor'].'</td>
					</tr>';
				}
			}

			?>

		</table>

	</div>

	<footer>
		Fast Pizza® | 2019
	</footer>

</body>
</html>