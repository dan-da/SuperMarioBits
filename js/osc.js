/**
 * Created by rbaron on 4/16/15.
 */

var OSC = new OSC_Object();

function OSC_Object(){
	
	var api  = '/api/index.php/';

	var service	= {
		
		tip: function( callback ){
			$.get(  api + 'tip', function( data ) {
				callback( data );
			});
		}
	};
    
    var payUserBits = function( mario_coins, callback ){

    	service.tip( function( data ){
    		
    		//data 	= JSON.parse( data );
    		
    		var err = null;
    		
    		if (data.status !== 200 ){
    			err = data.detail || data.err_msg;
    		}
    		
    		callback( err );    		
    	});


    };

    return {

        payUser: payUserBits

    };

}
