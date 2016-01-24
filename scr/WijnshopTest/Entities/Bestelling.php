<?php
//scr/WijnshopTest/Entities/Bestelling.php

namespace WijnshopTest\Entities;

class Bestelling{
    
    private static $idMap = array();
    
    private $idbestel;
    private $idklant;
    private $prijstotaal;
    private $besteldatum;
    private $levering;
    

    private function __construct($idbestel, $idklant, $prijstotaal,$besteldatum, $levering) {
        $this->idbestel = $idbestel;
        $this->idklant =$idklant;
        $this->besteldatum = $besteldatum;
        $this->prijstotaal = $prijstotaal;
        $this->levering = $levering;
        
    }
    
    public static function create($idbestel, $idklant, $prijstotaal, $besteldatum, $levering ) {
        if (!isset(self::$idMap[$idbestel])) {
            self::$idMap[$idbestel] = new Bestelling($idbestel, $idklant, $prijstotaal, $besteldatum, $levering);
        }
        return self::$idMap[$idbestel];
    }
    
    public function getIdBestel(){
        return $this->idbestel;
    }
    public function getIdKlant() {
        return $this->idklant;  
    }
    public function getPrijsTotaal() {
        return $this->prijstotaal;  
    }
    public function getBestelDatum() {
        return $this->besteldatum;  
    }
    public function getLevering() {
        return $this->levering;  
    }

    
    public function setIdKlant($idklant) {
         $this->idklant = $idklant;  
    }
    public function setPrijsTotaal($prijstotaal) {
         $this->prijstotaal = $prijstotaal;  
    }
    public function setBestelDatum($besteldatum) {
         $this->besteldatum = $besteldatum;  
    }
    public function setLevering($levering) {
         $this->levering = $levering;  
    }        
}

