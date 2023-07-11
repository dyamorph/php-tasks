<?php

declare(strict_types=1);

namespace core;

use db\DB;
class Model
{
    public DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }
}
