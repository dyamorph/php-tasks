<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form class="user-form" method="POST">
    <p>
        <label for="name">Your first and last name</label>
        <input id="name" type="text" name="name" placeholder="Enter your first and last name">
    </p>
    <p>
        <label for="email">Enter your email</label>
        <input id="email" type="text" name="email" placeholder="Enter your email">
    </p>
    <p>
        <label for="genre">Gender</label>
        <select id="genre" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </p>
    <p>
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </p>
    <button type="submit">Отправить</button>
</form>
</body>
</html>