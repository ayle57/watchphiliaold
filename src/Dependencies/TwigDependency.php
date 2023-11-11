<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Dependencies;

use Twig\{Loader\FilesystemLoader, Environment};

class TwigDependency
{
    public static function getTwig()
    {
        $loader = new FilesystemLoader(dirname(dirname(__DIR__)) . '/views/');
        $twig = new Environment($loader, [
            'cache' => false // '/path/to/compilation_cache',
        ]);
        return $twig;
    }
}