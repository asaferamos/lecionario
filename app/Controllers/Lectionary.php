<?php
namespace App\Controllers;
use \App\Models\LectionaryModel;
use \App\Log;
use \App\Controllers\Periods;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class Lectionary extends Controller{
    private $day;
    private $year;
    private $yearLiturgic;
    private $periods = [];
    
    public function __construct($year = null){
        if(is_null($year))
            $year = date('Y');
        
        $this->year = $year;
        self::setYearLiturgic();
        self::createPeriods();
        
        dd($this->periods);
        // echo $this->yearLiturgic;
    }
    
    public function nextSunday(){
        $carbon = new Carbon('next sunday');
        // var_dump($carbon->getTimestamp());
    }
    
    private function createPeriods(){
        // New Years Day
        self::setPeriod('NYDy', new Carbon('first day of January ' . $this->year));
        
        // First sunday of christmas
        self::setPeriod('Xmas02', new Carbon('second sunday of January ' . $this->year));
        
        // Epiphany of the Lord
        self::setPeriod('EpDy', Carbon::create($this->year,1,6,0,0));
        
        // First sunday after epiphany or Baptism of the Lord
        self::setPeriod('EpDy', Carbon::create($this->year,1,6,0,0));
        
        // 'Primeiro Domingo após Epifania' => mktime(0, 0, 0, 1, 6 + (7 - $epifania), $year),
        // 'Segundo Domingo após Epifania'  => mktime(0, 0, 0, 1, 6 + (14 - $epifania), $year),
        // 'Terceiro Domingo após Epifania' => mktime(0, 0, 0, 1, 6 + (21 - $epifania), $year),
        // 'Quarto Domingo após Epifania'   => mktime(0, 0, 0, 1, 6 + (28 - $epifania), $year),
        // 'Quinto Domingo após Epifania'   => mktime(0, 0, 0, 1, 6 + (35 - $epifania), $year),
        // 'Domingo da Transfiguração'      => mktime(0, 0, 0, 1, 6 + (42 - $epifania), $year),
    }
    
    private function setPeriod($code, $carbon){    
        // $this->periods[$code] = $carbon->getTimestamp();
        $this->periods[$code] = $carbon;
        
        return $this->periods;
    }
    
    private function setYearLiturgic(){
        if($this->year <= 1992){
            return false;
        }
        
        $firstYearA  = 1993;
        
        $diffYear = $this->year - $firstYearA;
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