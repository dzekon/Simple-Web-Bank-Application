<?php
require_once('connection.php');
require_once ('user_cards.php');

class User
{
    private $db;
    private $id;
    private $login;
    private $password;
    private $surname;
    private $lastname;
    private $pesel;
    private $street;
    private $houseNumber;
    private $zipCode;
    private $town;
    private $country;
    private $mail;
    private $telephoneNumber;
    private $status;
    private $bankAccounts;
    private $card;

    public function __construct($user_id)
    {
        $this->db = new Database('localhost', 'root', '', 'bank', '3306');
        $this->id = $user_id;
        $this->SetPersonalDate();
        $this->SetBankAccounts();
    }

    public function ShowBalanceAccount()
    {
        if ($this->bankAccounts == null) {
            return false;
        } else {
            return $this->bankAccounts['balance'];
        }
    }

    public function ShowNumberAccount()
    {
        return $this->bankAccounts['account_number'];
    }

    private function SetPersonalDate()
    {
        $data = $this->db->single("SELECT * FROM user_bank WHERE id = '$this->id'");
        $this->login = $data['login'];
        $this->password = $data['password'];
        $this->surname = $data['surname'];
        $this->lastname = $data['lastname'];
        $this->pesel = $data['pesel'];
        $this->street = $data['street'];
        $this->houseNumber = $data['house_number'];
        $this->zipCode = $data['zip_code'];
        $this->town = $data['town'];
        $this->country = $data['country'];
        $this->mail = $data['mail'];
        $this->telephoneNumber = $data['telephone_number'];
        $this->status = $data['status'];
    }

    private function SetBankAccounts()
    {
        $bankAccounts = $this->db->single("SELECT * FROM bank_account where id_user = '$this->id'");
        if ($bankAccounts == null) {
            return false;
        } else {
            $this->bankAccounts = $bankAccounts;
        }
    }

    private function SetCard()
    {
        $card = $this->db->single("SELECT * FROM card where id_user = '$this->id'");
        $this->card = $card;
    }
}