<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Command\Admin;

use App\Helpers\Managers\SessionManager;

trait AuthTrait
{
    public function __construct()
    {
        session_start();
    }

    public function auth()
    {
        if ($_SESSION['admin_login'] !== 1) {
            header('Location: /admin/logout');
            exit;
        }
    }

    public function redirect()
    {
        if($_SESSION['admin_login'] === 1) {
            header('Location: /admin/');
            exit;
        }
    }
}