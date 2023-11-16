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
        $manager = new SessionManager();
        session_destroy();
        header('Location: /');
    }
}