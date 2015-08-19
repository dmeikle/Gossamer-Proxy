<!DOCTYPE html>
<!-- circloid admin list -->
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Fav and touch icons
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/assets/images/required/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/assets/images/required/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/assets/images/required/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/assets/images/required/ico/apple-touch-icon-57-precomposed.png">
-->
  <title>|title|</title>


  <!-- Optional CSS Files -->
  <link type="text/css" href="/css/theme/bootstrap.min.css" rel="stylesheet">
  <link href="/css/theme/css" rel="stylesheet" type="text/css">
  <link type="text/css" href="/css/theme/jqvmap.css" rel="stylesheet">
  <link type="text/css" href="/css/theme/circloid-jqvmap.css" rel="stylesheet">
  <link type="text/css" href="/css/theme/fullcalendar.min.css" rel="stylesheet">
  <link type="text/css" href="/css/theme/circloid-fullcalendar.css" rel="stylesheet">
  <link type="text/css" href="/css/theme/fullcalendar.print.css" rel="stylesheet" media="print">
  <link type="text/css" href="/css/theme/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <link type="text/css" href="/css/theme/styles-core.css" rel="stylesheet">
  <link type="text/css" href="/css/theme/styles-core-responsive.css" rel="stylesheet">

  <!-- css start -->
  <!---css--->
  <!-- css end -->

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script async="" src="/js/theme/analytics.js"></script>
  <script async="" src="/js/theme/analytics.js"></script>
  <script src="/js/theme/ie10-viewport-bug-workaround.js"></script>

  <!-- head start -->
  <!---head--->
  <!-- head end -->


  <!--[if IE 7]>
        <link type="text/css" href="assets/css/required/misc/style-ie7.css" rel="stylesheet">
        <script type="text/javascript" src="assets/fonts/lte-ie7.js"></script>
        <![endif]-->
  <!--[if IE 8]>
        <link type="text/css" href="assets/css/required/misc/style-ie8.css" rel="stylesheet">
        <![endif]-->
  <!--[if lte IE 8]>
        <script type="text/javascript" src="assets/css/required/misc/excanvas.min.js"></script>
        <![endif]-->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
  <script src="/js/theme/jquery.mousewheel.min.js"></script>
</head>

