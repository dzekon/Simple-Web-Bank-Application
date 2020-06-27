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
                    <button class="header__button header__button--primary" id="login__button">Panel użytkownika</button>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="home" id="div_1">
            home
        </section>
        <section class="product" id="div_2">
        </section>
        <section class="contact" id="div_3">
            contact
        </section>
        <section class="help" id="div_4">
            help2
        </section>
        <section class="login" id="div_5" style="display: block">
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
                                        foreach ($user->logSendMoney as $log) {
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
                                                    echo $log['number_account_receive'];
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
                    case 'transferMoney': ?>
                        <section class="transfer-panel">
                        <h1 class="transfer-panel__header">
                            Przesyłanie środków z konta
                        </h1>
                        <?php
                        if (!isset($_POST['surnameReceiver'])) { ?>
                            <form class="transfer-panel__form" action="login.php?operation=transferMoney" method="POST">
                                <label class="transfer-panel__label" for="surnameReceiver">Imię</label>
                                <input class="transfer-panel__input" type="text" name="surnameReceiver" required>
                                <label class="transfer-panel__label" for="lastnameReceiver">Nazwisko</label>
                                <input class="transfer-panel__input" type="text" name="lastnameReceiver" required>
                                <label class="transfer-panel__label" for="number_account">Numer konta</label>
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
                            $countCard = ($user->cards) != null ? $countCard = sizeof($user->cards): $countCard = null;
                            if ($countCard == 2) { ?>
                                    <span class="applicationCard-panel__alert">Posiadasz już dwie karty!</span>
                            <?php
                            } else {
                                $user->setApplicationCard();
                                $application = $user->getApplicationCard();
                                $countCard = sizeof($application);
                                if ($application != null && sizeof($application) == 2) { ?>
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
                        <img src="assets/images/12.svg" alt="account_pictuter" width="200">
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
                    } ?>
                </section>
            </section>
        </section>
    </main>
    <footer>Tu jest stopka</footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>