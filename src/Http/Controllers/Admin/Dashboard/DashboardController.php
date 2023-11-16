<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\Dashboard;

use App\Command\Admin\AuthTrait;
use App\Helpers\Base\BaseController;

class DashboardController extends BaseController
{
    use AuthTrait;
    public function index()
    {
        $this->auth();
        $this->render('admin/dashboard/index',[
            'admin' => $_SESSION['admin']
        ]);
    }
}