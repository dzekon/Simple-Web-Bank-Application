<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <header>
        <div class="logo">To jest logo</div>
        <nav>
            <ul>
                <li class="nav__header">Menu</li>
                <li>
                    <button id="home__button">Strona Główna</button>
                </li>
                <li>
                    <button id="product__button">Produkty</button>
                </li>
                <li>
                    <button id="contact__button">Kontakt</button>
                </li>
                <li>
                    <button id="help__button">Pomoc</button>
                </li>
                <li>
                    <button id="login__button">Panel klienta</button>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="home" id="div_1"">
            <h1>Octopus Bank System</h1>
            <h2>Rozwiązania bankowe na miare XXI wieku</h2>
            Oferujemy najkorzystniejsze usługi bankowości internetowej na rynku<br>
            Już dziś załóż konto w banku, który sprosta Twoim wymaganiom.<br>
            <button class="button__main--middle" id="register__button">
                Załóż konto
            </button>
        </div>
        <div class="product" id="div_2">
            product
        </div>
        <div class="contact" id="div_3">
            contact
        </div>
        <div class="help" id="div_4">
            help2
        </div>
        <div class="login" id="div_5" style="display: block">
            tu jesteśmy
        </div>
    </main>
    <footer>Tu jest stopka</footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>