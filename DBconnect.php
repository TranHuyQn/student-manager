<?php


class DBconnect
{
    public $dsn;
    public $userName;
    public $userPass;

    public function __construct()
    {
        $this->dsn = 'mysql:host=localhost;dbname=student-manager';
        $this->userName = 'root';
        $this->userPass = 'Vanhuy123@';
    }

    public function connect()
    {
        $conn = null;
        try{
            $conn = new PDO($this->dsn, $this->userName, $this->userPass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e){
            echo $e -> getMessage();
        }
        return $conn;
    }
}