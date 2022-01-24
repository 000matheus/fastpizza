<?php

class Cliente
{
	protected $id;
	protected $nome;
	protected $email;
	protected $senha;
	protected $endereco;
	protected $bairro;
	protected $cidade;
	protected $uf;
	protected $telefone;

	public function __construct()
	{
	}

	public function __destruct()
	{
	}

	public function SetCliente($id, $nome, $email, $senha, $endereco, $bairro, $cidade, $uf, $telefone)
	{
		//adicionar atributo telefone aos métodos e formulários
		$this->id = $id;
		$this->nome = $nome;
		$this->email = $email;
		$this->senha = $senha;
		$this->endereco = $endereco;
		$this->bairro = $bairro;
		$this->cidade = $cidade;
		$this->uf = $uf;
		$this->telefone = $telefone;

		return null;
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function SelectCliente()
	{
		require_once 'Conexao.php';

		try {
			$conexao = new Conexao();
			$pdo = $conexao->getPDO();

			if (isset($this->id)) {
				$sql = "SELECT * FROM clientes WHERE id = $this->id";
			} else {
				$sql = "SELECT * FROM clientes";
			}

			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $resultado;
	}

	public function InsertCliente($nome, $email, $senha, $endereco, $bairro, $cidade, $uf, $telefone)
	{

		$this->nome = $nome;
		$this->email = $email;
		$this->senha = md5(sha1($senha));
		$this->endereco = $endereco;
		$this->bairro = $bairro;
		$this->cidade = $cidade;
		$this->uf = $uf;
		$this->telefone = $telefone;

		include "Conexao.php";

		$conexao = new Conexao();

		$pdo = $conexao->getPDO();

		try {
			$sql = "INSERT INTO clientes(nome, email, senha, endereco, bairro, cidade, uf, tel) VALUES(:nome, :email, :senha, :endereco, :bairro, :cidade, :uf, :telefone)";
			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':senha', $this->senha);
			$stmt->bindParam(':endereco', $this->endereco);
			$stmt->bindParam(':bairro', $this->bairro);
			$stmt->bindParam(':cidade', $this->cidade);
			$stmt->bindParam(':uf', $this->uf);
			$stmt->bindParam(':telefone', $this->telefone);

			$stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function UpdateCliente($id, $nome, $email, $endereco, $bairro, $cidade, $uf)
	{
		include "Conexao.php";

		$this->id = $id;
		$this->nome = $nome;
		$this->email = $email;
		$this->endereco = $endereco;
		$this->bairro = $bairro;
		$this->cidade = $cidade;
		$this->uf = $uf;

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();

		try {
			$sql = "UPDATE clientes SET nome = :nome, email = :email, endereco = :endereco, bairro = :bairro, cidade = :cidade, uf = :uf WHERE id = :id";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':endereco', $this->endereco);
			$stmt->bindParam(':bairro', $this->bairro);
			$stmt->bindParam(':cidade', $this->cidade);
			$stmt->bindParam(':uf', $this->uf);

			$stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function Login($email, $senha, $redirecionamento)
	{

		session_start();

		$this->email = $email;
		$this->senha = md5(sha1($senha));

		include_once "Conexao.php";

		$conexao = new Conexao();

		$pdo = $conexao->getPDO();

		try {
			$sql = "SELECT * FROM clientes WHERE email = :email AND senha = :senha";
			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':senha', $this->senha);

			$stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (count($users) <= 0) {
			//Usuário não encontrado.
			session_destroy();
			header("Location: ../falhalogin.html");
			exit;
		} else {
			// pega o primeiro usuário
			$usuario = $users[0];
			$_SESSION['id'] = $usuario['id'];
			$_SESSION['email'] = $usuario['email'];
			$_SESSION['nome'] = $usuario['nome'];
			$_SESSION['pedido'] = array();
			//echo "Login realizado! Redirecionando para o painel de usuário...";
			header("Location: $redirecionamento");
			exit;
		}
	}

	public function UpdateSenha($id, $senha)
	{
		$this->id = $id;
		$this->senha = md5(sha1($senha));

		include_once 'Conexao.php';

		$conexao = new Conexao();

		$pdo = $conexao->getPDO();

		try {
			$sql = "UPDATE clientes SET senha = :senha WHERE id = :id";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":senha", $this->senha);
			$stmt->bindParam(":id", $this->id);

			$stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function VerificarSenha($id, $senha, $redirecionamento)
	{
		$this->id = $id;
		$this->senha = md5(sha1($senha));

		include_once 'Conexao.php';

		$conexao = new Conexao();

		$pdo = $conexao->getPDO();

		try {
			$sql = "SELECT senha FROM clientes WHERE id = $this->id";
			$stmt = $pdo->query($sql);

			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		if ($resultado[0]['senha'] != $this->senha) {
			header("Location: $redirecionamento");
			exit;
		} else {
			return true;
		}
	}


	public function verificarSessao($email, $nome)
	{
		$this->email = $email;
		$this->nome = $nome;

		if (!isset($this->email) && !isset($this->nome)) {
			session_destroy();
			header("Location: falhalogin.html");
			exit;
		} else {
			// echo "<h1>SEM TEMPO IRMÃO</h1>";
		}
	}
}
