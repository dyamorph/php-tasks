<?php

require_once 'system/Migrations.php';
require_once 'system/Seeds.php';

use system\Migrations;
use system\Seeds;

$migration = new Migrations();
$migration->applyMigrations();

$seeds = new Seeds();
$seeds->seedUsers();
