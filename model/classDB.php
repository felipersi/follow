<?php
include_once('./config.php');
class db
{
    private $db_host = DB_HOST;
    private $db_usuario = DB_USUARIO;
    private $db_senha = DB_SENHA;
    private $db_nome = DB_NOME;
    public $db;
    public function __construct()
    {
        if (!isset($this->db)) {
            try {
                $conexao = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_nome, $this->db_usuario, $this->db_senha);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $conexao;

                echo "conectado";
                echo "<br>";

            } catch (PDOException $e) {
                die("Falha ao conectar com MySQL: " . $e->getMessage());
            }
        }
    }
    public function inserir($tabela, $dados)
     {
        if (!empty($dados) && is_array($dados)) {
            $string_coluna = implode(',', array_keys($dados));
            $string_valor = ":" . implode(',:', array_keys($dados));
            $sql = "INSERT INTO " . $tabela . " (" . $string_coluna . ") VALUES (" . $string_valor . ")";
            $query = $this->db->prepare($sql);
        
            foreach ($dados as $key => $val) {
                $val = htmlspecialchars(strip_tags($val));
                $query->bindValue(':' . $key, $val);
            }
        

            $insert = $query->execute();
        

            if ($insert) {
                $dados['id'] = $this->db->lastInsertId();
                return $dados;
        

            } else {
                return false;
            }
        } else {
            return false;
        }
    
    }

}


