/**
 * Created by rbaron on 4/16/15.
 */

var OSC = new OSC_Object();

function OSC_Object(){
	
	var api  = '/api/index.php/';

	var service	= {
		
		tip: function( mario_coins, callback ){
			$.get(  api + 'tip/' + mario_coins, function( data ) {
				callback( data );
			});
		}
	};
    
    var payUserBits = function( mario_coins, callback ){

    	service.tip( mario_coins, function( data ){
    		
    		//data 	= JSON.parse( data );
    		
    		var err = null;
    		
    		// 200, 201... things like that are fine status codes
    		if (data.status >= 300 ){
    			err = data.detail || data.err_msg;
    		}
    		
    		callback( err, data );    		
    	});


    };

    return {

        payUser: payUserBits

    };

}
