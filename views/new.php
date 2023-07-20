<form class="user-form col-sm-12 col-md-6 col-lg-4 py-5" action="/users/create" method="POST">
    <h3 class="h2 mb-5">Add new user</h3>
    <div class="form-group">
        <label for="name">Your first and last name</label>
        <input id="name"
               class="form-control form-input<?= isset($data[1]['name']) ? ' is-invalid' : '' ?>"
               type="text"
               name="name"
               placeholder="Enter your first and last name"
               data-name="name"
               value="<?= $data[0]['name'] ?? '' ?>">
        <div class="invalid-feedback">
            <?php
            if (isset($data[1]['name'])) :
                foreach ($data[1]['name'] as $error) : ?>
                    <p class="error-message"><?= $error ?></p>
                <?php
                endforeach ?>
            <?php
            endif ?>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Enter your email</label>
        <input id="email"
               class="form-control form-input<?= isset($data[1]['email']) ? ' is-invalid' : '' ?>"
               type="email"
               name="email"
               placeholder="Enter your email"
               data-email="email"
               value="<?= $data[0]['email'] ?? '' ?>">
        <div class="invalid-feedback">
            <?php
            if (isset($data[1]['email'])) :
                foreach ($data[1]['email'] as $error) : ?>
                    <p class="error-message"><?= $error ?></p>
                <?php
                endforeach ?>
            <?php
            endif ?>
        </div>
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender"
                name="gender"
                class="form-control select-input<?= isset($data[1]['gender']) ? ' is-invalid' : '' ?>"
                data-gender="gender">
            <option value="" selected disabled>Select gender:</option>
            <option
                <?php
                if (isset($data[0]['gender'])) : echo 'selected';
                endif ?>
                    value="male">Male
            </option>
            <option
                <?php
                if (isset($data[0]['gender'])) : echo 'selected';
                endif ?>
                    value="female">Female
            </option>
        </select>
        <div class="invalid-feedback">
            <?php
            if (isset($data[1]['gender'])) :
                foreach ($data[1]['gender'] as $error) : ?>
                    <p class="error-message"><?= $error ?></p>
                <?php
                endforeach ?>
            <?php
            endif ?>
        </div>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select id="status"
                name="status"
                class="form-control select-input<?= isset($data[1]['status']) ? ' is-invalid' : '' ?>"
                data-status="status">
            <option value="" selected disabled>Select status:</option>
            <option
                <?php
                if (isset($data[0]['status'])) : echo 'selected';
                endif ?>
                    value="active">Active
            </option>
            <option
                <?php
                if (isset($data[0]['status'])) : echo 'selected';
                endif ?>
                    value="inactive">Inactive
            </option>
        </select>
        <div class="invalid-feedback">
            <?php
            if (isset($data[1]['status'])) :
                foreach ($data[1]['status'] as $error) : ?>
                    <p class="error-message"><?= $error ?></p>
                <?php
                endforeach ?>
            <?php
            endif ?>
        </div>
    </div>
    <button class="btn btn-primary submit-btn" type="submit">Отправить</button>
</form>
