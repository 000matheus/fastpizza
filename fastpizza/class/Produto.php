<?php

/**
 * 
 */
class Produto{

	protected $id;
	protected $nome;
	protected $precoUnit;
	protected $descr;
	protected $tipo;
	// Tipos: 1 - Pizza; 2 - Bebidas; 3 - Sobremesas
	
	function __construct(){
		# code...
	}

	function __destruct(){

	}


	public function listarCardapio($tipo){
		include_once 'Conexao.php';

		$conexao = new Conexao();

		$pdo = $conexao->getPDO();

		if ($tipo == 0) {
			$sql = "SELECT * FROM produtos ORDER BY nome ASC";
		}else{
			$sql = "SELECT * FROM produtos WHERE tipo = '$tipo' ORDER BY nome ASC";
		}

		try {
			$stmt = $pdo->prepare($sql);
			$stmt->execute();

			$resultado = $stmt->fetchAll();

		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $resultado;
	}

	public function selectProduto($condicao){
		include_once 'Conexao.php';

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();
		$sql = 'SELECT * FROM produtos '.$condicao;
		$consulta = $pdo->prepare($sql);
		$consulta->execute();

		return $consulta;
	}

	public function selectPreco($idProduto){
		include_once 'Conexao.php';

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();
		$sql = "SELECT preco_unit FROM produtos WHERE id = $idProduto";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();
		$resultado = $consulta->fetch(PDO::FETCH_ASSOC);

		return $resultado; 
		// retorna resultado em array;
	}

}

?>