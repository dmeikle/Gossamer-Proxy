
<style type="text/css">
#blog {
	width: 700px;
}
#blog #dateEntered {
	text-align: right;
	font-weight: bold;
}
#blog #subject {
	display: block;
	font-size: 16px;
	clear: both;
}
#blog #tags {
	background-color: #666;
	padding: 10px;
	color: #0F9;
}
</style>

<?php
$rawdate = date_create($blog['dateEntered']);

?>
<div id="blog">
    <div id="dateEntered">
        <?php echo date_format($rawdate,'g:ia \o\n l F jS\, Y'); ?>
    </div>
    <h3>
        <?php echo $blog['subject'];?>
    </h3>
    <div id="subject"> 
        <?php echo $blog['comments'];?>
    </div>
    <div id="tags"> 
        at <?php echo date_format($rawdate,'g:ia'); ?><br>
        <?php echo $blog['tags'];?>
    </div>
    <div id="numViews"> 
        <?php echo $blog['numViews'];?>
    </div>
        
</div>
   