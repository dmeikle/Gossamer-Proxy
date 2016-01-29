<!-- list -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>|title|</title>
                    <!---head--->

                    <link rel="stylesheet" href="/css/core.min.css">

                        <!---css--->
                        </head>
                        <body>
                            <!---header--->
                            <!---leftnav--->
                            <div id="container">
                                <!--<div id="lower">-->
                                <main ng-controller="sideNavCtrl" ng-class="{'sideNavClosed': sideNavOpen == false}" class="content full-width">

                                    <!---section3--->
                                    <div id="payload">
                                        <!---payload--->
                                    </div>

                                </main>
                                <!--</div>-->
                                <div id="footer">  <!---section5---> </div>
                            </div>


                        </body>
                        <!---javascript--->
                        <script language="javascript">
                            (function () {
                                angular.bootstrap(document, [<?php echo $modules; ?>]);
                            })();
                        </script>
                        </html>
