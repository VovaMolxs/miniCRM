<?php

namespace Core\Db;



use mysqli;

class Database
{
    private static $instance = null;
    private $connection; //объект подключения к базе данных
    private $hostname = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $name = 'mini_crm';

    private function __construct() {
        $this->connection = new mysqli($this->hostname, $this->user, $this->pass, $this->name);
        if ($this->connection->connect_error) {
            die("Connection Filed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public static function getInstance() {
        if(!self::$instance) {
            return self::$instance = new self;
        }
        return self::$instance;
    }


}