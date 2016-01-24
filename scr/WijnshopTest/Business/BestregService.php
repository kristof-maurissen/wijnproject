<?php
//scr/WijnshopTest/Business/BestregService.php

namespace WijnshopTest\Business;

use WijnshopTest\Data\BestregDAO;

class BestregService{
    
    public function getBestreg($bestelid){
        $bestregDAO = new BestregDAO();
        $bestreg = $bestregDAO->getBestelId($bestelid);
        return $bestreg;
    }
    
    public function newBestreg($bestelid, $artcode, $aantal, $prijs){
        $bestregDAO = new BestregDAO();
        $bestregDAO->create($bestelid, $artcode, $aantal, $prijs);
    }    
}

