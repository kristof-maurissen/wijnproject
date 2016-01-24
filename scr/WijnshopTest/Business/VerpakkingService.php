<?php
//scr/WijnshopTest/Business/VerpakkingService.php

namespace WijnshopTest\Business;
use WijnshopTest\Data\VerpakkingDAO;


class VerpakkingService {
    
    public function getVerpakOverzicht() {
        $verpakDAO = new VerpakkingDAO(); 
        $lijst = $verpakDAO->getAll(); 
        return $lijst; 
    }
    
    public function getIdOfVerpak($id) {
        $verpakDAO = new VerpakkingDAO();
        $lijst = $verpakDAO->getVerpakById($id);
        return $lijst;
    }
    
    public function getArtcodeById($id) {
        $verpakDAO = new VerpakkingDAO();
        $verpak = $verpakDAO->getVerpakByID($id);
        $artcode = $verpak->getArtcode();
        return $artcode;
    }
    
    public function newVerpak($naam, $aantalinhoud, $artcode, $prijs) {       
        $verpakDAO = new VerpakkingDAO();
        $verpak = $verpakDAO->createWijn($naam, $aantalinhoud, $artcode, $prijs);
            if (isset($verpak)){
                return true;
            }else{
                return false;
            } 
    }
}

