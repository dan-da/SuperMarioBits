<?php
require 'vendor/autoload.php';
require 'ChangeTip.class.php';

$app = new \Slim\Slim();

//Routes
// /index.php/tip
$app->get('/tip',function() use ($app){
		
	$response = $app->response();
	$response['Content-Type'] = 'application/json';
	$response['X-Powered-By'] = 'Potato Energy';
	$response->status(200);
	// etc.
	
	$response->body(json_encode(ChangeTip::tipUser()));
} );

//Run application
$app->run();
