<?php
//WijnProject/login.php
use WijnshopTest\Business\KlantService;
use WijnshopTest\Exceptions\FouteLoginException;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");
//error_reporting(0); // Of php.ini aanpassen : error_reporting
session_start();

$error = "";
$email = "";
$wachtwoord = "";
    
    if (isset($_GET["action"])) {
        $email =      trim(htmlspecialchars($_POST["txtEmail"], ENT_QUOTES));
        $wachtwoord = trim(htmlspecialchars($_POST["txtWachtwoord"], ENT_QUOTES));
        
        if ($_GET["action"] == "aanmelden") {
                $klantService = new KlantService();

            try {   
                $klantService->controlKlant($email, $wachtwoord);
                $id = $klantService->getKlantId($email);
                $_SESSION["aangemeld"] = true;
                $_SESSION["id"] = $id;
                header ("location: index.php"); 
                exit(0);

            } catch (FouteLoginException $fle){
                header ("location: login.php?error=fouteInlog");
                exit(0);
            }
        }
    }else if (isset($_GET["error"])) {
    $error = $_GET["error"];
    }

$view = $twig->render("Login.twig", array("error" => $error));
print($view);

