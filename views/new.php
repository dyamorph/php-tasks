<form class="user-form" action="/users/create" method="POST">
    <h3 class="form-title">Add new user</h3>
    <p class="form-field">
        <label for="name">Your first and last name</label>
        <input id="name" class="form-input" type="text" name="name"
               placeholder="Enter your first and last name" data-name="name">
    </p>
    <p class="form-field">
        <label for="email">Enter your email</label>
        <input id="email" class="form-input" type="email" name="email"
               placeholder="Enter your email" data-email="email">
    </p>
    <p class="form-field">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" class="select-input" data-gender="gender">
            <option value="" disabled selected>Select gender:</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </p>
    <p class="form-field">
        <label for="status">Status</label>
        <select id="status" name="status" class="select-input" data-status="status">
            <option value="" disabled selected>Select status:</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </p>
    <button class="btn submit-btn" type="submit">Отправить</button>
</form>