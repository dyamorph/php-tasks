<form class="user-form" action="/users/create" method="POST">
    <h3 class="form-title">Add new user</h3>
    <p class="form-field">
        <label for="name">Your first and last name</label>
        <input id="name"
               class="form-input<?= isset($data[1]['name']) ? ' error-input' : '' ?>"
               type="text"
               name="name"
               placeholder="Enter your first and last name"
               data-name="name"
               value="<?= $data[0]['name'] ?? '' ?>">
        <?php
        if (isset($data[1]['name'])) :
            foreach ($data[1]['name'] as $error) : ?>
                <span class="error-message"><?= $error ?></span>
            <?php
            endforeach ?>
        <?php
        endif ?>
    </p>
    <p class="form-field">
        <label for="email">Enter your email</label>
        <input id="email"
               class="form-input<?= isset($data[1]['email']) ? ' error-input' : '' ?>"
               type="email"
               name="email"
               placeholder="Enter your email"
               data-email="email"
               value="<?= $data[0]['email'] ?? '' ?>">
        <?php
        if (isset($data[1]['email'])) :
            foreach ($data[1]['email'] as $error) : ?>
                <span class="error-message"><?= $error ?></span>
            <?php
            endforeach ?>
        <?php
        endif ?>
    </p>
    <p class="form-field">
        <label for="gender">Gender</label>
        <select id="gender"
                name="gender"
                class="select-input<?= isset($data[1]['gender']) ? ' error-input' : '' ?>"
                data-gender="gender">
            <option value="" selected disabled>Select gender:</option>
            <option
                <?php
                if (isset($data[0]['gender'])): echo 'selected'; endif ?>
                    value="male">Male
            </option>
            <option
                <?php
                if (isset($data[0]['gender'])): echo 'selected'; endif ?>
                    value="female">Female
            </option>
        </select>
        <?php
        if (isset($data[1]['gender'])) :
            foreach ($data[1]['gender'] as $error) : ?>
                <span class="error-message"><?= $error ?></span>
            <?php
            endforeach ?>
        <?php
        endif ?>
    </p>
    <p class="form-field">
        <label for="status">Status</label>
        <select id="status"
                name="status"
                class="select-input<?= isset($data[1]['status']) ? ' error-input' : '' ?>"
                data-status="status">
            <option value="" selected disabled>Select status:</option>
            <option
                <?php
                if (isset($data[0]['status'])): echo 'selected'; endif ?>
                    value="active">Active
            </option>
            <option
                <?php
                if (isset($data[0]['status'])):echo 'selected'; endif ?>
                    value="inactive">Inactive
            </option>
        </select>
        <?php
        if (isset($data[1]['status'])) :
            foreach ($data[1]['status'] as $error) : ?>
                <span class="error-message"><?= $error ?></span>
            <?php
            endforeach ?>
        <?php
        endif ?>
    </p>
    <button class="btn submit-btn" type="submit">Отправить</button>
</form>