<body cz-shortcut-listen="true">

  <!---leftnav--->
  <div class="container-fluid">

    <!-- START Body Container -->
    <div id="body-container">

      <!-- START Right Column -->
      <div id="right-column">
        <div class="right-column-content">
          <!---breadcrumbs--->
          <div class="row">
            <div class="col-xs-12">
              <ol class="breadcrumb">
                <li>
                  <a href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/index.html">Home</a>
                </li>
                <li class="active">
                  <a href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/?click_source=demo_page_img#">Dashboard v1</a>
                </li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <h1>
                <span aria-hidden="true" class="icon icon-grid-big"></span>
                <span class="main-text">
                  <?php echo $this->getString('TITLE'); ?>
                </span>
              </h1>
            </div>
            <div class="col-md-6">
            </div>
          </div>
          <div class="row">
            <!---topwidgets--->
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <!-- START Block: Overview Graph -->
                  <!---section3--->

                  <!-- END Block: Overview Graph -->
                </div>
                <div class="col-md-4">
                </div>
              </div>

            </div>
            <div class="col-md-4">
              <div class="card">
                <h1>Discounts</h1>
                <div class="clearfix"></div>
                <div class="cardleft">
                  <div id="discount-randomizer" class="graph graph-epc graph-size-small" data-percent="89" data-graph-colors="#f14141,#6ec06e,#4596f1,#ffd040" style="width: 90px;">
                    <span class="percent" style="line-height: 90px;">89</span>
                    <canvas height="90" width="90"></canvas>
                  </div>
                </div>
                <div class="cardright">
                  <div class="c-widget-content-heading">
                    Discount
                  </div>
                  <div class="c-widget-content-sub highlight-color-red-link">
                    <a href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/?click_source=demo_page_img#" class="update-graph">
                      <span class="glyphicon glyphicon-refresh"></span>
                      Randomize
                    </a>
                  </div>
                </div>
              </div>
              <div class="card">
                <h1>Vouchers</h1>
                <div class="clearfix"></div>
                <div class="cardleft">
                  <div id="vouchers" class="graph graph-epc graph-size-small" data-percent="38" data-graph-colors="#4596f1" style="width: 90px;">
                    <span class="percent" style="line-height: 90px;">38</span>
                    <canvas height="90" width="90"></canvas>
                  </div>
                </div>
                <div class="cardright">
                  <div class="c-widget-content-heading">
                    Vouchers Used
                  </div>
                  <div class="c-widget-content-sub">
                    76 of 200 Used
                  </div>
                </div>
              </div>
              <div class="card">
                <h1>Mail</h1>
                <div class="clearfix"></div>
                <div class="cardleft">
                  <p>From: Someone</p>
                </div>
                <div class="cardright">
                  <p class="pull-right">Subject: Something Important</p>
                </div>

                <div class="mailcontent">
                  <p>Threw out original markup for this - it was WAY too complicated for
                     the function it was performing</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat est illo laboriosam iure sit, doloribus voluptatibus, eos esse illum debitis ratione obcaecati non earum dicta eaque, quas error aliquam eligendi!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, consequuntur, amet. Rerum deserunt vero praesentium sunt cum itaque, porro architecto inventore dolorem accusamus mollitia quos, vel. Necessitatibus at voluptatem porro!</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste aliquid reiciendis repellendus deserunt, aliquam eum? Labore at asperiores quod sit obcaecati, consequuntur recusandae, maiores illo quibusdam nemo excepturi praesentium blanditiis.</p>
                </div>

                <div class="cardfooter">
                  <div class="pull-right">
                    <a href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/?click_source=demo_page_img#">
                      <span class="glyphicon glyphicon-pencil"></span>
                      Write Reply
                    </a>
                    <a href="http://livedemo.base5builder.com/circloid_html/type_1/templates/blue/?click_source=demo_page_img#">
                      <span class="glyphicon glyphicon-trash"></span>
                      Delete
                    </a>
                  </div>
                </div>
              </div>
              <!---section4--->

            </div>
          </div>
        </div>

        <!-- START Footer Container -->
        <div id="footer-container">
          <div class="footer-content">
            <!---footer--->
          </div>
        </div>
        <!-- END Footer Container -->

      </div>
      <!-- END Right Column -->

    </div>
    <!-- END Body Container -->
  </div>
  <!-- /.container -->
  <!-- Placed at the end of the document so the pages load faster -->

  <!-- Required JS Files -->
  <script type="text/javascript" src="/js/theme/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.easing.1.3-min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.mCustomScrollbar.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.mousewheel-3.0.6.min.js"></script>
  <script type="text/javascript" src="/js/theme/retina.min.js"></script>
  <script type="text/javascript" src="/js/theme/icheck.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.ui.touch-punch.min.js"></script>
  <script type="text/javascript" src="/js/theme/circloid-functions.js"></script>

  <!-- Optional JS Files -->
  <script type="text/javascript" src="/js/theme/circloid-functions-optional.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.vmap.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.vmap.world.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.vmap.sampledata.js"></script> <!-- JQVMap Sample Data -->
  <script type="text/javascript" src="/js/theme/jquery.flot.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.flot.JUMlib.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.flot.resize.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.flot.tooltip.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.flot.pie.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.flot.stack.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="/js/theme/jquery.easypiechart.min.js"></script>
  <script type="text/javascript" src="/js/theme/moment.js"></script>
  <script type="text/javascript" src="/js/theme/fullcalendar.min.js"></script>
  <script type="text/javascript" src="/js/theme/bootstrap-datetimepicker.min.js"></script>
  <!-- add optional JS plugin files here -->

  <!-- REQUIRED: User Editable JS Files -->
  <script type="text/javascript" src="/js/theme/script.js"></script>
  <!-- add additional User Editable files here -->

  <!-- Demo JS Files -->
  <script type="text/javascript" src="/js/theme/index.js"></script>

  <!-- REQUIRED: User Editable JS Files -->
  <script type="text/javascript" src="/js/theme/script.js"></script>
  <!-- add additional User Editable files here -->

  <!-- Demo JS Files -->
  <script type="text/javascript" src="/js/theme/index.js"></script>

  <!---javascript--->

  <script language="javascript">
    (function() {
      angular.bootstrap(document, [<?php echo $modules; ?>]);
    })();
  </script>

</body>

</html>
