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
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
</head>
<body>
<section class="wrapper">
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
            echo '<section class="home" id="div_1" style="display: none;">';
        } else {
            echo '<section class="home" id="div_1" style="display: none;">';
        }
        ?>
        </section>
        <section class="product" id="div_2">
            product
        </section>
        <section class="contact" id="div_3">
            contact
        </section>
        <section class="help" id="div_4">
            help
        </section>
        <?php
        if (isset($_GET['bad'])) {
            echo '<section class="login" id="div_5" style="display: block;">';
        } else {
            echo '<section class="login" id="div_5" style="display: block;">';
        }
        ?>
            <section class="login__signin" id="signin">
                <section class="login__signin--information">
                    <img src="assets/images/12.svg" alt="test" width="400" style="margin-top: 10px">
                </section>
                <section class="login__signin--form">
                    <center>
                    <img src="assets/images/login.svg" alt="login_icon" width="128" style="margin:0px 0px 15px 15px">
                    </center>
                <form method="POST">
                    <center>
                    <label for="login">login
                        </label><br>
                        <input type="text" name="login" required><br>
                    <label for="pwd">password
                        </label><br>
                        <input type="password" name="pwd" required>
                    </label><br>
                     <button id="button__signIn">zaloguj się</button>
                    </center>
                </form>
                    <center>
                    <button id="button__signOn">zarejestruj się</button>
                    </center>
                </section>
            </section>
            <section class="login__signon" id="signon">
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
            </section>
        </section>
    </main>
    <footer>Tu jest stopka</footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>