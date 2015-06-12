
<!-- admin list -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Template for Bootstrap</title>

    <script src="//javascript.phoenixrestorations.com/jquery.js"></script>

       <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="//css.phoenixrestorations.com/fonts/googlefonts.css" />
    <link rel="stylesheet" type="text/css" href="//css.phoenixrestorations.com/jqm/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" type="text/css" href="//css.phoenixrestorations.com/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="//css.phoenixrestorations.com/framework.desktop.css">
    <link rel="stylesheet" href="//css.phoenixrestorations.com/pagination.css">
    <style>
        #right-col {
            float: right;
            margin-top: 115px;
        }
        #left-col {
            margin-top: 115px;
            float: left;
            width: 150px;
            height: 100%;
        }
        #left-feature {
            margin: 60px 0px 0px 10px;
            max-width: 1120px;
            min-width: 50%;
            float: left;
        }
        #right-feature {
            margin: 60px 20px 0px 20px;
            float: right;
            width: 450px;
        }
        
        //radio buttons
        #feedback { font-size: 1.4em; }
        #selectable .ui-selecting { background: #FECA40; }
        #selectable .ui-selected { background: #F39814; color: white; }
        #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
        #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }
    </style>
    
    <script language="javascript">
    
    $(document).ready(function() {
       
       $('#set-homepage').click(function() {
           $.post('/admin/staff/homepage', function(data) {
               
           })
       });
    });
    
    </script>
    
	<!---css--->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#" id="set-homepage" title="set as homepage"><span class="glyphicon glyphicon-star"></span></a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
        <div id="left-feature-slider" class="col-lg-2">
            <!---featureslider--->
        </div>
        <div id="right-col">
            <!---section2--->
            menu item<br>menu item<br>menu item<br>menu item<br>menu item<br>menu item<br>
        </div>
        <div id="left-col">
            <ul>
                <li><a href="/admin/claims/0/20" title="jobs">Jobs</a></li>
                <li><a href="/admin/documents/0/20" title="jobs">Documents</a></li>
                <li><a href="/admin/staff/0/20" title="jobs">Staff</a></li>
                <li><a href="/admin/clients/0/20" title="jobs">Clients</a></li>
                <li><a href="/admin/customers/0/20" title="jobs">Customers</a></li>
                <li><a href="/admin/companies/0/20" title="jobs">Companies</a></li>
                <li><a href="/admin/projects/0/20" title="jobs">Addresses</a></li>
                <li><a href="/admin/tickets/0/20" title="jobs">Tickets</a></li>
                <li><a href="/admin/claims/0/20" title="jobs">Jobs</a></li>
                <li><a href="/admin/claims/0/20" title="jobs">Jobs</a></li>
            </ul>
        </div>
        <div class="col-lg-6" id="left-feature">
            <h3>Main</h3>
            <div class="panel panel-default">
                
                
        	<!---section3--->
                
            </div>
        </div>
         
        <div id="right-feature">
            <h3>Feeds</h3>
            <div class="feed">                
                <?php echo $this->getContent('admin_ticker_request_token', array('2', '192.168.2.120'));?>
            
                <a class="twitter-timeline" href="https://twitter.com/search?q=%40AM730Traffic" data-widget-id="587458728019959808"  data-show-replies="false">Tweets about @AM730Traffic</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
        </div> 
          
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="//javascript.phoenixrestorations.com/ie10-viewport-bug-workaround.js"></script>
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//javascript.phoenixrestorations.com/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
    <script src="//javascript.phoenixrestorations.com/plugins/jquery.panelslider.min.js"></script>
    <!---javascript--->
  </body>
</html>
