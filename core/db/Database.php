<?php

namespace Core\Db;



use mysqli;
use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $connection; //объект подключения к базе данных
    private $iniFile = "connection.ini";
    private $iniData = [];


    private function __construct() {
        $this->iniData = parse_ini_file($this->iniFile);
        $host = $this->iniData['host'];
        $db   = $this->iniData['db'];
        $user = $this->iniData['user'];
        $pass = $this->iniData['pass'];


        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$db",
                $user,
                $pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {
            echo "Connection filed: " . $exception->getMessage();
        }

    }

    public function getConnection()
    {
        return $this->connection;
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            return self::$instance = new self;
        }
        return self::$instance;
    }


}