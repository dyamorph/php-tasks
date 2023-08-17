<?php

declare(strict_types=1);

namespace app\providers;

use app\core\ApiClient;
use app\interfaces\IDataProvider;

class ApiProvider implements IDataProvider
{
    protected ApiClient $apiClient;

    public function __construct($baseUrl, $headers)
    {
        $this->apiClient = new ApiClient($baseUrl, $headers);
    }

    public function first(string $id): array | string
    {
         return $this->apiClient->get($id);
    }

    public function all(): array | string
    {
        return $this->apiClient->get();
    }

    public function withLimit(int $page, int $limit): array | string
    {
        return $this->apiClient->get(null, $page, $limit);
    }

    public function create(array $data): string | bool
    {
        return $this->apiClient->set($data);
    }

    public function update(array $data, string $id): string | bool
    {
        return $this->apiClient->update($data, $id);
    }

    public function delete(string $id): string | bool
    {
        return $this->apiClient->delete($id);
    }
}
