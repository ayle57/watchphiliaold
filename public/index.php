<?php declare(strict_types=1);
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Kernel();

$app->create();
$app->run();
