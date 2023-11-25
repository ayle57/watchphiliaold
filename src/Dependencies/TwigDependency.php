<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Dependencies;

use Twig\{Loader\FilesystemLoader, Environment, TwigFunction};

class TwigDependency
{
    private static $twig;

    public static function getTwig()
    {
        if (!self::$twig) {
            $loader = new FilesystemLoader(dirname(dirname(__DIR__)) . '/views/');
            $twig = new Environment($loader, [
                'cache' => false, // '/path/to/compilation_cache',
            ]);

            self::$twig = $twig;
        }

        return self::$twig;
    }
}