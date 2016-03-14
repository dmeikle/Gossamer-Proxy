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

use core\AbstractModel;
use Monolog\Logger;
use core\datasources\ConnectionAdapter;
use core\datasources\RestDataSource;

/**
 * Adapter class for REST data source
 *
 * @author Dave Meikle
 */
class RestConnectionAdapter extends ConnectionAdapter {

    /**
     * 
     * @param Logger $logger
     */
    public function __construct(Logger $logger) {
        parent::__construct($logger, new RestDataSource($logger));
    }

    /**
     * 
     * @param type $queryType
     * @param AbstractModel $entity
     * @param type $verb
     * @param type $params
     * 
     * @return array
     */
    public function query($queryType, AbstractModel $entity = null, $verb = null, $params = array()) {

        $this->datasource->setDatasourceKey($this->keyname);

        return $this->datasource->query($queryType, $entity, $verb, $params);
    }

}
