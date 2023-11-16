<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Helpers\Managers;

class SessionManager
{
    public function initialize()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function verify($key, $result)
    {
        if($_SESSION[$key] = $result) {
            return true;
        } else {
            return false;
        }
    }
}