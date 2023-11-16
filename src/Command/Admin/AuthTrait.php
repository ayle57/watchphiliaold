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
        $manager = new SessionManager();
        session_start();
        if(empty($_SESSION['admin_login'])) {
            $manager->set('admin_login', 0);
        }
        if($_SESSION['admin_login'] == 1) {
            $manager->set('admin_login', 1);
        } else {
            $manager->set('admin_login', 0);
        }
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
        if($_SESSION['admin_login']) {
            if ($_SESSION['admin_login'] === 1) {
                header('Location: /admin');
                exit;
            }
        } else {
            return false;
        }
    }
}