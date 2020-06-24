<?php
require_once('user.php');
session_start();

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
                    <button id="login__button">Panel klienta</button>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="home" id="div_1"">
        home
        </section>
        <section class="product" id="div_2">
            product
        </section>
        <section class="contact" id="div_3">
            contact
        </section>
        <section class="help" id="div_4">
            help2
        </section>
        <section class="login" id="div_5" style="display: block">
            <section class="login__panel">
                <section class="login__panel--operations">
                    <button>Pokaż historię</button>
                    <button>Prześlij pieniądze</button>
                    <button>Złóż wniosek o karte</button>
                </section>
                <section class="login__panel--informations">
                    <center>
                        <img src="assets/images/12.svg" alt="account_pictuter" width="200"></center>
                    <center>Witaj
                    <?php
                    echo $user->getSurname() . '!';
                    echo '<br>';
                    ?>
                        <b>Status konta</b>
                    <?php
                    if ($user->getStatus() == 'active') {
                        echo '<br>';
                        echo 'Aktywowane';
                        echo '<br>';
                        echo '<b>Numer konta bankowego</b>';
                        echo "<br>";
                        echo $user->getBankAccountNumber();
                        echo '<br>';
                        echo '<b>Saldo konta bankowego<b/>';
                        echo '<br>';
                        echo $user->getBankAccountBalance() . ' złotych';
                        echo '<br>';
                        if ($user->cards != null) {
                            echo '<b>Twoje karty</b>';
                            foreach ($user->cards as $card) {
                            echo '<table>';
                                echo '<thead>';
                                echo '<tr><th>Typ karty</th><th>Numer karty</th><th>Data ważności</th><th>Saldo</th></tr>';
                                echo '</thead>';
                                echo '<tr>';
                                if ($card['type'] == 'debit') {
                                    echo '<td><img src="assets/images/visa.svg" alt="visa_card" width="80"</td>';
                                } else {
                                    echo '<td><img src="assets/images/master.svg" alt="master_card" width="80"</td>';
                                }
                                echo '<td>' .$card['card_number'] . '</td>';
                                echo '<td>' .$card['duration'] . '</td>';
                                echo '<td>' .$card['balance'] . '</td>';
                                echo '</tr>';
                            echo '</table>';
                            }
                            }
                    } else {
                        echo "Nieaktywowane";
                    }
                    ?>
                    </center>
                </section>
            </section>
        </section>
    </main>
    <footer>Tu jest stopka</footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>