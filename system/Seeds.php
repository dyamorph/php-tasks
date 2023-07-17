<?php

namespace system;

use database\seeds\UserFactory;

require_once 'database/seeds/UserFactory.php';

class Seeds
{
    public \mysqli $db;
    public array $dbConfig;

    public function __construct()
    {
        $config = __DIR__ . '/../config/DB.php';
        $this->dbConfig = include($config);
        $this->db = new \mysqli(
            $this->dbConfig['DB_HOST'],
            $this->dbConfig['DB_USER'],
            $this->dbConfig['DB_PASSWORD'],
            $this->dbConfig['DB_DB']
        );
    }

    public function seedUsers(): void
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, gender, status) VALUES (?, ?, ?, ?)");

        $users = [];
        for ($i = 0; $i < 15; $i++) {
            $users[] = UserFactory::generateUser();
        }
        foreach ($users as $user) {
            $stmt->bind_param("ssss", $user[0], $user[1], $user[2], $user[3]);
            $stmt->execute();
        }
        echo "Seeding complete!";
    }
}