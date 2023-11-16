<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\SubSections;

use App\Command\Admin\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Http\Repository\Admin\Sections\SectionsRepository;
use App\Http\Repository\Admin\SubSections\SubSectionsRepository;
use App\Validators\Admin\Sections\SectionsValidator;
use App\Validators\Admin\SubSections\SubSectionsValidator;

class SubSectionsController extends BaseController
{
    use AuthTrait;
    public function __construct()
    {
        session_start();
        $this->auth();
    }

    public function index()
    {
        $repo = new SubSectionsRepository();
        $subsections = $repo->selectAll('subsections', 'id');
        $this->render('admin/subsections/index', [
            'subsections' => $subsections
        ]);
    }
    public function edit($id)
    {
        $repo = new SubSectionsRepository();
        $subsection = $repo->selectOne('subsections', 'id', $id);

        $validator = new SubSectionsValidator();
        $validator->edit($subsection);
        $errors = $validator->getErrors();

        $this->render('admin/subsections/edit', [
            'errors' => $errors,
            'subsection' => $subsection
        ]);
    }

    public function create()
    {
        $validator = new SubSectionsValidator();
        $validator->create();
        $this->render('admin/subsections/create');
    }

    public function delete($id)
    {
        $repo = new SubSectionsRepository();
        $repo->delete('subsections', 'id', $id);
        header('Location: /admin/subsections/');
        exit();
    }
}