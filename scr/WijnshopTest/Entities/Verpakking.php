<?php
//scr/WijnshopTest/Entities/Verpakking.php
namespace WijnshopTest\Entities;

class Verpakking{
    
    private static $idMap = array();
    
    private $idverpak;
    private $naam;
    private $aantalinhoud;
    private $artcode;
    private $prijs;
    
    private function __construct($idverpak, $naam, $aantalInhoud, $artcode, $prijs) {
        $this->idverpak = $idverpak;
        $this->naam =$naam;
        $this->aantalinhoud = $aantalInhoud;
        $this->artcode = $artcode;
        $this->prijs = $prijs;
    }
    
    public static function create($idverpak, $naam, $aantalInhoud, $artcode, $prijs) {
        if (!isset(self::$idMap[$idverpak])) {
            self::$idMap[$idverpak] = new Verpakking($idverpak, $naam, $aantalInhoud, $artcode, $prijs);
        }
        return self::$idMap[$idverpak];
    }
    
    public function getIdVerpak(){
        return $this->idverpak;
    }
    public function getNaam() {
        return $this->naam;  
    }
    public function getAantalInhoud() {
        return $this->aantalinhoud;  
    } 
    public function getArtcode(){
        return $this->artcode;
    }
    public function getPrijs(){
        return $this->prijs;
    }
    
    public function setNaam($naam) {
        $this->naam = $naam;
    }
    public function setAantalInhoud($aantalInhoud) {
        $this->aantalinhoud = $aantalInhoud;
    } 
    public function setArtcode($artcode) {
        $this->artcode = $artcode;
    }
    public function setPrijs($prijs) {
        $this->prijs = $prijs;
    }           
}

