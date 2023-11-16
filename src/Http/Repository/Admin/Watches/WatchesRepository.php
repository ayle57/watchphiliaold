<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Repository\Admin\Watches;

use App\Helpers\Base\BaseRepository;

class WatchesRepository extends BaseRepository
{
    public function new($name, $description, $identification_number, $image_url, $section, $subsection, $properties)
    {
        $sql = "INSERT INTO watches (name, description, identification_number, image_url, section_id, subsection_id) 
            VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        $params = array(
            $name,
            $description,
            $identification_number,
            $image_url,
            $section,
            $subsection
        );

        $stmt->execute($params);

        $watchId = $this->db->lastInsertId();

        foreach ($properties as $propertyId) {
            $propertyId = htmlspecialchars($propertyId);

            $propertySql = "INSERT INTO watch_properties (watch_id, properties_id) VALUES (?, ?)";

            $propertyStmt = $this->db->prepare($propertySql);

            $propertyParams = array(
                $watchId,
                $propertyId
            );

            $propertyStmt->execute($propertyParams);
        }

        header('Location: /admin/watches/');
        exit;
    }


    public function selectAll($table, $order)
    {
        $sql = "SELECT w.id, w.name, w.description, w.identification_number, w.image_url, w.section_id, w.subsection_id,
                   s.name AS section_name, ss.name AS subsection_name
            FROM {$table} w
            LEFT JOIN sections s ON w.section_id = s.id
            LEFT JOIN subsections ss ON w.subsection_id = ss.id
            ORDER BY {$order}";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}