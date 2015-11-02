
<!-- admin list -->


<!DOCTYPE html>
<html lang="en" ng-app="staff">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//javascript.phoenixrestorations.com/jquery.js"></script>
        <script src="//javascript.phoenixrestorations.com/jquery-ui.js"></script>

        <link rel="stylesheet" type="text/css" href="//css.phoenixrestorations.com/fonts/googlefonts.css" />
        <link rel="stylesheet" type="text/css" href="//css.phoenixrestorations.com/jquery-ui.min.css"/>
        <link rel="stylesheet" href="//css.phoenixrestorations.com/pagination.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="//css.phoenixrestorations.com/bootstrap/3.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            #logo {
                float: left;
                width: 200px;
            }
            #search-box {
                width: 500px;
                float: left;
            }
            #user-info {
                float: left;
            }
            #lower {
                margin-top: 100px;
            }
            .container-fluid #feature-left {

            }
            .container-fluid #left-col {
                clear: both;
                padding: 10px;
                margin-top: 40px;
            }

            .container-fluid #left-col ul li {
                list-style: none;
                margin-top: 5px;
            }
            .container-fluid #left-col ul li span.fa{
                float: left;
            }
            .container-fluid #left-col ul li .btn {
                width: 110px;
            }

            .container-fluid #feature-right {

                padding: 10px;
            }
            .container-fluid #right-col {

            }

            .feature-slider {
                position:absolute;
                /* set it to 10px to offset other div's padding */
                right: 10px;
                background-color: white;
                display:none;
                border: solid 1px grey;
                border-radius: 5px;
            }

            form {
                margin-right: 20px;
            }


            //radio buttons
            #feedback { font-size: 1.4em; }
            .selectable .ui-selecting { background: #FECA40; }
            .selectable .ui-selected { background: #F39814; color: white; }
            .selectable { list-style-type: none; margin: 0; padding: 0;  }
            .selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; width: 45%;}
            .selectable label {
                width: 45%;
            }
        </style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

        <!---css--->

        <script language="javascript">

            $(document).ready(function () {

                $('#set-homepage').click(function () {
                    $.post('/admin/staff/homepage', function (data) {

                    })
                });
            });

        </script>
    </head>
    <body>
        <div class="container-fluid">

            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar">qwe</span>
                            <span class="icon-bar">qwe</span>
                            <span class="icon-bar">qwe</span>
                        </button>
                        <div id="logo"></div>
                        <a class="navbar-brand" href="#">iRestore</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <?php
                                echo $this->getMenu('cssmenu_adminbar', array('staffid' => $this->getLoggedInUser()->getId()));
                                ?>
                            </li>
                            <li><a href="#" id="set-homepage" title="set as homepage"><span class="glyphicon glyphicon-star"></span></a></li>
                        </ul>
                        <form class="navbar-form">
                            <input type="text" class="form-control" placeholder="Search..." id="search-box">
                        </form>
                    </div>
                </div>
            </nav>
            <div id="lower">
                <div class="col-lg-1" id="left-col">
                    <p></p>
                    <ul>
                        <li>
                            <button onclick="document.location.href = '/admin/claims/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-folder-open" aria-hidden="true"> Jobs</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="document.location.href = '/admin/documents/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-file-text" aria-hidden="true"> Documents</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="document.location.href = '/admin/staff/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-rocket" aria-hidden="true"> Staff</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="document.location.href = '/admin/clients/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-users" aria-hidden="true"> Clients</span>
                            </button>

                        </li>
                        <li>
                            <button onclick="document.location.href = '/admin/companies/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-university" aria-hidden="true"> Companies</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="document.location.href = '/admin/projects/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-building" aria-hidden="true"> Addresses</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="document.location.href = '/admin/tickets/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-ticket" aria-hidden="true"> Tickets</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-child" aria-hidden="true"> Customers</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="document.location.href = '/admin/scheduling/calendar/0/20'" type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-calendar" aria-hidden="true"> Schedule</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6" id="feature-left">
                    <!---section3--->
                </div>
                <div class="col-lg-4" id="feature-right">

                    <h3>Feeds</h3>

                    <div class="feed">
                        <?php echo $this->getContent('admin_ticker_request_token', array('2', '192.168.2.120')); ?>
                    </div>
                    <div class="feed">
                        <?php
                        //echo $this->getMenu('admin_twitter_traffic', array(10));
                        echo $this->getContent('admin_twitter_traffic', array('2', '192.168.2.120'));
                        ?>
                    </div>
                </div>
                <div class="col-lg-1" id="right-col">
                    this is right col<br>
                    this is right col<br>
                    vthis is right col<br>
                    this is right col<br>

                </div>

                <div class="col-lg-5 feature-slider" id="left-feature-slider" >
                    <!---featureslider--->
                </div>

                <div class="col-lg-5 feature-slider" id="left-feature-slider-edit">
                    <!---featureslider-edit--->
                </div>
                <div class="col-lg-5 feature-slider" id="left-feature-slider-edit1">
                    <!---featureslider-edit1--->
                </div>

                <div class="col-lg-5 feature-slider" id="left-feature-slider-edit2">
                    <!---featureslider-edit2--->
                </div>

                <div class="col-lg-5 feature-slider" id="left-feature-slider-edit3">
                    <!---featureslider-edit3--->
                </div>

                <div class="col-lg-5 feature-slider" id="left-feature-slider-edit4">
                    <!---featureslider-edit4--->
                </div>
                <div class="col-lg-5 feature-slider" id="left-feature-slider-edit5">
                    <!---featureslider-edit5--->
                </div>

            </div>
        </div>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="//javascript.phoenixrestorations.com/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.2/underscore-min.js" type="text/javascript"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.2/backbone-min.js"></script>
        <script language="javascript" src="/js/angular/angular.min.js"></script>

        <!---javascript--->

    </body>
</html>