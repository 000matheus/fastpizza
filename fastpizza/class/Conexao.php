<?php

/**
 * 
 */
class Conexao{

	private $login = "root";
	private $senha = "";
	protected $database = "mysql:host=localhost;dbname=fastpizza;charset=utf8";
	protected $pdo;

	function __construct()
	{
		try{
			$this->pdo = new PDO($this->database, $this->login, $this->senha);
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