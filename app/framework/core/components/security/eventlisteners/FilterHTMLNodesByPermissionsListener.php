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
use core\eventlisteners\Event;
use core\eventlisteners\AbstractListener;
use libraries\utils\YamlFileIterator;

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

    use \libraries\utils\traits\LoadConfigFile;

    public function on_render_complete(Event &$event) {
        $this->filterPage($event);
    }

    public function on_render_bypass(Event &$event) {
        $this->filterPage($event);
    }

    private function filterPage(Event &$event) {

        $permissions = $this->loadPermissionsConfig();
        if (is_null($permissions)) {
            return;
        }

        $params = $event->getParams();

        $html = $params['renderedPage'];
        $dom = $this->getDomByString($html);
        $params['renderedPage'] = $this->filterHTMLPermissionsDivs($dom, $permissions);
        $event->setParams($params);
    }

    public function filterHTMLPermissionsDivs(HTMLDomParser $dom, array $row) {
        $clientPermissions = $this->getClientPermissions();

        if (!is_null($clientPermissions)) {

            foreach ($row['tags'] as $permission) {
                $tag = $permission['tag'];
                $key = $permission['permission-key'];

                $roles = $permission['roles'];

                $permittedRoles = array_intersect($clientPermissions, $roles);

                if (count($permittedRoles) == 0) {

                    foreach ($dom->find($tag . '[permission-key=' . $key . ']') as $e) {
                        $e->outertext = '';
                    }
                }
            }
        }

        $ret = $dom->save();

        // clean up memory
        $dom->clear();
        unset($dom);

        return $ret;
    }

// get html dom from string
    function getDomByString($str, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT) {
        $dom = new HTMLDomParser(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);

        if (empty($str) || strlen($str) > MAX_FILE_SIZE) {
            $dom->clear();
            return false;
        }

        $dom->load($str, $lowercase, $stripRN);

        return $dom;
    }

    private function getClientPermissions() {
        $client = $this->getClient();

        if (is_null($client)) {
            return null;
        }

        return $client->getRoles();
    }

    private function loadPermissionsConfig() {
        $config = $this->loadCachedComponentConfig(__YML_KEY, 'permissions_config', 'permissions');

        if (array_key_exists(__YML_KEY, $config)) {
            return $config[__YML_KEY];
        } else {
            return null;
        }
    }

}
