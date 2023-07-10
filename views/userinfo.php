<?php

use db\DB;

$db = new DB();

$name = $_POST['name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$status = $_POST['status'];

$db->set('users', ['name', 'email', 'gender', 'status'], [$name, $email, $gender, $status]);
?>

<a class="btn" href="/users">Список пользователей</a>