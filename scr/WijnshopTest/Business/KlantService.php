<?php
//scr/WijnshopTest/Business/KlantService.php

namespace WijnshopTest\Business;
use WijnshopTest\Data\KlantDAO;
use WijnshopTest\Exceptions\InvalidPasswordException;
use WijnshopTest\Exceptions\GeenLegeInputException;
use WijnshopTest\Exceptions\NoValidEmailException;
use WijnshopTest\Exceptions\FouteLoginException;

class KlantService {
    
    public function getKlantOverzicht() {
        $klantDao = new KlantDAO(); 
        $lijst = $klantDao->getAll(); 
        return $lijst; 
    }
    
    public function getKlantByEmail($email){
        $klantDao = new KlantDAO();
        $klant = $klantDao->getKlantEmail($email);
        return $klant;
    }
    
       public function getKlantId($email) { 
        $klantDao = new KlantDAO();    
        $klant = $klantDao->getKlantEmail($email);
        $id = $klant->getIdKlant();
        return $id;
    }
    
        public function getKlantById($idklant){ 
        $klantDao = new KlantDAO();
        $klant = $klantDao->getById($idklant);
        return $klant;
    }

    public function newKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {
        
        $checkLegeInput = $this->checkLeegInput($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
        if (is_null($checkLegeInput)){
            throw new GeenLegeInputException();
        }
        $wachtwoordchecked = $this->checkWachtwoord($wachtwoord);
        if (is_null($wachtwoordchecked)){
            throw new InvalidPasswordException();
        }
        $inValidEmail = $this->valEmail($email);
        if (is_null($inValidEmail)){
            throw new NoValidEmailException();
        }
        $klantDao = new KlantDAO();
        $klantDao->createKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);   
    }
    
    public function checkWachtwoord($wachtwoord) {
        if(
          // check op lengte, lowercase, uppercase, cijfer
            strlen($wachtwoord) > 6   &&  strlen($wachtwoord) < 32 &&   // lengte
            preg_match('/[a-z]/', $wachtwoord) &&     // heeft lowercase
            preg_match('/[A-Z]/', $wachtwoord)      // heeft uppercase
            ){ 
            $passed_count = 0;
            if( preg_match('/[0-9]/', $wachtwoord) ) { $passed_count++; }  // heeft cijfer
            if( $passed_count > 0 ) {
            return true; // valid wachtwoord
        }  
        }else{
            return null ; // Novalid wachtwoord !!!!!
        }  
    }
    
    public function checkLeegInput($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {
        if (empty($naam) || empty($voornaam) || empty($straat) || empty($nr) || empty($postcode) || empty($gemeente)|| empty($wachtwoord) || empty($email)) {
            return null;
        }else{
            return true;
        }
    }
    
    public function valEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true){ 
            return null;
            }else{
             return true;
            }
    }
    
    public function controlKlant($email, $wachtwoord) {
        $klantDao = new KlantDAO();
        $klant = $klantDao->getKlantEmail($email);
        if (!isset($klant)) {
            throw new FouteLoginException(); 
        }
        if (isset($klant) && $klant->getWachtwoord() != sha1($email . $wachtwoord)){
            throw new FouteLoginException();
        }else{
        return true;
        } 
    }
    
    public function controleerGeregistreerd($email) {
        $klantDao = new KlantDAO();
        $klant = $klantDao->getKlantEmail($email);
        if (isset($klant)) {
            return true;
        } else {
            return false;
        }
    }
}

