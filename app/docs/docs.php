<?php

require_once "vendor/autoload.php";

$openapi = \OpenApi\Generator::scan(['app']);

file_put_contents('app/docs/swagger-docs.json', $openapi->toJson());
