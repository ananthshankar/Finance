<?php
require __DIR__ .'/vendor/autoload.php';


use Finance\Profile\FinanceController;
use Dotenv\Dotenv;
use Laminas\Diactoros\Response;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;


$app_server_path = getenv("APP_SERVER_URL");


try {

	$router = new AltoRouter();
	$router->setBasePath('/psr4');
	$router->map('GET', '/profile/[*:symbol]', 'FinanceController#getProfileData');  
	$router->map('GET', '/quote/[*:symbol]', 'FinanceController#getQuoteData');  
	
	

	$match = $router->match();

	if ($match === false) {
    	echo "Detail Not Found, Try Profile or Quote Detail Path";
	} else {
	    list( $controller, $action ) = explode( '#', $match['target'] );

	    if($controller === 'FinanceController')
	    {
	    	$controllerObj = new FinanceController($app_server_path);
	    }
	    else{
	    	echo "controller not found";
	    }

	    if (is_callable(array($controllerObj, $action)) ) {

	        $controllerResponse = call_user_func_array(array($controllerObj,$action), $match['params']);
	        
	    } else {

	    	echo "controller not defined";
	        
	    }

	    ob_start();
	    $response = new Response();
	    $response->getBody()->write(json_encode($controllerResponse));
	    (new SapiEmitter)->emit($response);
		ob_end_flush();
	}

} 
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}




?>