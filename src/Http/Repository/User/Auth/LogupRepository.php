<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Repository\User\Auth;

use App\Helpers\Base\BaseRepository;
use App\Helpers\Objects\Database;

class LogupRepository
{
    private mixed $pdo;
    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPdo();
    }

    public function signUp($username, $email, $password, $password_confirmation) {
            $pdo = $this->pdo;

            $stmt = $pdo->prepare('INSERT INTO users (username, email, password, password_confirmation) VALUES (?, ?, ?, ?)');
            $stmt->execute(array($username, $email, $password, $password_confirmation));

            $userId = $pdo->lastInsertId();

            $repo = new BaseRepository();
            $user = $repo->selectOne('users', 'id', $userId);

            session_start();
            $_SESSION['user_login'] =  1;
            $_SESSION['user'] = $user;

            header('Location: /');
            exit;
    }
}