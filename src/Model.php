<?php
namespace Lectionary;
use Lectionary\DB;

class Model {

    public static function test(){
        $sql = "SELECT count(*) FROM lectionary";

        $DB = new DB;
        $result = $DB->prepare("SELECT count(*) FROM lectionary");
        $result->execute();
        
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}