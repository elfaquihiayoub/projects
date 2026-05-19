<?php
require "config.php";

class database{
    private $host=DB_HOST;
    private $dbname=DB_NAME;
    private $username=DB_USER;
    private $password=DB_PASS;
    private $charset=DB_CHARSET;

    public $connection;
    public function getConnection(){
        $this->connection=null;
        try{
            $this->connection=new PDO("mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}",$this->username,$this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        }catch(PDOException $e){
        echo "error de connection " .$e->getMessage();
            
        }
        return $this->connection;
    }

}