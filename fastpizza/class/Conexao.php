<?php

/**
 * 
 */
class Conexao{

	private const LOGIN = "root";
	private const SENHA = "";
	protected const DB = "mysql:host=localhost;dbname=fastpizza;charset=utf8";
	protected $pdo;

	function __construct()
	{
		try{
			$this->pdo = new PDO(self::DB, self::LOGIN, self::SENHA);
			date_default_timezone_set('America/Sao_Paulo');
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function __destruct(){
		
	}

	public function getPDO(){
		return $this->pdo;
	}

}

?>