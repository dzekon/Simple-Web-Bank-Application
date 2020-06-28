<?php
require_once('connection.php');

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
    private $bankAccount;
    private $applicationCard;
    private $applicationAccount;

    public $logSendMoney;
    public $logReceiveMoney;
    public $cards;

    public function __construct($user_id)
    {
        $this->db = new Database('localhost', 'root', '', 'bank', '3306');
        $this->id = $user_id;
        $this->setPersonalDate();
        $this->setBankAccount();
        $this->setCards();
    }

    public function getID()
    {
        return $this->id;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getPesel()
    {
        return $this->pesel;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getBankAccountNumber()
    {
        if ($this->bankAccount == null) {
            return false;
        } else {
            return $this->bankAccount['account_number'];
        }
    }

    public function getBankAccountBalance()
    {
        if ($this->bankAccount == null) {
            return false;
        } else {
            return $this->bankAccount['balance'];
        }
    }

    public function getApplicationCard()
    {
        if ($this->applicationCard == null) {
            return false;
        } else {
            return $this->applicationCard;
        }
    }

    public function setLogs(){
        $this->setLogSendMoney();
        $this->setLogReceiveMoney();
    }

    private function setLogSendMoney()
    {
        $account_number = $this->bankAccount['account_number'];
        $log = $this->db->multiRow("SELECT * FROM account_transfer_log where number_account_send = '$account_number'");
        if ($log == null) {
            return false;
        } else {
            $this->logSendMoney = $log;
        }
    }

    private function setLogReceiveMoney()
    {
        $account_number = $this->bankAccount['account_number'];
        $log = $this->db->multiRow("SELECT * FROM account_transfer_log where number_account_receive = '$account_number'");
        if ($log == null) {
            return false;
        } else {
            $this->logReceiveMoney = $log;
        }
    }

    public function setApplicationCard()
    {
        $application = $this->db->multiRow("SELECT * FROM application_card where id_user = '$this->id'");
        if ($application == null) {
            return false;
        } else {
            $this->applicationCard = $application;
        }
    }

    private function setPersonalDate()
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

    private function setBankAccount()
    {
        $bankAccount = $this->db->single("SELECT * FROM bank_account where id_user = '$this->id'");
        if ($bankAccount == null) {
            return false;
        } else {
            $this->bankAccount = $bankAccount;
        }
    }

    private function setCards()
    {
        $cards = $this->db->multiRow("SELECT * FROM card where id_user = '$this->id'");
        if ($cards == null) {
            return false;
        } else {
            $this->cards = $cards;
        }
    }
}