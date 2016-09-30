<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 8/31/2016
 * Time: 3:32 PM
 */

namespace libraries\utils\traits;


trait LoadCredentials
{

    private function getCredentials($key)
    {
        $loader = new \libraries\utils\YAMLParser($this->logger);
        $loader->setFilePath(__CONFIG_PATH .  DIRECTORY_SEPARATOR . 'credentials.yml');

        $config = $loader->loadConfig();
        if (!array_key_exists($key, $config)) {
            throw new \exceptions\KeyNotSetException('key ' . $key . ' missing from credentials');
        }

        return $config[$key];
    }

}