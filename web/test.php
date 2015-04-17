

<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<style type="text/css">
<!--
.chat_wrapper {
	width: 300px;
	margin-right: auto;
	margin-left: auto;
	background: #CCCCCC;
	border: 1px solid #999999;
	padding: 10px;
	font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
}
.chat_wrapper .message_box {
	background: #FFFFFF;
	height: 150px;
	overflow: auto;
	padding: 10px;
	border: 1px solid #999999;
}
.chat_wrapper .panel input{
	padding: 2px 2px 2px 5px;
}
.system_msg{color: #BDBDBD;font-style: italic;}
.user_name{font-weight:bold;}
.user_message{color: #88B6E0;}
-->
</style>
<style type="text/css">
.chat_wrapper {
	width: 300px;
	border: 1px solid #999;
}
.chat_wrapper #message_box {
	width: 96%;
	margin: 5px;
}
.chat_wrapper #message_box .row {
	height: 50px;
	width: 100%;
	margin-top: 5px;
	margin-bottom: 5px;
}
.chat_wrapper #message_box .row .icon {
	float: left;
	width: 20px;
	margin-right: 10px;
}
.chat_wrapper #message_box .row .subject {
	float: left;
	width: 50%;
}
.chat_wrapper #message_box .row .icon .message {
	clear: both;
	width: 100%;
}
.chat_wrapper #message_box .row .date {
	float: right;
	width: 60px;
}
.chat_wrapper #message_box .row .leftcol {
	width: 30px;
	float: left;
}
.chat_wrapper #message_box .row .middlecol {
	width: 195px;
	float: left;
	margin-left: 8px;
}
.chat_wrapper #message_box .row .middlecol .subject {
	width: 100%;
}
.chat_wrapper #message_box .row .middlecol .message {
	width: 100%;
}
.chat_wrapper #message_box .row .rightcol {
	float: right;
	width: 50px;
}
.chat_wrapper #message_box .row .rightcol {
	font-size: 10px;
	font-family: Verdana, Geneva, sans-serif;
}
.chat_wrapper #message_box .row .middlecol .subject {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: 600;
	color: #666;
}
.chat_wrapper #message_box .row .middlecol .message {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
}
</style>
</head>
<body>	
<?php 
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$user_colour = array_rand($colours);
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script language="javascript" type="text/javascript">  

</script>
<div class="chat_wrapper">
<div class="message_box" id="message_box"></div>
<div class="panel">
<input type="text" name="name" id="name" placeholder="Your Name" maxlength="10" style="width:20%"  />
<input type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:60%" />
<button id="send-btn">Send</button><br>
<a id="history" href="#">view more results</a>

</div>
</div>

</body>
</html>