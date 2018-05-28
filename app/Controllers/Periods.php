<?php
namespace App\Controllers;
use \App\Models\Lecionario;
use \App\Log;


class Periods extends Controller{
    private $periods;
    
    public function __construct(){
        
    }

    public function setPeriods($year){

    	$easter = easter_date($year); 

    	$datas = array(
    		'Epifania'  => mktime(0, 0, 0, 1, 6, $year),
    	);

    	$epifania = date('w', mktime(0, 0, 0, 1, 6, $year));

    	$datas = [
    		'Epifania'                       => mktime(0, 0, 0, 1, 6, $year),
    		'Primeiro Domingo após Epifania' => mktime(0, 0, 0, 1, 6 + (7 - $epifania), $year),
    		'Segundo Domingo após Epifania'  => mktime(0, 0, 0, 1, 6 + (14 - $epifania), $year),
    		'Terceiro Domingo após Epifania' => mktime(0, 0, 0, 1, 6 + (21 - $epifania), $year),
    		'Quarto Domingo após Epifania'   => mktime(0, 0, 0, 1, 6 + (28 - $epifania), $year),
    		'Quinto Domingo após Epifania'   => mktime(0, 0, 0, 1, 6 + (35 - $epifania), $year),
    		'Domingo da Transfiguração'      => mktime(0, 0, 0, 1, 6 + (42 - $epifania), $year),
    		'Quarta-feira de Cinzas'         => strtotime('-46 days', $easter),
    		'Primeiro domingo na Quaresma'   => strtotime('-' . (42) .' days', $easter),
    		'Segundo domingo na Quaresma'    => strtotime('-' . (42 - 7) .' days', $easter),
    		'Terceiro domingo na Quaresma'   => strtotime('-' . (42 - 14) .' days', $easter),
    		'Quarto domingo na Quaresma'     => strtotime('-' . (42 - 21) .' days', $easter),
    		'Quinto domingo na Quaresma'     => strtotime('-' . (42 - 28) .' days', $easter),
    		'Domingo de Ramos'   			 => strtotime('-' . (42 - 35) .' days', $easter),
    		'Segunda-Feira da Semana Santa'  => strtotime('-' . (42 - 36) .' days', $easter),
    		'Terça-Feira da Semana Santa'    => strtotime('-' . (42 - 37) .' days', $easter),
    		'Quarta-Feira da Semana Santa'   => strtotime('-' . (42 - 38) .' days', $easter),
    		'Quinta-Feira da Semana Santa'   => strtotime('-' . (42 - 39) .' days', $easter),
    		'Sexta-Feira Santa'  			 => strtotime('-' . (42 - 40) .' days', $easter),
    		'Sábado Santo'  			     => strtotime('-' . (42 - 41) .' days', $easter),
    		'Páscoa'  			             => $easter,
    		'Segundo domingo de Páscoa'  	 => strtotime('+' . 7 .' days', $easter),
    		'Terceiro domingo de Páscoa'  	 => strtotime('+' . 7*2 .' days', $easter),
    		'Quarto domingo de Páscoa'  	 => strtotime('+' . 7*3 .' days', $easter),
    		'Quinto domingo de Páscoa'  	 => strtotime('+' . 7*4 .' days', $easter),
    		'Sexto domingo de Páscoa'  	 	 => strtotime('+' . 7*5 .' days', $easter),
    		'Sétimo domingo de Páscoa'  	 => strtotime('+' . 7*6 .' days', $easter),
    		'Ascensão'  					 => strtotime('+' . 39 .' days', $easter),
    		'Dia de Pentecostes'  			 => strtotime('+' . 49 .' days', $easter),
    		'Domingo da Trindade'  			 => strtotime('+' . 7*8 .' days', $easter),
    		'Próprio'  						 => strtotime('+' . 7*9 .' days', $easter),
    	];

    	$this->periods = $datas;
    }
}