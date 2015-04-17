/**
 * Created by rbaron on 4/16/15.
 */

var OSC = new OSC_Object();

function OSC_Object() {

    var api = '/api/index.php/';

    var service = {

        tip : function(mario_coins, callback) {
            $.get(api + 'tip/' + mario_coins, function(data) {
                callback(data);
            });
        }
    };

    var payUserBits = function(mario_coins, callback) {

        service.tip(mario_coins, function(data) {

            //data 	= JSON.parse( data );

            var err = null;

            // 200, 201... things like that are fine status codes
            if (data.status >= 300) {
                err = data.detail || data.err_msg;
            }

            callback(err, data);
        });

    };

    /**
     * This method receives the url for the user to collect the tip
     * The idea is to show a big coin where the user can grab his money
     * @param {Object} tip_url
     */
    var collect_tip_window = function(tip_url, callback, num_coins) {
        //Let's set the url
        $('#magic_url').attr("href", tip_url );
        $('#magic_url').on("click", function(){
            $('#myModal').modal('toggle');
        });
        
        $('#earned_cents').text(num_coins);
        $('#myModal').modal('show');
        
        $('#myModal').on('hidden.bs.modal', function () {
            console.log("HIDDEN WINDOWS");
            // Call this callback to unpaused the game
            callback();
        })
        
        
        
    };

    return {

        payUser : payUserBits,
        collect_tip_window : collect_tip_window

    };

}
