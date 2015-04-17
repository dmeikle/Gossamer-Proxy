<!-- admin list jqm desktop -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel - jQuery Mobile Demos</title>
<!-- "http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" -->
<link rel="stylesheet" href="/css/fonts/googlefonts.css" />
<link rel="stylesheet" href="/css/jqm/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css"/>
<link rel="stylesheet" href="/css/framework.desktop.css">

<!---css--->


<script src="/js/jqm/jquery.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/jqm/jquery.mobile-1.4.5.min.js"></script>
<script src="/js/pagination.js"></script>  
</head>
<body>
<div data-role="page" class="jqm-demos jqm-panel-page" data-quicklinks="true" id="container">
  <div data-role="header" id="header">
    
    <!---section1--->
  </div>
  <!-- /header --> 
  
  
  <!-- Note: all other panels are at the end of the page, scroll down  --> 
	
  <div role="main" class="ui-content jqm-content" id="lower">
    <div id="right-col">
     staff list
    </div>
    
    <div id="left-col"> 
        <a href="/admin/claims/0/20"><img src="/images/icons/jobs.png" width="64" height="64" alt="Claims"></a>
        <img src="/images/icons/docs.png" width="64" height="64" alt="Documents"> 
        <a href="/admin/staff/0/20"><img src="/images/icons/staff.png" width="64" height="64" alt="Staff"></a>
        <img src="/images/icons/clients.png" width="64" height="64" alt="Clients">
        <img src="/images/icons/buildings.png" width="64" height="64" alt="Buildings"> 
     </div>
    <!-- /left-col -->
    <div id="left-feature">
        <!---section3--->
        
    </div>
    <div id="right-feature">
        ticker
        <div class="ticker">
            <?php echo $this->getContent('admin_ticker_request_token', array('2', '192.168.2.120'));?>
            
            <a class="twitter-timeline" href="https://twitter.com/search?q=%40AM730Traffic" data-widget-id="587458728019959808"  data-show-replies="false">Tweets about @AM730Traffic</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
    </div>
  </div>
  <!-- /content -->
  <div data-role="panel" class="jqm-navmenu-panel" data-position="left" data-display="overlay" id="pancake-menu"> </div>
  <!-- /panel -->
  
  
   <div id="footer"><!---section4---></div>
  <!-- /footer --> 
  
  <!-- Here are a bunch of panels at the end, just before the close page tag  --> 
  <!-- default panel  -->
  <div data-role="panel" id="defaultpanel" data-position="right" data-display="overlay">
   
    <?php
     
echo $this->getMenu('cssmenu_pancakes', array('staffid' => $this->getLoggedInUser()->getId()));
?>

    <a href="#demo-links" data-rel="close">Close panel</a> 
  </div>
  <!-- /default panel --> 
  <!-- rightpanel3  -->
  <div data-role="panel" id="right-panel-slider" data-position="right" data-display="overlay" data-dismissible="false">
    <h3>Right Panel: Overlay</h3>
    <p>This panel is positioned on the right with the overlay display mode. The panel markup is <em>after</em> the header, content and footer in the source order.</p>
    <p>To close, click off the panel, swipe left or right, hit the Esc key, or use the button below:</p>
     </div>
  <!-- /rightpanel3 --> 
 
</div>
<!-- /page -->

<!---javascript--->
</body>
</html>
