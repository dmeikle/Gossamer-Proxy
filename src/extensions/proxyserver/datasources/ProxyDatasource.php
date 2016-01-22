<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace extensions\proxyserver\datasources;

use core\datasources\DataSourceInterface;
use core\AbstractModel;
use libraries\utils\YAMLCredentialsConfiguration;
use Monolog\Logger;

/**
 * ProxyDatasource
 *
 * @author Dave Meikle
 */
class ProxyDatasource implements DataSourceInterface {

    use \core\datasources\traits\CurlResourceTrait;

    private $keyname;
    private $logger = null;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function query($queryType, AbstractModel $entity, $verb, $params) {
        return $this->$verb($entity, $verb, $params);
    }

    public function setDatasourceKey($keyName) {
        $this->keyname = $keyName;
    }

    private function mail(AbstractModel $entity, $verb, array $params) {

        return array('content' => $this->execute($entity->getTablename(), $verb, null, $params));
    }

}
