<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/genere.php';
    include_once '../../class/generes.php';

    $database = new Database();
    $db = $database->getConnection();
    $id = false;
    $url = false;

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $items = new Genere($db);

        $stmt = $items->getGenereGames($id);

        $gameArr = array();
        $gameArr["genere"] = array();

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

        $gameArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $e = array(
                "GameID" => $GameID,
                "Name" => $Name,
                "Remarks" => $Remarks,
                "URL" => $url,

            $gameArr["game"] = $e;
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