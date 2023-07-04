<?php
require_once(dirname(__FILE__) . '/../config/config.php');

$dal = new DAL();

$results = $dal->getAllUsers();

$arrayLenght = count($results);
echo "<div>";
echo "<p>Всего пользователей: {$arrayLenght}</p>";
echo "<table><tr><th>Id</th><th>Name</th><th>Email</th><th>Gender</th><th>Status</th></tr>";


foreach ($results as $result) {
    echo "<tr>";
        echo "<td>" . $result->id . "</td>";
        echo "<td>" . $result->name . "</td>";
        echo "<td>" . $result->email . "</td>";
        echo "<td>" . $result->gender . "</td>";
        echo "<td>" . $result->status . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";