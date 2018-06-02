<?php
namespace Lectionary;
use Lectionary\Model;
use Lectionary\Reading;

class Day{
    private $readings = [];
    
    public function __construct($code){
        $day = Model::getEspecialDay($code);
        
        foreach ($day as $key => $reading) {
            $o = new Reading($reading);
            $this->readings[] = $o;
        }
    }
    
    public function getDay(){
        return $this->readings;
    }
}