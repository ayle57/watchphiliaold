<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

$routeGenerator->generateCouple('/', \App\Http\Controllers\HomeController::class, 'index');

// ADMIN AUTH routes
$routeGenerator->generateCouple('/admin/login', \App\Http\Controllers\Admin\Auth\LoginController::class, 'login');
$routeGenerator->generateCouple('/admin/logout', \App\Http\Controllers\Admin\Auth\LogoutController::class, 'logout');

// ADMIN DASHBOARD routes
$routeGenerator->generateCouple('/admin', \App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'index');

// ADMIN SECTIONS routes
$routeGenerator->generateCouple('/admin/sections', \App\Http\Controllers\Admin\Sections\SectionsController::class, 'index');
$routeGenerator->generateCouple('/admin/sections/create', \App\Http\Controllers\Admin\Sections\SectionsController::class, 'create');
$routeGenerator->generateCouple('/admin/sections/edit/{id}', \App\Http\Controllers\Admin\Sections\SectionsController::class, 'edit');
$routeGenerator->generateCouple('/admin/sections/delete/{id}', \App\Http\Controllers\Admin\Sections\SectionsController::class, 'delete');

// ADMIN SUB-SECTIONS routes
$routeGenerator->generateCouple('/admin/subsections', \App\Http\Controllers\Admin\SubSections\SubSectionsController::class, 'index');
$routeGenerator->generateCouple('/admin/subsections/create', \App\Http\Controllers\Admin\SubSections\SubSectionsController::class, 'create');
$routeGenerator->generateCouple('/admin/subsections/edit/{id}', \App\Http\Controllers\Admin\SubSections\SubSectionsController::class, 'edit');
$routeGenerator->generateCouple('/admin/subsections/delete/{id}', \App\Http\Controllers\Admin\SubSections\SubSectionsController::class, 'delete');

// ADMIN PROPERTIES routes
$routeGenerator->generateCouple('/admin/properties', \App\Http\Controllers\Admin\Properties\PropertiesController::class, 'index');
$routeGenerator->generateCouple('/admin/properties/create', \App\Http\Controllers\Admin\Properties\PropertiesController::class, 'create');
$routeGenerator->generateCouple('/admin/properties/edit/{id}', \App\Http\Controllers\Admin\Properties\PropertiesController::class, 'edit');
$routeGenerator->generateCouple('/admin/properties/delete/{id}', \App\Http\Controllers\Admin\Properties\PropertiesController::class, 'delete');

// ADMIN WATCHES routes
$routeGenerator->generateCouple('/admin/watches', \App\Http\Controllers\Admin\Watches\WatchesController::class, 'index');
$routeGenerator->generateCouple('/admin/watches/create', \App\Http\Controllers\Admin\Watches\WatchesController::class, 'create');
$routeGenerator->generateCouple('/admin/watches/edit/{id}', \App\Http\Controllers\Admin\Watches\WatchesController::class, 'edit');
$routeGenerator->generateCouple('/admin/watches/delete/{id}', \App\Http\Controllers\Admin\Watches\WatchesController::class, 'delete');

// ADMIN USERS routes
$routeGenerator->generateCouple('/admin/users', \App\Http\Controllers\Admin\Users\UsersController::class, 'index');
$routeGenerator->generateCouple('/admin/users/delete/{id}', \App\Http\Controllers\Admin\Users\UsersController::class, 'delete');

