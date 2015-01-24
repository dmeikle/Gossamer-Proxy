<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\handlers;

use core\handlers\BaseHandler;
use libraries\utils\YAMLKeyParser;

/**
 * looks for uri tags using a yml key and places the real uri in there
 * 
 * @author Dave Meikle
 */
class URITagHandler extends BaseHandler {

    private $template = null;
    private $URIKeys = null;

    /**
     * 
     * @param array $params
     * 
     * @return string
     */
    public function handleRequest($params = array()) {
        // <gcms:uri='cart_admin_categories_list'/>
        $keys = $this->getURIKeys();
        $tags = $this->getURITagKeys();
        $tmp = $this->trimKeys($keys, $tags);
        $this->insertLinks($tmp);

        return $this->template;
    }

    /**
     * removes any keys that are not listed in the tags
     * 
     * @param array $keys
     * @param array $tags
     * 
     * @return array
     */
    private function trimKeys(array $keys, array $tags) {
        $flippedTags = array_flip($tags);

        foreach ($keys as $key => $value) {
            if (!array_key_exists($key, $flippedTags)) {
                unset($keys[$key]);
            }
        }
        array_walk($keys, function(&$item) {
            $item = '/' . $item;
        });

        return $keys;
    }

    /**
     * 
     * @param array $keys
     */
    function insertLinks($keys) {

        $uriLinks = array();

        foreach ($keys as $key => $link) {
            echo "$link<br>" . "<gcms:uri='$key'/><br>";
            $uriLinks[] = '<gcms:uri=\'' . $key . '\'/>';
        }

        $this->template = str_replace($uriLinks, $keys, $this->template);
    }

    /**
     * 
     * @return array
     */
    function getURITagKeys() {
        //<gmcs:uri=cart_admin_categories_list/>
        $pattern = "/<gcms:uri='(.*?)'\/>/";
        preg_match_all($pattern, $this->template, $matches);

        array_shift($matches);

        return current($matches);
    }

    /**
     * 
     * @return array
     */
    private function getURIKeys() {
        if (is_null($this->URIKeys)) {
            $parser = new YAMLKeyParser($this->logger);
            $this->URIKeys = $parser->getKeys();
            unset($parser);
        }

        return $this->URIKeys;
    }

    /**
     * accessor
     * 
     * @param string $template
     */
    public function setTemplate(&$template) {
        $this->template = $template;
    }

}
