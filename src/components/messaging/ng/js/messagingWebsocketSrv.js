
    
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
        .factory('messagingWebsocketSrv', messagingWebsocketSrv);

    function messagingWebsocketSrv($rootScope) {
        
        var apiPath = 'ws://phoenix.quantumunit.com:9000';
	var objectType = 'Messaging';
        var handshakeUrl = '/staff/connect';
        var socket = new WebSocket(apiPath + handshakeUrl + '?' + encodeURI(document.getElementById('MESSAGING_TOKEN').value));
        
        
        
        var self = this;
	
		
        var service = {
          connect: connect
        };
        
        function connect(token) {
            socket = new WebSocket(apiPath + handshakeUrl + '?' + encodeURI(token));
        }
       
        socket.onopen = function (ev) { // connection is open 
            $rootScope.$broadcast('MESSAGE_SOCKET_CONNECTED');
            getMessageList();
        };
        
        function getMessageList(rows) {
            var start = 0;
            if (rows === undefined) {
                rows = 10;
            }
            var msg = {
                uri: 'messaging/notifications/' + rows,
                start: start,
                rows: rows
            };
            
            socket.send(JSON.stringify(msg));
        }
        
        socket.onmessage = function (ev) {
            var msg = JSON.parse(ev.data); //PHP sends Json data
            $rootScope.$broadcast('MESSAGE_RESPONSE_RECEIVED', {msg: msg}); 
        };
        
        socket.onerror = function(ev) {
            $rootScope.$broadcast('MESSAGE_ERROR_OCCURRED', {msg: ev.data});
        };
        
        socket.onclose = function(ev) {
            $rootScope.$broadcast('MESSAGE_CONNECTION_CLOSED');
        };
        
        return service;
    }
})();