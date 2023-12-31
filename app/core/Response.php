<?php

declare(strict_types=1);

namespace app\core;

class Response
{
    public function redirect(string $location): View
    {
        header("Location: $location");
        exit();
    }

    public function message(string $message): string
    {
        return $message;
    }
}
