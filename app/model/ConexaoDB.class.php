<?php 

namespace app\model;

# Adicionado pois não encontra o PDO sem o namespace.
use \PDO;

class ConexaoDB {
	private $nomeServer;
	private $usuario;
	private $senha;
	private $dataBase;
    private $charset;
    public 	$con;

	function __construct() {
		#Configure a conexão do banco aqui
		$this->nomeServer = "localhost";
		#$this->usuario = "dml_user";
		#$this->senha = "senha_dml_user";
		$this->usuario = "root";
		$this->senha = "";
        $this->dataBase = "db_confeitaria";
        $this->charset = 'utf8mb4';
        $dsn = "mysql:host=$this->nomeServer;dbname=$this->dataBase;charset=$this->charset";

        # Não utilizarei bloco try aqui, para que a exceção seja jogada
        # e tratada na classe controladora 
        $this->con = new PDO($dsn, $this->usuario, $this->senha);
	}
}