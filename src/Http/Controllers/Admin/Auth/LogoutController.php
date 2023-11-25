<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\Managers\SessionManager;

class LogoutController
{
    public function logout()
    {
        $this->logoutAction();
    }

    private function logoutAction()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }
}