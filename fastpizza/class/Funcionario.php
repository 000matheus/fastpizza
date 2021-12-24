<?php

class Funcionario{
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
    protected $cargo;
    protected $atividade;

    public function __construct(){

    }

    public function __destruct(){

    }

    public function setFuncionario($id, $nome, $nomeCompleto, $email, $senha, $endereco, $bairro, $cidade, $uf, $telefone, $cargo, $atividade){
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

    public function getNome(){
		return $this->nome;
	}

	public function getEmail(){
		return $this->email;
	}

    public function selectFuncionario(){
        //lembre-se de setar o funcionario antes!!
		include 'Conexao.php';

		$conexao = new Conexao();
		$pdo = $conexao->getPDO();

		try {
			$sql = "SELECT * FROM funcionario WHERE id = $this->id";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		}catch (Exception $e) {
			echo $e->getMessage();
		}

		return $resultado;
	}
}

?>