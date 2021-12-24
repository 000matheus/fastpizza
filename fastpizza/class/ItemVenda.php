<?php

/**
 * 
 */
class ItemVenda{

	protected $id;
	protected $idVenda;
	protected $idProduto;
	protected $valor;

	function __construct(){
		# code...
	}

	function __destruct(){

	}
	
	public function setItemVenda($id, $idVenda, $idProduto, $valor){
		$this->id = $id;
		$this->idVenda = $idVenda;
		$this->idProduto = $idProduto;
		$this->valor = $valor;
	}

	public function insertItem($idProduto, $idVenda, $preco){
		include_once '../../class/Conexao.php';

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();
		$sql = "INSERT INTO item_venda (id_venda, id_produto, valor) VALUES ($idVenda,$idProduto,$preco)";

		$consulta = $pdo->prepare($sql);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
	}

	public function listarItens($idVenda){
		// Os produtos serão listados em linhas e colunas de tabelas.
		include_once 'Conexao.php';
		include_once 'Produto.php';

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();
		$sql = 'SELECT * FROM item_venda WHERE id_venda = "'.$idVenda.'"';

		try {
			$consulta = $pdo->prepare($sql);
			$consulta->execute();
			$resultado = $consulta->fetchAll();

		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $resultado;
	}
}

?>