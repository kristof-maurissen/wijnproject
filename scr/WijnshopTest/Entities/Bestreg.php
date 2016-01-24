<?php
//scr/WijnshopTest/Entities/Bestreg.php

namespace WijnshopTest\Entities;

class Bestreg{
    
    private static $idMap = array();
    
    private $idbestreg;
    private $idbestel;
    private $artcode;
    private $aantal;
    private $prijs;
    
    private function __construct($idbestreg, $idbestel, $artcode, $aantal, $prijs) {
        $this->idbestreg = $idbestreg;
        $this->idbestel = $idbestel;
        $this->artcode =$artcode;
        $this->aantal = $aantal;
        $this->prijs = $prijs;
    }
    
    public static function create($idbestreg, $idbestel, $artcode, $aantal, $prijs) {
        if (!isset(self::$idMap[$idbestreg])) {
            self::$idMap[$idbestreg] = new Bestreg($idbestreg, $idbestel, $artcode, $aantal, $prijs);
        }
        return self::$idMap[$idbestreg];
    }
    
    public function getIdBestreg(){
        return $this->idbestreg;
    }
    public function getIdBestel(){
        return $this->idbestel;
    }
    public function getArtcode() {
        return $this->artcode;  
    }
    public function getAantal() {
        return $this->aantal;  
    }
    public function getPrijs() {
        return $this->prijs;  
    }
    
   
     
    public function setIdBestel($idbestel) {
        $this->idbestel = $idbestel;  
    }
    public function setArtcode($artcode) {
        $this->artcode = $artcode;  
    }
    public function setAantal($aantal) {
         $this->aantal = $aantal;  
    }
    public function setPrijs($prijs) {
         $this->prijs = $prijs;  
    }
}

