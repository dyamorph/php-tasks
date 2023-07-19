<div class="table-responsive mt-5 mb-5">
    <p class="h5 mb-5 pl-1">Total users: <?= count($results) ?></p>
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Update</th>
            <th>Remove</th>
        </tr>
        </thead>
        <?php
        foreach ($results as $result) : ?>
            <tr>
                <td><?= $result['id'] ?></td>
                <td><?= $result['name'] ?></td>
                <td><?= $result['email'] ?></td>
                <td><?= $result['gender'] ?></td>
                <td><?= $result['status'] ?></td>
                <td>
                    <form method="GET" action="/users/edit/<?= $result['id'] ?>">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </td>
                <td>
                    <form data-id="<?= $result['id'] ?>" id="delete" method="POST" action="/users/<?= $result['id'] ?>">
                        <button data-id="<?= $result['id'] ?>" type="submit" class="btn btn-danger delete-btn">Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php
        endforeach ?>
    </table>
</div>
