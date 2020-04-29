<?php

use PDO;

class DatabaseTools
{
    private $host;
    private $dbName;
    private $user;
    private $password;

    private $dsn;
    private $pdo;

    public function __construct($host,$dbName,$user,$password)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;

        $this->dsn = "mysql:host={$host};dbname={$dbName}";
    }
    public function initDatabase()
    {
        $this->pdo = new PDO($this->dsn,$this->user,$this->password);
    }
    public function executeQuery($SQL)
    {
        $result = $this->pdo->query($SQL);
        return $result->fetchAll();
    }
    public function insertQuery($sql, $param) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($param);
    }
    public function selectByNameInTable($tableName, $rowName){
        $result = $this->pdo->query("SELECT * FROM $tableName WHERE name = '$rowName'");
        return $result->fetch();
    }
}


