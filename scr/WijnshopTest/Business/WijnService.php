<?php
//scr/WijnshopTest/Business/WijnService.php

namespace WijnshopTest\Business;
use WijnshopTest\Data\WijnDAO;


class WijnService {
    
    public function getWijnOverzicht() {
        $wijnDAO = new WijnDAO(); 
        $lijst = $wijnDAO->getAll(); 
        return $lijst; 
    }
    public function getOverzichtByCat($cat) {
        $wijnDAO = new WijnDAO();
        $lijst = $wijnDAO->getWijnByCat($cat);
        return $lijst;
    }
    public function getOverzichtByLand($land) {
        $wijnDAO = new WijnDAO();
        $lijst = $wijnDAO->getWijnByLand($land);
        return $lijst;
    }
    
    public function getOverzichtByJaar($jaar) {
        $wijnDAO = new WijnDAO();
        $lijst = $wijnDAO->getWijnByJaar($jaar);
        return $lijst;
    }
    
    public function getArtcodeById($id) {
        $wijnDAO = new WijnDAO();
        $wijn = $wijnDAO->getWijnByID($id);
        $artcode = $wijn->getArtCode();
        return $artcode;
    }
    
    public function getIdOfWijn($idwijn){
        $wijnDAO = new WijnDao();
        $lijst = $wijnDAO->getWijnByID($idwijn);
        return $lijst;
    }
    public function getSelectWijn($idwijn){
        $wijnDAO = new WijnDao();
        $lijst = $wijnDAO->getSelectWijnByID($idwijn);
        return $lijst;
    }

    public function insertWinkelmandje($item, $mandje){
        array_push($mandje, $item);
        return $mandje;
    }
    
    public function newWijn($naam, $jaartal, $land, $cat, $image, $artcode, $prijs) {       
        $wijnDAO = new WijnDAO();
        $wijn = $wijnDAO->createWijn($naam, $jaartal, $land, $cat, $image, $artcode, $prijs);
            if (isset($wijn)){
                return true;
            }else{
                return false;
            } 
    }
}    
    
  



    
   /* public function getTotaalWijn($id, $aantal){
        $wijnid = $this->getIdOfWijn($id);
        $wijn = $wijnid->getPrijs();
        $totaal = ($wijn*$aantal);
        return $totaal;
    } 
    public function getAantalWijnen($wijnen){
        $wijnArray = array();
        foreach($wijnen as $wijn){
            $naam = $wijn->getNaam();
            array_push($wijnArray, $naam);
        }
        $aantal = count($wijnArray);
        return $aantal;
    }*/

