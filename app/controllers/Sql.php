<?php

namespace App\Controllers;

use App\Config\DataBase;
use PDO;

class Sql 
{
    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function select($fields, $params = '')
    { 
        $query = "SELECT {$fields} FROM {$this->table} {$params}";
        $this->pdo = DataBase::connect();
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        DataBase::disconnect();
		return $result;
    }

    public function create() 
    {
        
    }

    public function read($id) 
    {

    }

    public function update($data) 
    {

    }

    public function delete($id) 
    {

    }
}
