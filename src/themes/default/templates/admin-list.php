<!DOCTYPE html>
<html lang="en">
<!-- admin list -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>|title|</title>

  <!-- css import for page -->
  <link rel="stylesheet" href="/css/core.min.css">

  <!-- css start -->
  <!---css--->
  <!-- css end -->


  <!-- head start -->
  <!---head--->
  <!-- head end -->
  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body cz-shortcut-listen="true" ng-cloak>
  <!---header--->
  
  <!---subnav--->
  <!---leftnav--->
  <div class="clearfix <?php if($this->getViewType() == 'html'){ echo 'hide';} ?>"></div>
  <main class="content full-width <?php if($this->getViewType() == 'tabbed'){ echo 'hide';} ?>">
    <!---content--->
    <!---payload--->
  </main>
  <div class="clearfix"></div>
  <!---footer--->
</body>

  <!---javascript--->



  <script language="javascript">
    (function() {
      angular.bootstrap(document, [<?php echo $modules; ?>]);
    })();
  </script>
</html>
