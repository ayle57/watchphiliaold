<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers;

use App\Helpers\Base\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $this->render('home/index');
    }
}