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

if (isset($_POST['lastname']) && isset($_POST['surname'])) {
    $db = new Database('localhost', 'root', '', 'bank', '3306');
    $user = $_POST;
    $db->execute("INSERT INTO user_bank(login, password, surname, lastname, pesel, street, house_number, zip_code, town, country, mail, telephone_number, status) VALUES ('')");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap"
          rel="stylesheet">
</head>
<body>
<section class="wrapper">
    <header class="header">
        <div class="header__logo">To jest logo</div>
        <nav class="header__nav">
            <ul class="header__list">
                <li class="header__item header__item--mobile">Menu</li>
                <li class="header__item">
                    <button class="header__button" id="home__button">Strona Główna</button>
                </li>
                <li class="header__item">
                    <button class="header__button" id="product__button">Produkty</button>
                </li>
                <li class="header__item">
                    <button class="header__button" id="contact__button">Kontakt</button>
                </li>
                <li class="header__item">
                    <button class="header__button" id="help__button">Pomoc</button>
                </li>
                <li class="header__item">
                    <button class="header__button header__button--primary" id="login__button">Logowanie</button>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <?php
        if (isset($_GET['bad'])) { ?>
            <section class="home" id="div_1" style="display: none;">
            <?php
        } else { ?>
        <section class="home" id="div_1" style="display: none;">
            <?php }
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
        <section class="signIn__container" id="signin">
            <article class="signIn__article">
                <img src="assets/images/12.svg" alt="test" width="400" style="margin-top: 10px">
            </article>
            <section class="signIn-panel">
                <div class="signIn-panel__icon">
                    <img src="assets/images/login.svg" alt="login_icon" width="128">
                </div>
                <form class="signIn-panel__form" method="POST">
                    <label class="signIn-panel__label" for="login">login</label>
                    <input class="signIn-panel__input" type="text" name="login" required>
                    <label class="signIn-panel__label" for="pwd">hasło</label>
                    <input class="signIn-panel__input" type="password" name="pwd" required>
                    <button class="btn btn--login" id="button__signIn">zaloguj się</button>
                </form>
                <button class="btn btn--register" id="button__signOn">zarejestruj się</button>
            </section>
        </section>
        <section class="signOn__container" id="signon">
            <article class="signOn__article">
                Tutaj tekst
            </article>
            <section class="signOn-panel">
                <h1 class="signOn-panel__header">
                    Zarejestruj nowe konto
                </h1>
                <form class="signOn-panel__form" action="index.php" method="POST">
                    <label class="signOn-panel__label" for="surname">Imię</label>
                    <input class="signOn-panel__input" type="text" name="surname" required>
                    <label class="signOn-panel__label" for="lastname">Nazwisko</label>
                    <input class="signOn-panel__input" type="text" name="lastname" required>
                    <label class="signOn-panel__label" for="pesel">PESEL</label>
                    <input class="signOn-panel__input" type="text" name="pesel" required>
                    <label class="signOn-panel__label" for="place">Ulica/Miejscowość</label>
                    <input class="signOn-panel__input" type="text" name="place" required>
                    <label class="signOn-panel__label" for="number_house">Nr mieszkania/domu</label>
                    <input class="signOn-panel__input" type="text" name="number_house" required>
                    <label class="signOn-panel__label" for="zip-code">Kod pocztowy</label>
                    <input class="signOn-panel__input" type="text" name="zip-code" required>
                    <label class="signOn-panel__label" for="town">Miasto</label>
                    <input class="signOn-panel__input" type="text" name="town" required>
                    <label class="signOn-panel__label" for="mail">E-mail:</label>
                    <input class="signOn-panel__input" type="email" name="mail" required>
                    <label class="signOn-panel__label" for="number_phone">Numer telefonu:</label>
                    <input class="signOn-panel__input" type="tel" name="number_phone" required>
                    <button class="btn btn--register" id="button__signOn">Zarejestruj się</button>
                </form>
                <button class="btn btn--cancel" id="button__cancel">Wróć</button>
            </section>
        </section>
</section>
</main>
<footer>Tu jest stopka</footer>
<script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>