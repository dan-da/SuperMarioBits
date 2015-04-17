<?php

class ChangeTip {
    
    /**
     * Change tip application settings
     */
    private static function getConfig(){
        return array(
            'ct_access_token' => "wCB0r7crcLs9uCF6E9S9VzYQc5BfeT"
            , 'ct_endpoint'     => "https://api.changetip.com/v2/"          
        );
    }
    
    private static function getCurlConfig(){
        
        $config = self::getConfig();
            
        $url            = $config['ct_endpoint']; //. '?' . http_build_query( $config['ct_data'] );
        $header_opts    = array(
            'Authorization: Bearer ' .  $config['ct_access_token'],
        );
        
        return array(
            'url'           => $url
            , 'header_opts' => $header_opts 
        );
    }

    /**
     *  receives number of coins that player earned and
     *  returns USD equivalent in pennies/cents.
     */
    public static function calculate_coins( $mario_coins ){
        
        // For now, each coin is worth 1 penny.
        return $mario_coins;
        
        $cents = $mario_coins / 10;
        return $cents;
        
    }
    
    public static function tipUser( $mario_coins ){
        
        /**
         * ------------------------------------------------------------------------------------------        
         * We are just testing we does not require to make the call      *
         * ------------------------------------------------------------------------------------------ 
         */
        // Uncomment this line to simulate a successful call to changetip.
        // return array('id'=> 722105, 'magic_url' => 'http://tip.me/once/FprD-2hQHKAfF', 'status' => 201);
        
        //Get the number of cents()
        // Please refer to https://www.changetip.com/v2/monikers/
        $coins      = self::calculate_coins( $mario_coins );

        $curl_conf  = self::getCurlConfig();
        $url        = $curl_conf[ 'url' ] . 'tip-url/';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_conf['header_opts'] );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  self::getPostParameters( $coins ));
        //Message will appear when user collects the money
        
        curl_setopt($ch, CURLOPT_POST, 1);
        
        $data = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        
        curl_close($ch);
    
        $result     = json_decode( $data );
        
        if ( $result == null ){
            $result = json_encode(array());// Create empty json object, I might too tired..
        }
                
        $result->status = $status;
            
        
        self::saveData( json_encode( $result ) );
        
        return $result;
    }
    
    public static function saveData( $data ){
        $logdir = '/tmp/logs';
        if( !file_exists($logdir) ) {
            mkdir( $logdir );
        }
        $filename = "/$logdir/logs_" . uniqid() . ".txt";
        file_put_contents( $filename, $data );
    }
    
    public static function getTextAmount( $mario_coins ){
        // return "text_amount=1%20cent"; 
        return  sprintf("text_amount=%s%s", $mario_coins, "%20cent" );
    }
    
    public static function getMessage( $mario_coins ){
        $coins = $mario_coins == 1 ? 'coin' : 'coins';

        $congrats = array( 'Well done!',
                           'Atta boy!',
                           'Good for you!',
                           'Good on ya!',
                           'Heck ya!',
                           'Damn skippy!',
                           'Hee Hawwwwww!',
                           'Yippeeee!',
                           'Congrats!',
                           'Impressive!',
                           'Chicks dig that!',
                           'Incredible!',
                           'Happy Day!',
                           'Mind. Blown!',
                           'Keep it up!',
                           'To the Moon!',
                           'Oh yeaaah!',
                         );
        $idx = rand( 0, count($congrats)-1 );
        $congrats_msg = $congrats[$idx];

        $message = "You collected $mario_coins mario $coins and completed the level. $congrats_msg";
        return  "&message=" . urlencode( $message );
    }
    
    public static function getPostParameters( $mario_coins ){
        
        $text_amount    = self::getTextAmount( $mario_coins );
        $message        = self::getMessage( $mario_coins );
        
        $params         = $text_amount . $message;
        return $params;
        
    }
}
