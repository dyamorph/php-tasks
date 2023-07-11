<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../assets/main.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="header-content">
                    <h1>Header</h1>
                    <nav class="navbar">
                        <ul class="navbar-list">
                            <li class="navbar-item"><a href="/">Main</a></li>
                            <li class="navbar-item"><a href="/users/new">Add User</a></li>
                            <li class="navbar-item"><a href="/users">Users</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main">
            <?php include 'views/' . $content; ?>
        </main>
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <h1>Footer</h1>
                </div>
            </div>
        </footer>
    </div>
    <script src="../assets/main.js"></script>
</body>

</html>