<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Validators\Admin\Sections;

use App\Http\Repository\Admin\Sections\SectionsRepository;

class SectionsValidator
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

                // --- Min Price
                if (isset($_POST['min_price']) && !empty($_POST['min_price'])) {
                    $min_price = htmlspecialchars($_POST['min_price']);

                    // --- Max Price
                    if (isset($_POST['max_price']) && !empty($_POST['max_price'])) {
                        $max_price = htmlspecialchars($_POST['max_price']);

                        $repo = new SectionsRepository();
                        $repo->new($name, $min_price, $max_price);
                        header('Location: /admin/sections');
                        exit;

                    } else {
                        $this->setErrors('Veuillez entrer un nouveau prix maximum');
                    }

                } else {
                    $this->setErrors('Veuillez entrer un nouveau prix minimum');
                }

            } else {
                $this->setErrors('Veuillez entrer un nouveau nom');
            }

        }
    }

    public function edit($old_section)
    {
        if (isset($_POST['submit'])) {
            $repo = new SectionsRepository();
            $updateOccurred = false;

            // --- Name
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = htmlspecialchars($_POST['name']);
                if ($old_section->name != $_POST['name']) {
                    $repo->update('sections', 'name', 'id', $old_section->id, $name);
                    $updateOccurred = true;
                } else {
                    $this->setErrors('Veuillez entrer un nouveau nom différent de l\'ancien');
                }
            }

            // --- Min Price
            if (isset($_POST['min_price']) && !empty($_POST['min_price'])) {
                $min_price = htmlspecialchars($_POST['min_price']);
                if ($old_section->min_price != $_POST['min_price']) {
                    $repo->update('sections', 'min_price', 'id', $old_section->id, $min_price);
                    $updateOccurred = true;
                } else {
                    $this->setErrors('Veuillez entrer un nouveau prix minimal différent de l\'ancien');
                }
            }

            // --- Max Price
            if (isset($_POST['max_price']) && !empty($_POST['max_price'])) {
                $max_price = htmlspecialchars($_POST['max_price']);
                if ($old_section->max_price != $_POST['max_price']) {
                    $repo->update('sections', 'max_price', 'id', $old_section->id, $max_price);
                    $updateOccurred = true;
                } else {
                    $this->setErrors('Veuillez entrer un nouveau prix maximal différent de l\'ancien');
                }
            }

            if ($updateOccurred) {
                header('Location: /admin/sections/');
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