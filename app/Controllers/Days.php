<?php
namespace App\Controllers;
use \App\Models\LectionaryModel;
use \App\Log;
use \App\Controllers\Periods;


class Days extends Controller{
    private $day;
    
    public function __construct(){
        echo 'Days';
        $entradas = LectionaryModel::test();
                
        echo '<table>';
        foreach ($periods->getAll(2018) as $key => $value) {
        	echo '<tr><td>' . $key . ':</td><td><b>' . strftime('%A', $value) . '</b></td><td><b>' . strftime('%d de %B de %Y', $value) . '</b></td></tr>';
        }
        echo '</table>';
    }
}