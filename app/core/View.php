<?php

declare(strict_types=1);

namespace app\core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../views');
        $this->twig = new Environment($loader, ['auto_reload' => true, 'autoescape' => false]);
    }

    public function render(string $template, array $data = []): View
    {
        $this->twig->display($template, $data);
        return $this;
    }
}
