<?php

declare(strict_types=1);

namespace app\core;

class Database
{
    private static ?Database $instance = null;
    private \mysqli $mysqli;
    private array $db;

    private function __construct()
    {
        $dbConfig = __DIR__ . '/../../config/DB.php';
        $this->db = include($dbConfig);
        $this->mysqli = new \mysqli(
            $this->db['DB_HOST'],
            $this->db['DB_USER'],
            $this->db['DB_PASSWORD'],
            $this->db['DB_DB']
        );
        if ($this->mysqli->connect_error) {
            die("Database connection failed: " . $this->mysqli->connect_error);
        }
    }

    public static function getInstance(): Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function get(
        $table,
        $fields = null,
        $where = null,
        $whereData = null,
        $limit = null,
        $offset = null
    ): array | bool | null {
        if (!empty($limit)) {
            $sql = sprintf("SELECT %s FROM %s LIMIT %d OFFSET %d", $fields, $table, $limit, $offset);
            return $this->query($sql);
        }

        if (!empty($where)) {
            $sql = sprintf("SELECT %s FROM %s WHERE %s = %s", $fields, $table, $where, $whereData);
            return $this->query($sql);
        }

        $sql = "SELECT $fields FROM $table";
        return $this->query($sql);
    }

    public function set($table, $fields, $values): array | bool | null
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES ('%s', '%s', '%s', '%s')",
            $table,
            implode(', ', $fields),
            ...$values
        );

        return $this->query($sql);
    }

    public function delete($table, $id): array | bool | null
    {
        $sql = "DELETE FROM $table WHERE $table.id = '$id'";
        if ($this->query($sql) === true) {
            return $this->query($sql);
        }

        return null;
    }

    public function update(
        $table,
        $fields,
        $values,
        $where = null,
        $whereData = null
    ): array | bool | null {
        $fieldPlaceholders = implode(" = '%s', ", $fields) . " = '%s' ";

        $sql = sprintf(
            "UPDATE %s SET $fieldPlaceholders WHERE %s = '%s'",
            $table,
            ...array_merge($values, [$where, $whereData])
        );

        return $this->query($sql);
    }

    private function query($sql): array | bool | null
    {
        $res = $this->mysqli->query($sql);

        if ($res) {
            if (!str_contains($sql, 'SELECT')) {
                return true;
            }
        } elseif (!str_contains($sql, 'SELECT')) {
            return false;
        } else {
            return null;
        }

        $queryResults = array();

        while ($row = $res->fetch_assoc()) {
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
