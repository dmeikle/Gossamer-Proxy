<!-- super list fullscreen -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap 101 Template</title>

<!-- Latest compiled and minified CSS
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 -->
<link rel="stylesheet" href="/css/bootstrap/3.1.1-dist/css/bootstrap.min.css" />
     
     
<link rel="stylesheet" type="text/css" href="/css/selectize/selectize.css" />
<link rel="stylesheet" type="text/css" href="/css/selectize/selectize.bootstrap3.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" />

<!---css--->
    
    
<!-- system framework --->
<link rel="stylesheet" href="/css/framework.css" />
    
    
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
-->
<script src="/js/bootstrap/bootstrap.min.js"></script> 


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
<script src="/js/ie10-viewport-bug-workaround.js"></script> 

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    


</head>

<body>
     <?php
echo $this->getMenu('cssmenu_superuserbar', array('staffid' => $this->getLoggedInUser()->getId()));
?>
<div id="container-fluid">
  <div id="header-admin">
      <div id="logo">Phoenix Restorations</div>
    <!---section1--->
     <!---section2---> 
    
   
  </div>
  <div id="lower">
    <div id="leftcolumn"> </div>
    <div id="payload">  
     <!---section3--->
    </div>
  </div>
  <div id="footer"><!---section4---></div>
</div>


<!---javascript--->
<script src="/js/pagination.js"></script>  

</body>
</html>
