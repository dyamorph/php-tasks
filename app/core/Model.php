<?php

declare(strict_types=1);

namespace app\core;

use app\interfaces\IDataProvider;

class Model
{
    public IDataProvider $dataProvider;

    public function __construct(IDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    public function all(): array
    {
        return $this->dataProvider->all();
    }

    public function first(string $id): array
    {
        return $this->dataProvider->first($id);
    }

    public function withLimit(int $page, int $limit): array
    {
        return $this->dataProvider->withLimit($page, $limit);
    }

    public function create(array $data): mixed
    {
        return $this->dataProvider->create($data);
    }

    public function update(array $data, string $id): mixed
    {
        return $this->dataProvider->update($data, $id);
    }

    public function delete(string $id): mixed
    {
        return $this->dataProvider->delete($id);
    }
}
