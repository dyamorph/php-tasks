<?php

namespace app\core;

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

    public function getSession(): array
    {
        return $_SESSION;
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

    public function getHeader($headers, $headerName): ?string
    {
        $headersArray = explode("\r\n", $headers);
        foreach ($headersArray as $header) {
            $headerParts = explode(':', $header, 2);
            if (count($headerParts) === 2 && strtolower(trim($headerParts[0])) === strtolower($headerName)) {
                return trim($headerParts[1]);
            }
        }
        return null;
    }
}
