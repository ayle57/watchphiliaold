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
    private function initTwig()
    {
        return $twig = TwigDependency::getTwig();
    }
    public function render(string $filename, array $args = [])
    {
        $twig = $this->initTwig();
        $filename .= '.html.twig';
        echo $twig->render($filename, $args);
    }
}