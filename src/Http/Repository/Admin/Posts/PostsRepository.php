<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Repository\Admin\Posts;

use App\Helpers\Base\BaseRepository;

class PostsRepository extends BaseRepository
{

    public function new(string $name, string $content)
    {
        $req = $this->db->prepare('INSERT INTO posts (title, content) VALUES (?, ?)');
        $req->execute(array($name, $content));
        return true;
    }
}