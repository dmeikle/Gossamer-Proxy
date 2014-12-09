<?php

namespace core\handlers;

use core\handlers\BaseHandler;
use libraries\utils\YAMLKeyParser;


class HTMLTagHandler extends BaseHandler
{
    private $template = null;
    
    private $URIKeys = null;
    
    public function handleRequest($params = array()) {
        $htmlTags = include __SITE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'core' .
                DIRECTORY_SEPARATOR . 'handlers' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR .
                'HTMLTags.php';
        foreach($htmlTags as $key => $tag) {            
            $this->template = str_replace($key, $tag, $this->template);
        }
    }
    
    
    
    private function swapURITags($tag) {
       if(is_null($this->URIKeys)) {
            $parser = new YAMLKeyParser($this->logger);
            $this->URIKeys = $parser->getKeys();
            unset($parser);
        }
        if(!array_key_exists($ag, $this->URIKeys)) {
            throw new URINotFoundException('HTMLTagHander::'. $tag . ' not found in URIKeys');
        }
        
        return '/' . $this->URIKeys[$tag];
    }
    
    public function setTemplate($template) {
        $this->template = $template;
    }

}