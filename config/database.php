<?php

    include_once './settings.php';

    class Database {
        private $host = $config["bbdd"]["host"];
        private $database_name = $config["bbdd"]["database_name"];
        private $username = $config["bbdd"]["username"];
        private $password = $config["bbdd"]["password"];

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>