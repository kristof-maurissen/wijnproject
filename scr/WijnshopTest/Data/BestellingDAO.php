<?php
//scr/WijnshopTest/Data/BestellingDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Bestelling;
//use WijnshopTest\Entities\Klant;
use PDO;

class BestellingDAO {
    
    public function getBestelByIdbestel($idbestel) {
        $sql = "select * from bestelling where idbestel = :idbestel"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idbestel' => $idbestel)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $bestelling = Bestelling::create($rij["idbestel"], $rij["idklant"], $rij["prijstotaal"], $rij["besteldatum"], $rij["levering"] );
        $dbh = null; 
        return $bestelling; 
    }
    
    public function createBestel($idklant, $prijstotaal, $besteldatum, $levering) {
        
        $sql = "insert into bestelling (idklant, prijstotaal, besteldatum, levering) "
                . "values(:idklant, :prijstotaal, :besteldatum, :levering)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":idklant" => $idklant, ":prijstotaal" => $prijstotaal, ":besteldatum" => $besteldatum,  ":levering" => $levering));
        $bestellingId = $dbh->lastInsertId();
        $dbh = null;
        return $bestellingId;
        
    }
}







    /*public function getKlantId($idklant) {
        $sql = "select * from bestelling, klant where bestelling.idklant = :idklant"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idklant' => $idklant)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $klant = Klant::create($rij["klant.idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["email"]);
        $bestelling = Bestelling::create($rij["idbestel"], $klant, $rij["prijstotaal"], $rij["besteldata"], $rij["levering"] );
        $dbh = null; 
        return $bestelling; 
    }*/

