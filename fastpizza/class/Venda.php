<?php

/**
 * 
 */
class Venda{

	protected $id;
	protected $idCliente;
	protected $data;
	protected $total;
	protected $status;
	
	function __construct(){

	}

	public function listarVenda($idCliente){
		include_once 'Conexao.php';

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();
		$sql = 'SELECT *, DATE_FORMAT(data_venda, "%d/%m/%Y - %H:%i") as data_venda FROM vendas WHERE id_cliente = "'.$idCliente.'";';	
		
		try {
			$consulta = $pdo->prepare($sql);
			$consulta->execute();
			$resultado = $consulta->fetchAll();

			//print_r($resultado);

			echo "
			
			";

			foreach ($resultado as $venda) {

				if ($venda['status'] == 0) {
					$status = "Em andamento";
				}else if($venda['status'] == 1){
					$status = "Entregue";
				}else if($venda['status'] == 2){
					$status = "A caminho";
				}else{
					$status = "";
				}

				$venda["valor_total"] = number_format($venda["valor_total"], 2, ',', '.');

				echo '
				<tr>
				<td>'.$venda["id"].'</td>
				<td>R$'.$venda["valor_total"].'</td>
				<td>'.$venda['data_venda'].'</td>
				<td>'.$status.'</td>
				<td><a href="ver-pedido.php?numpedido='.$venda['id'].'">Ver Pedido</a></td>
				</tr>
				';
			}


		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function insertVenda($idCliente){
		
		try {
			include_once 'Conexao.php';

			$conexao = new Conexao();
			$pdo = $conexao->getPDO();
			$sql = "INSERT INTO vendas(id_cliente, valor_total, status) VALUES ($idCliente, 0, 0)";

			$consulta = $pdo->prepare($sql);
			$consulta->execute();
			

			$conexao = new Conexao();
			$pdo = $conexao->getPDO();
			$sql = "SELECT MAX(id) as id_venda FROM vendas";

			$consulta = $pdo->prepare($sql);
			$consulta->execute();
			
			$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
			//print_r($resultado);

			return $resultado;

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}


?>