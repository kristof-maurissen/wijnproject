<?php
//scr/WijnshopTest/Business/BestellingService.php

namespace WijnshopTest\Business;

use WijnshopTest\Data\BestellingDAO;

class BestellingService{
    
    public function newBestelling($idklant, $prijstotaal, $besteldatum,  $levering){
        $bestelDAO = new BestellingDAO();
        $bestelling = $bestelDAO->createBestel($idklant, $prijstotaal, $besteldatum,  $levering);
        return $bestelling;
    }
    
    public function getBestelling($idbestel){
        $bestelDAO = new BestellingDAO();
        $bestelling = $bestelDAO->getBestelByIdbestel($idbestel);
        return $bestelling;
    }
    
}

