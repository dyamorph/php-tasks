<?php
declare(strict_types=1);
class UserController
{
    public function new() {
        echo 'user controller action new';
        return true;
    }
    public function create() {
        echo 'user controller action create';
        return true;
    }
}