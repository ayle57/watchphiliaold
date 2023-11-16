<?php

namespace App\Validators\Admin\Watches;

use App\Http\Repository\Admin\Watches\WatchesRepository;

class WatchesValidator
{
    private array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function create()
    {
        $updateOccurred = false;
        if (isset($_POST['submit'])) {
            $repo = new WatchesRepository();

            // --- Name
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = htmlspecialchars($_POST['name']);

                // --- Description
                if (isset($_POST['description']) && !empty($_POST['description'])) {
                    $description = htmlspecialchars($_POST['description']);

                    // --- Identification Number
                    if (isset($_POST['identification_number']) && !empty($_POST['identification_number'])) {
                        $identification_number = htmlspecialchars($_POST['identification_number']);

                        // --- Image Upload
                        if (isset($_POST['image_url'])) {
                            $image_url = htmlspecialchars($_POST['image_url']);

                            // --- Section
                            if (isset($_POST['section']) && !empty($_POST['section'])) {
                                $section = htmlspecialchars($_POST['section']);

                                // --- Subsection
                                if (isset($_POST['subsection']) && !empty($_POST['subsection'])) {
                                    $subsection = htmlspecialchars($_POST['subsection']);

                                    // --- Properties
                                    if (isset($_POST['properties']) && !empty($_POST['properties'])) {
                                        $properties = $_POST['properties'];
                                        $repo->new($name, $description, $identification_number, $image_url, $section, $subsection, $properties);
                                        $updateOccurred = true;
                                    } else {
                                        $this->setErrors('Veuillez entrer des nouvelles propriétés');
                                    }

                                } else {
                                    $this->setErrors('Veuillez entrer une nouvelle sous-section associée');
                                }

                            } else {
                                $this->setErrors('Veuillez entrer une nouvelle section associée');
                            }
                        } else {
                            $this->setErrors('Veuillez entrer une nouvelle image');
                        }
                    } else {
                        $this->setErrors('Veuillez entrer un nouveau numéro d\'identification');
                    }

                } else {
                    $this->setErrors('Veuillez entrer une nouvelle description');
                }

            } else {
                $this->setErrors('Veuillez entrer un nouveau nom');
            }

            if ($updateOccurred) {
                header('Location: /admin/watches/');
                exit();
            } else {
                $this->setErrors('Aucune création effectuée');
            }
        }
    }

    public function edit($old_property)
    {
        // Logique pour la modification
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