<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\blogs\listeners;

use core\components\caching\eventlisteners\AbstractCachableListener;
use core\eventlisteners\Event;
use Gossamer\Caching\CacheManager;
use exceptions\KeyNotSetException;

/**
 * Description of SaveStaticCacheListener
 *
 * @author Dave Meikle
 */
class SaveStaticCacheListener extends AbstractCachableListener {

    use \libraries\utils\traits\LoadConfigFile;

    public function on_response_start(Event $event) {

        ob_start(); // start the output buffer
    }

    public function on_render_complete(Event $event) {
        $caching = $this->getCachingFromConfig();
        if (!$caching) {
            ob_end_flush();
            return;
        }

        $requestParams = $this->httpRequest->getParameters();
        $params['permalink'] = end($requestParams);

        $key = $this->getKey();
        $locale = $this->getDefaultLocale();

        if (!is_null($key)) {
            $key .= '-' . implode('_', $requestParams);
            $manager = new CacheManager($this->logger);
            $manager->saveToCache('blogs' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . $locale['locale'] . DIRECTORY_SEPARATOR . $key, ob_get_contents(), true);
            unset($manager);
        }
        ob_end_flush();
    }

    /**
     * loads configuration for cookies from the config file.
     * relies on included trait LoadConfig
     */
    private function getCachingFromConfig() {

        //load from trait
        $config = $this->loadConfig();

        if (!array_key_exists('blog', $config)) {
            throw new KeyNotSetException('blog key not found in config');
        }
        if (!array_key_exists('caching', $config['blog'])) {
            throw new KeyNotSetException('blog:caching key not found in config');
        }

        return $config['blog']['caching'] == 'true';
    }

}
