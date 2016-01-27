/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
 

$(document).ready(function () {
    //create a new WebSocket object.
    var wsTrafficUri = "ws://phoenix.quantumunit.com:9000/staff/connect?" + encodeURI($('#traffic-token').val());
    var lastTrafficRow = 0;
    trafficSocket = new WebSocket(wsTrafficUri);


    trafficSocket.onopen = function (ev) { // connection is open 
        $('#traffic-rows').append("<div class=\"system_msg\"> -- Traffic Feed Connected --</div>"); //notify user

        getTrafficList();
    }

    window.setInterval(getTrafficUpdates, 60000); // 60 seconds

    function buildTrafficRow(msg) {

        return '<div class="row">' +
                '<div class="date">' + (msg.dateEntered) + '</div>' +
                '<div class="message">' + createLinks(msg.message) + '</div>' +
                '</div>';
    }

    function getTrafficUpdates() {

        var start = 0;
        var rows = 10;

        var msg = {
            uri: 'traffic/updates/' + lastTrafficRow,
            start: start,
            rows: lastTrafficRow
        };
        trafficSocket.send(JSON.stringify(msg));
    }

    function getTrafficList(rows) {
        var start = 0;
        if (rows == undefined) {
            rows = 10;
        }
        var msg = {
            uri: 'traffic/list/' + rows,
            start: start,
            rows: rows
        };
        trafficSocket.send(JSON.stringify(msg));
    }

    //#### Message received from server?
    trafficSocket.onmessage = function (ev) {
        var msg = JSON.parse(ev.data); //PHP sends Json data

        if (msg.type == 'single') {
            $('#traffic-rows').prepend(buildNotificationRow(msg));
        } else if (msg.type == 'list') {
            for (key in msg.rows) {
                var row = msg.rows[key];
                if (lastTrafficRow < key) {
                    lastTrafficRow = key;
                }
                $('#traffic-rows').prepend(buildTrafficRow(row));
            }
        }

    };

    trafficSocket.onerror = function (ev) {
        $('#traffic-rows').append("<div class=\"system_error\">Error Occurred - " + ev.data + "</div>");
    };


    var re = /(http:\/\/[^ ]+)/g;

    function createLinks(els) {
        var string = linkHashTags(els);
        return string.replace(/( http:\/\/[^ ]+)/g, '<a href="$1">$1</a>/');
    }
    hashtag_regexp = /#([a-zA-Z0-9]+)/g;

    function linkHashTags(text) {
        return text.replace(
                hashtag_regexp,
                '<a class="hashtag" href="http://twitter.com/#search?q=$1">#$1</a>'
                );
    }

    window.onbeforeunload = function () {
        trafficSocket.onclose = function (ev) {
            $('#traffic-rows').append("<div class=\"system_msg\">Connection Closed</div>");
        };

        trafficSocket.close();
    };

});