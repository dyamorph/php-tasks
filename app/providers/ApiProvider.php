<?php

namespace app\providers;

use app\interfaces\IDataProvider;

class ApiProvider implements IDataProvider
{
    public string $baseUrl = "https://gorest.co.in/public/v2/users";
    public array $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        "Authorization: Bearer dda568d4d8b2186c9f4f55ca709c5a744fb1219112ad5388954a16e11847b863"
    ];

    public function first(string $id): array | string
    {
        $url = $this->baseUrl . "/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "cURL Error: " . curl_error($ch);
        }

        $firstUser = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        curl_close($ch);

        return $firstUser;
    }

    public function all(): array | string
    {
        $url = $this->baseUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "cURL Error: " . curl_error($ch);
        }

        $users = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        curl_close($ch);

        return $users;
    }

    public function withLimit(int $page, int $limit): array | string
    {
        $url = $this->baseUrl . "?page=$page&per_page=$limit";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "cURL Error: " . curl_error($ch);
        }

        $users = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        curl_close($ch);

        return $users;
    }

    public function create(array $data): string | bool
    {
        $url = $this->baseUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_THROW_ON_ERROR));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "cURL Error: " . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }

    public function update(array $data, string $id): string | bool
    {
        $url = $this->baseUrl . "/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_THROW_ON_ERROR));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "cURL Error: " . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }

    public function delete(string $id): string | bool
    {
        $url = $this->baseUrl . "/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "cURL Error: " . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }
}
