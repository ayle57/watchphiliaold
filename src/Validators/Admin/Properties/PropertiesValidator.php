<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Validators\Admin\Properties;

use App\Http\Repository\Admin\Properties\PropertiesRepository;
use App\Http\Repository\Admin\SubSections\SubSectionsRepository;

class PropertiesValidator
{
    private array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function create()
    {
        if (isset($_POST['submit'])) {


            // --- Name
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = htmlspecialchars($_POST['name']);

                $repo = new PropertiesRepository();
                $repo->new($name);
                header('Location: /admin/properties');
                exit;

            } else {
                $this->setErrors('Veuillez entrer un nouveau nom');
            }

        }
    }

    public function edit($old_property)
    {
        if (isset($_POST['submit'])) {
            $repo = new PropertiesRepository();
            $updateOccurred = false;

            // --- Name
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = htmlspecialchars($_POST['name']);
                if ($old_property->name != $_POST['name']) {
                    $repo->update('properties', 'name', 'id', $old_property->id, $name);
                    $updateOccurred = true;
                } else {
                    $this->setErrors('Veuillez entrer un nouveau nom différent de l\'ancien');
                }
            }

            if ($updateOccurred) {
                header('Location: /admin/properties/');
                exit();
            } else {
                $this->setErrors('Aucune mise à jour effectuée');
            }
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(string $errors): void
    {
        $this->errors[] = $errors;
    }
}