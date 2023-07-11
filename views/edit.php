<form class="user-form" action="/users/update/<?= $id ?>" method="POST">
    <h3 class="form-title">Update user</h3>
    <p class="form-filed">
        <label for="name">Your first and last name</label>
        <input id="name" type="text" name="name" placeholder="Enter your first and last name" required 
            value="<?= $name ?>">
    </p>
    <p class="form-filed">
        <label for="email">Enter your email</label>
        <input id="email" type="text" name="email" placeholder="Enter your email" required
            value="<?= $email ?>">
    </p>
    <p class="form-filed">
        <label for="genre">Gender</label>
        <select id="genre" name="gender">
            <option <?= $gender === "male" ? "selected" : '' ?> value="male">Male</option>
            <option <?= $gender === "female" ? "selected" : '' ?> value="female">Female</option>
        </select>
    </p>
    <p class="form-filed">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option <?= $status === "active" ? "selected" : '' ?>value="active">Active</option>
            <option <?= $status === "inactive" ? "selected" : '' ?> value="inactive">Inactive</option>
        </select>
    </p>
    <button class="btn submit-btn" type="submit" name="submit">Обновить</button>
</form>