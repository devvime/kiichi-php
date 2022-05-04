<?php

namespace App\Controllers;

use App\Core\DataBase;
use PDO;

class Sql 
{
    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function select($fields, $condition = '')
    { 
        $query = "SELECT {$fields} FROM {$this->table} {$condition}";
        $this->pdo = DataBase::connect();
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        DataBase::disconnect();
		return $result;
    }

    public function create($data)
	{
        $fields = implode(',', array_keys($data));
        $params = str_replace(array_keys($data), '?', $fields);
		$query = "INSERT INTO {$this->table} ({$fields}) VALUES ({$params})";
		$this->pdo = DataBase::connect();
		$stmt = $this->pdo->prepare($query);
		$result = $stmt->execute(array_values($data));
		DataBase::disconnect();
		return $result;
	}

    public function update($data, $condition) 
    {        
        unset($data['id']);  
        $fields = [];
        foreach (array_keys($data) as $value) {
            array_push($fields, $value . ' = ?');
        }
        $fields = implode(',', $fields);
        $query = "UPDATE {$this->table} SET {$fields} {$condition}";
		$this->pdo = DataBase::connect();
		$stmt = $this->pdo->prepare($query);		
		$result = $stmt->execute(array_values($data));
		DataBase::disconnect();
		return $result;
    }

    public function delete($id) 
    {

    }
}
