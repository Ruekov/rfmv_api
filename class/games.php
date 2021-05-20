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

        public function getGamesByGenere($genereGame){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN GameGeneres ggn ON ggn.GameId = g.GameId
            LEFT JOIN Generes gn ON ggn.GenereID = gn.GenereID
            WHERE gn.Name= '" . $genereGame . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamesByLanguage($language){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN GameLanguages glan ON glan.GameId = g.GameId
            LEFT JOIN Idioms id ON glan.IdiomID = id.IdiomID
            WHERE id.Name= '" . $language . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamesByPlatform($platform){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN Platforms pl ON pl.PlatformID = gp.PlatformID
            WHERE pl.Name= '" . $platform . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamesByDeveloper($developer){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN Platforms pl ON pl.PlatformID = gp.PlatformID
            LEFT JOIN GameDevelopers gDev ON gDev.GameId = g.GameId
            LEFT JOIN Companies com ON com.CompanyID = gDev.CompanyID
            WHERE com.Name= '" . $developer . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamesByPublisher($publisher){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN Platforms pl ON pl.PlatformID = gp.PlatformID
            LEFT JOIN GamePublishers gPub ON gPub.GameId = g.GameId
            LEFT JOIN Companies com ON com.CompanyID = gPub.CompanyID
            WHERE com.Name= '" . $publisher . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamesByTheme($theme){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN Platforms pl ON pl.PlatformID = gp.PlatformID
            LEFT JOIN GameThemes gt ON gt.GameId = g.GameId
            LEFT JOIN Themes th ON th.ThemeID = gt.ThemeID
            WHERE th.Name= '" . $theme . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamesByStyle($style){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN GameStyles gst ON gst.GameId = g.GameId
            LEFT JOIN Styles st ON gst.ThemeID = st.ThemeID
            WHERE st.Name= '" . $style . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getGamesByCountry($country){
            $sqlQuery = "SELECT 
            g.GameId AS 'GameID', 
            g.publishedName AS 'Name',
            g.url AS 'url',
            gp.ReleaseDate As 'Published'
            FROM        
            " . $this->db_table . " g
            LEFT JOIN GamePlatforms gp ON gp.GameId = g.GameId
            LEFT JOIN GameCountries gc ON gc.GameId = g.GameId
            LEFT JOIN Countries ct ON gc.CountryID = ct.CountryID
            WHERE ct.Name= '" . $country . "'
			GROUP BY g.gameId  
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

    }
?>

