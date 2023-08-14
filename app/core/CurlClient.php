<?php

declare(strict_types=1);

namespace app\core;

class CurlClient
{
    private $ch;

    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function setUrl(string $url): void
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }

    public function setHeaders(array $headers): void
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    }

    public function setOptions(array $options): void
    {
        foreach ($options as $option => $value) {
            curl_setopt($this->ch, $option, $value);
        }
    }

    public function execute(): bool | string
    {
        $response = curl_exec($this->ch);

        if (curl_errno($this->ch)) {
            $error = curl_error($this->ch);
            return "cURL Error: $error";
        }

        return $response;
    }

    public function close(): void
    {
        curl_close($this->ch);
    }
}
