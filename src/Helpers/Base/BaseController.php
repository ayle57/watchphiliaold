<?php
/**
 * IDE: PhpStorm
 * Project: watchphilia
 * User: allistair
 * Year: 2023
 */

namespace App\Helpers\Base;

use App\Dependencies\TwigDependency;

class BaseController
{
    private Mixed $twig;
    public function __construct()
    {
        $this->twig = TwigDependency::getTwig();
    }

    public function render(String $filename, Array $args = [])
    {
        $filename .= '.html.twig';
        echo $this->twig->render($filename, $args);
    }
}