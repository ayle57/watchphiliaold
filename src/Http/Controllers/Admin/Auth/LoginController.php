<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\Auth;

use App\Command\Admin\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Validators\Admin\Auth\LoginValidator;

class LoginController extends BaseController
{
    use AuthTrait;

    private Array $infos;

    public function login()
    {
        $this->loginAction();

        $this->render('admin/auth/login', [
            'errors' => $this->getInfos()
        ]);
    }

    public function getInfos(): array
    {
        return $this->infos;
    }

    public function setInfos($infos): void
    {
        $this->infos = $infos;
    }

    private function loginAction()
    {
        $this->redirect();

        $errors = LoginValidator::authenticate();
        $this->setInfos($errors);
    }
}