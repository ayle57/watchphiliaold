<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\User\Auth\Login;

use App\Command\User\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Validators\User\Auth\LoginValidator;

class LoginController extends BaseController
{
    use AuthTrait;
    public function login()
    {
        $this->redirect();

        $login_valid = new LoginValidator();
        $login_valid->login();
        $errors = $login_valid->getErrors();

        $this->render('auth/login/login', [
            'errors' => $errors
        ]);
    }
}