<?php 
    $server = 'localhost';
    $user = 'root';
    $pass = 'rootroot';
    $db = 'myDBtest';

    $conn = new mysqli($server, $user, $pass, $db);
    if ($conn->connect_error) {
        die('Failed: ' . $conn->connect_error);
    }
    // check table for exist if not exist - create
    $extQuery = "SHOW TABLES LIKE 'users'";
    $ext = $conn->query($extQuery);
    if (!$ext->num_rows) {
        $createTable = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            gender VARCHAR(6) NOT NULL,
            status VARCHAR(8) NOT NULL)";
        $conn->query($createTable);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    if(isset($name) && isset($email) && isset($gender) && isset($status))
    {
        $query = "INSERT INTO users (name, email, gender, status) VALUES ('{$name}', '{$email}', '{$gender}', '{$status}')";
        if ($conn->query($query)) {
            echo "Запись добавлена!";
        }
    }
?>

<a class="btn" href="/users">Список пользователей</a>