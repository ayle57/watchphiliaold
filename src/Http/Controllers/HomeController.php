<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers;

use App\Command\User\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Helpers\Base\BaseRepository;
use App\Http\Controllers\Admin\Watches\WatchesController;
use App\Http\Repository\Admin\Posts\PostsRepository;
use App\Http\Repository\Admin\Properties\PropertiesRepository;
use App\Http\Repository\Admin\Watches\WatchesRepository;

class HomeController extends BaseController
{
    private $base_repo;
    public function __construct()
    {
        session_start();
        $this->base_repo = new BaseRepository();
    }

    public function index()
    {
        $postsRepo = new PostsRepository();
        $posts = $postsRepo->selectAll('posts', 'id', 6);

        $watchesRepo = new WatchesRepository();
        $watches = $watchesRepo->selectAll('watches', 'id', 6);

        $propertiesRepo = new PropertiesRepository();
        foreach ($watches as $watch) {
            $watch->properties = $propertiesRepo->getPropertiesForWatch($watch->id);
        }


        $this->render('home/index', [
            'user' => $_SESSION['user'] ?? null,
            'posts' => $posts,
            'watches' => $watches,
        ]);
    }
}