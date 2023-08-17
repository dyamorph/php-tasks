<?php

declare(strict_types=1);

namespace app\providers;

use app\core\Database;

class UserDatabaseProvider extends DatabaseProvider
{
    private Database $database;

    public function __construct()
    {
        parent::__construct('users', '*', 'id');
        $this->database = Database::getInstance();
    }

    public function first(string $id): bool | array | null
    {
        $user = $this->database->get($this->table, $this->fields, $this->where, $id);
        return $user[0];
    }

    public function all(): bool | array | null
    {
        return $this->database->get($this->table, $this->fields);
    }

    public function withLimit(int $page, int $limit): bool | array | null
    {
        $offset = $page * $limit;
        return $this->database->get($this->table, $this->fields, null, null, $limit, $offset);
    }

    public function create(array $data): bool | array | null
    {
        $fields = array_keys($data);
        $values = array_values($data);
        return $this->database->set($this->table, $fields, $values);
    }

    public function update(array $data, string $id): bool | array | null
    {
        $fields = array_keys($data);
        $values = array_values($data);
        return $this->database->update($this->table, $fields, $values, $this->where, $id);
    }

    public function delete(string $id): bool | array | null
    {
        return $this->database->delete($this->table, $id);
    }
}
