<?php

declare(strict_types=1);

namespace models;

use core\Model;
use db\DB;

class UserModel extends Model
{
    public function getAll($table): bool|array|null
    {
        return (new DB())->get($table);
    }

    public function getOne($table, $fields, $where, $whereData): bool|array|null
    {
        return (new DB())->get($table, $fields, $where, $whereData);
    }

    public function delete($table, $id): bool|array|null
    {
        return (new DB())->delete($table, $id);
    }

    public function update(
        $table,
        $fields,
        $values,
        $where,
        $whereData
    ): bool|array|null {
        return (new DB())->update($table, $fields, $values, $where, $whereData);
    }

    public function set($table, $fields, $values): bool|array|null
    {
        return (new DB())->set($table, $fields, $values);
    }
}
