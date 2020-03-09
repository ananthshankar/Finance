<?php


use Finance\Quote\Quote;
use Finance\Profile\Profile;



// set_error_handler(function($errno, $errstr, $errfile, $errline){
// 	throw new Exception($errstr, $errno, 0, $errfile, $errline);
// });

// $quotee = new Quote();

// print_r($quotee);

// $arrayName = array('test' =>'testee');

// $getProfile = new Profile($arrayName);

// print_r($getProfile);

// // $get = Profile::getProfile($params['symbol']);
// $get = Profile::getProfile($params['symbol']);
// $get = $getProfile->getProfile();



$get = Profile::getProfileData($params['symbol']);

print_r($get);


?>