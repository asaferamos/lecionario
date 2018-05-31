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
        
        $this->year = (int)$year;
        self::setYearLiturgic();
        self::createPeriods();
        
        dd($this->periods);
        // echo $this->yearLiturgic;
    }
    
    public function nextSunday(){
        $carbon = new Carbon('next sunday');
        // var_dump($carbon->getTimestamp());
    }
    
    private function getSundayDayBefore($code){
        $next = new Carbon('next sunday ' . self::getEspecialDay($code)['date']);
        return $next;
    }
    
    private function getEspecialDay($code){
        return $this->periods[$code];
    }
    
    private function createPeriods(){
        // Easter
        self::setEspecialDay('Ress', Carbon::now()->timestamp(easter_date($this->year)));
        
        // Epiphany of the Lord
        self::setEspecialDay('EpDy', Carbon::create($this->year,1,6,0,0));
        
        // All Saints Day
        self::setEspecialDay('AllS', Carbon::create($this->year,11,1,0,0));
        
        // Nativity of the Lord - Christmas
        self::setEspecialDay('Natv', Carbon::create($this->year,12,24,0,0));
        
        // New Years Day
        self::setEspecialDay('NYDy', new Carbon('first day of January ' . $this->year));
        
        // First Sunday of christmas
        self::setEspecialDay('Xmas01', new Carbon('next sunday ' . self::getEspecialDay('Natv')['date']));
        
        // Second Sunday of christmas
        // Sunday between January 2 and January 5
        $observed = (self::getSundayDayBefore('NYDy')->between(Carbon::create(($this->year+1),1,2),Carbon::create(($this->year+1),1,5))) ? true : false;
        self::setEspecialDay('Xmas02', new Carbon('first sunday of January ' . ($this->year+1)), $observed);
        
        
        
        // First Sunday after Epiphany or Baptism of the Lord ( Ordinary 1 )
        self::setEspecialDay('Epip01', new Carbon('next sunday ' . self::getEspecialDay('EpDy')['date']));
        
        // Second Sunday after Epiphany ( Ordinary 2 )
        self::setEspecialDay('Epip02', new Carbon('next sunday ' . self::getEspecialDay('Epip01')['date']));
        
        // Third Sunday after Epiphany ( Ordinary 3 )
        self::setEspecialDay('Epip03', new Carbon('next sunday ' . self::getEspecialDay('Epip02')['date']));
        
        // Fourth Sunday after Epiphany ( Ordinary 4 )
        self::setEspecialDay('Epip04', new Carbon('next sunday ' . self::getEspecialDay('Epip03')['date']));
        
        // Fifth Sunday after Epiphany ( Ordinary 5 )
        self::setEspecialDay('Epip05', new Carbon('next sunday ' . self::getEspecialDay('Epip04')['date']));
        
        // Sixth Sunday after Epiphany - Proper 1 ( Ordinary 6 )
        self::setEspecialDay('Epip06', new Carbon('next sunday ' . self::getEspecialDay('Epip05')['date']));
        
        // Seventh Sunday after Epiphany - Proper 2 ( Ordinary 7 )
        self::setEspecialDay('Epip07', new Carbon('next sunday ' . self::getEspecialDay('Epip06')['date']));
        
        // Eighth Sunday after Epiphany - Proper 3 ( Ordinary 8 )
        self::setEspecialDay('Epip08', new Carbon('next sunday ' . self::getEspecialDay('Epip07')['date']));
        
        // Ninth Sunday after Epiphany - Proper 4 ( Ordinary 9 )
        self::setEspecialDay('Epip09', new Carbon('next sunday ' . self::getEspecialDay('Epip08')['date']));
        
        // Transfiguration Sunday (or Last Sunday after Epiphany)
        self::setEspecialDay('Tran', new Carbon('next sunday ' . self::getEspecialDay('Epip09')['date']));
        
        
        
        // Ash Wednesday
        self::setEspecialDay('AshW', Carbon::now()->timestamp(easter_date($this->year))->subDays(46));
        
        // First Sunday in Lent
        self::setEspecialDay('Lent01', new Carbon('next sunday ' . self::getEspecialDay('AshW')['date']));
        
        // Second Sunday in Lent
        self::setEspecialDay('Lent02', new Carbon('next sunday ' . self::getEspecialDay('Lent01')['date']));
        
        // Third Sunday in Lent
        self::setEspecialDay('Lent03', new Carbon('next sunday ' . self::getEspecialDay('Lent02')['date']));
        
        // Fourth Sunday in Lent
        self::setEspecialDay('Lent04', new Carbon('next sunday ' . self::getEspecialDay('Lent03')['date']));
        
        // Fifth Sunday in Lent
        self::setEspecialDay('Lent05', new Carbon('next sunday ' . self::getEspecialDay('Lent04')['date']));
        
        // Passion Sunday or Palm Sunday
        self::setEspecialDay('Palm', new Carbon('next sunday ' . self::getEspecialDay('Lent05')['date']));
        
        
        
        // Monday of Holy Week
        self::setEspecialDay('Holy01', new Carbon('next day ' . self::getEspecialDay('Palm')['date']));
        
        // Tuesday of Holy Week
        self::setEspecialDay('Holy02', new Carbon('next day ' . self::getEspecialDay('Holy01')['date']));
        
        // Wednesday of Holy Week
        self::setEspecialDay('Holy03', new Carbon('next day ' . self::getEspecialDay('Holy02')['date']));
        
        // Holy Thursday
        self::setEspecialDay('Holy04', new Carbon('next day ' . self::getEspecialDay('Holy03')['date']));
        
        // Good Friday
        self::setEspecialDay('Holy05', new Carbon('next day ' . self::getEspecialDay('Holy04')['date']));
        
        // Holy Saturday
        self::setEspecialDay('Holy06', new Carbon('next day ' . self::getEspecialDay('Holy05')['date']));
        
        
        
        // Easter Vigil
        self::setEspecialDay('Vigl', new Carbon('next day ' . self::getEspecialDay('Holy06')['date']));
        
        // Second Sunday of Easter
        self::setEspecialDay('East02', new Carbon('next sunday ' . self::getEspecialDay('Vigl')['date']));
        
        // Third Sunday of Easter
        self::setEspecialDay('East03', new Carbon('next sunday ' . self::getEspecialDay('East02')['date']));
        
        // Fourth Sunday of Easter
        self::setEspecialDay('East04', new Carbon('next sunday ' . self::getEspecialDay('East03')['date']));
        
        // Fifth Sunday of Easter
        self::setEspecialDay('East05', new Carbon('next sunday ' . self::getEspecialDay('East04')['date']));
        
        // Sixth Sunday of Easter
        self::setEspecialDay('East06', new Carbon('next sunday ' . self::getEspecialDay('East05')['date']));
        
        // Sixth Sunday of Easter
        self::setEspecialDay('Ascn', new Carbon('next thursday ' . self::getEspecialDay('East06')['date']));
        
        // Seventh Sunday of Easter
        self::setEspecialDay('East07', new Carbon('next sunday ' . self::getEspecialDay('East06')['date']));
        
        
        
        // Day of Pentecost
        self::setEspecialDay('PDay', new Carbon('next sunday ' . self::getEspecialDay('East07')['date']));
        
        // Triniy Sunday (First Sunday after Pentecost)
        self::setEspecialDay('Trin', new Carbon('next sunday ' . self::getEspecialDay('PDay')['date']));

        // Set Propers dates
        $firstProper = self::getFirstProperAfterPentecost();
        for ($proper = 3; $proper <= 29; $proper++) {
            $observed = ($proper < $firstProper) ? false : true;

            $beforeProper = (($proper-1) < 10) ? 'Prop0' . ($proper-1) : 'Prop' . ($proper-1);
            
            if($proper == $firstProper || $proper == 3){
                $beforeProper = 'Trin';
            }
            
            $stringProper = ($proper < 10) ? 'Prop0' . $proper : 'Prop' . $proper;
            self::setEspecialDay($stringProper, new Carbon('next sunday ' . self::getEspecialDay($beforeProper)['date']), $observed);
        }
        
        
        
        // First Sunday of Advent
        self::setEspecialDay('Advt01', new Carbon('next sunday ' . self::getEspecialDay('Prop29')['date']));
        
        // Second Sunday of Advent
        self::setEspecialDay('Advt02', new Carbon('next sunday ' . self::getEspecialDay('Advt01')['date']));
        
        // Third Sunday of Advent
        self::setEspecialDay('Advt03', new Carbon('next sunday ' . self::getEspecialDay('Advt02')['date']));
        
        // Fourth Sunday of Advent
        self::setEspecialDay('Advt04', new Carbon('next sunday ' . self::getEspecialDay('Advt03')['date']));
        
    }
    
    private function getFirstProperAfterPentecost(){
        $firstSunday = new Carbon('next sunday ' . self::getEspecialDay('Trin')['date']);
        
        // Proper 3 ( Ordinary 8 )
        // Sunday between May 24 and May 28 inclusive (if after Trinity Sunday)
        if(self::getSundayDayBefore('Trin')->between(Carbon::create($this->year,5,24),Carbon::create($this->year,5,28)))
            return 3;
        
        // Proper 4 ( Ordinary 9 )
        // Sunday between May 29 and Jun 4 inclusive (if after Trinity Sunday)
        if(self::getSundayDayBefore('Trin')->between(Carbon::create($this->year,5,29),Carbon::create($this->year,6,4)))
            return 4;
        
        // Proper 5 ( Ordinary 10 )
        // Sunday between June 5 and June 11 inclusive (if after Trinity Sunday)
        if(self::getSundayDayBefore('Trin')->between(Carbon::create($this->year,6,5),Carbon::create($this->year,6,11)))
            return 5;
        
        // Proper 6 ( Ordinary 11 )
        // Sunday between June 12 and June 18 inclusive (if after Trinity Sunday)
        if(self::getSundayDayBefore('Trin')->between(Carbon::create($this->year,6,12),Carbon::create($this->year,6,18)))
            return 6;
        
        // Proper 7 ( Ordinary 12 )
        // Sunday between June 19 and June 25 inclusive (if after Trinity Sunday)
        if(self::getSundayDayBefore('Trin')->between(Carbon::create($this->year,6,19),Carbon::create($this->year,6,25)))
            return 7;
    }
    
    private function setEspecialDay($code, Carbon $carbon, $observed = true){
        // $this->periods[$code] = $carbon->getTimestamp();
        $this->periods[$code] = [
            'date'     => $carbon,
            'observed' => $observed
        ];
        
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