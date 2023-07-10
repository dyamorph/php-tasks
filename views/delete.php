<?php

use db\DB;

$db = new DB();

$uri = $_SERVER['REQUEST_URI'];
$uriArray = explode('/', $uri);


$db->delete('users', $uriArray[2]);

?>

<div>
    <h3>Пользователь удален!</h3>
    <a class="btn" href="/users">Список пользователей</a>
</div>

