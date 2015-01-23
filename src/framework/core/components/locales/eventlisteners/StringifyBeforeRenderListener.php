<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\locales\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * performs the find/replace of locale strings into content
 *
 * @author Dave Meikle
 */
class StringifyBeforeRenderListener extends AbstractListener {

    private $locales = null;

    /**
     * entry point
     * 
     * @param Event $event
     */
    public function on_response_start(Event &$event) {

        $this->locales = $this->httpRequest->getAttribute('langFiles');

        $params = $event->getParams();
        $retval = array();
        if (is_array($params)) {
            foreach ($params as $key => $item) {
                $retval[$key] = $this->renderItem($item);
            }
        }

        $event->setParams($retval);
    }

    /**
     * renders the item into the content
     * 
     * @param array|string
     * 
     * @return type
     */
    private function renderItem($item) {
        if (is_array($item)) {
            $result = array();

            foreach ($item as $key => $subitem) {
                $result[$key] = $this->renderItem($subitem);
            }

            return $result;
        }

        preg_match('/\|(.+?)\|/', $item, $content);

        if (is_array($content) && count($content) > 0) {
            return str_replace($content[0], $this->locales->getString($content[1]), $item);
        }

        return $item;
    }

}
