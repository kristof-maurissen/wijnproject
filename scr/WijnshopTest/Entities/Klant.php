<?php
//scr/WijnshopTest/Entities/Klant.php

namespace WijnshopTest\Entities;

class Klant{
    
    private static $idMap = array();
    
    private $idklant;
    private $naam;
    private $voornaam;
    private $straat;
    private $nr;
    private $postcode;
    private $gemeente;
    private $wachtwoord;
    private $email;
    
    
    
    private function __construct($idKlant, $naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {
        $this->idklant = $idKlant;
        $this->naam =$naam;
        $this->voornaam = $voornaam;
        $this->straat = $straat;
        $this->nr = $nr;
        $this->postcode = $postcode;
        $this->gemeente = $gemeente;
        $this->wachtwoord = $wachtwoord;
        $this->email = $email; 
    }
    
    public static function create($idKlant, $naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email) {
        if (!isset(self::$idMap[$idKlant])) {
            self::$idMap[$idKlant] = new Klant($idKlant, $naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email);
        }
        return self::$idMap[$idKlant];
    }
    
    public function getIdKlant(){
        return $this->idklant;
    }
    public function getNaam() {
        return $this->naam;  
    }
    public function getVoornaam() {
        return $this->voornaam;  
    }
    public function getStraat() {
        return $this->straat;  
    }
    public function getNr() {
        return $this->nr;  
    }
    public function getPostcode() {
        return $this->postcode;  
    }
    public function getGemeente() {
        return $this->gemeente;  
    }
    public function getWachtwoord(){
        return $this->wachtwoord;
    }
    public function getEmail(){
        return $this->email;
    }
    
    
    public function setNaam($naam) {
        $this->naam = $naam;
    }
    public function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }
    public function setStraat($straat) {
        $this->straat = $straat;
    }
    public function setNr($nr) {
        $this->nr = $nr;
    }
    public function setPostcode($postcode) {
        $this->postcode = $postcode;
    }
    public function setGemeente($gemeente) {
        $this->gemeente = $gemeente;
    }
    public function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }
    public function setEmail($email) {
        $this->email = $email;
    }           
}

