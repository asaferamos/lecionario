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
    private $especialDays = [];
    
    public function __construct($year = null){
        if(is_null($year))
            $year = date('Y');
        
        $this->year = (int)$year;
        self::setYearLiturgic();
        self::createPeriods();
        
        // return $this->especialDays;
        // echo $this->yearLiturgic;
    }
    
    public function nextSunday(){
        $carbon = new Carbon('next sunday');
        // var_dump($carbon->getTimestamp());
    }
    
    public function especialDays(){
        return $this->especialDays;
    }
    
    private function getSundayDayBefore($code){
        $next = new Carbon('next sunday ' . self::getEspecialDay($code)['date']);
        return $next;
    }
    
    private function getEspecialDay($code){
        return $this->especialDays[$code];
    }
    
    private function createPeriods(){
        // Easter
        self::setEspecialDay('Ress', Carbon::now()->timestamp(easter_date($this->year)));
        
        // Epiphany of the Lord
        self::setEspecialDay('EpDy', Carbon::create($this->year,1,6,0,0));
        
        // Ash Wednesday
        self::setEspecialDay('AshW', Carbon::now()->timestamp(easter_date($this->year))->subDays(46));
        
        // Transfiguration Sunday (or Last Sunday after Epiphany)
        self::setEspecialDay('Tran', self::getEspecialDay('AshW')['date']->copy()->modify('previous sunday'));
        
        // All Saints Day
        self::setEspecialDay('AllS', Carbon::create($this->year,11,1,0,0));
        
        // Nativity of the Lord - Christmas
        self::setEspecialDay('Natv', Carbon::create($this->year,12,24,0,0));
        
        // New Years Day
        self::setEspecialDay('NYDy', new Carbon('first day of January ' . $this->year));
        
        // First Sunday of christmas
        self::setEspecialDay('Xmas01', self::getEspecialDay('Natv')['date']->copy()->modify('next sunday'));
        
        // Second Sunday of christmas
        // Sunday between January 2 and January 5
        $observed = (self::getSundayDayBefore('NYDy')->between(Carbon::create($this->year,1,2),Carbon::create($this->year,1,5))) ? true : false;
        self::setEspecialDay('Xmas02', new Carbon('first sunday of January ' . $this->year), $observed);
        
        
        
        // First Sunday after Epiphany or Baptism of the Lord ( Ordinary 1 )
        self::setEspecialDay('Epip01', self::getEspecialDay('EpDy')['date']->copy()->modify('next sunday'));
        
        // Second Sunday after Epiphany ( Ordinary 2 )
        self::setEspecialDay('Epip02', self::getEspecialDay('Epip01')['date']->copy()->modify('next sunday'));
        
        // Third Sunday after Epiphany ( Ordinary 3 )
        self::setEspecialDay('Epip03', self::getEspecialDay('Epip02')['date']->copy()->modify('next sunday'));
        
        // Fourth Sunday after Epiphany ( Ordinary 4 )
        self::setEspecialDay('Epip04', self::getEspecialDay('Epip03')['date']->copy()->modify('next sunday'));
        
        // Fifth Sunday after Epiphany ( Ordinary 5 )
        self::setEspecialDay('Epip05', self::getEspecialDay('Epip04')['date']->copy()->modify('next sunday'));
        
        // Set Epiphany dates
        $diffTranEpip05 = self::getEspecialDay('Epip05')['date']->diffInWeeks(self::getEspecialDay('Tran')['date']);
        for ($proper = 1; $proper <= 4; $proper++) {
            $epip = $proper + 5;
            var_dump($diffTranEpip05);
            $observed = ($proper <= $diffTranEpip05-1) ? true : false;
            
            $beforeEpip = (($epip-1) < 10) ? 'Epip0' . ($epip-1) : 'Epip' . ($epip-1);
            
            $stringEpip = ($epip < 10) ? 'Epip0' . $epip : 'Epip' . $epip;
            self::setEspecialDay($stringEpip, new Carbon('next sunday ' . self::getEspecialDay($beforeEpip)['date']), $observed);
        }
        
        
        
        // First Sunday in Lent
        self::setEspecialDay('Lent01', self::getEspecialDay('AshW')['date']->copy()->modify('next sunday'));
        
        // Second Sunday in Lent
        self::setEspecialDay('Lent02', self::getEspecialDay('Lent01')['date']->copy()->modify('next sunday'));
        
        // Third Sunday in Lent
        self::setEspecialDay('Lent03', self::getEspecialDay('Lent02')['date']->copy()->modify('next sunday'));
        
        // Fourth Sunday in Lent
        self::setEspecialDay('Lent04', self::getEspecialDay('Lent03')['date']->copy()->modify('next sunday'));
        
        // Fifth Sunday in Lent
        self::setEspecialDay('Lent05', self::getEspecialDay('Lent04')['date']->copy()->modify('next sunday'));
        
        // Passion Sunday or Palm Sunday
        self::setEspecialDay('Palm',   self::getEspecialDay('Lent05')['date']->copy()->modify('next sunday'));
        
        
        
        // Monday of Holy Week
        self::setEspecialDay('Holy01', self::getEspecialDay('Palm')['date']->copy()->addDay());
        
        // Tuesday of Holy Week
        self::setEspecialDay('Holy02', self::getEspecialDay('Holy01')['date']->copy()->addDay());
        
        // Wednesday of Holy Week
        self::setEspecialDay('Holy03', self::getEspecialDay('Holy02')['date']->copy()->addDay());
        
        // Holy Thursday
        self::setEspecialDay('Holy04', self::getEspecialDay('Holy03')['date']->copy()->addDay());
        
        // Good Friday
        self::setEspecialDay('Holy05', self::getEspecialDay('Holy04')['date']->copy()->addDay());
        
        // Holy Saturday
        self::setEspecialDay('Holy06', self::getEspecialDay('Holy05')['date']->copy()->addDay());
        
        
        
        // Easter Vigil
        self::setEspecialDay('Vigl', self::getEspecialDay('Holy06')['date']->copy()->addDay());
        
        // Second Sunday of Easter
        self::setEspecialDay('East02', self::getEspecialDay('Vigl')['date']->copy()->modify('next sunday'));
        
        // Third Sunday of Easter
        self::setEspecialDay('East03', self::getEspecialDay('East02')['date']->copy()->modify('next sunday'));
        
        // Fourth Sunday of Easter
        self::setEspecialDay('East04', self::getEspecialDay('East03')['date']->copy()->modify('next sunday'));
        
        // Fifth Sunday of Easter
        self::setEspecialDay('East05', self::getEspecialDay('East04')['date']->copy()->modify('next sunday'));
        
        // Sixth Sunday of Easter
        self::setEspecialDay('East06', self::getEspecialDay('East05')['date']->copy()->modify('next sunday'));
        
        // Sixth Sunday of Easter
        self::setEspecialDay('Ascn', self::getEspecialDay('East06')['date']->copy()->modify('next thursday'));
        
        // Seventh Sunday of Easter
        self::setEspecialDay('East07', self::getEspecialDay('Ascn')['date']->copy()->modify('next sunday'));
        
        
        
        // Day of Pentecost
        self::setEspecialDay('PDay', self::getEspecialDay('East07')['date']->copy()->modify('next sunday'));
        
        // Triniy Sunday (First Sunday after Pentecost)
        self::setEspecialDay('Trin', self::getEspecialDay('PDay')['date']->copy()->modify('next sunday'));

        // Set Propers dates
        $firstProper = self::getFirstProperAfterPentecost();
        for ($proper = 3; $proper <= 29; $proper++) {
            $observed = ($proper < $firstProper) ? false : true;

            $beforeProper = (($proper-1) < 10) ? 'Prop0' . ($proper-1) : 'Prop' . ($proper-1);
            
            if($proper == $firstProper || $proper == 3){
                $beforeProper = 'Trin';
            }
            
            $stringProper = ($proper < 10) ? 'Prop0' . $proper : 'Prop' . $proper;
            self::setEspecialDay($stringProper, self::getEspecialDay($beforeProper)['date']->copy()->modify('next sunday'), $observed);
        }
        
        
        
        // First Sunday of Advent
        self::setEspecialDay('Advt01', self::getEspecialDay('Prop29')['date']->copy()->modify('next sunday'));
        
        // Second Sunday of Advent
        self::setEspecialDay('Advt02', self::getEspecialDay('Advt01')['date']->copy()->modify('next sunday'));
        
        // Third Sunday of Advent
        self::setEspecialDay('Advt03', self::getEspecialDay('Advt02')['date']->copy()->modify('next sunday'));
        
        // Fourth Sunday of Advent
        self::setEspecialDay('Advt04', self::getEspecialDay('Advt03')['date']->copy()->modify('next sunday'));
        
    }
    
    private function getTransfigurationSunday(){
    }
    
    private function getFirstProperAfterPentecost(){    
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
        // $this->especialDays[$code] = $carbon->getTimestamp();
        $this->especialDays[$code] = [
            'date'     => $carbon,
            'observed' => $observed
        ];
        
        return $this->especialDays;
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