<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\security\eventlisteners;

use core\components\security\lib\HTMLDomParser;
use core\components\security\lib\HTMLDomNode;
use core\eventlisteners\AbstractListener;

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

/**
 * FilterHTMLNodesByPermissionsListener
 *
 * @author Dave Meikle
 */
class FilterHTMLNodesByPermissionsListener extends AbstractListener {

    public function on_request_end($params) {
        error_log('inside filter nodes');
        pr($parms);
        die;
        $this->filterHTMLPermissionsDivs($html);
    }

    function filterHTMLPermissionsDivs($html) {


        // remove all comment elements
        foreach ($html->find('div[permissions=true]') as $e) {
            $e->outertext = '';
        }
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

}
