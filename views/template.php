<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/main.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Header</h1>
        </header>
        <main class="main">
            <?php include 'views/' . $content; ?>
        </main>
        <footer class="footer">
            <h1>Footer</h1>
        </footer>
    </div>
    <script src="../assets/main.js"></script>
</body>
</html>