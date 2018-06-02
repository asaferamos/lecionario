<?php
namespace Lectionary;
use Lectionary\Model;

class Reading{
    private $id, $liturgical_name, $calendar_date, $first_reading_comp, $first_reading_semi, $psalm_comp, $psalm_semi, $epistle_reading, $gospel_reading, $theme, $vanderbilt_idurl, $vanderbilt_code, $vanderbilt_art, $vanderbilt_prayer, $vanderbilt_hymns, $colors, $colors_code, $year;
    
    public function __construct($reading){
        
        foreach ($reading as $key => $v) {
            switch ($key) {
                case 'id':
                    self::setId($v);
                    break;
                    
                case 'liturgical_name':
                    self::setLiturgicalName($v);
                    break;
                    
                case 'calendar_dated':
                    self::setCalendarDated($v);
                    break;
                
                case 'first_reading_comp':
                    self::setFirstReadingComp($v);
                    break;
                    
                case 'first_reading_semi':
                    self::setFirstReadingSemi($v);
                    break;
                    
                case 'psalm_comp':
                    self::setPsalmComp($v);
                    break;
                
                case 'psalm_semi':
                    self::setPsalmSemi($v);
                    break;
                    
                case 'epistle_reading':
                    self::setEpistleReading($v);
                    break;
                    
                case 'gospel_reading':
                    self::setGospelReading($v);
                    break;
                
                case 'theme':
                    self::setTheme($v);
                    break;
                    
                case 'vanderbilt_idurl':
                    self::setVanderbiltIdUrl($v);
                    break;
                    
                case 'vanderbilt_code':
                    self::setVanderbiltCode($v);
                    break;
                    
                case 'vanderbilt_art':
                    self::setVanderbiltArt($v);
                    break;
                    
                case 'vanderbilt_prayer':
                    self::setVanderbiltPrayer($v);
                    break;
                
                case 'vanderbilt_hymns':
                    self::setVanderbiltHymns($v);
                    break;
                    
                case 'colors':
                    self::setColors($v);
                    break;
                    
                case 'colors_code':
                    self::setColorsCode($v);
                    break;
                    
                case 'year':
                    self::setYear($v);
                    break;
            }
        }
    }
                
    private function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    private function setLiturgicalName($liturgical_name){
        $this->liturgical_name = $liturgical_name;
    }
    
    public function getLiturgicalName(){
        return $this->liturgical_name;
    }
    
    private function setCalendarDate($calendar_date){
        $this->calendar_date = $calendar_date;
    }
    
    public function getCalendarDate(){
        return $this->calendar_date;
    }
    
    private function setFirstReadingComp($first_reading_comp){
        $this->first_reading_comp = $first_reading_comp;
    }
    
    public function getFirstReadingComp(){
        return $this->first_reading_comp;
    }
    
    private function setFirstReadingSemi($first_reading_semi){
        $this->first_reading_semi = $first_reading_semi;
    }
    
    public function getFirstReadingSemi(){
        return $this->first_reading_semi;
    }
    
    private function setPsalmComp($psalm_comp){
        $this->psalm_comp = $psalm_comp;
    }
    
    public function getPsalmComp(){
        return translateBooks($this->psalm_comp);
    }
    
    private function setPsalmSemi($psalm_semi){
        $this->psalm_semi = $psalm_semi;
    }
    
    public function getPsalmSemi(){
        return $this->psalm_semi;
    }
    
    private function setEpistleReading($epistle_reading){
        $this->epistle_reading = $epistle_reading;
    }
    
    public function getEpistleReading(){
        return $this->epistle_reading;
    }
    
    private function setGospelReading($gospel_reading){
        $this->gospel_reading = $gospel_reading;
    }
    
    public function getGospelReading(){
        return $this->gospel_reading;
    }
    
    private function setTheme($theme){
        $this->theme = $theme;
    }
    
    public function getTheme(){
        return $this->theme;
    }
    
    private function setVanderbiltIdUrl($vanderbilt_idurl){
        $this->vanderbilt_idurl = $vanderbilt_idurl;
    }
    
    private function setVanderbiltCode($vanderbilt_code){
        $this->vanderbilt_code = $vanderbilt_code;
    }
    
    public function getVanderbiltIdUrl(){
        return $this->vanderbilt_idurl;
    }
    
    private function setVanderbiltArt($vanderbilt_art){
        $this->vanderbilt_art = $vanderbilt_art;
    }
    
    public function getVanderbiltArt(){
        return $this->vanderbilt_art;
    }
    
    private function setVanderbiltPrayer($vanderbilt_prayer){
        $this->vanderbilt_prayer = $vanderbilt_prayer;
    }
    
    public function getVanderbiltPrayer(){
        return $this->vanderbilt_prayer;
    }
    
    private function setVanderbiltHymns($vanderbilt_hymns){
        $this->vanderbilt_hymns = $vanderbilt_hymns;
    }
    
    private function setColors($colors){
        $this->colors = $colors;
    }
    
    public function getColors(){
        return $this->colors;
    }
    
    private function setColorsCode($colors_code){
        $this->colors_code = $colors_code;
    }
    
    public function getColorsCode(){
        return $this->colors_code;
    }
    
    private function setYear($year){
        $this->year = $year;
    }
    
    public function getYear(){
        return $this->year;
    }
}