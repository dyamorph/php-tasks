<?php

namespace app\providers;

use app\core\Database;
use app\core\Request;
use app\interfaces\IDataProvider;

class DatabaseProvider implements IDataProvider
{
    public Database $database;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->database = Database::getInstance();
    }

    public function first(string $id)
    {
        $user = $this->database->get('users', '*', 'id', $id, null, null);
        return $user[0];
    }

    public function all(): bool | array | null
    {
        return $this->database->get('users', '*', null, null, null, null);
    }

    public function withLimit(int $page, int $limit): bool | array | null
    {
        $offset = $page * $limit;
        return $this->database->get('users', '*', null, null, $limit, $offset);
    }

    public function create(array $data): bool | array | null
    {
        $fields = array_keys($data);
        $values = array_values($data);
        return $this->database->set('users', $fields, $values);
    }

    public function update(array $data, string $id): bool | array | null
    {
        $fields = array_keys($data);
        $values = array_values($data);
        return $this->database->update('users', $fields, $values, 'id', $id);
    }

    public function delete(string $id): bool | array | null
    {
        return $this->database->delete('users', $id);
    }
}
