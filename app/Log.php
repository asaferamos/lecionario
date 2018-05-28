<?php
namespace App;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\WebProcessor;
use Monolog\Formatter\JsonFormatter;


class Log {

    protected $log;

    public function __construct(){
        #return $log;
    }

    public static function erro($content){
        $log = Log::comum();

        $log->error($content);
    }

    public static function info($content){

        $log = Log::comum();

        $log->addInfo($content);

    }

    public static function comum(){

        $log = new Logger('lecionario');
        $logdata = new StreamHandler(LOG_URL, Logger::DEBUG);

        $log->pushHandler($logdata);
        $logdata->setFormatter(new JsonFormatter());
        $log->pushProcessor(new WebProcessor($_SERVER,array('url','ip')));

        return $log;

    }
}
