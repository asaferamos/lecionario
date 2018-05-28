<?php
namespace App\Controllers;
use \App\Models\LectionaryModel;
use \App\Log;
use \App\Controllers\Periods;


class Lectionary extends Controller{
    private $day;
    private $year;
    private $yearLiturgic;
    
    public function __construct($year = null){
        if(is_null($year))
            $year = date('Y');
        
        self::setYearLiturgic($year);
        
        echo $this->yearLiturgic;
    }
    
    private function setYearLiturgic($year){
        if($year <= 1992){
            return false;
        }
        
        $this->$year = $year;
        $firstYearA  = 1993;
        
        $diffYear = $year - $firstYearA;
        $diffYearRest = $diffYear % 3;
        
        switch ($diffYearRest) {
            case 0:
                $this->yearLiturgic = 'A';
                break;
            
            case 1:
                $this->yearLiturgic = 'B';
                break;
            
            case 2:
                $this->yearLiturgic = 'C';
                break;
        }
        
        return true;
    }
}