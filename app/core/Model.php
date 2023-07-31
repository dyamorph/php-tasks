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

    public function getOneFromDatabase($table, $fields, $where, $whereData): array | bool | null
    {
        return $this->database->get($table, $fields, $where, $whereData, null, null);
    }

    public function getOneFromAPI($id): array
    {
        $session = $this->request->getSession();
        if ($session['data-source'] === 'gorest') {
            $url = "https://gorest.co.in/public/v2/users/$id";

            $headers = [
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Bearer d5d106ddbcf6f9524154a529a9330d7fdc2a6615c9ab50bce1bcc69964273cfe"
            ];

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
        }

        return $data;
    }

    public function getWithLimitFromDatabase($table, $fields, $startLimit, $offset): array | bool | null
    {
        return $this->database->get($table, $fields, null, null, $startLimit, $offset);
    }

    public function getWithLimitFromAPI($page, $perPage): array
    {
        $url = "https://gorest.co.in/public/v2/users?page=$page&per_page=$perPage";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer d5d106ddbcf6f9524154a529a9330d7fdc2a6615c9ab50bce1bcc69964273cfe",
            "X-Pagination-Total: 30"
        ];

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
            $totalUsers = $this->request->getHeader($responseHeaders, 'X-Pagination-Total');
        }
        curl_close($ch);

        return [$data, $totalUsers];
    }

    public function deleteFromDatabase($table, $id): array | bool | null
    {
        return $this->database->delete($table, $id);
    }

    public function deleteFromAPI($id): string
    {
        $url = "https://gorest.co.in/public/v2/users/$id";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer d5d106ddbcf6f9524154a529a9330d7fdc2a6615c9ab50bce1bcc69964273cfe"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_exec($ch);

        if (curl_errno($ch)) {
            $response =  "cURL Error: " . curl_error($ch);
        } else {
            $response = "User deleted successfully";
        }
        curl_close($ch);

        return $response;
    }

    public function updateFromDatabase(
        $table,
        $fields,
        $values,
        $where,
        $whereData
    ): bool | array | null {
        return $this->database->update($table, $fields, $values, $where, $whereData);
    }

    public function updateFromAPI($data, $id): string
    {
        $url = "https://gorest.co.in/public/v2/users/$id";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer d5d106ddbcf6f9524154a529a9330d7fdc2a6615c9ab50bce1bcc69964273cfe"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_THROW_ON_ERROR));

        curl_exec($ch);

        if (curl_errno($ch)) {
            $response =  "cURL Error: " . curl_error($ch);
        } else {
            $response = "User updated successfully";
        }
        curl_close($ch);

        return $response;
    }

    public function setToDatabase($table, $fields, $values): array | bool | null
    {
        return $this->database->set($table, $fields, $values);
    }

    public function setToAPI($data): string
    {
        $url = "https://gorest.co.in/public/v2/users";

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer d5d106ddbcf6f9524154a529a9330d7fdc2a6615c9ab50bce1bcc69964273cfe"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_THROW_ON_ERROR));

        curl_exec($ch);

        if (curl_errno($ch)) {
            $response =  "cURL Error: " . curl_error($ch);
        } else {
            $response = "User updated successfully";
        }
        curl_close($ch);

        return $response;
    }
}
