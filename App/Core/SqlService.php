<?php

namespace App\Core;

use App\Core\Database;
use PDO;

class SqlService 
{
    public $table;
    public $paginatedQuery;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function select($fields, $condition = '')
    { 
        $query = "SELECT {$fields} FROM {$this->table} {$condition} {$this->paginatedQuery}";
        $this->pdo = DataBase::connect();
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        DataBase::disconnect();
		return $result;
    }

    public function create($data)
	{
        $data = get_object_vars($data);
        if (isset($data['id'])) {
            unset($data['id']);
        }
        $fields = implode(',', array_keys($data));
        $params = str_replace(array_keys($data), '?', $fields);
		$query = "INSERT INTO {$this->table} ({$fields}) VALUES ({$params})";
		$this->pdo = DataBase::connect();
		$stmt = $this->pdo->prepare($query);
		$result = $stmt->execute(array_values($data));
		DataBase::disconnect();
		return $result;
	}

    public function update($data, $condition = '')
    {
        $data = get_object_vars($data);
        if ($data['id']) {
            unset($data['id']);
        }
        if ($condition === '') {
            echo json_encode(['error'=>'Condition is required! Ex: WHERE id = $id']);
            exit;
        }
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

    public function destroy($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
		$this->pdo = DataBase::connect();
		$stmt = $this->pdo->prepare($query);
		$stmt->bindValue(":id", $id);
		$result = $stmt->execute();
		DataBase::disconnect();
		return $result;
    }

    public function paginate()
    {
        $perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($perPage * $page) - $perPage;
        $this->paginatedQuery = "LIMIT {$start}, {$perPage}";
    }
}
