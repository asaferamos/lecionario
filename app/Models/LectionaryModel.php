<?php
namespace App\Models;
use App\DB;

class LectionaryModel {

    public static function test(){
        $sql = "SELECT count(*) FROM lecionario;";

        $DB = new DB;
        $result = $DB->prepare("SELECT count(*) FROM lecionario");
        $result->execute();
        
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}