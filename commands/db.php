<?php

require_once 'system/Migrations.php';

use system\Migrations;

$migrate = new Migrations();

$migrate->applyMigrations();