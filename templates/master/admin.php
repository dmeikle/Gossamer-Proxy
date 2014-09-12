<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Spectral Cow | Paranormal Investigations Vancouver</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="http://includes.spectralcow.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://includes.spectralcow.com/jquery.slidertron-1.3.js"></script>
<script type="text/javascript" src="http://includes.spectralcow.com/admin.js"></script>

<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="http://css.spectralcow.com/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="http://css.spectralcow.com/fonts.css" rel="stylesheet" type="text/css" media="all" />
<style type="text/css" title="currentStyle">
    @import "http://css.spectralcow.com/DataTables/media/css/demo_table.css";
</style>
<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
    <?php include_once("includes/analytics.php") ?>
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="http://www.spectralcow.com">SpectralCow</a></h1>

        </div>
        <div id="menu">
            <ul>
                <li><a href="http://www.spectralcow.com" accesskey="1" title="Vancouver Paranormal Investigations">Homepage</a></li>

                <?php foreach($upperNav as $navLocation => $navParams):
                    if($navParams['current']):?>
                     <li class="current_page_item"><a href="/<?php echo $navParams['uri'];?>/" accesskey="4" title="<?php echo $navParams['title'];?>"><?php echo $navParams['text'];?></a></li>
                    <?php else:?>
                    <li><a href="/<?php echo $navParams['uri'];?>/" accesskey="4" title="<?php echo $navParams['title'];?>"><?php echo $navParams['text'];?></a></li>
                <?php endif;
                endforeach; ?>

            </ul>
            <!---subnav--->
        </div>

    </div>
</div>
<!--<div id="header-featured"> </div>-->
<div id="banner-wrapper">
    <div id="banner" class="container">
        <p><!---content---></p>
    </div>
</div>
<div>
    <!---lowersection--->
</div>
<div id="copyright" class="container">
    <p>Copyright (c) 2013 spectralcow.com. All rights reserved. | Website by <a href="http://www.quantumunit.com/" >www.quantumunit.com</a>.</p>
</div>
</body>
</html>
