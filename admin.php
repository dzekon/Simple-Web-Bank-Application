<?php
session_start();
require_once('user.php');
require_once('connection.php');
$db = new Database('localhost', 'root', '', 'bank', '3306');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="css/style-admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap"
          rel="stylesheet">
</head>
<body>
<section class="wrapper">
    <header>
        Panel administratora banku
    </header>
    <main>
        <section id=""></section>
        <nav>
            <ul>
                <li><a href="">Pokaż wszystkie konta</a></li>
                <li><a href="">Pokaż wszystkie karty</a></li>
                <li><a href="">Aplikacje nowych użytkowników</a></li>
                <li><a href="">Aplikacje o przydzielenie karty</a></li>
                <li><a href="">Logi transferów</a></li>
                <li><a href="">Logi operacji administratorów</a></li>
            </ul>
        </nav>
    </main>
    <footer></footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>