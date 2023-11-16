<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Helpers\Objects;

class Database
{
    private String $db_host = 'localhost';
    private String $db_name = 'watchphilia';
    private String $db_user = 'root';
    private String $db_pass = '';
    private Mixed $pdo = null;
    public function getPdo(): \PDO
    {
        if($this->pdo !== null) {
            return $this->pdo;
        }
        $pdo = new \PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_pass);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
        return $pdo;
    }

    public function diePdo(): bool
    {
        $this->pdo = null;
        return false;
    }
}