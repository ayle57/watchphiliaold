<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\Sections;

use App\Command\Admin\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Http\Repository\Admin\Sections\SectionsRepository;
use App\Validators\Admin\Sections\SectionsValidator;

class SectionsController extends BaseController
{
    use AuthTrait;
    public function __construct()
    {
        session_start();
        $this->auth();
    }

    public function index()
    {
        $repo = new SectionsRepository();
        $sections = $repo->selectAll('sections', 'id');
        $this->render('admin/sections/index', [
            'sections' => $sections
        ]);
    }

    public function create()
    {
        $validator = new SectionsValidator();
        $validator->create();
        $errors = $validator->getErrors();

        $this->render('admin/sections/create', [
            'errors' => $errors
        ]);
    }

    public function edit($id)
    {
        $repo = new SectionsRepository();
        $section = $repo->selectOne('sections', 'id', $id);

        $validator = new SectionsValidator();
        $validator->edit($section);
        $errors = $validator->getErrors();

        $this->render('admin/sections/edit', [
            'errors' => $errors,
            'section' => $section
        ]);
    }

    public function delete($id)
    {
        $repo = new SectionsRepository();
        $repo->delete('sections', 'id', $id);
        header('Location: /admin/sections/');
        exit();
    }
}