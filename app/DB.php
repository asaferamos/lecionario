<?php
 
namespace app;

class DB extends \PDO{
    public function __construct(){
        parent::__construct('sqlite:' . DB_SQLITE);
    }
}