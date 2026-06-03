<?php
require 'configue.php';

class Database{
    private static $instatce=null;
    private $connection;
     private $host = "DB_HOST";
    private $db_name = "DB_NAME";
    private $username = "DB_USERNAME";
    private $password = "DB_PASSWORD";

    private function __construct(){
        try {
                $this->connection = new PDO(

                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password

            );   
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
             }
             catch(PDOException $e) {
                echo " Database connection error: " . $e->getMessage();

    
}}
    public static function getInstance(){
        if (self::$instatce==null){
            self::$instatce=new Database();
        }
        return self::$instatce;
    }
    public function getConnection(){
        return $this->connection;
    }
}
