<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


include_once('includes/configuration.php');
include_once('../vendor/autoload.php');
include_once('includes/init.php');
include_once('includes/bootstrap.php');

use core\components\security\lib\HTMLDomNode;
use core\components\security\lib\HTMLDomParser;

define('HDOM_TYPE_ELEMENT', 1);
define('HDOM_TYPE_COMMENT', 2);
define('HDOM_TYPE_TEXT', 3);
define('HDOM_TYPE_ENDTAG', 4);
define('HDOM_TYPE_ROOT', 5);
define('HDOM_TYPE_UNKNOWN', 6);
define('HDOM_QUOTE_DOUBLE', 0);
define('HDOM_QUOTE_SINGLE', 1);
define('HDOM_QUOTE_NO', 3);
define('HDOM_INFO_BEGIN', 0);
define('HDOM_INFO_END', 1);
define('HDOM_INFO_QUOTE', 2);
define('HDOM_INFO_SPACE', 3);
define('HDOM_INFO_TEXT', 4);
define('HDOM_INFO_INNER', 5);
define('HDOM_INFO_OUTER', 6);
define('HDOM_INFO_ENDSPACE', 7);
define('DEFAULT_TARGET_CHARSET', 'UTF-8');
define('DEFAULT_BR_TEXT', "\r\n");
define('DEFAULT_SPAN_TEXT', " ");
define('MAX_FILE_SIZE', 600000);

function html_no_permissions($html) {


    // remove all comment elements
//    foreach ($html->find('input[type=checkbox]') as $e)
//        $e->outertext = '';

    $ret = $html->save();

    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}

// get html dom from string
function str_get_html($str, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT) {
    $dom = new HTMLDomParser(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
    if (empty($str) || strlen($str) > MAX_FILE_SIZE) {
        $dom->clear();
        return false;
    }
    $dom->load($str, $lowercase, $stripRN);
    return $dom;
}

$html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Bootstrap 101 Template</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>Hello, world!</h1>
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
      <label>
        <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
        Carpet </label>
    </div>
  <div class="panel-heading"> Extraction </div>

  <div class="checkbox">
      <label>
        <input type="checkbox" name="SecondarySheet[1]" value="1" ng-model="secondarySheet.item_1" id="SecondarySheet_question" />
        Carpet </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="SecondarySheet[2]" value="1" ng-model="secondarySheet.item_2" id="SecondarySheet_question" />
        Lino </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="SecondarySheet[3]" value="1" ng-model="secondarySheet.item_3" id="SecondarySheet_question" />
        Tile </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="SecondarySheet[4]" value="1" ng-model="secondarySheet.item_4" id="SecondarySheet_question" />
        Hardwood </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="SecondarySheet[5]" value="1" ng-model="secondarySheet.item_5" id="SecondarySheet_question" />
        Other </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="SecondarySheet[6]" value="1" ng-model="secondarySheet.item_6" id="SecondarySheet_question" />
        Leech Wand </label>
    </div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>

<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
';

$dom = str_get_html($html);
echo html_no_permissions($dom);
