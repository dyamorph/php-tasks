<?php

declare(strict_types=1);

namespace db;

use mysqli;

class DB
{
    private array $db;

    public function __construct()
    {
        $dbConfig = __DIR__.'/../config/DB.php';
        $this->db = include($dbConfig);
    }

    public function get(
        $table,
        $fields = [],
        $where = null,
        $whereData = null
    ): bool|array|null {
        if (empty($fields)) {
            $sql = "SELECT * FROM $table";
        } else {
            $res = '';
            foreach ($fields as $field) {
                $res .= "$table.$field, ";
            }
            $res[strlen($res) - 2] = ' ';
            $sql = "SELECT $res FROM $table";
        }
        if (isset($where)) {
            $sql .= " WHERE $where = $whereData";
        }
        return $this->query($sql);
    }

    public function set($table, $fields, $values): bool|array|null
    {
        $res = '';
        foreach ($fields as $field) {
            $res .= "$field, ";
        }
        $res[strlen($res) - 2] = ' ';
        $sql
            = "INSERT INTO $table ($res) VALUES ('$values[0]', '$values[1]', '$values[2]', '$values[3]')";
        return $this->query($sql);
    }

    public function delete($table, $id): bool|array|null
    {
        $sql = "DELETE FROM $table WHERE $table.id = '$id'";
        return $this->query($sql);
    }

    public function update(
        $table,
        $fields,
        $values,
        $where = null,
        $whereData = null
    ): bool|array|null {
        $sql = "UPDATE $table SET $fields[0] = '$values[0]', $fields[1] = '$values[1]',
                $fields[2] = '$values[2]', $fields[3] = '$values[3]'";
        if (isset($where)) {
            $sql .= " WHERE $where = $whereData";
        }
        return $this->query($sql);
    }

    private function query($sql): array|bool|null
    {
        $conn = new mysqli(
            $this->db['DB_HOST'],
            $this->db['DB_USER'],
            $this->db['DB_PASSWORD'],
            $this->db['DB_DB']
        );
        $res = $conn->query($sql);

        if ($res) {
            if ( ! str_contains($sql, 'SELECT')) {
                return true;
            }
        } elseif ( ! str_contains($sql, 'SELECT')) {
            return false;
        } else {
            return null;
        }
        $queryResults = array();

        while ($row = $res->fetch_array()) {
            foreach ($row as $key => $value) {
                $result[$key] = $value;
            }
            if (isset($result)) {
                $queryResults[] = $result;
            }
        }
        return $queryResults;
    }
}
