<?php
require_once('connection.php');
$db = new Database('localhost', 'root', '', 'bank', '3306');

$login = $mail;
$password = 'admin';
$surname = $_POST['surname'];
$lastname = $_POST['lastname'];
$pesel = $_POST['pesel'];
$place = $_POST['place'];
$number_house = $_POST['number_house'];
$zip_code = $_POST['zip-code'];
$town = $_POST['town'];
$country = $_POST['country'];
$mail = $_POST['mail'];
$number_phone = $_POST['number_phone'];

$db->execute("INSERT INTO user_bank (login, password, surname, lastname, pesel, street, house_number, zip_code, town, country, mail, telephone_number)
VALUES ('$login', '$password' , '$surname' , '$lastname', '$pesel', '$place', '$number_house', '$zip_code', '$town', '$country', '$mail', '$number_phone');");

header('location:index.php');
exit();



