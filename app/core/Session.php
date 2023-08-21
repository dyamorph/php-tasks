<?php

declare(strict_types=1);

namespace app\core;

class Session
{
    private static ?Session $instance = null;

    private function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    final public function __clone()
    {
        throw new \RuntimeException('Cannot clone singleton.');
    }

    final public function __wakeup()
    {
        throw new \RuntimeException("Cannot unserialize singleton.");
    }

    public static function getInstance(): Session
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }
}
