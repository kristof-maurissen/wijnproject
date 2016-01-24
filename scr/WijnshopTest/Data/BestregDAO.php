<?php
//scr/WijnshopTest/Data/BestregDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Bestreg;
use PDO;

class BestregDAO {
    
    public function getBestregId($bestelid) {
        $sql = "select * from bestelreg where idbestel = :bestelid"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':bestelid' => $bestelid)); 
        $resultSet = $stmt->fetchAll();
        $lijst = array();
        
        foreach ($resultSet as $rij) {
            $bestreg = Bestreg::create($rij["idbestreg"], $rij["idbestel"], $rij["artcode"], $rij["aantal"], $rij["prijs"]); 
            array_push($lijst, $bestreg);  
        } 
            $dbh = null; 
            return $bestreg;       
    }
    
    public function create($idbestel, $artcode, $aantal, $prijs) {

        $sql = "insert into bestelreg (idbestel, artcode, aantal, prijs) "
                . "values(:idbestel, :artcode, :aantal, :prijs)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":idbestel" => $idbestel, ":artcode" => $artcode, ":aantal" => $aantal, ":prijs" => $prijs));

        $dbh = null;
        
    }
}

