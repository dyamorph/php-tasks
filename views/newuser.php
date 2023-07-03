<form class="user-form" method="POST">
    <h3 class="form-title">Add new user</h3>
    <p class="form-filed">
        <label for="name">Your first and last name</label>
        <input id="name" type="text" name="name" placeholder="Enter your first and last name">
    </p>
    <p class="form-filed">
        <label for="email">Enter your email</label>
        <input id="email" type="text" name="email" placeholder="Enter your email">
    </p>
    <p class="form-filed">
        <label for="genre">Gender</label>
        <select id="genre" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </p>
    <p class="form-filed">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </p>
    <button class="btn submit-btn" type="submit">Отправить</button>
</form>