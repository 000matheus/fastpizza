<?php  

session_start();

include_once '../../class/Cliente.php';
include_once '../../class/ItemVenda.php';
include_once '../../class/Venda.php';
include_once '../../class/Produto.php';

$cliente = new Cliente();
$venda = new Venda();
$itemVenda = new ItemVenda();
$produto = new Produto();

$cliente->verificarSessao($_SESSION['email'], $_SESSION['nome']);

$idVenda = $venda->insertVenda($_SESSION['id']);

$i = count($_SESSION['pedido']);
$j = 0;

while ($j < $i) {
	$idProduto = $_SESSION['pedido'][$j];
	$valorProduto = $produto->selectPreco($idProduto);
	$itemVenda->insertItem($idProduto, $idVenda['id_venda'], $valorProduto['preco_unit']);
	$j++;
}

$_SESSION['pedido'] = null;

$redirecionamento = "../ver-pedido.php?numpedido=".$idVenda['id_venda'];

echo "<script>setTimeout('window.location=\" ".$redirecionamento." \" ', 10)</script>";
?>