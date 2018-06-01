<?php
namespace Lectionary;
use Lectionary\Model;
use Lectionary\Reading;

class Day{
    private $readings = [];
    
    public function __construct($yearLiturgic, $code){
        $day = Model::getAllReadingsByYear($yearLiturgic);
        dd($day);
        foreach ($day as $key => $reading) {
            $o = new Reading($reading);
            $this->readings[] = $o;
        }
        // die;
    }
}