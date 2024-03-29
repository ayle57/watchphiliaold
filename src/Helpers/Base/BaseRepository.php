<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Helpers\Base;

use App\Helpers\Objects\Database;

class BaseRepository
{
    public Mixed $db;

    public function __construct()
    {
        $db = new Database();
        $this->db = $db->getPdo();
    }

    public function selectAll($table, $order, $limit = null)
    {
        $pdo = $this->db;
        if($limit != null) {
            $stmt = $pdo->prepare("SELECT * FROM {$table} ORDER BY {$order} LIMIT {$limit}");
        } else {
            $stmt = $pdo->prepare("SELECT * FROM {$table} ORDER BY {$order}");
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function selectOne($table, $condition, $value)
    {
        $pdo = $this->db;
        $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE {$condition} = ?");
        $stmt->execute(array($value));
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function update($table, $key, $condition_key, $condition, $value)
    {
        $pdo = $this->db;
        $stmt = $pdo->prepare("UPDATE {$table} SET {$key} = ? WHERE {$condition_key} = ?");
        $stmt->execute(array($value, $condition));
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function delete($table, $condition_key, $condition)
    {
        $pdo = $this->db;

        $stmt = $pdo->prepare("SELECT * FROM {$table} WHERE {$condition_key} = ?");
        $stmt->execute(array($condition));
        $recordToDelete = $stmt->fetch(\PDO::FETCH_OBJ);

        $stmt = $pdo->prepare("UPDATE watch_properties SET properties_id = NULL WHERE properties_id = ?");
        $stmt->execute(array($recordToDelete->id));

        $stmt = $pdo->prepare("DELETE FROM {$table} WHERE {$condition_key} = ?");
        $stmt->execute(array($condition));

        return true;
    }
}