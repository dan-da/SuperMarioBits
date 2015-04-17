<?php

class ChangeTip {
	
	/**
	 * Change tip application settings
	 */
	private static function getConfig(){
		return array(
			'ct_access_token' => "wCB0r7crcLs9uCF6E9S9VzYQc5BfeT"
			, 'ct_endpoint'     => "https://api.changetip.com/v2/"
			, 'ct_data'         => array( 'text_amount' => '1%20cent' )
		);
	}
	
	private static function getCurlConfig(){
		
		
		$config = self::getConfig();
			
		$url 			= $config['ct_endpoint'] . '?' . http_build_query( $config['ct_data'] );
		$header_opts	= array(
	    	'Authorization: Bearer ' .  $config['ct_access_token'],
	    );
		
		return array(
			'url' 			=> $url
			, 'header_opts' => $header_opts 
		);
	}
	
	public static function tipUser(){
		
		$curl_conf 	= self::getCurlConfig();
		$url 		= $curl_conf[ 'url' ] . 'tip-url/';
		
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url );
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_conf['header_opts'] );
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
		
	    $data = curl_exec($ch);
	    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
		
		var_dump( $status );
		var_dump( curl_error( $ch ) );
	    curl_close($ch);
	
		$result			= json_decode( $data );
//		$result->status	= $status;
		
		self::saveData( json_encode( $result ) );
		
	    return $result;
	}
	
	public static function saveData( $data ){
		$filename = "./logs/logs_" . uniqid() . ".txt";
		file_put_contents( $filename, $data );
	}
}
