<?php

namespace app\providers;

use app\interfaces\IDataProvider;

class ApiProvider implements IDataProvider
{
    public string $baseUrl = "https://gorest.co.in/public/v2/users";
    public array $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        "Authorization: Bearer d5d106ddbcf6f9524154a529a9330d7fdc2a6615c9ab50bce1bcc69964273cfe"
    ];

    public function first($id)
    {
        $url = $this->baseUrl . "/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            $firstUser = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        }

        curl_close($ch);

        return $firstUser;
    }

    public function all()
    {
        $url = $this->baseUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            $users = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        }

        curl_close($ch);

        return $users;
    }

    public function withLimit($limit, $offset, $page)
    {
        $url = $this->baseUrl . "?page=$page&per_page=$limit";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            $users = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        }

        curl_close($ch);

        return $users;
    }

    public function create($fields, $values, $data)
    {
        $url = $this->baseUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_THROW_ON_ERROR));

        curl_exec($ch);

        if (curl_errno($ch)) {
            $response =  "cURL Error: " . curl_error($ch);
        } else {
            $response = "User added successfully";
        }

        curl_close($ch);

        return $response;
    }

    public function update($fields, $values, $where, $whereData, $data, $id)
    {
        $url = $this->baseUrl . "/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
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

    public function delete($id)
    {
        $url = $this->baseUrl . "/$id";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
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
}
