<?php

namespace core\handlers;

use core\handlers\BaseHandler;
use libraries\utils\YAMLKeyParser;

class URITagHandler extends BaseHandler
{
    private $template = null;
    
    private $URIKeys = null;
    
    public function handleRequest($params = array()) {
        // <gcms:uri='cart_admin_categories_list'/>
        $keys = $this->getURIKeys();
        $tags = $this->getURITagKeys();
        $tmp = $this->trimKeys($keys, $tags);
        $this->insertLinks($tmp);
        
        return $this->template;
    }
    
    private function trimKeys($keys, $tags) {
        $flippedTags = array_flip($tags);
        
        foreach ($keys as $key => $value) {
            if(!array_key_exists($key, $flippedTags)) {
                unset($keys[$key]);
            }
        }
        array_walk($keys, function(&$item) { $item = '/' . $item;});
        
        return $keys;
    }

    function insertLinks($keys) {

        $uriLinks = array();
       
        foreach($keys as $key => $link) {
            echo "$link<br>"."<gcms:uri='$key'/><br>";
            $uriLinks[] = '<gcms:uri=\''.$key.'\'/>';
        }
        
        $this->template = str_replace($uriLinks, $keys, $this->template);
    }

    function getURITagKeys()
    {
        //<gmcs:uri=cart_admin_categories_list/>
        $pattern = "/<gcms:uri='(.*?)'\/>/";
        preg_match_all($pattern, $this->template, $matches);
      
        array_shift($matches);
       
        return current($matches);
    }
    
    
    private function getURIKeys() {
        if(is_null($this->URIKeys)) {
            $parser = new YAMLKeyParser($this->logger);
            $this->URIKeys = $parser->getKeys();
            unset($parser);
        }
        
        return $this->URIKeys;
    }
    
    
    public function setTemplate(&$template) {
        $this->template = $template;
    }
}