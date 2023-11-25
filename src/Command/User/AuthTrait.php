<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Command\User;

trait AuthTrait
{
    public function __construct()
    {
        session_start();
    }

    public function auth()
    {
        if ($_SESSION['user_login'] !== 1) {
            session_unset();
            session_destroy();
            header('Location: /logout');
            exit;
        }
    }

    public function redirect()
    {
        if ($_SESSION['user_login']) {
            if ($_SESSION['user_login'] === 1) {
                header('Location: /home');
            }
        }
    }
}