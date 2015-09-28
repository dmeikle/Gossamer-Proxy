<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\locales\utils;

use core\components\locales\exceptions\LangFileNotFoundException;

/**
 * loads the locales string files
 * 
 * @author Dave Meikle
 */
class LocaleLoader {

    private $localesList = array();

    /**
     * loads the file
     * 
     * @param string $filepath
     * 
     * @throws LangFileNotFoundException
     */
    public function loadFile($filepath) {
        if (file_exists($filepath)) {
            $loadedStrings = include $filepath;
            $this->localesList = array_merge($this->localesList, $loadedStrings);
        } else {
            throw new LangFileNotFoundException($filepath . ' does not exist');
        }
    }

    /**
     * returns the string from the loaded list based on requested key
     * 
     * @param string $key
     * @param string $default - the string to use if requested key not found
     * 
     * @return string
     */
    public function getString($key, $default = null) {

        if (array_key_exists($key, $this->localesList)) {

            return $this->localesList[$key];
        }

        return (is_null($default)) ? $key : $default;
    }

}
