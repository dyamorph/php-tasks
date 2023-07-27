<?php

namespace app\core;

class Response
{
    public function redirect($url): void
    {
        header("Location: $url");
    }

    public function message($message): void
    {
        echo $message;
    }
}