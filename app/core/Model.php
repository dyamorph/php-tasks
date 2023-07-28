<?php

declare(strict_types=1);

namespace app\core;

class Model
{
    public Database $database;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->database = Database::getInstance();
    }

    public function getAll($table, $fields): array | bool | null
    {
        return $this->database->get($table, $fields, null, null, null, null);
    }

    public function getOne($table, $fields, $where, $whereData): array | bool | null
    {
        $session = $this->request->getSession();
        if ($session['data-source'] === 'gorest') {
            $url = "https://gorest.co.in/public/v2/users";

            $headers = array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Bearer c2e2d7605c4426899877055782f9bc4be953851de101c6b9277dfdb66d717eb7"
            );

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo "cURL Error: " . curl_error($ch);
            } else {
                $data = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
            }
            curl_close($ch);
        } else {
            $data = $this->database->get($table, $fields, $where, $whereData, null, null);
        }
        return $data;
    }

    public function getWithLimitFromDatabase($table, $fields, $startLimit, $offset): array | bool | null
    {
        return $this->database->get($table, $fields, null, null, $startLimit, $offset);
    }

    public function getWithLimitFromAPI($page, $perPage)
    {
        $url = "https://gorest.co.in/public/v2/users?page=$page&per_page=$perPage";

        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer c2e2d7605c4426899877055782f9bc4be953851de101c6b9277dfdb66d717eb7",
            "X-Pagination-Total: 100",
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            $data = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
            $responseHeaders = curl_getinfo($ch, CURLINFO_HEADER_OUT);
            $totalUsers = $this->getHeader($responseHeaders, 'X-Pagination-Total');
        }
        curl_close($ch);
        return [$data, $totalUsers];
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

//    public function getWithLimit($table, $fields, $startLimit, $offset): array | bool | null
//    {
//        $session = $this->request->getSession();
//    }

    public function delete($table, $id): array | bool | null
    {
        return $this->database->delete($table, $id);
    }

    public function update(
        $table,
        $fields,
        $values,
        $where,
        $whereData
    ): bool | array | null {
        return $this->database->update($table, $fields, $values, $where, $whereData);
    }

    public function set($table, $fields, $values): array | bool | null
    {
        return $this->database->set($table, $fields, $values);
    }
}
