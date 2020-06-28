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

if (isset($_POST['surname']) && isset($_POST['lastname']) && isset($_POST['pwdNewUser'])
    && isset($_POST['place']) && isset($_POST['number_house']) && isset($_POST['pesel'])
    && isset($_POST['zip-code']) && isset($_POST['town'])
    && isset($_POST['mail']) && isset($_POST['number_phone'])) {
    $surname = $_POST['surname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['pwdNewUser'];
    $pesel = $_POST['pesel'];
    $place = $_POST['place'];
    $numberHouse = $_POST['number_house'];
    $zip_code = $_POST['zip-code'];
    $town = $_POST['town'];
    $mail = $_POST['mail'];
    $numberPhone = $_POST['number_phone'];
    $db = new Database('localhost', 'root', '', 'bank', '3306');
    $db->execute("INSERT INTO user_bank (login, password, surname, lastname, pesel, street, house_number, zip_code, town, country, mail, telephone_number)
VALUES ('$mail', '$password', '$surname', '$lastname', '$pesel', '$place', '$numberHouse', '$zip_code', '$town', 'Polska', '$mail', '$numberPhone')");
    header('location:index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LenBank</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.jpg"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-mobile.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>
<body>
<section class="wrapper">
    <header class="header">
        <div class="header__logo">LenBank</div>
        <nav class="header__nav">
            <ul class="header__list">
                <li class="header__item header__item--mobile">
                    Menu
<!--                    <button class="header__button" id="home__button">Menu</button>-->
                </li>
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
                    <button class="header__button header__button--primary" id="login__button">Logowanie</button>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <?php
        if (isset($_GET['bad'])) { ?>
        <section class="home" id="homeSection" style="display: none;">
            <?php
            } else { ?>
            <section class="home" id="homeSection" style="display: block;">
                <?php }
                ?>
                <section class="home-container">
                    <h1 class="home-container__header">LenBank</h1>
                    <h2 class="home-container__information">Nowoczesne rozwiązania bankowości online</h2>
                    <div class="home-benefits">
                        <div class="home-benefits__item">
                            <div class="home-benefits__icon">
                                <img src="assets/images/useful.svg" width="130">
                            </div>
                            <h3 class="home-benefits__advantage">Prosta obsługa konta!</h3>
                        </div>
                        <div class="home-benefits__item">
                            <div class="home-benefits__icon">
                                <img src="assets/images/fast_transfer.svg" width="130">
                            </div>
                            <h3 class="home-benefits__advantage">Szybkie przelewy!</h3>
                        </div>
                        <div class="home-benefits__item">
                            <div class="home-benefits__icon">
                                <img src="assets/images/control.svg" width="150">
                            </div>
                            <h3 class="home-benefits__advantage">Mnóstwo możliwości</h3>
                        </div>
                        <div class="home-benefits__item">
                            <div class="home-benefits__icon">
                                <img src="assets/images/support.svg" width="130">
                            </div>
                            <h3 class="home-benefits__advantage">Support 24/7!</h3>
                        </div>
                    </div>
                </section>
            </section>
            <section class="product" id="productSection">
                <section class="product-container">
                    <h1 class="product-header">Nasze produkty</h1>
                    <section class="product-account" id="productAccount">
                        <div class="product-account__container">
                                <img class="product-account__image" src="assets/images/control.svg" alt="account" width="340px">
                            <div class="product-account__describe">
                                <h2 class="product-account__header">Konto bankowe</h2>
                                Kontroluj przepływ swoich środków i zarządzaj nimi!<br>
                                Stwórz konto już dziś i dołacz do naszych zadowolonych klientów!
                            </div>
                        </div>
                    </section>
                    <section class="product-card product--visa" id="productVisa">
                        <section class="product-card__icon">
                            <img src="assets/images/visa.svg" alt="visa" width="200px">
                        </section>
                        <section class="product-card__container">
                            <div class="product-card__describe">
                                <h2 class="product-card__header">VISA</h2>
                                <span class="product-card__information">
                                Karta debetowa VISA niesie ze sobą wiele korzyści takich jak:
                                <ul class="product-card__list">
                                    <li class="product-card__item">
                                    Brak opłat za korzystanie z karty!
                                    </li>
                                    <li class="product-card__item">
                                    Wypłacanie pieniedzy z kazdego bankomatu!
                                    </li>
                                    <li class="product-card__item">
                                    Zabezpieczenia w postaci limitów dziennych!
                                    </li>
                                </ul>
                            </div>
                            </span>
                        </section>
                    </section>
                    <section class="product-card product--mastercard" id="productMaster">
                        <section class="product-card__container">
                            <div class="product-card__describe">
                                <h2 class="product-card__header">MasterCard</h2>
                                <span class="product-card__information">
                                Obawiasz się, że braknie Ci gotówki podczas zakupów?<br>
                                    Skorzystaj z karty kredytowej MasterCard!
                                <ul class="product-card__list">
                                    <li class="product-card__item">
                                    Brak opłat za korzystanie z karty!
                                    </li>
                                    <li class="product-card__item">
                                    Wypłacanie pieniedzy z kazdego bankomatu!
                                    </li>
                                    <li class="product-card__item">
                                    Zabezpieczenia w postaci limitów dziennych!
                                    </li>
                                </ul>
                            </div>
                            </span>
                        </section>
                        <section class="product-card__icon">
                            <img src="assets/images/master.svg" alt="masterCard" width="200px">
                        </section>
                    </section>
                    <nav class="product-nav">
                        <ul class="product-nav__list">
                            <li class="product-nav__item">
                                <a class="btn" id="btn-nav__previous" href="#"><
                                </a>
                            </li>
                            <li class="product-nav_item">
                                <a class="btn" id="btn-nav__next" href="#">></a>
                            </li>
                        </ul>
                    </nav>
                </section>
            </section>
            <section class="contact" id="contactSection">
                <div class="contact-container">
                    <h1 class="contact-container__header">Kontakt</h1>
                    <div class="contact-container__methods">
                        <div class="contact-container__place">
                            <h2 class="contact-container__info">Siedziba firmy</h2>
                            <address class="contact-address">
                                <div class="contact-address__place">
                                    ul.Wiosny Ludów 12<br>
                                    80-900 Poznań
                                </div>
                            </address>
                            <h2 class="contact-container__info">Godziny pracy</h2>
                            <div class="contact-work">
                                <div class="contact-work__day">Pon-Czw</div>
                                <div class="contact-work__hours">8:00-16:00</div>
                                <div class="contact-work__day">Pt-Sob</div>
                                <div class="contact-work__hours">7:30-17:00</div>
                                <div class="contact-work__day">Ndz</div>
                                <div class="contact-work__hours">Nieczynne!</div>
                            </div>
                        </div>
                        <div class="contact-container__contact">
                            <h2 class="contact-container__info">Kontakt elektroniczny</h2>
                            <div class="contact-ways__header">
                                Telefon komórkowy
                            </div>
                            <div class="contact-ways__number">
                                777-666-555
                            </div>
                            <div class="contact-ways__header">
                                Telefon Stacjonarny
                            </div>
                            <div class="contact-ways__number">
                                (0)54-237-611-555
                            </div>
                            <div class="contact-ways__header">
                                Adres mailowy
                            </div>
                            <div class="contact-ways__number">
                                kontakt@lenbank.pl
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            if (isset($_GET['bad'])) { ?>
            <section class="login" id="loginSection" style="display: block;">
                <?php
                } else { ?>
                <section class="login" id="loginSection" style="display: none;">
                    <?php
                    }
                    ?>
                    <section class="signIn__container" id="signin">
                        <article class="signIn__article">
                            <h1 class="signIn__header">Zaloguj się do panelu użytkownika</h1>
                            <img src="assets/images/panel.svg" alt="panel_account" width="300" style="margin-top: 10px">
                        </article>
                        <section class="signIn-panel">
                            <div class="signIn-panel__icon">
                                <img src="assets/images/login.svg" alt="login_icon" width="128">
                            </div>
                            <?php
                            if (isset($_GET['bad'])) { ?>
                                <span class="signIn-panel__alert">dane niepoprawne</span>
                                <?php
                            } else { ?>

                                <?php
                            }
                            ?>
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
                        <section class="signOn-panel">
                            <h1 class="signOn-panel__header">
                                Zarejestruj nowe konto
                            </h1>
                            <form class="signOn-panel__form" action="index.php" method="POST">
                                <label class="signOn-panel__label" for="surname">Imię</label>
                                <input class="signOn-panel__input" type="text" name="surname" required>
                                <label class="signOn-panel__label" for="lastname">Nazwisko</label>
                                <input class="signOn-panel__input" type="text" name="lastname" required>
                                <label class="signOn-panel__label" for="pwdNewUser">Hasło</label>
                                <input class="signOn-panel__input" type="password" name="pwdNewUser" required>
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
            </section>
        </section>
    </main>
    <footer class="footer">
        <div class="footer__logo">LenBank</div>
        <div class="footer__information">
            <span class="footer__rights">Grafiki wykorzystane na stronie pochodzą z</span>
            <a class="footer__link" href="https://pl.freepik.com/">Freepik.com</a>
            <a class="footer__link" href="https://www.flaticon.com/">Flaticon.com</a>
        </div>
    </footer>
    <script type="text/javascript" src="js/main.js" charset="UTF-8"></script>
</body>
</html>