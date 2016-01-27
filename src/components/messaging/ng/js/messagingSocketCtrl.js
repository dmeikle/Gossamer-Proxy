    /* 
     *  This file is part of the Quantum Unit Solutions development package.
     * 
     *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
     * 
     *  For the full copyright and license information, please view the LICENSE
     *  file that was distributed with this source code.
     */
    
    
(function() {
    
    angular
        .module('messagingAdmin')
        .controller('messagingSocketCtrl', messagingSocketCtrl);

    function messagingSocketCtrl($rootScope,messagingWebsocketSrv) {
        var self = this;

       
        var lastTrafficRow = 0;
         
        $rootScope.$on('MESSAGE_SOCKET_CONNECTED', function() {
            self.connected = true;
        });
        
        $rootScope.$on('MESSAGE_RESPONSE_RECEIVED', function(event, msg) {
           if (msg.type == 'single') {
                $('#traffic-rows').prepend(buildNotificationRow(msg));
            } else if (msg.type == 'list') {
                for (var key in msg.rows) {
                    var row = msg.rows[key];
                    if (lastTrafficRow < key) {
                        lastTrafficRow = key;
                    }
                    $('#traffic-rows').prepend(buildTrafficRow(row));
                }
            } 
        });
        
        
        $rootScope.$on('MESSAGE_ERROR_OCCURRED', function(event, message) {
           alert(message) ;
        });
        
        $rootScope.$on('MESSAGE_CONNECTION_CLOSED', function() {
           alert('closed') ;
        });
        
        
        connect();

        function connect() {

        }
    }
})();