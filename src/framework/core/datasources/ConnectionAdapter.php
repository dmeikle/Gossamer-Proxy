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

use Monolog\Logger;
use core\AbstractModel;
use core\datasources\AdapterInterface;

abstract class ConnectionAdapter
{
    protected $datasource = null;

    protected $logger = null;
    
    protected $keyname;
    
    public function __construct(Logger $logger, AdapterInterface $datasource) {
        $this->datasource = $datasource;
        $this->logger = $logger;
    }
        
    public function setDatasourceKey($keyName) {
        $this->keyname = $keyName;
    }
    
    public abstract function query($queryType, AbstractModel $entity = null, $verb = null, $params = array());
}
