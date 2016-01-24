<?php
//WijnProject/selected.php

use WijnshopTest\Business\WijnService;
use WijnshopTest\Business\VerpakkingService;
require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");
//error_reporting(0); // Of php.ini aanpassen : error_reporting
session_start();

    if (isset($_GET["action"])) {
        if(!isset($_SESSION["mandje"])) {
        $_SESSION["mandje"] = array();
        $_SESSION["mandjeVerpak"] = array();
        $_SESSION["totaal"] = 0;
        $_SESSION["aantal"] = 0;
        $_SESSION["aantalVerpak"] = 0;
        $aantal = 0;
        $wijnArray = array();
        }
        $wijnService = new WijnService();
        $wijn = $wijnService->getSelectWijn($_GET["id"]);
        $verpakService = new VerpakkingService();
        $verpak = $verpakService->getVerpakOverzicht();
        $idWijn = $_GET["id"];

        if ($_GET["action"] == "select") {
            if ($_POST["aantal"]>0) {
                $wijnId = $_GET["id"];
                $wijnselect = $wijnService->getIdOfWijn($wijnId);
                $aantal = $_POST["aantal"];
                $prijs = $wijnselect->getPrijs();
                $naamWijn = $wijnselect->getNaam();
                $artcode = $wijnService->getArtcodeById($wijnId);
                $subtotaal = $aantal*$prijs;
                $wijnArray["id"]= $wijnId;
                $wijnArray["artcode"] = $artcode;
                $wijnArray["naam"]= $naamWijn;
                $wijnArray["prijs"]= $prijs;
                $wijnArray["aantal"]= $aantal;
                $wijnArray["subtotaal"]= $subtotaal;
                $_SESSION["mandje"] = $wijnService->insertWinkelmandje($wijnArray, $_SESSION["mandje"]);
                $_SESSION["aantal"] += $aantal; 
                $_SESSION["totaal"] += $subtotaal;

                $verpakId = $_POST["verpak"];
                if ($verpakId >1) {
                    $verpakSelect = $verpakService->getIdOfVerpak($verpakId); 
                    $prijsVerpak = $verpakSelect->getPrijs();
                    $naamVerpak = $verpakSelect->getNaam();
                    $artcodeVerpak = $verpakService->getArtcodeById($verpakId);
                    $aantalVerpak = 1;
                    $verpakArray["idVerpak"]= $verpakId;
                    $verpakArray["artcodeVerpak"] = $artcodeVerpak;
                    $verpakArray["naamVerpak"]= $naamVerpak;
                    $verpakArray["prijsVerpak"]= $prijsVerpak;
                    $verpakArray["aantalVerpak"]= $aantalVerpak;
                    $verpakArray["subVerpak"] = $prijsVerpak;
                    $_SESSION["mandjeVerpak"] = $wijnService->insertWinkelmandje($verpakArray, $_SESSION["mandjeVerpak"]);
                    $_SESSION["aantalVerpak"] += $aantalVerpak; 
                    $_SESSION["totaal"] += $prijsVerpak;
                } else {}
            }
        }
        if (isset($_GET["action"]) && $_GET["action"]== "verwijdart") {
            $key = $_GET["item"];
            $selectedDelete = $_SESSION["mandje"][$key];
            $deleteSub = $selectedDelete["subtotaal"];
            if ($_SESSION["totaal"] > 0){
                $_SESSION["totaal"] -= $deleteSub;          
            } else {
                $_SESSION["totaal"] = 0;
            }
            $deleteAantal = $selectedDelete["aantal"];print_r($deleteAantal);
            if($_SESSION["aantal"] > 0) {
                $_SESSION["aantal"] -= $deleteAantal;          
            } else {
                $_SESSION["aantal"] = 0;
            }
            unset($_SESSION["mandje"][$key]);
            header("Location: winkelmandje.php");
            exit(0);  
        }
        if (isset($_GET["action"]) && $_GET["action"]== "verwijdVerpak") {
            $key = $_GET["verpak"];
            $selectedDeleteVerpak = $_SESSION["mandjeVerpak"][$key];
            $deleteSub = $selectedDeleteVerpak["subVerpak"];
            if($_SESSION["totaal"] > 0) {
                $_SESSION["totaal"] -= $deleteSub;          
            } else {
                $_SESSION["totaal"] = 0;
            }
            $deleteAantalVerpak = $selectedDeleteVerpak["aantalVerpak"];
            if($_SESSION["aantalVerpak"] > 0) {
                $_SESSION["aantalVerpak"] -= $deleteAantalVerpak;          
            } else {
                $_SESSION["aantalVerpak"] = 0;
            }
            unset($_SESSION["mandjeVerpak"][$key]);
            header("Location: winkelmandje.php");
            exit(0);  
        }    
    }    
$view = $twig->render("selected.twig", array("mandjeVerpak" => $_SESSION["mandjeVerpak"],
    "aantalverpak" => $_SESSION["aantalVerpak"], 
    "verpakking" => $verpak ,"aantal" => $_SESSION["aantal"], 
    "wijn" => $wijn, "mandje" => $_SESSION["mandje"], "totaal" => $_SESSION["totaal"]));
print($view);


