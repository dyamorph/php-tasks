<?php

declare(strict_types=1);

namespace app\core;

class Model
{
    public Database $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public function getAll($table, $fields): array | bool | null
    {
        return $this->database->get($table, $fields, null, null, null, null);
    }

    public function getOne($table, $fields, $where, $whereData): array | bool | null
    {
        return $this->database->get($table, $fields, $where, $whereData, null, null);
    }

    public function getWithLimit($table, $fields, $startLimit, $offset): array | bool | null
    {
        return $this->database->get($table, $fields, null, null, $startLimit, $offset);
    }

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
