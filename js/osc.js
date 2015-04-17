/**
 * Created by rbaron on 4/16/15.
 */

var OSC = new OSC_Object();

function OSC_Object(){

    var payUserBits = function( mario_coins, callback ){

        console.log("OSC payment has been made for: " + mario_coins );

        var err = null;
        callback( err );
    };

    return {

        payUser: payUserBits

    };

}
