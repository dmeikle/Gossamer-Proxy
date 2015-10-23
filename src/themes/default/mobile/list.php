
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title></title>

                    <!-- Latest compiled and minified CSS -->
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

                        <link rel="stylesheet" href="http://localhost/css/framework.css" />
                        <link rel="stylesheet" type="text/css" href="../css/selectize/selectize.css" />
                        <link rel="stylesheet" type="text/css" href="../css/selectize/selectize.bootstrap3.css" />
                        <link href="/css/portal-framework.css" rel="stylesheet" type="text/css" />



                        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                        <!-- Include all compiled plugins (below), or include individual files as needed -->
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

                        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
                        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

                        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                        <!--[if lt IE 9]>
                              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                            <![endif]-->


                        <style>

                            .full-width {width: 100% !important;}


                            .selectable .ui-selected {background: #F39814; color: white; }
                            .selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
                            .selectable li { padding:5px; margin: 3px;  font-size: 1.4em; }


                            .selectable label input{visibility: hidden;}
                            .selectable label{display:block; border-radius:5px; border: 1px solid #ccc; cursor: pointer;}

                            .selectable label.ui-selected{background: #F39814; color: white;}
                            #container #lower #leftcolumn {
                                float: left;
                                width: 200px;
                            }
                            #container #lower #payload #common-areas {
                                clear: both;
                                width: 100%;
                                margin-top: 10px;
                                display: block;
                            }



                            #container #lower #common-areas a {
                                width: 200px;
                                float: left;
                                text-align: center;
                                background-color: #F60;
                                padding: 5px;
                                margin-right: 10px;
                                margin-left: 10px;
                                font-size: 18px;
                                font-weight: 600;
                                color: #FFF;
                                border: 1px solid #333;
                            }
                            #container #lower #payload{
                                width:700px;
                            }
                            #container #lower #payload div #name {
                                font-size: 36px;
                                line-height: 40px;
                            }
                            #container #lower #payload .unitInfo {
                                width: 75px;
                                float: left;
                                margin-right: 2px;
                                margin-top: 10px;
                            }
                            #container #lower #payload .unitInfo .unit {
                                border: 1px solid #333;
                                font-size: 24px;
                                font-weight: bold;
                                text-align: center;
                                padding-top: 5px;
                                padding-bottom: 5px;
                            }
                        </style>


                        <script>
                            $(function () {

                                $('.selectable').on('mouseup', 'label', function () {
                                    var el = $(this);
                                    console.info(el);
                                    if (el.hasClass('ui-selected')) {
                                        el.removeClass('ui-selected');
                                    } else {
                                        el.addClass('ui-selected');
                                    }

                                })



                            });
                        </script>


                        </head>

                        <body>
                            <div id="container">
                                <!---section1--->
                                <div id="lower">
                                    <!---section3--->
                                    <div id="payload">
                                        <!---section4--->

                                    </div>

                                </div>
                                <div id="footer">  <!---section5---> </div>
                            </div>


                        </body>
                        </html>
