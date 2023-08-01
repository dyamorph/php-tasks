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

    public function first($id)
    {
        $user = $this->database->get('users', '*', 'id', $id, null, null);
        return $user[0];
    }

    public function all(): bool | array | null
    {
        return $this->database->get('users', '*', null, null, null, null);
    }

    public function withLimit($limit, $offset, $page): bool | array | null
    {
        return $this->database->get('users', '*', null, null, $limit, $offset);
    }

    public function create($fields, $values, $data): bool | array | null
    {
        return $this->database->set('users', $fields, $values);
    }

    public function update($fields, $values, $where, $whereData, $data, $id): bool | array | null
    {
        return $this->database->update('users', $fields, $values, $where, $whereData);
    }

    public function delete($id): bool | array | null
    {
        return $this->database->delete('users', $id);
    }
}
