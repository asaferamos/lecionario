<?php
define('BASE_PATH', dirname(__FILE__));


require 'vendor/autoload.php';
require 'config.php';

use \App\Log;
use \App\View;
use \App\Controllers\Lectionary;


$app = new \Slim\App(
    $config['slim']
);



$app->get('/', function ($request, $response){
    new Lectionary();
});


$app->any('/{controlle}[/{function}[/{dado}]]', function($request, $response){  
    $controlle = "\App\Controllers\\" . ucfirst(strtolower($request->getAttribute('controlle')));
    if(!$function = strtolower($request->getAttribute('function'))){
        $function = 'index';
    }
    $dado = $request->getAttribute('dado');


    

    //Testa se a requisção é POST,
    //se for, não imprime a view.
    if($request->isPost()){
        
        //Testa se classe existe
        if(class_exists($controlle)){
            $Controller = new $controlle;
        }else{
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die();
        }

        $postfunction = 'post' . ucfirst($function);

        if(!method_exists($Controller, $postfunction)){
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die();
        }


        if(!$data = $Controller->$postfunction($dado)){
            $data = array();
        }

    }else{
        //Testa se classe existe
        if(class_exists($controlle)){
            $Controller = new $controlle;
        }else{
            error('Classe não existente.');
            die();
        }

        //Se a requisição não for POST,
        //testa se função existe na classe e imprime (make) a view.
        if(!method_exists($Controller, $function)){
            error('Função não existente.');
            die();
        }

        if(!$data = $Controller->$function($dado)){
            $data = array();
        }



        View::make(ucfirst(strtolower($request->getAttribute('controlle'))) . "/$function", $data);
    }

    
});











 
 


$app->add(function ($request, $response, $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if ($path != '/' && substr($path, -1) == '/') {
        // permanently redirect paths with a trailing slash
        // to their non-trailing counterpart
        $uri = $uri->withPath(substr($path, 0, -1));
        
        if($request->getMethod() == 'GET') {
            return $response->withRedirect((string)$uri, 301);
        }
        else {
            return $next($request->withUri($uri), $response);
        }
    }

    return $next($request, $response);
});
 
$app->run();

