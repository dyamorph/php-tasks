<?php

declare(strict_types=1);

namespace core;

class View
{
    public function render(string $content, string $template)
    {
        $file = 'views/' . $template;
        if (file_exists($file)) {
            include_once $file;
        }
    }
}
