<form class="update-form" action="/users/update/<?= $id ?? '' ?>" method="POST">
    <h3 class="form-title">Update user</h3>
    <p class="form-field">
        <label for="name">Your first and last name</label>
        <input id="name" class="form-input" type="text" name="name"
               placeholder="Enter your first and last name"
               data-name="name"
               value="<?= $name ?? '' ?>">
    </p>
    <p class="form-field">
        <label for="email">Enter your email</label>
        <input id="email" class="form-input" type="text" name="email" placeholder="Enter your email"
               data-email="email" value="<?= $email ?? '' ?>">
    </p>
    <p class="form-field">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" data-gender="gender">
            <option <?= $gender === "male" ? "selected" : '' ?> value="male">
                Male
            </option>
            <option <?= $gender === "female" ? "selected" : '' ?>
                    value="female">Female
            </option>
        </select>
    </p>
    <p class="form-field">
        <label for="status">Status</label>
        <select id="status" name="status" data-status="status">
            <option <?= $status === "active" ? "selected" : '' ?>
                    value="active">Active
            </option>
            <option <?= $status === "inactive" ? "selected" : '' ?>
                    value="inactive">Inactive
            </option>
        </select>
    </p>
    <button class="btn update-btn" type="submit">Обновить</button>
</form>