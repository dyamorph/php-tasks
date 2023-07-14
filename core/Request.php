<?php

namespace core;

class Request
{
    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody(): array
    {
        $data = [];

        if ($this->getMethod() === "GET") {
            foreach ($_GET as $key => $value) {
                $data[$key] = $value;
            }
        }

        if ($this->getMethod() === "POST") {
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }

}