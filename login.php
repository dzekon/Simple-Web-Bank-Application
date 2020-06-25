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
        <section class="home" id="div_1"
        ">
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
                echo '<section class="login__panel--history">';
                $user->setLogs();
                if ($user->logSendMoney == null) {
                    echo 'jest null';
                } else {
                    $id_log = 1;
                    foreach ($user->logSendMoney as $log) {
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
                echo '</section>';
                break;
            case 'transferMoney':
                echo '<section class="login__panel--history">To sa pieniadze</section>';
                break;
            case 'logout':
                session_destroy();
                unset($_SESSION['user_id']);
                header('location: index.php');
                exit();
                break;
        }
    } else {
        echo '<section class="login__panel--account">';
        echo '<section class="login__panel--operations">';
        echo '<center>';
        echo '<img src="assets/images/12.svg" alt="account_pictuter" width="200" style="margin:20px 0"></center>';
        echo '<center>';
        echo '<a href="login.php?operation=showHistory">';
        echo '<button class="button__operation">Pokaż historię</button>';
        echo '</a>';
        echo '<a href="login.php?operation=transferMoney">';
        echo '<button class="button__operation">Prześlij pieniądze</button>';
        echo '<a/>';
        echo '<button class="button__operation">Złóż wniosek o karte</button>';
        echo '<a href="login.php?operation=logout">';
        echo '<button class="button__operation--logout">Wyloguj się</button>';
        echo '</a>';
        echo '</center>';
        echo '</section>';
        echo '<section class="login__panel--information">';
        echo '<span class="login__panel--information--header">Użytkownik konta</span>';
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