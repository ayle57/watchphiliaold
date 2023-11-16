<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Repository\Admin\SubSections;

use App\Helpers\Base\BaseRepository;

class SubSectionsRepository extends BaseRepository
{
    public function new($name)
    {
        $req = $this->db->prepare('INSERT INTO subsections (name) VALUES (?)');
        $req->execute(array($name));
        return true;
    }
}