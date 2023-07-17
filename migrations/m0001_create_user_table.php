<?php

declare(strict_types=1);

use system\Migrations;

class m0001_create_user_table
{
    public function up()
    {
        $migration = new Migrations();
        $db = $migration->db;

        $sql = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                gender VARCHAR(255) NOT NULL,
                status VARCHAR(255) NOT NULL
            )  ENGINE=INNODB;";
        $db->execute_query($sql);
    }

    public function down()
    {
        $migration = new Migrations();
        $db = $migration->db;

        $sql = "DROP TABLE users;";
        $db->execute_query($sql);
    }
}