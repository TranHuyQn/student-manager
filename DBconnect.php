<?php


class DBconnect
{
    public $dsn;
    public $username;
    public $password;

    public function __construct()
    {
        $this->dsn = 'mysql:host=localhost;dbname=student-manager';
        $this->username = 'root';
        $this->password = 'Vanhuy123@';
    }

    public function connect()
    {
        $conn = null;
        try{
            $conn = new PDO($this->dsn, $this->username, $this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e){
            echo $e -> getMessage();
        }
        return $conn;
    }
}