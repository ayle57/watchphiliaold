<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\User\Profil;

use App\Command\User\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Helpers\Base\BaseRepository;
use App\Validators\User\Profil\ProfilValidator;

class ProfilController extends BaseController
{
    use AuthTrait;
    public function profil()
    {
        $this->auth();
        $user = $_SESSION['user'];
        $base_repo = new BaseRepository();
        $user = $base_repo->selectOne('users', 'id', $user->id);
        $this->render('profil/index', [
            'user' => $user
        ]);
    }

    public function delete($id)
    {
        $base_repo = new BaseRepository();
        $base_repo->delete('users', 'id', $id);

        header('Location: /logout');
    }

    public function edit($id)
    {
        $this->auth();
        $valid = new ProfilValidator();
        $user = $_SESSION['user'];
        $base_repo = new BaseRepository();
        $user = $base_repo->selectOne('users', 'id', $user->id);
        $valid->editProfile($user);
        $errors = $valid->getErrors();
        $password = sha1($user->password);
        $password_confirmation = sha1($user->password_confirmation);
        $this->render('profil/edit', [
            'user' => $user,
            'errors' => $errors,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
        ]);
    }
}