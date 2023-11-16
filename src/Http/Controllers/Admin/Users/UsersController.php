<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\Users;

use App\Helpers\Base\BaseController;
use App\Http\Repository\Admin\Users\UsersRepository;

class UsersController extends BaseController
{
    public function index()
    {
        $users_repo = new UsersRepository();
        $users = $users_repo->selectAll('users', 'id');
        $this->render('admin/users/index', [
            'users' => $users
        ]);
    }

    public function delete($id)
    {
        $users_repo = new UsersRepository();
        $user = $users_repo->delete('users', 'id', $id);

        header('Location: /admin/users');
        exit;
    }
}