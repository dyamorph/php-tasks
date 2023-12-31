<?php

declare(strict_types=1);

namespace system;

class Migrations
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

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(__DIR__ . '/../database/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once __DIR__ . '/../database/migrations' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("There are no migrations to apply");
        }
    }

    protected function createMigrationsTable(): void
    {
        $this->db->execute_query(
            "CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)"
        );
    }

    protected function getAppliedMigrations(): array
    {
        $res = $this->db->execute_query("SELECT migration FROM migrations");
        $result = [];
        while ($row = $res->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    protected function saveMigrations(array $newMigrations): void
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->db->prepare(
            "INSERT INTO migrations (migration) VALUES $str"
        );
        $statement->execute();
    }

    public function prepare($sql): false|\mysqli_stmt
    {
        return $this->db->prepare($sql);
    }

    private function log($message): void
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }
}