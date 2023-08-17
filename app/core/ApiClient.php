<?php

declare(strict_types=1);

namespace app\core;

class ApiClient
{
    private CurlClient $curl;
    private string $baseUrl;
    private array $headers;

    public function __construct($baseUrl, $headers)
    {
        $this->curl = new CurlClient();
        $this->baseUrl = $baseUrl;
        $this->headers = $headers;
    }

    public function get(string $id = null, int $page = null, int $limit = null): mixed
    {
        if (isset($id)) {
            $url = $this->baseUrl . "/$id";
        } elseif (isset($page, $limit)) {
            $url = $this->baseUrl . "?page=$page&per_page=$limit";
        } else {
            $url = $this->baseUrl;
        }

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->close();

        return json_decode($this->curl->execute(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function set(array $data): bool | string
    {
        $this->curl->setUrl($this->baseUrl);
        $this->curl->setHeaders($this->headers);
        $this->curl->setOptions(
            [
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS    => json_encode($data, JSON_THROW_ON_ERROR)
            ]
        );
        $this->curl->close();

        return $this->curl->execute();
    }

    public function update(array $data, string $id): bool | string
    {
        $url = $this->baseUrl . "/$id";

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->setOptions(
            [
                CURLOPT_CUSTOMREQUEST => "PATCH",
                CURLOPT_POSTFIELDS    => json_encode($data, JSON_THROW_ON_ERROR)
            ]
        );
        $this->curl->close();

        return $this->curl->execute();
    }

    public function delete(string $id): bool | string
    {
        $url = $this->baseUrl . "/$id";

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->setOptions(
            [
                CURLOPT_CUSTOMREQUEST => "DELETE",
            ]
        );
        $this->curl->close();

        return $this->curl->execute();
    }
}
