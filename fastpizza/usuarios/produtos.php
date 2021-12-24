<?php

session_start();

include_once '../class/Cliente.php';
include_once '../class/Produto.php';

$cliente = new Cliente();
$prod = new Produto();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

if (isset($_GET['filtro'])) {
	$filtro = $_GET['filtro'];
}else{
	$filtro = 0;
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
	<link rel="stylesheet" type="text/css" href="../config/style.css" />
	<link rel="icon" type="imagem/png" href="../img/logo.png" />

	<style type="text/css">
		.item{
			background-color: #fff;
			border-radius: 5px;
			padding: 5px;
			margin: 5px;
			width: 32%;
			text-align: center;
		}

		.item-img{
			max-width: 80%;
			height: 200px;
			/*border: #CCC 1px solid;*/
		}

		.prod-desc{
			height:35px; 
		}

		button a, button a:hover{
			text-decoration: none;
			color: inherit;
		}

		@media screen and (max-width: 800px){
			.item{
				width: 45%;
				margin: 5px auto;
			}

			.row{
				text-align: center;
			}

			.prod-desc{
				height: 40px;
				margin-bottom: 40px; 
			}

			body{
				font-size: 16px;
			}

		}

		@media screen and (max-width: 500px){
			.prod-desc{
				height: 70px;
				margin-bottom: 40px; 
			}

			.item{
				font-size: 13px;
			}

			h2{
				font-size: 28px;
			}
		}
	</style>

	<script type="text/javascript">

		function tipoFiltro(tipo) {
			var x = tipo;
			switch(x){
				case 1:
				document.getElementById('texto-filtro').innerHTML = '<p>Filtrado por: Pizzas</p>';
				break;
				case 2:
				document.getElementById('texto-filtro').innerHTML = '<p>Filtrado por: Bebidas</p>';
				break;
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
	</div>

	<div class="container" style="min-width: 90%;">

		<div style="padding: 5px; margin-left: -15px;">
			<form method="GET" action="produtos.php">
				<select name="filtro">
					<option value="0">Todos</option>
					<option value="1">Pizzas</option>
					<option value="2">Bebidas</option>
				</select>
				<input type="submit" value="Filtrar" class="btn-primary">
			</form>

			<p><span id="texto-filtro"></span></p>
			
			<?php

			echo "<script type='text/javascript'>tipoFiltro(".$filtro.");</script>";
			
			?>
			
		</div>

		<div class="row">
			<?php

			switch ($filtro) {
				case '1':
				$resultado = $prod->listarCardapio($filtro);
				break;
				case '2':
				$resultado = $prod->listarCardapio($filtro);
				break;
				default:
				$resultado = $prod->listarCardapio($filtro);
				break;
			}

				// var_dump($resultado);

			foreach ($resultado as $produto) {
				$produto['preco_unit'] = number_format($produto['preco_unit'], 2, ',', '.');
				echo "<div class='item'>
				<h2>".$produto['nome']."</h2><hr />
				<p><img src='".$produto['imagem']."' class='item-img'></p>
				<p class='prod-desc'>".$produto['descr']."</p>
				<p>R$".$produto['preco_unit']."</p>
				<p><button><a href='acoes/adicionar-item.php?idproduto=".$produto['id']."'>Adicionar ao Pedido</a></button></p>
				</div>";
			}
			


			?>
		</div>
		
	</div>

	<footer>
		Fast Pizza® | 2019
	</footer>

</body>
</html>