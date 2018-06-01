<?php
namespace Lectionary;
use Lectionary\DB;
use \PDO;

class Model {

    public static function getAllReadingsByYear($year){
        $DB    = new DB;
        $query = $DB->prepare("SELECT * FROM lectionary WHERE year = :year");
        $query->bindValue('year', $year);
        $query->execute();
        
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public static function getEspecialDay($code){
        $DB    = new DB;
        $query = $DB->prepare("SELECT * FROM lectionary WHERE vanderbilt_code = :vanderbilt_code");
        $query->bindValue('vanderbilt_code', $code);
        $query->execute();
        
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public static function getLiturgicalName($code){
        $DB    = new DB;
        $query = $DB->prepare("SELECT liturgical_name FROM lectionary WHERE vanderbilt_code = :vanderbilt_code");
        $query->bindValue('vanderbilt_code', $code);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_NUM)[0];
    }
}