<?php
# models/Model.php
class Model
{

    // Não é a forma mais indicada de armazenar usuário e senha
    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'sistematwig';
    private $port = '3306';
    private $user = 'root';
    private $password = null;

    protected $table;
    protected $conex;

    public function __construct() {
        // Descobre o nome da tabela
        $tbl = strtolower(get_class($this));
        $tbl .= 's';
        $this->table = $tbl;

        // Conecta no banco
        $this->conex = new PDO("{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->user, $this->password);
    }

    public function getAll() {
        $sql = $this->conex->query("SELECT * FROM {$this->table}");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

}