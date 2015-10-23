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

use \core\eventlisteners\AbstractListener;
use core\components\locales\utils\LocaleLoader;

/**
 * loads the strings based on currently selected locale
 *
 * @author Dave Meikle
 */
class LoadLocaleStringsListener extends AbstractListener {

    public function on_entry_point($filename) {
        $this->loadStrings($filename);
    }

    /**
     *
     * @param string  $filename
     *
     * @return LocaleLoader
     */
    public function on_request_start($filename) {
        $this->loadStrings($filename);
    }

    public function loadStrings($filename) {
        $config = $this->httpRequest->getAttribute('langFilesList');
        if (is_null($config)) {

            return new LocaleLoader($filename);
        }

        $loader = new LocaleLoader($filename);

        foreach ($config as $filename) {
            try {
                $loader->loadFile($this->getFilepath($filename . '.php'));
            } catch (\Exception $e) {
                $this->logger->addError($e->getMessage());
            }
        }

        $this->httpRequest->setAttribute('langFiles', $loader);
    }

    /**
     * determines the filepath of the locale strings based on the currently
     * selected locale
     *
     * @param string $filename
     *
     * @return string
     */
    private function getFilepath($filename) {
        $locale = $this->getDefaultLocale();

        return __SITE_PATH . DIRECTORY_SEPARATOR . str_replace('*', $locale['locale'], $filename);
    }

}
