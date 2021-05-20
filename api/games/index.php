<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET');
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/games.php';
    include_once '../../class/game.php';

    $database = new Database();
    $db = $database->getConnection();
    $id = false;
    $url = false;
    $genere = false;   

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $items = new Game($db);

        $stmt = $items->getGame($id);

        $gameArr = array();
        $gameArr["game"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Remarks" => $Remarks,
                "url" => $url
            );

            array_push($gameArr["game"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['url'])){
        $url = $_GET['url'];

        $items = new Game($db);

        $stmt = $items->getGameByUrl($url);
        $stLang = $items->getGameLanguages($url);
        $stDev = $items->getGameDevelopers($url);
        $stPub = $items->getGamePublishers($url);
        $stGamePlat = $items->getGamePlatforms($url);
        $stCountries = $items->getGameCountries($url);
        $stGeneres = $items->getGameGeneres($url);
        $stGameTh = $items->getGameThemes($url);
        $stGameSty = $items->getGameStyles($url);

        $gameArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $gameLang = array();
            $gameDev = array();
            $gamePub = array();
            $gamePlat = array();
            $gameCt = array();
            $gameGn = array();
            $gameTh = array();
            $gameSty = array();

            while ($langRow = $stLang->fetch(PDO::FETCH_ASSOC)){
                extract($langRow);
                if($IdiomId != null)
                {
                $e = array(
                    "LanguageId" => $IdiomId,
                    "Name" => $Name,
                );
                array_push($gameLang, $e);
                }
            }

            while ($devRow = $stDev->fetch(PDO::FETCH_ASSOC)){
                extract($devRow);
                $e = array(
                    "CompanyId" => $CompanyID,
                    "Name" => $Name,
                );
                array_push($gameDev, $e);
            }

            while ($pubRow = $stPub->fetch(PDO::FETCH_ASSOC)){
                extract($pubRow);
                $e = array(
                    "CompanyId" => $CompanyID,
                    "Name" => $Name,
                );
                array_push($gamePub, $e);
            }

            while ($gamPlRow = $stGamePlat->fetch(PDO::FETCH_ASSOC)){
                extract($gamPlRow);
                $e = array(
                    "PlatformId" => $PlatformID,
                    "Name" => $Name,
                    "ReleaseDate" => $ReleaseDate
                );
                array_push($gamePlat, $e);
            }

            while ($ctRow = $stCountries->fetch(PDO::FETCH_ASSOC)){
                extract($ctRow);
                $e = array(
                    "CountryId" => $CountryID,
                    "Name" => $Name
                );
                array_push($gameCt, $e);
            }

            while ($gnRow = $stGeneres->fetch(PDO::FETCH_ASSOC)){
                extract($gnRow);
                $e = array(
                    "GenereId" => $GenereID,
                    "Name" => $Name
                );
                array_push($gameGn, $e);
            }

            while ($gthRow = $stGameTh->fetch(PDO::FETCH_ASSOC)){
                extract($gthRow);
                if($ThemeID != null)
                {
                    $e = array(
                        "ThemeId" => $ThemeID,
                        "Name" => $Name
                    );
                }
                array_push($gameTh, $e);
            }

            while ($gstRow = $stGameSty->fetch(PDO::FETCH_ASSOC)){
                extract($gstRow);
                if($StyleID != null)
                {
                    $e = array(
                        "StyleId" => $StyleID,
                        "Name" => $Name
                    );
                }
                array_push($gameSty, $e);
            }


            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Remarks" => $Remarks,
                "URL" => $url,
                "Developers" => $gameDev,
                "Publishers" => $gamePub,
                "Platforms" => $gamePlat,
                "Countries" => $gameCt,
                "Generes" => $gameGn,
                "Themes" => $gameTh,
                "Styles" => $gameSty,
                "Languages" =>  $gameLang
            );

            $gameArr["game"] = $e;
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['genere'])){
        $genere = $_GET['genere'];
        $genereProcessed = str_replace("-", " ", $genere);

        $items = new Games($db);

        $stmt = $items->getGamesByGenere($genereProcessed);

        $gameArr = array();
        $gameArr["games"] = array();



        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['language'])){
        $language = $_GET['language'];

        $items = new Games($db);

        $stmt = $items->getGamesByLanguage($language);

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['platform'])){
        $platform = $_GET['platform'];
        $platformProcessed = str_replace("-", " ", $platform);

        $items = new Games($db);

        $stmt = $items->getGamesByPlatform($platformProcessed);

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['developer'])){
        $developer = $_GET['developer'];
        $developerProcessed = str_replace("-", " ", $developer);

        $items = new Games($db);

        $stmt = $items->getGamesByDeveloper($developerProcessed);

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['publisher'])){
        $publisher = $_GET['publisher'];
        $publisherProcessed = str_replace("-", " ", $publisher);

        $items = new Games($db);

        $stmt = $items->getGamesByPublisher($publisherProcessed);

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['theme'])){
        $theme = $_GET['theme'];
        $themeProcessed = str_replace("-", " ", $theme);

        $items = new Games($db);

        $stmt = $items->getGamesByTheme($themeProcessed);

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['style'])){
        $style = $_GET['style'];
        $styleProcessed = str_replace("-", " ", $style);

        $items = new Games($db);

        $stmt = $items->getGamesByStyle($styleProcessed);

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else if(isset($_GET['country'])){
        $country = $_GET['country'];
        $countryProcessed = str_replace("-", " ", $country);

        $items = new Games($db);

        $stmt = $items->getGamesByCountry($countryProcessed);

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);

    }
    else
    {
        $items = new Games($db);

        $stmt = $items->getGames();

        $gameArr = array();
        $gameArr["games"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Developers" => $Developers,
                "Countries" => $Countries,
                "Published" => $Published,
                "url" => $url
            );

            array_push($gameArr["games"], $e);
        }
        echo json_encode($gameArr);
    }
?>