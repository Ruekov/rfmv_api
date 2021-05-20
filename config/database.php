<?php
    class Database {

        public $conn;

        public function getConnection(){

            $this->conn = null;

            $configs = include('settings.php');
            $host = $configs["host"];
            $database_name = $configs["database_name"];
            $username = $configs["username"];
            $password = $configs["password"];

            try{
                $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $database_name, $username, $password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            
            return $this->conn;
        }
    }  
?>