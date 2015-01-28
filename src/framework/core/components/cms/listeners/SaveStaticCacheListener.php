<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\listeners;

use core\eventlisteners\AbstractCachableListener;
use core\eventlisteners\Event;
use Gossamer\Caching\CacheManager;

/**
 * saves a fully rendered page to cache
 *
 * @author Dave Meikle
 */
class SaveStaticCacheListener extends AbstractCachableListener {

    use \libraries\utils\traits\LoadConfigFile;
    
    /**
     * called before we begin to draw our ouput
     * 
     * @param Event $event
     */
    public function on_response_start(Event $event) {
        //start the output buffer
        ob_start();
    }

    /**
     * called once we've completed our output and want to save to cache
     * for later re-use
     * 
     * @param Event $event
     */
    public function on_render_complete(Event $event) {

        $caching = $this->getCachingFromConfig();
        if(!$caching) {
            try {
                while (ob_get_level() > 0) {
                    ob_end_flush();
                }
            } catch( Exception $e ) {}
            
            return;
        }
        
        $requestParams = $this->httpRequest->getParameters();
        $params['permalink'] = end($requestParams);

        $key = $this->getKey();
        $locale = $this->getDefaultLocale();

        if (!is_null($key)) {
            $key .= '-' . implode('_', $requestParams);
            $manager = new CacheManager($this->logger);
            $manager->saveToCache('cms' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . $locale['locale'] . DIRECTORY_SEPARATOR . $key, ob_get_contents(), true);
            unset($manager);
        }
        //flush the response
        try {
            while (ob_get_level() > 0) {
                ob_end_flush();
            }
        } catch( Exception $e ) {}
        
    }
    
    /**
     * loads configuration for cookies from the config file.
     * relies on included trait LoadConfig
     */
    private function getCachingFromConfig() {

        //load from trait
        $config = $this->loadConfig();
        
        if(!array_key_exists('cms', $config)) {
            throw new KeyNotSetException('cms key not found in config');
        }
        if(!array_key_exists('caching', $config['cms'])) {
            throw new KeyNotSetException('cms:caching key not found in config');
        }
      
        return $config['cms']['caching'] == 'true';
    }

}
