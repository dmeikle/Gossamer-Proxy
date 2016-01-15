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
    foreach ($html->find('form[permissions=true]') as $e)
        $e->outertext = '';

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

$html = '
<!-- list -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>|title|</title>


                    <link rel="stylesheet" href="/css/core.min.css">

                        <link href="/css/components/staff/dist/css/staff.min.css" rel="stylesheet">

                        </head>

                        <body>
                            <div id="container">
                                <!---header--->
                                <div id="lower">

<div style="max-width:400px; padding-left: auto; padding-right: auto">
    <h2>Login Form</h2>
    <form role="form" method="post" permissions="true">
        <div class="form-group" permissions="true">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" />        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" />        </div>
        <div style="text-align:right">
            <a href="/admin/login/reset">I forgot my password</a>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </div>
    <input type="hidden" name="FORM_SECURITY_TOKEN" id="FORM_SECURITY_TOKEN" value="$1$5Cu3aClT$Azln3iYdjajtM6GhV9P1c." />
</form>

</div>
                                    <div id="payload">
                                        <!---payload--->

                                    </div>

                                </div>
                                <div id="footer">  <!---section5---> </div>
                            </div>


                        </body>


                        </html>

';

$dom = str_get_html($html);
echo html_no_permissions($dom);
