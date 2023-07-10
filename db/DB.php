<?php

declare(strict_types=1);

namespace db;

use mysqli;

class DB
{
    private $db;
    private $fields = [];
    private $table;

    public function __construct()
    {
        $dbConfig = __DIR__ . '/../config/DB.php';
        $this->db = include($dbConfig);
    }

    public function get($table, $fields = [], $where = null, $whereData = null)
    {
        $sql = '';
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

    public function set($table, $fields, $values)
    {
        $res = '';
        foreach ($fields as $field) {
            $res .= "$field, ";
        }
        $res[strlen($res) - 2] = ' ';
        $sql = "INSERT INTO $table ($res) VALUES ('$values[0]', '$values[1]', '$values[2]', '$values[3]')";
        return $this->query($sql);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE $table.id = '$id'";
        return $this->query($sql);
    }

    public function update($table, $fileds, $values, $where = null, $whereData = null)
    {
        $sql = "UPDATE $table SET $fileds[0] = '$values[0]', $fileds[1] = '$values[1]',
                $fileds[2] = '$values[2]', $fileds[3] = '$values[3]'";
        if (isset($where)) {
            $sql .= " WHERE $where = $whereData";
        }
        return $this->query($sql);
    }

    private function query($sql)
    {
        $conn = new mysqli($this->db['DB_HOST'], $this->db['DB_USER'], $this->db['DB_PASSWORD'], $this->db['DB_DB']);
        $res = $conn->query($sql);

        if ($res) {
            if (strpos($sql, 'SELECT') === false) {
                return true;
            }
        } else {
            if (strpos($sql, 'SELECT') === false) {
                return false;
            } else {
                return null;
            }
        }
        $queryResults = array();

        while ($row = $res->fetch_array()) {
            foreach ($row as $key => $value) {
                $result[$key] = $value;
            }
            $queryResults[] = $result;
        }
        return $queryResults;
    }
}
