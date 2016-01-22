<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\datasources;

use core\datasources\DataSourceInterface;
use core\AbstractModel;
use libraries\utils\YAMLCredentialsConfiguration;
use Monolog\Logger;

/**
 * used for reading/writing info to a file datasource
 *
 * @author Dave Meikle
 */
class RemoteFileDataSource implements DataSourceInterface {

    private $keyname;
    private $logger = null;
    private $credentials = null;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    /**
     * query    - a few of the default parameters passed in will not be used for
     *            the basic simplicity of the File I/O
     *
     * @param string queryType  PUT/POST/GET/DELETE #ignored
     * @param AbstractModel entity  #ignored
     * @param string verb       save/delete/get/list #required
     * @param array params      parameters needed for file I/O
     */
    public function query($queryType, AbstractModel $entity, $verb, $params) {
        error_log($verb);
        return $this->$verb($entity, $verb, $params);
    }

    /**
     *
     * @param string $keyName
     */
    public function setDatasourceKey($keyName) {
        $this->keyname = $keyName;
    }

    private function save($content, $filepath) {
        file_put_contents($filepath, $content);
    }

    private function delete($content, $filepath) {
        shell_exec('rm -fr ' . $filepath);
    }

    private function pdf(AbstractModel $entity, $verb, array $params) {

        $queryString = '';
        foreach ($params as $key => $value) {
            $queryString .= "&$key=" . urldecode($value);
        }

        return array('content' => $this->execute($entity->getTablename(), $verb, substr($queryString, 1)));
    }

    private function mail(AbstractModel $entity, $verb, array $params) {

        return array('content' => $this->execute($entity->getTablename(), $verb, null, $params));
    }

    private function execute($segment, $verb, $queryString = null, array $params = null) {
        if (is_null($this->credentials)) {
            $this->setCredentials($this->keyname);
        }

        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->credentials['baseUrl'] . "$segment/$verb" . (!is_null($queryString) ? "/?" . $queryString : ''));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if (!is_null($params)) {

            $fieldsString = '';
            error_log('posting');

            //url-ify the data for the POST
            $fieldsString = json_encode($params);

            curl_setopt($ch, CURLOPT_POST, count($params));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
            file_put_contents('/var/www/ip2/phoenixrestorations.com/logs/save.log', print_r($fieldsString, true), FILE_APPEND);
        }
        $r = curl_exec($ch);
        curl_close($ch);

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

        file_put_contents('/var/www/ip2/phoenixrestorations.com/logs/save.log', print_r($credentials, true));
        unset($config);
        $this->credentials = $credentials['credentials'];
        file_put_contents('/var/www/ip2/phoenixrestorations.com/logs/save.log', print_r($this->credentials, true), FILE_APPEND);
    }

}
