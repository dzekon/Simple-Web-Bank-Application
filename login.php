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
                        <section class="login__panel--history">
                            <section class="login__panel--history--sendMoney">
                                <span>Historia przelewów wysłanych</span><br>
                                <?php
                                if ($user->logSendMoney == null) {
                                    echo 'Brak historii';
                                } else {
                                    $id_log = 1;
                                    foreach ($user->logSendMoney as $log) {
                                        echo $id_log;
                                        echo ' ';
                                        echo $log['number_account_send'];
                                        echo ' ';
                                        echo $log['number_account_receive'];
                                        echo ' ';
                                        echo $log['date'];
                                        echo '';
                                        echo $log['amount'];
                                        $id_log++;
                                    }
                                }
                                ?>
                            </section>
                            <section class="login__panel--history--receiveMoney">
                                <span>Historia przelewów wysłanych</span><br>
                                <?php
                                if ($user->logReceiveMoney == null) {
                                    echo 'Brak historii';
                                } else {
                                    $id_log = 1;
                                    foreach ($user->logReceiveMoney as $log) {
                                        echo $id_log;
                                        echo '<br>';
                                        echo $log['number_account_send'];
                                        echo '<br>';
                                        echo $log['number_account_receive'];
                                        echo '<br>';
                                        echo $log['date'];
                                        echo '<br>';
                                        echo $log['amount'];
                                        $id_log++;
                                    }
                                }
                                ?>
                            </section>
                        </section>
                        <?php
                        break;
                    case 'transferMoney': ?>
                        <section class="login__panel--transferMoney">
                        <?php
                        if (!isset($_POST['surnameReceiver'])) { ?>
                            <form action="login.php?operation=transferMoney" method="POST">
                                <label for="surnameReceiver">Imię</label>
                                <input type="text" name="surnameReceiver" required>
                                <label for="lastnameReceiver">Nazwisko</label>
                                <input type="text" name="lastnameReceiver" required>
                                <label for="number_account">Numer konta</label>
                                <input type="text" name="numberAccountReceiver" required>
                                <label for="amountMoney">Kwota</label>
                                <input type="number" name="amountMoney" required>
                                <button>Wyślij</button>
                            </form>
                            <a href="login.php">
                                <button>Wróć do panelu</button>
                            </a>
                            </section>
                            <?php
                        } else {
                            $dateReceiver = $_POST;
                            $numberAccount = $dateReceiver['numberAccountReceiver'];
                            $userMoney = $user->getBankAccountBalance();
                            $userAccount = $user->getBankAccountNumber();
                            $amountMoney = $dateReceiver['amountMoney'];
                            if ($db->single("SELECT * FROM bank_account where account_number = '$numberAccount'")) {
                                if ($dateReceiver['amountMoney'] > $userMoney) {
                                    echo 'Masz za mało pieniędzy, aby wykonać przelew!';
                                } else {
                                    $db->execute("UPDATE bank_account SET balance = balance - $amountMoney WHERE account_number = '$userAccount'");
                                    $db->execute("UPDATE bank_account SET balance = balance + $amountMoney WHERE account_number = '$numberAccount'");
                                    header('location:login.php?operation=transferMoney');
                                    exit();
                                }
                            } else {
                                echo 'nie ma takiego konta';
                            }
                            ?>
                            <a href="login.php?operation=transferMoney">
                                <button>Wróć</button>
                            </a>
                        <?php }
                        break;
                    case 'licationCard':
                        ?>
                        <section class="login__panel--aplicationCard">
                        <?php
                        if (!isset($_POST['cardType'])) {
                            if (sizeof($user->cards) == 2) {
                                echo 'Nie możesz posiadać więcej niż 2 kart.';
                            } else {
                                $user->setAplicationCard();
                                $aplication = $user->getAplicationCard();
                                if ($aplication != null && sizeof($aplication) == 2) {
                                    echo 'Złożyłeś już dwa wnioski o karty!'; ?>
                                    <a href="login.php">
                                        <button>Wróć</button>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    Możesz posiadać maksymalnie 2 karty!
                                    <form action="login.php?operation=aplicationCard" method="POST">
                                        Wybierz typ karty:
                                        <input type="radio" name="cardType" value="credit">
                                        <label for="creditCard">Karta Kredytowa</label>
                                        <input type="radio" name="cardType" value="debit">
                                        <label for="debitCard">Karta Debetowa</label>
                                        <button>Wyślij wniosek</button>
                                    </form>
                                    <a href="login.php">
                                        <button>Wróć</button>
                                    </a>
                                    </section>
                                    <?php
                                }
                            }
                        } else {
                            if (isset($_POST['cardType'])) {
                                $user->setAplicationCard();
                                $aplication = $user->getAplicationCard();
                                if ($aplication != null) {
                                    $isExistAplication = in_array($_POST['cardType'], array_column($aplication, 'type'));
                                } else {
                                    $isExistAplication = false;
                                }
                                if ($isExistAplication) {
                                    echo 'Wniosek o ten typ karty został już złożony'; ?>
                                    <a href="login.php?operation=aplicationCard">
                                        <button>Wróć</button>
                                    </a>
                                    <?php
                                } else {
                                    $type = $_POST['cardType'];
                                    $idUser = $user->getID();
                                    $status = 'wait';
                                    $db->execute("INSERT INTO aplication_card (type, id_user, status) VALUES ('$type', '$idUser', '$status');");
                                    ?>
                                    Wniosek został wysłany!
                                    <a href="login.php?operation=aplicationCard">
                                        <button>Wróć</button>
                                    </a>
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
            <section class="login__panel--account">
                <section class="login__panel--operations">
                    <center>
                        <img src="assets/images/12.svg" alt="account_pictuter" width="200" style="margin:20px 0">
                    </center>
                    <center>
                        <a href="login.php?operation=showHistory">
                            <button class="button__operation">Pokaż historię</button>
                        </a>
                        <a href="login.php?operation=transferMoney">
                            <button class="button__operation">Prześlij pieniądze</button>
                            <a/>
                            <a href="login.php?operation=aplicationCard">
                                <button class="button__operation">Złóż wniosek o karte</button>
                            </a>
                            <a href="login.php?operation=logout">
                                <button class="button__operation--logout">Wyloguj się</button>
                            </a>
                    </center>
                </section>
                <section class="login__panel--information">
                    <span class="login__panel--information--header">Użytkownik konta</span>
                    <?php
                    echo $user->getLastname() . ' ' . $user->getSurname();
                    echo '<span class="login__panel--information--header">Status</span>';
                    if ($user->getStatus() == 'active') {
                        echo 'Aktywowane';
                        echo '<span class="login__panel--information--header">Numer konta</span>';
                        echo $user->getBankAccountNumber();
                        echo '<span class="login__panel--information--header">Saldo</span>';
                        echo $user->getBankAccountBalance() . ' złotych';
                    } else {
                        echo '<br>Nieaktywowane';
                    }
                    if ($user->cards != null) {
                        echo '<span class="login__panel--information--header">Twoje karty</span>';
                        foreach ($user->cards as $card) {
                            echo '<table>';
                            echo '<thead>';
                            echo '<tr><th>Typ karty</th><th>Numer karty</th><th>Saldo</th></tr>';
                            echo '</thead>';
                            echo '<tr>';
                            if ($card['type'] == 'debit') {
                                echo '<td><img src="assets/images/visa.svg" alt="visa_card" width="80"</td>';
                            } else {
                                echo '<td><img src="assets/images/master.svg" alt="master_card" width="80"</td>';
                            }
                            echo '<td>' . $card['card_number'] . '</td>';
                            echo '<td>' . $card['balance'] . 'zł</td>';
                            echo '</tr>';
                            echo '</table>';
                        }
                    }
                    }
                    ?>
                </section>
            </section>
        </section>
    </main>
    <footer>Tu jest stopka</footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>