<?php
session_start();
require_once('connection.php');

if (isset($_POST['login']) && isset($_POST['pwd'])) {
    $db = new Database('localhost', 'root', '', 'bank', '3306');
    $login = $_POST['login'];
    $password = $_POST['pwd'];
    $user = $db->single("SELECT id, login , password FROM user_bank WHERE login = '$login'");


    if (!empty($user)) {
        if ($user['password'] == $password) {
            $_SESSION['user_id'] = $user['id'];
            header('location:login.php');
            exit();
        } else {
            header('location:index.php?bad&password');
            exit();
        }
    } else {
        header('location:index.php?bad&user');
        exit();
    }
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
                    <button id="login__button">Logowanie</button>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        if (isset($_GET['bad'])) {
            echo '<div class="home" id="div_1" style="display: none;">';
        } else {
            echo '<div class="home" id="div_1" style="display: none;">';
        }
        ?>
<!--        <div class="home" id="div_1">-->
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
            help
        </div>
        <?php
        if (isset($_GET['bad'])) {
            echo '<div class="login" id="div_5" style="display: block;">';
        } else {
            echo '<div class="login" id="div_5" style="display: block;">';
        }
        ?>
<!--        <div class="login" id="div_5">-->
            <div class="login__signin" id="signin">
                Zaloguj się
                <form method="POST">
                    <label>Login
                        <input type="text" name="login" required>
                    </label><br>
                    <label>Hasło
                        <input type="password" name="pwd" required>
                    </label><br>
                    <button>Logowanie</button>
                </form>
                <button id="button__signon">Zarejestruj się</button>
            </div>
            <div class="login__signon" id="signon">
                Zarejestruj nowe konto:
                <form action="register.php" method="POST">
                    <label for="surname">Imię</label>
                    <input type="text" name="surname" required>
                    <label for="lastname">Nazwisko</label>
                    <input type="text" name="lastname" required>
                    <label for="pesel">PESEL</label>
                    <input type="text" name="pesel" required>
                    <label for="place">Ulica/Miejscowość</label>
                    <input type="text" name="place" required>
                    <label for="number_house">Nr mieszkania/domu</label>
                    <input type="text" name="number_house" required>
                    <label for="zip-code">Kod pocztowy</label>
                    <input type="text" name="zip-code" required>
                    <label for="town">Miasto</label>
                    <input type="text" name="town" required>
                    <label for="mail">E-mail:</label>
                    <input type="email" name="mail" required>
                    <label for="number_phone">Numer telefonu:</label>
                    <input type="tel" name="number_phone" required>
                    <input type="submit" name="register_button" value="Zarejestruj się">
                </form>
                <button id="button__cancel">Wróć</button>
            </div>
        </div>
    </main>
    <footer>Tu jest stopka</footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>