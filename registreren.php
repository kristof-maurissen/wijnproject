<?php
//WijnProject/registreren.php
use WijnshopTest\Business\KlantService;
use WijnshopTest\Exceptions\EmailBestaatException;
use WijnshopTest\Exceptions\InvalidPasswordException;
use WijnshopTest\Exceptions\GeenLegeInputException;
use WijnshopTest\Exceptions\NoValidEmailException;

require_once ("Bootstrap.php");
require_once ("Libraries/Twig/AutoLoader.php");
//error_reporting(0); // Of php.ini aanpassen : error_reporting
session_start();

$error = "";

    if (isset($_GET["action"])) {
        $naam =       trim(htmlspecialchars($_POST["naam"], ENT_QUOTES));
        $voornaam =   trim(htmlspecialchars($_POST["voornaam"], ENT_QUOTES));
        $straat =     trim(htmlspecialchars($_POST["straat"], ENT_QUOTES));
        $nr =         trim(htmlspecialchars($_POST["nr"], ENT_QUOTES));
        $postcode =   trim(htmlspecialchars($_POST["postcode"], ENT_QUOTES));
        $gemeente =   trim(htmlspecialchars($_POST["gemeente"], ENT_QUOTES));
        $wachtwoord = trim(htmlspecialchars($_POST["wachtwoord"], ENT_QUOTES));
        $email =      trim(htmlspecialchars($_POST["email"], ENT_QUOTES));

        if ($_GET["action"] == "registreer") { 
            $klantService = new KlantService();
            try {
                $klantService->newKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
                header ("location: login.php"); 
                exit(0);

            } catch (GeenLegeInputException $se) {
                    header ("location: registreren.php?error=leegInput");
                    exit(0);
            } catch (InvalidPasswordException $e) {
                    header ("location: registreren.php?error=wachtwoord");
                    exit(0);
            } catch (EmailBestaatException $ex) {
                    header ("location: registreren.php?error=emailBestaat");
                    exit(0);
            }  catch (NoValidEmailException $ex) {
                    header ("location: registreren.php?error=noValidEmail");
                    exit(0);
            }

            }
        }elseif(isset($_GET["error"])) {
            $error = $_GET["error"]; 
    }

$view = $twig->render("Registreren.twig", array("error" => $error));
print($view);


