<?php
//scr/WijnshopTest/Data/VerpakkingDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Verpakking;
use PDO;

class VerpakkingDAO {
    
    public function getAll() {
        $sql = "select * from verpakking"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array(); 
        
        foreach ($resultSet as $rij) {
            $verpakking = Verpakking::create($rij["idverpak"], $rij["naam"], $rij["aantalinhoud"], $rij["artcode"], $rij["prijs"]); 
            array_push($lijst, $verpakking);   
        } 
            $dbh = null; 
            return $lijst;       
    }
    
    public function getVerpakByID($idverpak) {
        $sql = "select * from verpakking where idverpak = :idverpak";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idverpak' => $idverpak)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $verpakking = Verpakking::create($rij["idverpak"], $rij["naam"], $rij["aantalinhoud"], $rij["artcode"], $rij["prijs"]);

        $dbh = null; 
        return $verpakking; 
    } 
}

