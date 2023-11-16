<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Validators\Admin\SubSections;

use App\Http\Repository\Admin\SubSections\SubSectionsRepository;

class SubSectionsValidator
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

                $repo = new SubSectionsRepository();
                $repo->new($name);
                header('Location: /admin/subsections');
                exit;

            } else {
                $this->setErrors('Veuillez entrer un nouveau nom');
            }

        }
    }

    public function edit($old_section)
    {
        if (isset($_POST['submit'])) {
            $repo = new SubSectionsRepository();
            $updateOccurred = false;

            // --- Name
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = htmlspecialchars($_POST['name']);
                if ($old_section->name != $_POST['name']) {
                    $repo->update('subsections', 'name', 'id', $old_section->id, $name);
                    $updateOccurred = true;
                } else {
                    $this->setErrors('Veuillez entrer un nouveau nom différent de l\'ancien');
                }
            }

            if ($updateOccurred) {
                header('Location: /admin/subsections/');
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