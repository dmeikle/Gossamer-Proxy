<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\datasources\traits;

use libraries\utils\YAMLCredentialsConfiguration;

/**
 * CurlResourceTrait
 *
 * @author Dave Meikle
 */
trait CurlResourceTrait {

    private $credentials = null;

    protected function execute($segment, $verb, $queryString = null, array $params = null) {
        if (is_null($this->credentials)) {
            $this->setCredentials($this->keyname);
        }
        file_put_contents('/var/www/ip2/phoenixrestorations.com/logs/save.log', $this->credentials['baseUrl'] . "$segment/$verb" . (!is_null($queryString) ? "/?" . $queryString : ''), FILE_APPEND);

        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->credentials['baseUrl'] . "$segment/$verb" . (!is_null($queryString) ? "/?" . $queryString : ''));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if (!is_null($params)) {

            $fieldsString = '';

            //url-ify the data for the POST
            $fieldsString = json_encode($params);

            curl_setopt($ch, CURLOPT_POST, count($params));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
            file_put_contents('/var/www/ip2/phoenixrestorations.com/logs/save.log', $fieldsString, FILE_APPEND);
        }
        $r = curl_exec($ch);
        curl_close($ch);
        file_put_contents('/var/www/ip2/phoenixrestorations.com/logs/save.log', print_r($r, true), FILE_APPEND);

        return $r;
    }

    /**
     * sets the credentials to identify ourselves to the API server
     *
     * @param type $ymlKey
     *
     * @return array
     */
    private function setCredentials($ymlKey) {

        $config = new YAMLCredentialsConfiguration($this->logger);

        $credentials = $config->getNodeParameters($ymlKey);
        unset($config);

        $this->credentials = $credentials['credentials'];
    }

}
