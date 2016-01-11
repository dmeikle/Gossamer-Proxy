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

        return $this->$verb($params);
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

    private function get($params) {

        $url = "http://www.offthemaptattoo.com/The-Perfect-Tattoo.pdf";
//        file_put_contents("/var/www/ip2/phoenixrestorations.com/logs/save.log", fopen($url, 'r'));
//        die('complete');
//
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $r = curl_exec($ch);
        curl_close($ch);
//        header('Expires: 0'); // no cache
//        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
//        header('Cache-Control: private', false);
//        header('Content-Type: application/force-download');
//        header('Content-Disposition: attachment; filename="' . basename($url) . '"');
//        header('Content-Transfer-Encoding: binary');
//        header('Content-Length: ' . strlen($r)); // provide file size
//        header('Connection: close');

        return array('content' => $r, 'filename' => basename($url));
    }

    /**
     * gets the credentials to identify ourselves to the API server
     *
     * @param type $ymlKey
     *
     * @return array
     */
    private function getCredentials($ymlKey) {

        $config = new YAMLCredentialsConfiguration($this->logger);

        $credentials = $config->getNodeParameters($ymlKey);
        unset($config);

        return $credentials;
    }

}
