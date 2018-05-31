<?php
 
namespace Lectionary;

class DB extends \PDO{
    public function __construct(){
        $DB_SQL 'data/lectionary.db';
        parent::__construct('sqlite:' . $DB_SQL);
    }
}