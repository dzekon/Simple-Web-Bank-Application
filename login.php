<?php
session_start();
require_once('user.php');
require_once('connection.php');
$db = new Database('localhost', 'root', '', 'bank', '3306');

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
} else {
    $user = new User($_SESSION['user_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <button class="header__button header__button--primary" id="login__button">Panel użytkownika</button>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <section class="home" id="homeSection">
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
                        <section class="product-account__image">
                            <img src="assets/images/control.svg" alt="account" width="340px">
                        </section>
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
        <section class="login" id="loginSection" style="display: block">
            <?php
            if (isset($_GET['operation'])) {
                switch ($_GET['operation']) {
                    case 'showHistory':
                        $user->setLogs();
                        ?>
                        <section class="history-panel">
                            <span class="history-panel__header">Historia przelewów wysłanych</span>
                            <section class="history-panel__container">
                                <?php
                                if ($user->logSendMoney == null) { ?>
                                    <span class="history-panel__info">Brak historii przelewów wysłanych</span>
                                    <?php
                                } else { ?>
                                    <table class="history-panel__table">
                                        <thead class="history-panel__table-head">
                                        <tr class="history-panel__table-row">
                                            <th class="history-panel__table-header">
                                                ID
                                            </th>
                                            <th class="history-panel__table-header">
                                                Data
                                            </th>
                                            <th class="history-panel__table-header">
                                                Kwota
                                            </th>
                                            <th class="history-panel__table-header">
                                                Numer konta odbierającego
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="history-panel__table-body">
                                        <?php
                                        $id_log = 1;
                                        foreach ($user->logSendMoney as $log) { ?>
                                            <tr class="history-panel__table-row">
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $id_log;
                                                    ?>
                                                </td>
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $log['date'];
                                                    ?>
                                                </td>
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $log['amount'];
                                                    ?>
                                                </td>
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $log['number_account_receive'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php $id_log++;
                                        } ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } ?>
                            </section>
                            <span class="history-panel__header">Historia przelewów odebranych</span>
                            <section class="history-panel__container">
                                <?php
                                if ($user->logReceiveMoney == null) { ?>
                                    <span class="history-panel__info">Brak historii przelewów wysłanych</span>
                                    <?php
                                } else { ?>
                                    <table class="history-panel__table">
                                        <thead class="history-panel__table-head">
                                        <tr class="history-panel__table-row">
                                            <th class="history-panel__table-header">
                                                ID
                                            </th>
                                            <th class="history-panel__table-header">
                                                Data
                                            </th>
                                            <th class="history-panel__table-header">
                                                Kwota
                                            </th>
                                            <th class="history-panel__table-header">
                                                Numer konta wysyłającego
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="history-panel__table-body">
                                        <?php
                                        $id_log = 1;
                                        foreach ($user->logReceiveMoney as $log) {
                                            ?>
                                            <tr class="history-panel__table-row">
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $id_log;
                                                    ?>
                                                </td>
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $log['date'];
                                                    ?>
                                                </td>
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $log['amount'];
                                                    ?>
                                                </td>
                                                <td class="history-panel__table-data">
                                                    <?php
                                                    echo $log['number_account_send'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php $id_log++;
                                        } ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                            </section>
                            <nav class="history-panel__nav">
                                <a class="history-panel__link" href="login.php">
                                    <button class="btn">Wróć</button>
                                </a>
                            </nav>
                        </section>
                        <?php
                        break;
                    case 'transferMoney':
                        ?>
                        <section class="transfer-panel">
                        <h1 class="transfer-panel__header">
                            Przesyłanie środków z konta
                        </h1>
                        <?php
                        if (!isset($_POST['surnameReceiver']) && !isset($_POST['lastnameReceiver']) && !isset($_POST['numberAccountReceiver']) && !isset($_POST['amountMoney'])) { ?>
                            <form class="transfer-panel__form" action="login.php?operation=transferMoney" method="POST">
                                <label class="transfer-panel__label" for="surnameReceiver">Imię</label>
                                <input class="transfer-panel__input" type="text" name="surnameReceiver" required>
                                <label class="transfer-panel__label" for="lastnameReceiver">Nazwisko</label>
                                <input class="transfer-panel__input" type="text" name="lastnameReceiver" required>
                                <label class="transfer-panel__label" for="numberAccountReceiver">Numer konta</label>
                                <input class="transfer-panel__input" type="text" name="numberAccountReceiver" required>
                                <label class="transfer-panel__label" for="amountMoney">Kwota</label>
                                <input class="transfer-panel__input" type="number" name="amountMoney" required>
                                <button class="btn btn--cancel">Wyślij</button>
                            </form>
                            <nav class="transfer-panel__nav">
                                <a class="transfer-panel__link" href="login.php">
                                    <button class="btn">Wróć do panelu</button>
                                </a>
                            </nav>
                            </section>
                            <?php
                        } else {
                            $dateReceiver = $_POST;
                            $numberAccount = $dateReceiver['numberAccountReceiver'];
                            $userMoney = $user->getBankAccountBalance();
                            $userAccount = $user->getBankAccountNumber();
                            $amountMoney = $dateReceiver['amountMoney'];
                            if ($db->single("SELECT * FROM bank_account where account_number = '$numberAccount'")) {
                                if ($dateReceiver['amountMoney'] > $userMoney) { ?>
                                    <span class="transfer-panel__alert">Nie posiadasz wystarczającej ilości środków, aby wykonać ten przelew!</span>
                                    <?php
                                } else {
                                    $now = new DateTime();
                                    $date = $now->format('Y-m-d');
                                    $db->execute("UPDATE bank_account SET balance = balance - $amountMoney WHERE account_number = '$userAccount'");
                                    $db->execute("UPDATE bank_account SET balance = balance + $amountMoney WHERE account_number = '$numberAccount'");
                                    $db->execute("INSERT INTO account_transfer_log (number_account_send, number_account_receive, date, amount) VALUES ('$userAccount', '$numberAccount', '$date' ,'$amountMoney')");
                                    header('location:login.php?operation=transferMoney');
                                    exit();
                                }
                            } else { ?>
                                <span class="transfer-panel__alert">Takie konta nie ma w bazie!</span>
                                <?php
                            }
                            ?>
                            <nav class="transfer-panel__nav">
                                <a class="transfer-panel__link" href="login.php?operation=transferMoney">
                                    <button class="btn">Wróć do panelu</button>
                                </a>
                            </nav>
                        <?php }
                        break;
                    case 'applicationCard':
                        ?>
                        <section class="applicationCard-panel">
                        <h1 class="applicationCard-panel__header">Wniosek o nową kartę</h1>
                        <?php
                        if (!isset($_POST['cardType'])) {
                            $countCard = ($user->cards) != null ? $countCard = sizeof($user->cards) : $countCard = null;
                            if ($countCard == 2) { ?>
                                <span class="applicationCard-panel__alert">Posiadasz już dwie karty!</span>
                                <?php
                            } else {
                                $user->setApplicationCard();
                                $application = $user->getApplicationCard();
                                $countCard = ($user->cards) != null ? $countCard = sizeof($user->cards) : $countCard = null;
                                if ($countCard != null && sizeof($application) == 2) { ?>
                                    <span class="applicationCard-panel__alert">Złożyłeś już dwa wnioski o karty</span>
                                    <nav class="applicationCard-panel__nav">
                                        <a class="applicationCard-panel__link" href="login.php">
                                            <button class="btn">Wróć do panelu</button>
                                        </a>
                                    </nav>
                                    <?php
                                } else {
                                    ?>
                                    <span class="applicationCard-panel__information">
                                        Możesz posiadać maksymalnie 2 karty innego rodzaju.
                                    </span>
                                    <span class="applicationCard-panel__information">
                                        Wybierz typ karty:
                                    </span>
                                    <form class="applicationCard-panel__form"
                                          action="login.php?operation=applicationCard" method="POST">
                                        <input class="applicationCard-panel__input" type="radio" name="cardType"
                                               value="credit">
                                        <label class="applicationCard-panel__label" for="creditCard">Karta
                                            Kredytowa</label>
                                        <input class="applicationCard-panel__input" type="radio" name="cardType"
                                               value="debit">
                                        <label class="applicationCard-panel__label" for="debitCard">Karta
                                            Debetowa</label>
                                        <button class="btn btn--cancel">Wyślij wniosek</button>
                                    </form>
                                    <nav class="applicationCard-panel__nav">
                                        <a class="applicationCard-panel__link" href="login.php">
                                            <button class="btn">Wróć do panelu</button>
                                        </a>
                                    </nav>
                                    </section>
                                    <?php
                                }
                            }
                        } else {
                            if (isset($_POST['cardType'])) {
                                $user->setApplicationCard();
                                $application = $user->getApplicationCard();
                                if ($application != null) {
                                    $isExistApplication = in_array($_POST['cardType'], array_column($application, 'type'));
                                } else {
                                    $isExistApplication = false;
                                }
                                if ($isExistApplication) { ?>
                                    <span class="applicationCard-panel__information">
                                        Złożyłeś już wniosek o ten typ karty!
                                    </span>
                                    <nav class="applicationCard-panel__nav">
                                        <a class="applicationCard-panel__link"
                                           href="login.php?operation=applicationCard">
                                            <button class="btn">Wróć</button>
                                        </a>
                                    </nav>
                                    <?php
                                } else {
                                    $type = $_POST['cardType'];
                                    $idUser = $user->getID();
                                    $status = 'wait';
                                    $db->execute("INSERT INTO application_card (type, id_user, status) VALUES ('$type', '$idUser', '$status');");
                                    ?>
                                    <span class="applicationCard-panel__information">
                                        Wniosek został wysłany!
                                    </span>
                                    <nav class="applicationCard-panel__nav">
                                        <a class="applicationCard-panel__link"
                                           href="login.php?operation=applicationCard">
                                            <button class="btn">Wróć</button>
                                        </a>
                                    </nav>
                                    <?php
                                }
                            }
                        }
                        break;
                    case 'logout':
                        session_destroy();
                        unset($_SESSION['user_id']);
                        header('location: index.php');
                        exit();
                        break;
                }
            } else { ?>
            <section class="login-panel">
                <section class="panel-operation">
                    <div class="panel-operation__icon">
                        <img src="assets/images/useful.svg" alt="panel_account_picture" width="200">
                    </div>
                    <nav class="panel-operation__nav">
                        <a class="panel-operation__item" href="login.php?operation=showHistory">
                            <button class="btn btn--operation">Pokaż historię</button>
                        </a>
                        <a class="panel-operation__item" href="login.php?operation=transferMoney">
                            <button class="btn btn--operation">Prześlij pieniądze</button>
                        </a>
                        <a class="panel-operation__item" href="login.php?operation=applicationCard">
                            <button class="btn btn--operation">Złóż wniosek o karte</button>
                        </a>
                        <a class="panel-operation__item" href="login.php?operation=logout">
                            <button class="btn btn--logout">Wyloguj się</button>
                        </a>
                    </nav>
                </section>
                <section class="panel-information">
                    <span class="panel-information__header">Użytkownik konta</span>
                    <span class="panel-information__return-value">
                    <?php
                    echo $user->getLastname() . ' ' . $user->getSurname();
                    ?>
                    </span>
                    <span class="panel-information__header">Status</span>
                    <?php
                    if ($user->getStatus() == 'active') { ?>
                        <span class="panel-information__return-value">
                        <?php
                        echo 'Aktywowane';
                        ?>
                        </span>
                        <span class="panel-information__header">Numer konta</span>
                        <span class="panel-information__return-value">
                        <?php
                        echo $user->getBankAccountNumber();
                        ?>
                        </span>
                        <span class="panel-information__header">Saldo</span>
                        <span class="panel-information__return-value">
                        <?php
                        echo $user->getBankAccountBalance() . ' złotych';
                        ?>
                        </span>
                        <?php
                    } else { ?>
                        <span class="panel-information__info">
                            <?php
                            echo '<br>Konto nieaktywowane';
                            ?>
                        </span>
                        <?php
                    }
                    if ($user->cards != null) { ?>
                        <span class="panel-information__header">Twoje karty</span>
                        <table class="panel-information__table">
                            <thead class="panel-information__table-head">
                            <tr class="panel-information__table-row">
                                <th class="panel-information__table-header">
                                    Typ karty
                                </th>
                                <th class="panel-information__table-header">
                                    Numer karty
                                </th>
                                <th class="panel-information__table-header">
                                    Okres ważności
                                </th>
                            </tr>
                            </thead>
                            <tbody class="panel-information__table-body">
                            <?php
                            foreach ($user->cards as $card) { ?>
                                <tr class="panel-information__table-row">
                                    <?php
                                    if ($card['type'] == 'debit') { ?>
                                        <td class="panel-information__table-data">
                                            <img src="assets/images/visa.svg" alt="visa_card" width="80"
                                        </td>
                                        <?php
                                    } else { ?>
                                        <td class="panel-information__table-data">
                                            <img src="assets/images/master.svg" alt="master_card" width="80"
                                        </td>
                                    <?php } ?>
                                    <td class="panel-information__table-data">
                                        <?php
                                        echo $card['card_number'];
                                        ?>
                                    </td>
                                    <td class="panel-information__table-data">
                                        <?php
                                        echo $card['duration'];
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            } ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    }
                    ?>
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