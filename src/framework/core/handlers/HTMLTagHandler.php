<?php

namespace core\handlers;

use core\handlers\BaseHandler;
use libraries\utils\YAMLKeyParser;


class HTMLTagHandler extends BaseHandler
{
    private $template = null;
    
    private $URIKeys = null;
    
    public function handleRequest($params = array()) {
        $loader = new YAMLKeyParser($this->logger);
//        $loader->setFilePath(__SITE_PATH. DIRECTORY_SEPARATOR . __NAMESPACE . DIRECTORY_SEPARATOR . ((strpos(__NAMESPACE, 'framework') !== false) ? 'core' . DIRECTORY_SEPARATOR : '') .
//                __COMPONENT_FOLDER. DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'views.yml');
        
        $config = $loader->getNodeByKey(__YML_KEY, 'views');
        if(!array_key_exists('htmltags', $config)) {
            return $this->template;
        }
        
        
        
        $this->getTagValues($config['htmltags'], $params);
        
        return $this->template;
    }
    
    private function getTagValues($htmlTags, $params) {
        $tags = $htmlTags['tags'];
        
        if(array_key_exists('container', $htmlTags)) {
            //let's assume we've got a single item to deal with
            $item = current($params[$htmlTags['container']]);
        } else {
            $item = $params;
        } 

        foreach($tags as $key => $tag) {
            if(substr($tag, 0, 1) == '@'){
                
                //check to ensure it's in the passed in params
                $value = $this->findKey($item,substr($tag, 1));
                
                if($value !== false) {
                    $this->template = str_replace("|$key|",$value, $this->template);
                }                
            } else {
                //just put the hardcoded value in from the config file
                $this->template = str_replace("|$key|",$tag, $this->template);
            }
        }        
    }
    
    private function findKey($array, $key) {
        
        if(array_key_exists($key, $array)) {
            
            return $array[$key];
        }
      
        if(array_key_exists('locales', $array)) {
            if(array_key_exists($key, $array['locales'][$array['locale']])) {
               
                return $array['locales'][$array['locale']][$key];
            }
        }
    }
    
    private function getTagString($tag, array $params) {
        
    }
    
    public function setTemplate($template) {
        $this->template = $template;
    }

}