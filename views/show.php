<div class="table-responsive mt-5">
    <p class="h5 mb-5 pl-1">Total users: <?= $totalUsers ?? '' ?></p>
    <form class="table-form" action="/users/delete" method="POST">
        <table class="table table-hover">
            <thead class="thead-light">
            <button class="btn btn-danger delete-all-btn" type="submit">Delete All</button>
            <tr>
                <th><input class="check-all" type="checkbox"></th>
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
                    <td><input class="table-checkbox" type="checkbox" name="ids[]" value="<?= $result['id'] ?>"></td>
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
                        <form data-id="<?= $result['id'] ?>" id="delete" method="POST"
                              action="/users/<?= $result['id'] ?>">
                            <button data-id="<?= $result['id'] ?>" type="submit" class="btn btn-danger delete-btn">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
            endforeach ?>
        </table>
    </form>
    <nav class="" aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <?php
            for ($i = 0; $i < $pages; $i++) : ?>
                <li class="page-item" data-page="<?= $i + 1 ?>">
                    <a class="page-link" href=" ?page=<?= $i + 1 ?>"><?= $i + 1 ?></a>
                </li>
            <?php
            endfor; ?>
        </ul>
    </nav>
</div>
