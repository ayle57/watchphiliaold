<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Http\Controllers\Admin\Watches;

use App\Command\Admin\AuthTrait;
use App\Helpers\Base\BaseController;
use App\Http\Repository\Admin\Properties\PropertiesRepository;
use App\Http\Repository\Admin\Sections\SectionsRepository;
use App\Http\Repository\Admin\SubSections\SubSectionsRepository;
use App\Http\Repository\Admin\Watches\WatchesRepository;
use App\Validators\Admin\Watches\WatchesValidator;

class WatchesController extends BaseController
{
    use AuthTrait;
    public function __construct()
    {
        session_start();
        $this->auth();
    }

    public function index()
    {
        $repo = new WatchesRepository();
        $watches = $repo->selectAll('watches', 'id');

        $propertiesRepo = new PropertiesRepository();
        foreach ($watches as $watch) {
            $watch->properties = $propertiesRepo->getPropertiesForWatch($watch->id);
        }

        $this->render('admin/watches/index', [
            'watches' => $watches,
        ]);
    }
    public function edit($id)
    {
        $repo = new WatchesRepository();
        $watch = $repo->selectOne('watches', 'id', $id);

        $validator = new WatchesValidator();
        $validator->edit($watch);
        $errors = $validator->getErrors();

        $sections_repo = new SectionsRepository();
        $sections = $sections_repo->selectAll('sections', 'id');
        $subsections_repo = new SubSectionsRepository();
        $subsections = $subsections_repo->selectAll('subsections', 'id');
        $properties_repo = new PropertiesRepository();
        $properties = $properties_repo->selectAll('properties', 'id');

        return $this->render('admin/watches/edit', [
            'watch' => $watch,
            'sections' => $sections,
            'subsections' => $subsections,
            'properties' => $properties,
            'errors' => $errors
        ]);
    }

    public function create()
    {
        $sections_repo = new SectionsRepository();
        $sections = $sections_repo->selectAll('sections', 'id');

        $subsections_repo = new SubSectionsRepository();
        $subsections = $subsections_repo->selectAll('subsections', 'id');

        $properties_repo = new PropertiesRepository();
        $properties = $properties_repo->selectAll('properties', 'id');

        $validator = new WatchesValidator();
        $validator->create();

        $this->render('admin/watches/create', [
            'sections' => $sections,
            'subsections' => $subsections,
            'properties' => $properties
        ]);
    }

    public function delete($id)
    {
        $repo = new WatchesRepository();
        $repo->delete('watches', 'id', $id);
        header('Location: /admin/watches/');
        exit();
    }
}