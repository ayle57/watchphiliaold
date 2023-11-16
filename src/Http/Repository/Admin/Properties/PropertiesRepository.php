<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Repository\Admin\Properties;

use App\Helpers\Base\BaseRepository;

class PropertiesRepository extends BaseRepository
{
    public function new($name)
    {
        $req = $this->db->prepare('INSERT INTO properties (name) VALUES (?)');
        $req->execute(array($name));
        return true;
    }

    public function getPropertiesForWatch($watchId)
    {
        $sql = "SELECT p.*
                FROM properties p
                JOIN watch_properties wp ON p.id = wp.properties_id
                WHERE wp.watch_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($watchId));

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}