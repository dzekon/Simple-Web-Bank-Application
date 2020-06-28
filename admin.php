<?php
session_start();
require_once('user.php');
require_once('connection.php');
$db = new Database('localhost', 'root', '', 'bank', '3306');

if (isset($_POST['selectNewCards'])) {
    $applications = $_POST['selectNewCards'];
    foreach ($applications as $application) {
        $applicationCard = $db->single("SELECT * FROM application_card WHERE id = '$application'");
        $userCard = $applicationCard['id_user'];
        $typeCard = $applicationCard['type'];
        $cardToAssign = $db->single("SELECT * FROM card_to_assign WHERE type='$typeCard' ORDER BY id DESC LIMIT 1");
        $cardID = $cardToAssign['id'];
        $cardNumber = $cardToAssign['card_number'];
        $cardCvvNumber = $cardToAssign['cvv'];
        $cardDuration = $cardToAssign['duration'];
        $db->execute("INSERT INTO card (id_user, card_number, cvv, duration, balance, type, status) VALUES ('$userCard' , '$cardNumber', '$cardCvvNumber', '$cardDuration', '10', '$typeCard', 'active')");
        $db->execute("UPDATE application_card SET status = 'accept' WHERE id = '$application'");
        $db->execute("DELETE FROM card_to_assign WHERE id = '$cardID'");
        header('location:admin.php');
        exit();
    }
}

if (isset($_POST['selectNewAccounts'])) {
    $applications = $_POST['selectNewAccounts'];
    foreach ($applications as $application) {
        $applicationUser = $db->single("SELECT * FROM application_user WHERE id = '$application'");
        $userId = $applicationUser['id_user'];
        $accountToAssign = $db->single("SELECT * FROM account_to_assign ORDER BY id DESC LIMIT 1");
        $accountToAssignID = $accountToAssign['id'];
        $numberAccount = $accountToAssign['account_number'];
        $db->execute("INSERT INTO bank_account (id_user, account_number, balance) VALUES ('$userId','$numberAccount' , 0)");
        $db->execute("UPDATE user_bank SET status = 'active' WHERE id = '$userId'");
        $db->execute("DELETE FROM account_to_assign WHERE id = '$accountToAssignID'");
        $db->execute("UPDATE application_user SET status = 'accept' WHERE id_user = '$userId'");
        header('location:admin.php');
        exit();
    }
}

