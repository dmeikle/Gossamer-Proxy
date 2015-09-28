/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://ticker.phoenixrestorations.com:9000/staff/connect?" + encodeURI($('#ticker-token').val()); 
     
	websocket = new WebSocket(wsUri); 
	
	websocket.onopen = function(ev) { // connection is open 
		$('#message_box').append("<div class=\"system_msg\"> -- Ticker Connected --</div>"); //notify user
                loadHistory();
	}

        function buildTickerRow(msg) {
       
          //var date =(msg.dateEntered.replace(" ","T"));
         
            return '<div class="row">'+
                '<div class="leftcol">icon: ' + (tickerCounter++) + '</div>' +
                '<div class="middlecol">'+
                    '<div class="subject">' + msg.subject + '</div>'+
                    '<div class="message">' + msg.message + '</div>'+
                '</div>'+
                '<div class="rightcol">' + formatDate(msg.dateEntered) + '</div>'+
            '</div>';              
              
        }
  
        function getMonth(monthNumber) {
            var month = new Array();
            month[0] = "Jan";
            month[1] = "Feb";
            month[2] = "Mar";
            month[3] = "Apr";
            month[4] = "May";
            month[5] = "Jun";
            month[6] = "Jul";
            month[7] = "Aug";
            month[8] = "Sep";
            month[9] = "Oct";
            month[10] = "Nov";
            month[11] = "Dec";
            
            return month[monthNumber];
        }
        
        function formatDate(date) {
            var datetime = date.split(' ');
            var dateArray = datetime[0].split('-');
            
            var time = datetime[1].split(':');
            var hours = time[0] % 12;
            hours = hours ? hours : 12;// the hour '0' should be '12'
            var minutes = time[1] < 10 ? '0' + time[1] : time[1];
            var ampm = hours >= 12 ? 'PM' : 'AM';
            
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return getMonth(parseInt(dateArray[1])) + ' ' + dateArray[2] + ' ' + '<br>' + strTime;
        }
//        function formatDate(date) {
//            var hours = date.getHours();
//            var minutes = date.getMinutes();
//            var ampm = hours >= 12 ? 'PM' : 'AM';
//            
//            hours = hours % 12;
//            hours = hours ? hours : 12; // the hour '0' should be '12'
//            minutes = minutes < 10 ? '0'+minutes : minutes;
//            
//            var strTime = hours + ':' + minutes + ' ' + ampm;
//            
//            return getMonth(date.getMonth()) + " " + date.getDate() + " " + date.getFullYear() + " " + strTime;
//      }

        
      var tickerCounter = 1;  
	$('#send-btn').click(function(){ //use clicks message send button	
		var mymessage = $('#message').val(); //get message text
		var myname = $('#name').val(); //get user name
		
		if(myname == ""){ //empty name?
			alert("Enter your Name please!");
			return;
		}
		if(mymessage == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}
		
		//prepare json data
		var msg = {
                roomId: 1,
		message: mymessage,
		name: myname,
		color : '<?php echo $colours[$user_colour]; ?>'
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	});
	var start = -1;
        $('#history').click(function() {
            loadHistory();
        });
        
        $('#message_box').bind('scroll', function() {
            clearTimeout( $.data( this, "scrollCheck" ) );
            $.data( this, "scrollCheck", setTimeout(function() {
                if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight) {
                    loadHistory();
                }
            }, 250) );
            
        });
  
        function loadHistory(rows) {
            if(rows == undefined) {
                rows = 5;
            }
            var msg = {
                uri: 'staff/history',
                start: start,
                rows: rows
            };
            websocket.send(JSON.stringify(msg));
        }
         
	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
                
                if(msg.type == 'single') {
                    $('#message_box').prepend(buildNotificationRow(msg));
                } else if(msg.type == 'list') {
                    for(i = 0; i < msg.rows.length; i++) {
                        var row = msg.rows[i];
                        start = msg.rows[i].id;
                        $('#message_box').append(buildTickerRow(row));
                        
                    }
                }

		
	};
	
	websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; 
        
        window.onbeforeunload = function() {
            websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");};         
            websocket.close();
        };
});