<?php
require __DIR__ .'/vendor/autoload.php';


use Finance\Profile\FinanceController;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$app_server_path = getenv("APP_SERVER_URL");


try {
	$router = new AltoRouter();
	$router->setBasePath('/psr4');
	$router->map('GET', '/', 'index'); 
	$router->map('GET', '/profile/[*:symbol]', 'FinanceController#getProfileData');  
	$router->map('GET', '/quote/[*:symbol]', 'FinanceController#getQuoteData');  
	
	

	$match = $router->match();
	if ($match === false) {
    	echo "page Not Found";
	} else {
	    list( $controller, $action ) = explode( '#', $match['target'] );

	    if($controller === 'FinanceController')
	    {
	    	$controllerObj = new FinanceController($app_server_path);
	    }
	    else{
	    	$controllerObj = new Quote();	
	    }

	    if ( is_callable(array($controllerObj, $action)) ) {

	        call_user_func_array(array($controllerObj,$action), $match['params']);
	    } else {

	    	echo "controler not defined";
	        
	    }
	}	
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>