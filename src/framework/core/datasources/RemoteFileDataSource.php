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
use Monolog\Logger;

/**
 * used for reading/writing info to a file datasource
 *
 * @author Dave Meikle
 */
class RemoteFileDataSource implements DataSourceInterface {

    private $keyname;
    private $logger = null;

    use core\datasources\traits\CurlResourceTrait;

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

}
