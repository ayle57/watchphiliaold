<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\Properties;

use App\Command\Admin\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Http\Repository\Admin\Properties\PropertiesRepository;
use App\Validators\Admin\Properties\PropertiesValidator;

class PropertiesController extends BaseController
{
    use AuthTrait;
    public function __construct()
    {
        session_start();
        $this->auth();
    }

    public function index()
    {
        $repo = new PropertiesRepository();
        $properties = $repo->selectAll('properties', 'name');
        $this->render('admin/properties/index', [
            'properties' => $properties
        ]);
    }

    public function create()
    {
        $validator = new PropertiesValidator();
        $validator->create();
        $errors = $validator->getErrors();

        $this->render('admin/properties/create', [
            'errors' => $errors
        ]);
    }

    public function edit($id)
    {
        $repo = new PropertiesRepository();
        $property = $repo->selectOne('properties', 'id', $id);

        $validator = new PropertiesValidator();
        $validator->edit($property);
        $errors = $validator->getErrors();

        $this->render('admin/properties/edit', [
            'errors' => $errors,
            'property' => $property
        ]);
    }

    public function delete($id)
    {
        $repo = new PropertiesRepository();
        $repo->delete('properties', 'id', $id);
        header('Location: /admin/properties/');
        exit();
    }
}