function logout()
{
    session_destroy();
    unset($_SESSION['user_id']);
    header('location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LenBank Admin</title>
    <link rel="stylesheet" href="css/style-admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap"
          rel="stylesheet">
</head>
<body>
<section class="wrapper">
    <header class="page-header">
        <h1 class="page-header__title">
            Panel administratora banku
        </h1>
    </header>
    <main>
        <section class="admin-panel">
            <nav class="admin-panel__nav">
                <ul class="admin-panel__list">
                    <li class="admin-panel__item">
                        <a class="admin-panel__anchor" href="admin.php?operation=showAllAccounts">Pokaż wszystkie
                            konta</a>
                    </li>
                    <li class="admin-panel__item">
                        <a class="admin-panel__anchor" href="admin.php?operation=showAllCards">Pokaż wszystkie karty</a>
                    </li>
                    <li class="admin-panel__item">
                        <a class="admin-panel__anchor" href="admin.php?operation=accountApplication">Aplikacje nowych
                            użytkowników</a>
                    </li>
                    <li class="admin-panel__item">
                        <a class="admin-panel__anchor" href="admin.php?operation=cardApplication">Aplikacje o
                            przydzielenie karty</a>
                    </li>
                    <li class="admin-panel__item">
                        <a class="admin-panel__anchor" href="admin.php?operation=transferLog">Logi transferów</a>
                    </li>
                    <li class="admin-panel__item">
                        <a class="admin-panel__anchor" href="admin.php?operation=logout">Wyloguj się</a>
                    </li>
                </ul>
            </nav>
            <section class="admin-panel__operations">
                <?php
                if (isset($_GET['operation'])) {
                    switch ($_GET['operation']) {
                        case 'showAllAccounts':
                            ?>
                            <span class="admin-panel__header">Lista kont w banku</span>
                            <?php
                            $users = $db->multiRow("SELECT * FROM user_bank INNER JOIN bank_account ON user_bank.id = bank_account.id_user");
                            if ($users != null) {
                                ?>
                                <div class="admin-panel__container">
                                    <table class="admin-panel__table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nazwisko</th>
                                            <th>Imię</th>
                                            <th>Status konta</th>
                                            <th>Numer konta bankowego</th>
                                            <th>Saldo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $id = 1;
                                        foreach ($users as $user) {
                                            ?>
                                            <tr>
                                                <?php
                                                echo '<td>' . $id . '</td>';
                                                echo '<td>' . $user['lastname'] . '</td>';
                                                echo '<td>' . $user['surname'] . '</td>';
                                                echo '<td>' . $user['status'] . '</td>';
                                                echo '<td>' . $user['account_number'] . '</td>';
                                                echo '<td>' . $user['balance'] . '</td>';
                                                $id++;
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else { ?>
                                <span class="admin-panel__information">
                                    Brak wyników!
                                </span>
                                <?php
                            }
                            break;
                        case 'showAllCards':
                            ?>
                            <span class="admin-panel__header">Lista kart</span>
                            <?php
                            $cards = $db->multiRow("SELECT * FROM user_bank INNER JOIN card ON user_bank.id = card.id_user");
                            if ($cards != null) {
                                ?>
                                <div class="admin-panel__container">
                                    <table class="admin-panel__table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nazwisko</th>
                                            <th>Imię</th>
                                            <th>Rodzaj karty</th>
                                            <th>Numer karty</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $id = 1;
                                        foreach ($cards as $card) {
                                            ?>
                                            <tr>
                                                <?php
                                                echo '<td>' . $id . '</td>';
                                                echo '<td>' . $card['lastname'] . '</td>';
                                                echo '<td>' . $card['surname'] . '</td>';
                                                echo '<td>' . $card['type'] . '</td>';
                                                echo '<td>' . $card['card_number'] . '</td>';
                                                $id++;
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else { ?>
                                <span class="admin-panel__information">
                                    Brak wyników!
                                </span>
                                <?php
                            }
                            break;
                        case 'accountApplication':
                            ?>
                            <span class="admin-panel__header">Lista wniosków o nowe konta</span>
                            <?php
                            $users = $db->multiRow("SELECT application_user.id, user_bank.lastname, user_bank.surname, user_bank.pesel, user_bank.street, user_bank.house_number, user_bank.zip_code, user_bank.town, user_bank.country, user_bank.mail, user_bank.telephone_number FROM application_user JOIN user_bank WHERE application_user.id_user = user_bank.id AND application_user.status = 'wait'");
                            if ($users != null) {
                                ?>
                                <div class="admin-panel__container">
                                    <form action="admin.php" method="POST">
                                        <table class="admin-panel__table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Nazwisko</th>
                                                <th>Imię</th>
                                                <th>PESEL</th>
                                                <th>Ulica</th>
                                                <th>Numer</th>
                                                <th>Kod pocztowy</th>
                                                <th>Miasto</th>
                                                <th>Email</th>
                                                <th>Telefon</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $id = 1;
                                            foreach ($users as $user) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    echo '<td><input type="checkbox" name="selectNewAccounts[]" value="' . $user['id'] . '"></td>';
                                                    echo '<td>' . $id . '</td>';
                                                    echo '<td>' . $user['lastname'] . '</td>';
                                                    echo '<td>' . $user['surname'] . '</td>';
                                                    echo '<td>' . $user['pesel'] . '</td>';
                                                    echo '<td>' . $user['street'] . '</td>';
                                                    echo '<td>' . $user['house_number'] . '</td>';
                                                    echo '<td>' . $user['zip_code'] . '</td>';
                                                    echo '<td>' . $user['town'] . '</td>';
                                                    echo '<td>' . $user['mail'] . '</td>';
                                                    echo '<td>' . $user['telephone_number'] . '</td>';
                                                    $id++;
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <input type="submit" value="Send">
                                    </form>
                                </div>
                                <?php
                            } else { ?>
                                <span class="admin-panel__information">
                                    Brak wyników!
                                </span>
                                <?php
                            }
                            break;
                        case 'cardApplication':
                            ?>
                            <span class="admin-panel__header">Lista wniosków o przydzielenie kart</span>
                            <?php
                            $cards = $db->multiRow("SELECT application_card.id, application_card.type, user_bank.lastname, user_bank.surname FROM application_card JOIN user_bank WHERE application_card.id_user = user_bank.id AND application_card.status = 'wait'");
                            if ($cards != null) {
                                ?>
                                <div class="admin-panel__container">
                                    <form action="admin.php" method="POST">
                                        <table class="admin-panel__table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Nazwisko</th>
                                                <th>Imię</th>
                                                <th>Rodzaj karty</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $id = 1;
                                            foreach ($cards as $card) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    echo '<td><input type="checkbox" name="selectNewCards[]" value="' . $card['id'] . '"></td>';
                                                    echo '<td>' . $id . '</td>';
                                                    echo '<td>' . $card['lastname'] . '</td>';
                                                    echo '<td>' . $card['surname'] . '</td>';
                                                    echo '<td>' . $card['type'] . '</td>';
                                                    $id++;
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <input type="submit" value="Send">
                                    </form>
                                </div>
                                <?php
                            } else { ?>
                                <span class="admin-panel__information">
                                    Brak wyników!
                                </span>
                                <?php
                            }
                            break;
                        case 'transferLog':
                            ?>
                            <span class="admin-panel__header">Logi transferów posortowane według daty</span>
                            <?php
                            $logs = $db->multiRow("SELECT * FROM account_transfer_log ORDER BY date");
                            if ($logs != null) {
                                ?>
                                <div class="admin-panel__container">
                                    <table class="admin-panel__table">
                                        <thead class="admin-panel__table-head">
                                        <tr class="admin-panel__table-row">
                                            <th class="admin-panel__table-header">#</th>
                                            <th class="admin-panel__table-header">Wysyłający</th>
                                            <th class="admin-panel__table-header">Odbierający</th>
                                            <th class="admin-panel__table-header">Data przelewu</th>
                                            <th class="admin-panel__table-header">Kwota</th>
                                        </tr>
                                        </thead>
                                        <tbody class="admin-panel__table-body">
                                        <?php
                                        $id = 1;
                                        foreach ($logs as $log) {
                                            ?>
                                            <tr class="admin-panel__table-row">
                                                <td class="admin-panel__table-date">
                                                    <?php
                                                    echo $id;
                                                    ?>
                                                </td>
                                                <td class="admin-panel__table-date">
                                                    <?php
                                                    echo $log['number_account_send'];
                                                    ?>
                                                </td>
                                                <td class="admin-panel__table-date">
                                                    <?php
                                                    echo $log['number_account_receive'];
                                                    ?>
                                                </td>
                                                <td class="admin-panel__table-date">
                                                    <?php
                                                    echo $log['date'];
                                                    ?>
                                                </td>
                                                <td class="admin-panel__table-date">
                                                    <?php
                                                    echo $log['amount'];
                                                    ?>
                                                </td>
                                                <?php
                                                $id++;
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                                <?php
                            } else { ?>
                                <span class="admin-panel__information">
                                    Brak wyników!
                                </span>
                                <?php
                            }
                            break;
                        case 'logout':
                            logout();
                            break;
                    }
                } else { ?>
                    <span class="admin-panel__header">
                        Wybierz opcje z menu
                    <?php
                }
                ?>
            </section>
        </section>
    </main>
    <footer></footer>
    <script type="text/javascript" src="main.js" charset="UTF-8"></script>
</body>
</html>