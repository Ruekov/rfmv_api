<?php
    class Game{

        // Connection
        private $conn;

        // Table
        private $db_table = "Games";

        // Columns
        public $GameID;
        public $Name;
        public $Remarks;
        public $url;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getGame($id){
            $sqlQuery = "SELECT 
             g.publishedName AS 'Name',
             g.GameId AS 'GameID',
             g.remarks As 'Remarks',
             g.url As 'url'
            FROM        
            " . $this->db_table . " g
            WHERE
            g.GameId = " . $id;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGameByUrl($url){
            $sqlQuery = "SELECT 
             g.publishedName AS 'Name',
             g.GameId AS 'GameID',
             g.remarks As 'Remarks',
             g.url As 'url'
            FROM        
            " . $this->db_table . " g
            WHERE
            g.url = '" . $url . "'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGameLanguages($url){
            $sqlQuery = "SELECT  
                id.Name,
                id.IdiomId
            FROM Games g 
            LEFT JOIN GameLanguages gl ON g.GameID = gl.GameID
            LEFT JOIN Idioms id ON id.IdiomID = gl.IdiomID
            WHERE
            g.url = '" . $url . "'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGameDevelopers($url){
            $sqlQuery = "SELECT  
                c.Name,
                c.CompanyID
            FROM Games g 
            LEFT JOIN GameDevelopers gd ON g.GameID = gd.GameID
            LEFT JOIN Companies c ON c.CompanyID = gd.CompanyID
            WHERE
            g.url = '" . $url . "'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamePublishers($url){
            $sqlQuery = "SELECT  
                c.Name,
                c.CompanyID
            FROM Games g 
            LEFT JOIN GamePublishers gd ON g.GameID = gd.GameID
            LEFT JOIN Companies c ON c.CompanyID = gd.CompanyID
            WHERE
            g.url = '" . $url . "'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamePlatforms($url){
            $sqlQuery = "SELECT  
                c.Name,
                c.PlatformID,
                pl.ReleaseDate
            FROM Games g 
            LEFT JOIN GamePlatforms pl ON g.GameID = pl.GameID
            LEFT JOIN Platforms c ON c.PlatformID = pl.PlatformID
            WHERE
            g.url = '" . $url . "'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGameCountries($url){
            $sqlQuery = "SELECT  
                c.Name,
                c.CountryID
            FROM Games g 
            LEFT JOIN GameCountries gc ON gc.GameID = g.GameID
            LEFT JOIN Countries c ON c.CountryID = gc.CountryID
            WHERE
            g.url = '" . $url . "'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

    }
?>

