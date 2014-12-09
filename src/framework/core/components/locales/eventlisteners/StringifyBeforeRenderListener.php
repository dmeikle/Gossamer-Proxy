<?php

namespace core\components\locales\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;


/**
 * Description of StringifyBeforeRenderListener
 *
 * @author davem
 */
class StringifyBeforeRenderListener extends AbstractListener{
    
    private $locales = null;
    
    public function on_response_start(Event &$event) {
        
        $this->locales = $this->httpRequest->getAttribute('langFiles');
        
        $params = $event->getParams();
        $retval = array();
        if(is_array($params)) {
            foreach($params as $key => $item) {
                $retval[$key] = $this->renderItem($item);
            }
        }        
        
        $event->setParams($retval);
    }
    
    private function renderItem($item) {
        if(is_array($item)) {
            $result = array();
            
            foreach($item as $key => $subitem) {
                $result[$key] = $this->renderItem($subitem);
            }
            
            return $result;
        }
        
        preg_match('/\|(.+?)\|/', $item, $content);
        
        if(is_array($content) && count($content) > 0) {
            return str_replace($content[0] , $this->locales->getString($content[1]), $item); 
        }
          
        return $item;
    }
}
