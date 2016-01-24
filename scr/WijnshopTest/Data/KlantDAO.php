<?php
//scr/WijnshopTest/Data/KlantDAO.php

namespace WijnshopTest\Data;

use WijnshopTest\Data\DBConfig;
use WijnshopTest\Entities\Klant;
use WijnshopTest\Exceptions\EmailBestaatException;
use PDO;

class KlantDAO {
    
    public function getAll() {
        $sql = "select * from klant"; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array(); 
        
        foreach ($resultSet as $rij) {
            $klanten = Klant::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["wachtwoord"], $rij["email"]); 
            array_push($lijst, $klanten);  
        } 
            $dbh = null; 
            return $lijst;       
    }
    
    public function createKlant($naam, $voornaam, $straat, $nr, $postcode, $gemeente, $wachtwoord, $email){
        $bestaandEmail = $this->getKlantEmail($email);
        if (!is_null($bestaandEmail)){
            throw new EmailBestaatException();
        }
       
        $wachtwoordsha = sha1($email . $wachtwoord);
       
        $sql = "insert into klant (naam, voornaam, straat, nr, postcode, gemeente, wachtwoord,email) "
                . "values(:naam, :voornaam, :straat, :nr, :postcode, :gemeente, :wachtwoordsha, :email)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":naam" => $naam, ":voornaam" => $voornaam, ":straat" => $straat, ":nr" => $nr, ":postcode" => $postcode, ":gemeente" => $gemeente, ":wachtwoordsha" => $wachtwoordsha, ":email" => $email));
        $dbh = null;
    }
     
    public function getKlantEmail($email) {
        $sql = "select * from klant where email = :email";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':email' => $email)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rij) {
            return null;
        }else{ 
        $klant = Klant::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"],$rij["wachtwoord"], $rij["email"]);
        
        $dbh = null; 
        return $klant;
        }
    }

    public function getById($idKlant) {
        $sql = "select * from klant where idklant = :idKlant";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idKlant' => $idKlant)); 
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $klant = Klant::create($rij["idklant"], $rij["naam"], $rij["voornaam"], $rij["straat"], $rij["nr"], $rij["postcode"], $rij["gemeente"], $rij["wachtwoord"], $rij["email"]);
        
        $dbh = null; 
        return $klant; 
    }
    
    public function deleteKlant($idKlant) { 
        $sql = "delete from klant where idklant = :idKlant" ; 
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':idKlant' => $idKlant)); 
        $dbh = null;    
    }
    
}

