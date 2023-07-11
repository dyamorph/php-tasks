<?php

use db\DB;

$db = new DB();
$results = $db->get('users', []);
$arrayLenght = count($results);
?>

<div class="users-table">
    <p class="users-title">Всего пользователей: <?= $arrayLenght ?></p>
    <table >
        <tr>
            <th>Id</th><th>Name</th><th>Email</th><th>Gender</th><th>Status</th><th>Update</th><th>Remove</th>
        </tr>
            <?php foreach ($results as $result) : ?>
                <tr>
                    <td><a class="users-table-id" href=/user/<?= $result['id']?>><?= $result['id']?></a></td>
                    <td><?= $result['name'] ?></td>
                    <td><?= $result['email'] ?></td>
                    <td><?= $result['gender'] ?></td>
                    <td><?= $result['status'] ?></td>
                    <td>
                        <form method="POST" action="/users/update/<?= $result['id']?>">
                            <!-- <input class="edit-btn" type="submit" value="Изменить" /> -->
                            <button type="submit" class="users-table-edit-btn">Изменить</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="/users/<?= $result['id']?>">
                            <!-- <input class="delete-btn" type="submit" value="Удалить" /> -->
                            <button type="submit" class="users-table-delete-btn">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
    </table>
</div>
