<?php

class Funcionario
{
	protected $id;
	protected $nome;
	protected $nomeCompleto;
	protected $email;
	protected $senha;
	protected $endereco;
	protected $bairro;
	protected $cidade;
	protected $uf;
	protected $telefone;
	protected $cargo; // Gerente = 1 | Caixa = 2
	protected $atividade;

	public function __construct()
	{
	}

	public function __destruct()
	{
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setSenha($senha)
	{
		$this->senha = md5(sha1($senha));
	}

	public function setFuncionario($id, $nome, $nomeCompleto, $email, $senha, $endereco, $bairro, $cidade, $uf, $telefone, $cargo, $atividade)
	{
		//adicionar atributo telefone aos métodos e formulários
		$this->id = $id;
		$this->nome = $nome;
		$this->nomeCompleto = $nomeCompleto;
		$this->email = $email;
		$this->senha = $senha;
		$this->endereco = $endereco;
		$this->bairro = $bairro;
		$this->cidade = $cidade;
		$this->uf = $uf;
		$this->telefone = $telefone;
		$this->cargo = $cargo;
		$this->atividade = $atividade;

		return null;
	}

	public function selectFuncionario()
	{
		//lembre-se de setar o funcionario antes!!
		include 'Conexao.php';

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();

		try {
			$sql = "SELECT * FROM funcionario WHERE id = $this->id";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $resultado;
	}

	public function login($redirecionamento)
	{
		session_start();

		include_once "Conexao.php";

		$conexao = new Conexao();

		$pdo = $conexao->getPDO();

		try {
			$sql = "SELECT * FROM funcionarios WHERE email = :email AND senha = :senha";
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
			$_SESSION['cargo'] = $usuario['cargo'];
			//echo "Login realizado! Redirecionando para o painel de usuário...";
			header("Location: $redirecionamento");
			exit;
		}
	}

	public function verificarSessao($email, $nome){
		$this->email = $email;
		$this->nome = $nome;

		if (!isset($this->email) && !isset($this->nome)){
			session_destroy();
			header("Location: falhalogin.html");
			exit;
		}else{
 			// echo "<h1>SEM TEMPO IRMÃO</h1>";
		}
	}
}
