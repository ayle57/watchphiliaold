<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Repository\Admin\Sections;

use App\Helpers\Base\BaseRepository;

class SectionsRepository extends BaseRepository
{
    public function new($name, $min_price, $max_price)
    {
        $req = $this->db->prepare('INSERT INTO sections (name, min_price, max_price) VALUES (?, ?, ?)');
        $req->execute(array($name, $min_price, $max_price));
        return true;
    }
}