<?php
//WijnProject/afrekenen.php
use WijnshopTest\Business\BestregService;
use WijnshopTest\Business\BestellingService;

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
        $_SESSION["totaal"] = $_SESSION["totaal"];
        $error = "";
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "bestellen") {
            if (($_SESSION["aangemeld"]) == false){
               header("location:afrekenen.php?error=notLogin");  
            }   
            if (($_SESSION["aangemeld"]) == true){
                $aantal= 0;
                $bestellingService = new BestellingService();
                $aantalbesteld = $_SESSION["aantal"];
                $levering = $_POST["levering"]; 
                    if(($aantalbesteld < 4) && $levering == 1 ){
                        $_SESSION["totaal"] += "3";
                    } elseif (($aantalbesteld > 4) && $levering == 1 ) {
                        $levering = 2;
                    } 
                $tijdstip = date("Y-m-d H:i:s");
                $totaalprijs = $_SESSION["totaal"];
                $klant = ($_SESSION["id"]);
                $_SESSION["bestellingId"] = $bestellingService->newBestelling($klant, $totaalprijs, $tijdstip, $levering);  
                $bestregService = new BestregService();
                foreach($_SESSION["mandje"] as $regel) {
                    $artcodeWijn = $regel["artcode"];
                    $prijsWijn = $regel["prijs"];
                    $aantalWijn = $regel["aantal"];
                    $_SESSION["bestellingId"] = $_SESSION["bestellingId"];
                    $bestregService->newBestreg($_SESSION["bestellingId"], $artcodeWijn, $aantalWijn, $prijsWijn);   
                }    
                foreach ($_SESSION["mandjeVerpak"] as $bestel) {
                    $artcodeVerpak = $bestel["artcodeVerpak"];
                    $prijsVerpak = $bestel["prijsVerpak"];
                    $aantalVerpak = $bestel["aantalVerpak"];
                    $bestregService->newBestreg($_SESSION["bestellingId"], $artcodeVerpak, $aantalVerpak, $prijsVerpak);
                } $bestelId = $_SESSION["bestellingId"];
            unset($_SESSION["aangemeld"]);
            unset($_SESSION["mandje"]);
            unset($_SESSION["mandjeVerpak"]);
            unset($_SESSION["id"]);
            unset($_SESSION["bestellingId"]); 
            unset($_SESSION["totaal"]);
            header("location:index.php");
            exit(0);    
            }
            }
        }elseif(isset($_GET["error"])) {
            $error = $_GET["error"]; 
        }
   
$view = $twig->render("Afrekenen.twig", array("mandje" => $_SESSION["mandje"], 
                      "totaal" => $_SESSION["totaal"], "error" => $error, 
                      "mandjeVerpak" => $_SESSION["mandjeVerpak"], "aantal" => $_SESSION["aantal"], 
                      "aantalVerpak" => $_SESSION["aantalVerpak"]));
print($view);

