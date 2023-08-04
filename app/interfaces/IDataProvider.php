<?php

namespace app\interfaces;

interface IDataProvider
{
    public function first(string $id);

    public function all();

    public function withLimit(int $page, int $limit);

    public function create(array $data);

    public function update(array $data, string $id);

    public function delete(string $id);
}
