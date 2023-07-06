<?php

declare(strict_types=1);

namespace db;

use mysqli;

class DB
{
    private $db;

    public function __construct()
    {
        $dbConfig = __DIR__ . '/../config/DB.php';
        $this->db = include($dbConfig);
    }

    public function getAllUsers()
    {
        $sql = "SELECT users.id as id, users.name as name, users.email as email, 
        users.gender as gender, users.status as status FROM users";
        return $this->query($sql);
    }

    public function getOneUser($id)
    {
        $sql = "SELECT users.id as id, users.name as name, users.email as email, 
        users.gender as gender, users.status as status FROM users WHERE user.id = '$id'";
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
