<?php
//WijnProject/winkelmandje.php
require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");
//error_reporting(0); // Of php.ini aanpassen : error_reporting
session_start();

    if(!isset($_SESSION["mandje"])) {
        $_SESSION["mandje"] = array();
        $_SESSION["mandjeVerpak"] = array();
        $_SESSION["totaal"] = 0;
        $_SESSION["aantal"] = 0;
        $_SESSION["aantalVerpak"] = 0;
        }

    $mandje = $_SESSION["mandje"];
    $mandjeVerpak = $_SESSION["mandjeVerpak"];
    $totaal = $_SESSION["totaal"];
    $aantal = $_SESSION["aantal"];
    $aantalVerpak = $_SESSION["aantalVerpak"];
    
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

$view = $twig->render("Winkelmandje.twig", array( "mandje" => $mandje, "totaal" => $totaal, 
    "mandjeVerpak" => $mandjeVerpak, "aantal" => $aantal, "aantalVerpak" => $aantalVerpak));
print($view);