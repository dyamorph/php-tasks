<?php

class DAL {
    public function getAllUsers() {
        $sql = "SELECT users.id as id, users.name as name, users.email as email, 
        users.gender as gender, users.status as status FROM users";
        return $this->query($sql);
    }

    private function query($sql) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
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
        $results = array();
    
        while ($row = $res->fetch_array()) {   
            $result = new DALQueryResult();
            foreach ($row as $key=>$value) {
                $result->$key = $value;
            }
            $results[] = $result;
        }
        return $results;
    }
}

class DALQueryResult {
 
    private $results = array();
   
    public function __construct(){}
   
    public function __set($var,$val)
    {
        $this->results[$var] = $val;
    }
   
    public function __get($var)
    {
        if (isset($this->results[$var])) {
            return $this->results[$var];
        }
        else {
            return null;
        }
    }

    
}