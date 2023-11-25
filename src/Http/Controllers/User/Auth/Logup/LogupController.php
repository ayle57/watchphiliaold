<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\User\Auth\Logup;

use App\Command\User\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Validators\User\Auth\LogupValidator;

class LogupController extends BaseController
{
    use AuthTrait;
    public function logup() {
        $this->redirect();

        $logup_valid = new LogupValidator();
        $logup_valid->logup();
        $errors = $logup_valid->getErrors();

        $this->render('auth/logup/logup', [
            'errors' => $errors
        ]);
    }
}