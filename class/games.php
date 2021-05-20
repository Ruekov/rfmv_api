<?php
    class Games{

        // Connection
        private $conn;

        // Table
        private $db_table = "Games";

        // Columns
        public $GameID;
        public $Name;
        public $Published;
        public $Countries;
        public $Developers;
        public $url;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getGames(){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            GROUP_CONCAT(distinct(ct.Name)) As 'Countries',
            gp.ReleaseDate As 'Published',
            GROUP_CONCAT(distinct(c.Name)) As 'Developers'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GameCountries gc ON gc.GameId = g.GameId
            LEFT JOIN Countries ct ON ct.CountryID = gc.CountryID
            LEFT JOIN GamePlatforms gp ON gc.GameId = g.GameId
            LEFT JOIN GameDevelopers gd ON gd.GameId = g.GameId
            LEFT JOIN Companies c ON c.CompanyID = gd.CompanyID
            GROUP BY g.gameId
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

    }
?>

