<?php
require 'vendor/autoload.php';
require 'ChangeTip.class.php';

$app = new \Slim\Slim();

//Routes
// /index.php/tip
$app->get('/tip/:coins',function( $coins ) use ($app){
		
		
	$response = $app->response();
	$response['Content-Type'] = 'application/json';	
	$response->status(200);
	
	
	$response->body( json_encode( ChangeTip::tipUser( $coins ) ) );
} );

//Run application
$app->run();
